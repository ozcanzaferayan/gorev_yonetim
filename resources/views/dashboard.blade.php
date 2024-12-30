@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-foreground">Dashboard</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Toplam Görev Sayısı -->
        <div class="bg-card rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-card-foreground">Toplam Görev</h3>
            <p class="mt-2 text-3xl font-bold text-primary">{{ App\Models\Task::count() }}</p>
        </div>

        <!-- Tamamlanan Görevler -->
        <div class="bg-card rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-card-foreground">Tamamlanan Görevler</h3>
            <p class="mt-2 text-3xl font-bold text-green-600">
                {{ App\Models\Task::where('status', 'completed')->count() }}
            </p>
        </div>

        <!-- Bekleyen Görevler -->
        <div class="bg-card rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-card-foreground">Bekleyen Görevler</h3>
            <p class="mt-2 text-3xl font-bold text-blue-600">
                {{ App\Models\Task::where('status', 'pending')->count() }}
            </p>
        </div>
    </div>

    <!-- Son Eklenen Görevler -->
    <div class="bg-card rounded-lg shadow">
        <div class="p-6">
            <h2 class="text-lg font-medium text-card-foreground">Son Eklenen Görevler</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-muted">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-medium text-muted-foreground">Başlık</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-muted-foreground">Durum</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-muted-foreground">Atanan Kişi</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-muted-foreground">Bitiş Tarihi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @foreach(App\Models\Task::with('user')->latest()->take(5)->get() as $task)
                        <tr>
                            <td class="px-4 py-3 text-sm">
                                <a href="{{ route('tasks.show', $task) }}" class="hover:text-primary">
                                    {{ $task->title }}
                                </a>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <span class="px-2 py-1 text-xs rounded-full
                                    @if($task->status === 'completed') bg-green-100 text-green-800
                                    @elseif($task->status === 'in_progress') bg-blue-100 text-blue-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm">{{ $task->user->name }}</td>
                            <td class="px-4 py-3 text-sm">{{ $task->due_date?->format('d.m.Y') ?? 'Belirtilmemiş' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 