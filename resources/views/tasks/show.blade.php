@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-foreground">Görev Detayları</h1>
        <div class="flex items-center space-x-2">
            <a href="{{ route('tasks.edit', $task) }}">
                <x-ui.button variant="outline">Düzenle</x-ui.button>
            </a>
            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline"
                onsubmit="return confirm('Bu görevi silmek istediğinizden emin misiniz?');">
                @csrf
                @method('DELETE')
                <x-ui.button variant="destructive" type="submit">Sil</x-ui.button>
            </form>
            <a href="{{ route('tasks.index') }}">
                <x-ui.button variant="outline">Geri Dön</x-ui.button>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-card rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Görev Bilgileri</h2>
            <dl class="space-y-4">
                <div>
                    <dt class="text-sm font-medium text-muted-foreground">Başlık</dt>
                    <dd class="mt-1 text-sm text-foreground">{{ $task->title }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-muted-foreground">Açıklama</dt>
                    <dd class="mt-1 text-sm text-foreground whitespace-pre-wrap">{{ $task->description }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-muted-foreground">Durum</dt>
                    <dd class="mt-1">
                        <span @class([
                            'px-2 py-1 text-xs rounded-full',
                            'bg-yellow-100 text-yellow-800' => $task->status === 'pending',
                            'bg-blue-100 text-blue-800' => $task->status === 'in_progress',
                            'bg-green-100 text-green-800' => $task->status === 'completed',
                        ])>
                            {{ task_status_text($task->status) }}
                        </span>
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-muted-foreground">Son Tarih</dt>
                    <dd class="mt-1 text-sm text-foreground">
                        {{ $task->due_date ? $task->due_date->format('d.m.Y') : 'Belirtilmemiş' }}
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-muted-foreground">Oluşturulma Tarihi</dt>
                    <dd class="mt-1 text-sm text-foreground">{{ $task->created_at->format('d.m.Y H:i') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-muted-foreground">Son Güncelleme</dt>
                    <dd class="mt-1 text-sm text-foreground">{{ $task->updated_at->format('d.m.Y H:i') }}</dd>
                </div>
            </dl>
        </div>

        <div class="bg-card rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Atanan Kullanıcı</h2>
            <div class="space-y-4">
                <div>
                    <dt class="text-sm font-medium text-muted-foreground">Ad Soyad</dt>
                    <dd class="mt-1 text-sm text-foreground">{{ $task->user->name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-muted-foreground">Email</dt>
                    <dd class="mt-1 text-sm text-foreground">{{ $task->user->email }}</dd>
                </div>
                <div class="pt-4">
                    <dt class="text-sm font-medium text-muted-foreground">Diğer Görevleri</dt>
                    <dd class="mt-2">
                        @if($task->user->tasks->where('id', '!=', $task->id)->isEmpty())
                            <p class="text-sm text-muted-foreground">Bu kullanıcının başka görevi bulunmamaktadır.</p>
                        @else
                            <div class="space-y-2">
                                @foreach($task->user->tasks->where('id', '!=', $task->id) as $otherTask)
                                    <div class="flex items-center justify-between p-2 bg-background rounded">
                                        <div class="flex items-center space-x-2">
                                            <span @class([
                                                'w-2 h-2 rounded-full',
                                                'bg-yellow-400' => $otherTask->status === 'pending',
                                                'bg-blue-400' => $otherTask->status === 'in_progress',
                                                'bg-green-400' => $otherTask->status === 'completed',
                                            ])></span>
                                            <span class="text-sm text-foreground">{{ $otherTask->title }}</span>
                                        </div>
                                        <a href="{{ route('tasks.show', $otherTask) }}" class="text-sm text-primary hover:underline">
                                            Detay
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </dd>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 