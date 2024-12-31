<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-bind:class="{ 'dark': darkMode }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="h-full font-sans antialiased bg-background text-foreground">
        <div class="min-h-full">
            <!-- Navigation -->
            <nav class="border-b border-border bg-card" x-data="{ mobileMenuOpen: false }">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 justify-between">
                        <div class="flex">
                            <div class="flex flex-shrink-0 items-center">
                                <a href="{{ route('dashboard') }}" class="text-xl font-bold text-foreground">
                                    {{ config('app.name', 'Laravel') }}
                                </a>
                            </div>
                            <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                                <a href="{{ route('dashboard') }}"
                                    class="{{ request()->routeIs('dashboard') ? 'border-primary' : 'border-transparent' }} inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium text-foreground">
                                    Dashboard
                                </a>
                                <a href="{{ route('tasks.index') }}"
                                    class="{{ request()->routeIs('tasks.*') ? 'border-primary' : 'border-transparent' }} inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium text-foreground">
                                    Görevler
                                </a>
                                <a href="{{ route('users.index') }}"
                                    class="{{ request()->routeIs('users.*') ? 'border-primary' : 'border-transparent' }} inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium text-foreground">
                                    Kullanıcılar
                                </a>
                            </div>
                        </div>
                        <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-4">
                            <!-- Theme Toggle Button -->
                            <button type="button" 
                                x-on:click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)"
                                class="rounded-md p-2 text-muted-foreground hover:bg-accent hover:text-accent-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                                <svg x-show="!darkMode" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                                </svg>
                                <svg x-show="darkMode" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </button>

                            <!-- User Dropdown -->
                            <div class="relative ml-3" x-data="{ open: false }">
                                <div>
                                    <button type="button"
                                        @click="open = !open"
                                        class="flex rounded-full bg-background text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
                                        id="user-menu-button" 
                                        aria-expanded="false" 
                                        aria-haspopup="true">
                                        <span class="sr-only">Kullanıcı menüsünü aç</span>
                                        @if(Auth::user()->avatar_url)
                                            <img class="h-8 w-8 rounded-full" src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}">
                                        @else
                                            <div class="h-8 w-8 rounded-full bg-primary/10 flex items-center justify-center">
                                                <span class="text-sm font-medium text-primary">
                                                    {{ substr(Auth::user()->name, 0, 2) }}
                                                </span>
                                            </div>
                                        @endif
                                    </button>
                                </div>

                                <!-- Dropdown menu -->
                                <div x-show="open" 
                                    @click.away="open = false"
                                    x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95"
                                    class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-card py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    role="menu" 
                                    aria-orientation="vertical" 
                                    aria-labelledby="user-menu-button" 
                                    tabindex="-1">
                                    <div class="px-4 py-2 text-sm text-muted-foreground border-b border-border">
                                        <div class="font-medium text-foreground">{{ Auth::user()->name }}</div>
                                        <div class="text-xs">{{ Auth::user()->email }}</div>
                                    </div>
                                    <form method="POST" action="{{ route('logout') }}" role="none">
                                        @csrf
                                        <button type="submit"
                                            class="w-full text-left px-4 py-2 text-sm text-foreground hover:bg-accent hover:text-accent-foreground"
                                            role="menuitem" 
                                            tabindex="-1">
                                            Çıkış Yap
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="-mr-2 flex items-center sm:hidden">
                            <!-- Mobile menu button -->
                            <button type="button"
                                @click="mobileMenuOpen = !mobileMenuOpen"
                                class="inline-flex items-center justify-center rounded-md p-2 text-muted-foreground hover:bg-accent hover:text-accent-foreground focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary"
                                aria-controls="mobile-menu" 
                                :aria-expanded="mobileMenuOpen">
                                <span class="sr-only">Ana menüyü aç</span>
                                <svg 
                                    x-show="!mobileMenuOpen"
                                    class="h-6 w-6" 
                                    fill="none" 
                                    viewBox="0 0 24 24" 
                                    stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                                <svg 
                                    x-show="mobileMenuOpen" 
                                    class="h-6 w-6" 
                                    fill="none" 
                                    viewBox="0 0 24 24" 
                                    stroke-width="1.5" 
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Mobile menu -->
                <div class="sm:hidden" id="mobile-menu" x-show="mobileMenuOpen" 
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 -translate-y-1"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 -translate-y-1">
                    <div class="space-y-1 pb-3 pt-2">
                        <a href="{{ route('dashboard') }}"
                            class="{{ request()->routeIs('dashboard') ? 'bg-primary/10 border-primary text-primary' : 'border-transparent text-foreground' }} block border-l-4 py-2 pl-3 pr-4 text-base font-medium">
                            Dashboard
                        </a>
                        <a href="{{ route('tasks.index') }}"
                            class="{{ request()->routeIs('tasks.*') ? 'bg-primary/10 border-primary text-primary' : 'border-transparent text-foreground' }} block border-l-4 py-2 pl-3 pr-4 text-base font-medium">
                            Görevler
                        </a>
                        <a href="{{ route('users.index') }}"
                            class="{{ request()->routeIs('users.*') ? 'bg-primary/10 border-primary text-primary' : 'border-transparent text-foreground' }} block border-l-4 py-2 pl-3 pr-4 text-base font-medium">
                            Kullanıcılar
                        </a>
                    </div>
                    <div class="border-t border-border pb-3 pt-4">
                        <div class="flex items-center justify-between px-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    @if(Auth::user()->avatar_url)
                                        <img class="h-10 w-10 rounded-full" src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}">
                                    @else
                                        <div class="h-10 w-10 rounded-full bg-primary/10 flex items-center justify-center">
                                            <span class="text-sm font-medium text-primary">
                                                {{ substr(Auth::user()->name, 0, 2) }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-3">
                                    <div class="text-base font-medium text-foreground">{{ Auth::user()->name }}</div>
                                    <div class="text-sm font-medium text-muted-foreground">{{ Auth::user()->email }}</div>
                                </div>
                            </div>
                            <!-- Theme Toggle Button (Mobile) -->
                            <button type="button" 
                                x-on:click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)"
                                class="rounded-md p-2 text-muted-foreground hover:bg-accent hover:text-accent-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                                <svg x-show="!darkMode" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                                </svg>
                                <svg x-show="darkMode" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </button>
                        </div>
                        <div class="mt-3 space-y-1 px-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block w-full rounded-md px-3 py-2 text-base font-medium text-foreground hover:bg-accent hover:text-accent-foreground">
                                    Çıkış Yap
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>

            <main>
                <div class="py-6 px-6">
                    @yield('content')
                </div>
            </main>
        </div>

        @if(session('success'))
            <div x-data="{ show: true }" 
                x-show="show" 
                x-init="setTimeout(() => show = false, 3000)"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform translate-x-full"
                x-transition:enter-end="opacity-100 transform translate-x-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 transform translate-x-0"
                x-transition:leave-end="opacity-0 transform translate-x-full"
                class="fixed bottom-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded"
                role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div x-data="{ show: true }" 
                x-show="show" 
                x-init="setTimeout(() => show = false, 3000)"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform translate-x-full"
                x-transition:enter-end="opacity-100 transform translate-x-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 transform translate-x-0"
                x-transition:leave-end="opacity-0 transform translate-x-full"
                class="fixed bottom-4 right-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded"
                role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif
    </body>
</html>
