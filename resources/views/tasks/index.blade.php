@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-foreground">Görevler</h1>
        <a href="{{ route('tasks.create') }}">
            <x-ui.button>Yeni Görev</x-ui.button>
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-card rounded-lg shadow overflow-hidden">
        <div class="p-6">
            <form action="{{ route('tasks.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-foreground">Arama</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                        class="mt-1 block w-full rounded-md border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                        placeholder="Görev başlığı...">
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-foreground">Durum</label>
                    <select name="status" id="status"
                        class="mt-1 block w-full rounded-md border-input bg-background px-3 py-2 text-sm ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2">
                        <option value="">Tümü</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Bekliyor</option>
                        <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>Devam Ediyor</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Tamamlandı</option>
                    </select>
                </div>
                <div>
                    <label for="user_id" class="block text-sm font-medium text-foreground">Atanan Kullanıcı</label>
                    <select name="user_id" id="user_id"
                        class="mt-1 block w-full rounded-md border-input bg-background px-3 py-2 text-sm ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2">
                        <option value="">Tümü</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end">
                    <x-ui.button type="submit" class="w-full">Filtrele</x-ui.button>
                </div>
            </form>
        </div>

        <div class="border-t border-border">
            <table class="min-w-full divide-y divide-border">
                <thead class="bg-muted">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                            Başlık
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                            Durum
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                            Atanan
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                            Son Tarih
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-muted-foreground uppercase tracking-wider">
                            İşlemler
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-background divide-y divide-border">
                    @forelse($tasks as $task)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-foreground">{{ $task->title }}</div>
                                <div class="text-sm text-muted-foreground">{{ Str::limit($task->description, 50) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span @class([
                                    'px-2 py-1 text-xs rounded-full',
                                    'bg-yellow-100 text-yellow-800' => $task->status === 'pending',
                                    'bg-blue-100 text-blue-800' => $task->status === 'in_progress',
                                    'bg-green-100 text-green-800' => $task->status === 'completed',
                                ])>
                                    {{ task_status_text($task->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-foreground">{{ $task->user->name }}</div>
                                <div class="text-xs text-muted-foreground">{{ $task->user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-foreground">
                                {{ $task->due_date ? $task->due_date->format('d.m.Y') : 'Belirtilmemiş' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('tasks.show', $task) }}" class="text-primary hover:text-primary/80">
                                        Detay
                                    </a>
                                    <a href="{{ route('tasks.edit', $task) }}" class="text-primary hover:text-primary/80">
                                        Düzenle
                                    </a>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Bu görevi silmek istediğinizden emin misiniz?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-destructive hover:text-destructive/80">
                                            Sil
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-muted-foreground text-center">
                                Görev bulunamadı.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($tasks->hasPages())
            <div class="px-6 py-4 border-t border-border">
                {{ $tasks->withQueryString()->links() }}
            </div>
        @endif
    </div>
</div>
@endsection 