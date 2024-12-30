<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Görev Yönetim') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-background min-h-screen">
    @include('layouts.partials.header')
    
    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>

    @include('layouts.partials.footer')
</body>
</html> 