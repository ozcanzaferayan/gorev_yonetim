@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-foreground">Dashboard</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-card rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold">Görevler</h2>
                <a href="{{ route('tasks.index') }}" class="text-sm text-primary hover:underline">Tümünü Gör</a>
            </div>
            <div class="mt-4 space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-muted-foreground">Toplam</span>
                    <span class="text-2xl font-bold">{{ $totalTasks }}</span>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div class="bg-background rounded p-2 text-center">
                        <span class="text-xs text-muted-foreground block">Bekliyor</span>
                        <span class="text-lg font-semibold text-yellow-600">{{ $pendingTasks }}</span>
                    </div>
                    <div class="bg-background rounded p-2 text-center">
                        <span class="text-xs text-muted-foreground block">Devam Ediyor</span>
                        <span class="text-lg font-semibold text-blue-600">{{ $inProgressTasks }}</span>
                    </div>
                    <div class="bg-background rounded p-2 text-center">
                        <span class="text-xs text-muted-foreground block">Tamamlandı</span>
                        <span class="text-lg font-semibold text-green-600">{{ $completedTasks }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-card rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold">Kullanıcılar</h2>
                <a href="{{ route('users.index') }}" class="text-sm text-primary hover:underline">Tümünü Gör</a>
            </div>
            <div class="mt-4 space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-muted-foreground">Toplam</span>
                    <span class="text-2xl font-bold">{{ $totalUsers }}</span>
                </div>
                <div class="space-y-2">
                    <div class="bg-background rounded p-2">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-muted-foreground">En Çok Görevi Olan</span>
                            <span class="text-sm font-medium">{{ $userWithMostTasks->tasks_count ?? 0 }} görev</span>
                        </div>
                        @if($userWithMostTasks)
                            <div class="mt-1">
                                <span class="text-sm font-medium">{{ $userWithMostTasks->name }}</span>
                                <span class="text-xs text-muted-foreground block">{{ $userWithMostTasks->email }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-card rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold">Son Aktiviteler</h2>
            </div>
            <div class="mt-4 space-y-4">
                @forelse($recentTasks as $task)
                    <div class="bg-background rounded p-3">
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-sm font-medium">{{ $task->title }}</span>
                                <span class="text-xs text-muted-foreground block">{{ $task->user->name }}</span>
                            </div>
                            <span @class([
                                'px-2 py-1 text-xs rounded-full',
                                'bg-yellow-100 text-yellow-800' => $task->status === 'pending',
                                'bg-blue-100 text-blue-800' => $task->status === 'in_progress',
                                'bg-green-100 text-green-800' => $task->status === 'completed',
                            ])>
                                {{ ucfirst($task->status) }}
                            </span>
                        </div>
                        <div class="mt-2 flex items-center justify-between">
                            <span class="text-xs text-muted-foreground">
                                {{ $task->updated_at->diffForHumans() }}
                            </span>
                            <a href="{{ route('tasks.show', $task) }}" class="text-xs text-primary hover:underline">
                                Detay
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-muted-foreground">Henüz görev bulunmamaktadır.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-card rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold">Yaklaşan Görevler</h2>
            </div>
            @if($upcomingTasks->isEmpty())
                <p class="text-sm text-muted-foreground">Yaklaşan görev bulunmamaktadır.</p>
            @else
                <div class="space-y-4">
                    @foreach($upcomingTasks as $task)
                        <div class="flex items-center justify-between p-3 bg-background rounded">
                            <div>
                                <span class="text-sm font-medium">{{ $task->title }}</span>
                                <div class="flex items-center space-x-2 mt-1">
                                    <span class="text-xs text-muted-foreground">{{ $task->user->name }}</span>
                                    <span class="text-xs text-muted-foreground">•</span>
                                    <span class="text-xs text-muted-foreground">
                                        Son Tarih: {{ $task->due_date->format('d.m.Y') }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span @class([
                                    'px-2 py-1 text-xs rounded-full',
                                    'bg-yellow-100 text-yellow-800' => $task->status === 'pending',
                                    'bg-blue-100 text-blue-800' => $task->status === 'in_progress',
                                    'bg-green-100 text-green-800' => $task->status === 'completed',
                                ])>
                                    {{ ucfirst($task->status) }}
                                </span>
                                <a href="{{ route('tasks.show', $task) }}" class="text-sm text-primary hover:underline">
                                    Detay
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="bg-card rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold">Kullanıcı Görev Dağılımı</h2>
            </div>
            @if($userTaskDistribution->isEmpty())
                <p class="text-sm text-muted-foreground">Henüz görev dağılımı bulunmamaktadır.</p>
            @else
                <div class="space-y-4">
                    @foreach($userTaskDistribution as $user)
                        <div class="flex items-center justify-between p-3 bg-background rounded">
                            <div>
                                <span class="text-sm font-medium">{{ $user->name }}</span>
                                <span class="text-xs text-muted-foreground block">{{ $user->email }}</span>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="text-right">
                                    <span class="text-sm font-medium">{{ $user->tasks_count }}</span>
                                    <span class="text-xs text-muted-foreground block">Görev</span>
                                </div>
                                <a href="{{ route('users.show', $user) }}" class="text-sm text-primary hover:underline">
                                    Detay
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
