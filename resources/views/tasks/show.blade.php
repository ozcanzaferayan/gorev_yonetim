@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-foreground">Görev Detayı</h1>
        <div class="flex space-x-2">
            <a href="{{ route('tasks.edit', $task) }}">
                <x-ui.button>Düzenle</x-ui.button>
            </a>
            <a href="{{ route('tasks.index') }}">
                <x-ui.button variant="outline">Geri Dön</x-ui.button>
            </a>
        </div>
    </div>

    <div class="bg-card rounded-lg shadow p-6 space-y-4">
        <div>
            <h3 class="text-sm font-medium text-muted-foreground">Başlık</h3>
            <p class="mt-1 text-foreground">{{ $task->title }}</p>
        </div>

        <div>
            <h3 class="text-sm font-medium text-muted-foreground">Açıklama</h3>
            <p class="mt-1 text-foreground">{{ $task->description ?? 'Açıklama bulunmuyor.' }}</p>
        </div>

        <div>
            <h3 class="text-sm font-medium text-muted-foreground">Durum</h3>
            <span class="mt-1 inline-block px-2 py-1 text-xs rounded-full
                @if($task->status === 'completed') bg-green-100 text-green-800
                @elseif($task->status === 'in_progress') bg-blue-100 text-blue-800
                @else bg-gray-100 text-gray-800
                @endif">
                {{ ucfirst(str_replace('_', ' ', $task->status)) }}
            </span>
        </div>

        <div>
            <h3 class="text-sm font-medium text-muted-foreground">Atanan Kişi</h3>
            <p class="mt-1 text-foreground">{{ $task->user->name }}</p>
        </div>

        <div>
            <h3 class="text-sm font-medium text-muted-foreground">Bitiş Tarihi</h3>
            <p class="mt-1 text-foreground">{{ $task->due_date?->format('d.m.Y') ?? 'Belirtilmemiş' }}</p>
        </div>

        <div>
            <h3 class="text-sm font-medium text-muted-foreground">Oluşturulma Tarihi</h3>
            <p class="mt-1 text-foreground">{{ $task->created_at->format('d.m.Y H:i') }}</p>
        </div>

        <div>
            <h3 class="text-sm font-medium text-muted-foreground">Son Güncelleme</h3>
            <p class="mt-1 text-foreground">{{ $task->updated_at->format('d.m.Y H:i') }}</p>
        </div>

        <div class="pt-4 border-t border-border">
            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="flex justify-end">
                @csrf
                @method('DELETE')
                <x-ui.button variant="destructive" type="submit"
                    onclick="return confirm('Bu görevi silmek istediğinizden emin misiniz?')">
                    Görevi Sil
                </x-ui.button>
            </form>
        </div>
    </div>
</div>
@endsection 