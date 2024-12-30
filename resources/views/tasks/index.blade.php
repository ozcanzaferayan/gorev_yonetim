@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-foreground">Görevler</h1>
        <a href="{{ route('tasks.create') }}">
            <x-ui.button>Yeni Görev</x-ui.button>
        </a>
    </div>

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
                                <div class="flex items-center justify-end space-x-3">
                                    <a href="{{ route('tasks.show', $task) }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200" title="Detay">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('tasks.edit', $task) }}" class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-200" title="Düzenle">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Bu görevi silmek istediğinizden emin misiniz?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-200" title="Sil">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
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