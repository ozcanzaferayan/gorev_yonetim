@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-foreground">Kullanıcı Detayları</h1>
        <div class="flex items-center space-x-2">
            <a href="{{ route('users.edit', $user) }}">
                <x-ui.button variant="outline">Düzenle</x-ui.button>
            </a>
            <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline"
                onsubmit="return confirm('Bu kullanıcıyı silmek istediğinizden emin misiniz?');">
                @csrf
                @method('DELETE')
                <x-ui.button variant="destructive" type="submit">Sil</x-ui.button>
            </form>
            <a href="{{ route('users.index') }}">
                <x-ui.button variant="outline">Geri Dön</x-ui.button>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-card rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Kullanıcı Bilgileri</h2>
            <dl class="space-y-4">
                <div>
                    <dt class="text-sm font-medium text-muted-foreground">Ad Soyad</dt>
                    <dd class="mt-1 text-sm text-foreground">{{ $user->name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-muted-foreground">Email</dt>
                    <dd class="mt-1 text-sm text-foreground">{{ $user->email }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-muted-foreground">Kayıt Tarihi</dt>
                    <dd class="mt-1 text-sm text-foreground">{{ $user->created_at->format('d.m.Y H:i') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-muted-foreground">Son Güncelleme</dt>
                    <dd class="mt-1 text-sm text-foreground">{{ $user->updated_at->format('d.m.Y H:i') }}</dd>
                </div>
            </dl>
        </div>

        <div class="bg-card rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold">Görevler</h2>
                <span class="text-sm text-muted-foreground">Toplam: {{ $user->tasks->count() }}</span>
            </div>
            @if($user->tasks->isEmpty())
                <p class="text-sm text-muted-foreground">Bu kullanıcıya atanmış görev bulunmamaktadır.</p>
            @else
                <div class="space-y-4">
                    @foreach($user->tasks as $task)
                        <div class="flex items-center justify-between p-3 bg-background rounded-lg">
                            <div>
                                <h3 class="text-sm font-medium text-foreground">{{ $task->title }}</h3>
                                <p class="text-xs text-muted-foreground">Son Tarih: {{ $task->due_date ? $task->due_date->format('d.m.Y') : 'Belirtilmemiş' }}</p>
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
    </div>
</div>
@endsection 