@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-foreground">Görevler</h1>
        <a href="{{ route('tasks.create') }}">
            <x-ui.button>Yeni Görev Ekle</x-ui.button>
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-card rounded-lg shadow">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-muted">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-medium text-muted-foreground">Başlık</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-muted-foreground">Durum</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-muted-foreground">Atanan Kişi</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-muted-foreground">Bitiş Tarihi</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-muted-foreground">İşlemler</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse ($tasks as $task)
                        <tr>
                            <td class="px-4 py-3 text-sm">{{ $task->title }}</td>
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
                            <td class="px-4 py-3 text-sm">{{ $task->due_date?->format('d.m.Y') }}</td>
                            <td class="px-4 py-3 text-sm">
                                <div class="flex space-x-2">
                                    <a href="{{ route('tasks.show', $task) }}">
                                        <x-ui.button variant="ghost" size="sm">Görüntüle</x-ui.button>
                                    </a>
                                    <a href="{{ route('tasks.edit', $task) }}">
                                        <x-ui.button variant="ghost" size="sm">Düzenle</x-ui.button>
                                    </a>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <x-ui.button variant="destructive" size="sm" type="submit" 
                                            onclick="return confirm('Bu görevi silmek istediğinizden emin misiniz?')">
                                            Sil
                                        </x-ui.button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-3 text-sm text-center text-muted-foreground">
                                Henüz görev bulunmuyor.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-border">
            {{ $tasks->links() }}
        </div>
    </div>
</div>
@endsection 