<header class="bg-card shadow">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="text-2xl font-bold text-foreground">
                    {{ config('app.name', 'Görev Yönetim') }}
                </a>
            </div>
            
            <nav class="flex space-x-4">
                <a href="{{ route('dashboard') }}" class="text-muted-foreground hover:text-foreground">Dashboard</a>
                <a href="{{ route('tasks.index') }}" class="text-muted-foreground hover:text-foreground">Görevler</a>
                <a href="{{ route('users.index') }}" class="text-muted-foreground hover:text-foreground">Kullanıcılar</a>
            </nav>

            <div class="flex items-center space-x-4">
                @auth
                    <span class="text-sm text-muted-foreground">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-ui.button variant="ghost" type="submit">Çıkış Yap</x-ui.button>
                    </form>
                @else
                    <a href="{{ route('login') }}">
                        <x-ui.button variant="ghost">Giriş Yap</x-ui.button>
                    </a>
                    <a href="{{ route('register') }}">
                        <x-ui.button>Kayıt Ol</x-ui.button>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header> 