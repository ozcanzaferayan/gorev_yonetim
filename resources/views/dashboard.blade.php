@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
            </svg>
            <h1 class="text-2xl font-bold text-foreground">Dashboard</h1>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-card rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <h2 class="text-lg font-semibold">Görevler</h2>
                </div>
                <a href="{{ route('tasks.index') }}" class="text-sm text-primary hover:underline flex items-center space-x-1">
                    <span>Tümünü Gör</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            <div class="mt-4 space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-muted-foreground">Toplam</span>
                    <span class="text-2xl font-bold">{{ $totalTasks }}</span>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div class="bg-background rounded p-2 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-auto mb-1 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-xs text-muted-foreground block">{{ task_status_text('pending') }}</span>
                        <span class="text-lg font-semibold text-yellow-600">{{ $pendingTasks }}</span>
                    </div>
                    <div class="bg-background rounded p-2 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-auto mb-1 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        <span class="text-xs text-muted-foreground block">{{ task_status_text('in_progress') }}</span>
                        <span class="text-lg font-semibold text-blue-600">{{ $inProgressTasks }}</span>
                    </div>
                    <div class="bg-background rounded p-2 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-auto mb-1 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-xs text-muted-foreground block">{{ task_status_text('completed') }}</span>
                        <span class="text-lg font-semibold text-green-600">{{ $completedTasks }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-card rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <h2 class="text-lg font-semibold">Kullanıcılar</h2>
                </div>
                <a href="{{ route('users.index') }}" class="text-sm text-primary hover:underline flex items-center space-x-1">
                    <span>Tümünü Gör</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            <div class="mt-4 space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-muted-foreground">Toplam</span>
                    <span class="text-2xl font-bold">{{ $totalUsers }}</span>
                </div>
                <div class="space-y-2">
                    <div class="bg-background rounded p-2">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                </svg>
                                <span class="text-sm text-muted-foreground">En Çok Görevi Olan</span>
                            </div>
                            <span class="text-sm font-medium">{{ $userWithMostTasks->tasks_count ?? 0 }} görev</span>
                        </div>
                        @if($userWithMostTasks)
                            <div class="mt-1 ml-7">
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
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h2 class="text-lg font-semibold">Son Aktiviteler</h2>
                </div>
            </div>
            <div class="mt-4 space-y-4">
                @forelse($recentTasks as $task)
                    <div class="bg-background rounded p-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                <div>
                                    <span class="text-sm font-medium">{{ $task->title }}</span>
                                    <span class="text-xs text-muted-foreground block">{{ $task->user->name }}</span>
                                </div>
                            </div>
                            <span @class([
                                'px-2 py-1 text-xs rounded-full flex items-center space-x-1',
                                'bg-yellow-100 text-yellow-800' => $task->status === 'pending',
                                'bg-blue-100 text-blue-800' => $task->status === 'in_progress',
                                'bg-green-100 text-green-800' => $task->status === 'completed',
                            ])>
                                @if($task->status === 'pending')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                @elseif($task->status === 'in_progress')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                @endif
                                <span>{{ task_status_text($task->status) }}</span>
                            </span>
                        </div>
                        <div class="mt-2 flex items-center justify-between">
                            <span class="text-xs text-muted-foreground flex items-center space-x-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ $task->updated_at->diffForHumans() }}</span>
                            </span>
                            <a href="{{ route('tasks.show', $task) }}" class="text-xs text-primary hover:underline flex items-center space-x-1">
                                <span>Detay</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="flex items-center justify-center text-sm text-muted-foreground">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <span>Henüz görev bulunmamaktadır.</span>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-card rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <h2 class="text-lg font-semibold">Yaklaşan Görevler</h2>
                </div>
            </div>
            @if($upcomingTasks->isEmpty())
                <div class="flex items-center justify-center text-sm text-muted-foreground">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <span>Yaklaşan görev bulunmamaktadır.</span>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($upcomingTasks as $task)
                        <div class="flex items-center justify-between p-3 bg-background rounded">
                            <div class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                <div>
                                    <span class="text-sm font-medium">{{ $task->title }}</span>
                                    <div class="flex items-center space-x-2 mt-1">
                                        <span class="text-xs text-muted-foreground">{{ $task->user->name }}</span>
                                        <span class="text-xs text-muted-foreground">•</span>
                                        <span class="text-xs text-muted-foreground flex items-center space-x-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span>Son Tarih: {{ $task->due_date->format('d.m.Y') }}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span @class([
                                    'px-2 py-1 text-xs rounded-full flex items-center space-x-1',
                                    'bg-yellow-100 text-yellow-800' => $task->status === 'pending',
                                    'bg-blue-100 text-blue-800' => $task->status === 'in_progress',
                                    'bg-green-100 text-green-800' => $task->status === 'completed',
                                ])>
                                    @if($task->status === 'pending')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    @elseif($task->status === 'in_progress')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    @endif
                                    <span>{{ task_status_text($task->status) }}</span>
                                </span>
                                <a href="{{ route('tasks.show', $task) }}" class="text-sm text-primary hover:underline flex items-center space-x-1">
                                    <span>Detay</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="bg-card rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <h2 class="text-lg font-semibold">Kullanıcı Görev Dağılımı</h2>
                </div>
            </div>
            @if($userTaskDistribution->isEmpty())
                <div class="flex items-center justify-center text-sm text-muted-foreground">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <span>Henüz görev dağılımı bulunmamaktadır.</span>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($userTaskDistribution as $user)
                        <div class="flex items-center justify-between p-3 bg-background rounded">
                            <div class="flex items-center space-x-2">
                                <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="h-8 w-8 rounded-full">
                                <div>
                                    <span class="text-sm font-medium">{{ $user->name }}</span>
                                    <span class="text-xs text-muted-foreground block">{{ $user->email }}</span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="text-right flex items-center space-x-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <div>
                                        <span class="text-sm font-medium">{{ $user->tasks_count }}</span>
                                        <span class="text-xs text-muted-foreground block">Görev</span>
                                    </div>
                                </div>
                                <a href="{{ route('users.show', $user) }}" class="text-sm text-primary hover:underline flex items-center space-x-1">
                                    <span>Detay</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
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
