@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-foreground">Kullanıcılar</h1>
        <a href="{{ route('users.create') }}">
            <x-ui.button>Yeni Kullanıcı Ekle</x-ui.button>
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
                        <th class="px-4 py-3 text-left text-sm font-medium text-muted-foreground">Ad Soyad</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-muted-foreground">Email</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-muted-foreground">Görev Sayısı</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-muted-foreground">Kayıt Tarihi</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-muted-foreground">İşlemler</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse ($users as $user)
                        <tr>
                            <td class="px-4 py-3 text-sm">{{ $user->name }}</td>
                            <td class="px-4 py-3 text-sm">{{ $user->email }}</td>
                            <td class="px-4 py-3 text-sm">{{ $user->tasks_count }}</td>
                            <td class="px-4 py-3 text-sm">{{ $user->created_at->format('d.m.Y') }}</td>
                            <td class="px-4 py-3 text-sm">
                                <div class="flex space-x-2">
                                    <a href="{{ route('users.show', $user) }}">
                                        <x-ui.button variant="ghost" size="sm">Görüntüle</x-ui.button>
                                    </a>
                                    <a href="{{ route('users.edit', $user) }}">
                                        <x-ui.button variant="ghost" size="sm">Düzenle</x-ui.button>
                                    </a>
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <x-ui.button variant="destructive" size="sm" type="submit" 
                                            onclick="return confirm('Bu kullanıcıyı silmek istediğinizden emin misiniz?')">
                                            Sil
                                        </x-ui.button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-3 text-sm text-center text-muted-foreground">
                                Henüz kullanıcı bulunmuyor.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-border">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection 