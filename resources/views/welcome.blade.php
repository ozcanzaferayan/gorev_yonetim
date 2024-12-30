<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="relative min-h-screen bg-background">
            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                <div class="flex flex-col items-center justify-center space-y-4">
                    <h1 class="text-4xl font-bold text-foreground">Shadcn UI in Laravel</h1>
                    
                    <div class="flex flex-wrap gap-4 justify-center">
                        <x-ui.button>Default Button</x-ui.button>
                        <x-ui.button variant="secondary">Secondary Button</x-ui.button>
                        <x-ui.button variant="destructive">Destructive Button</x-ui.button>
                        <x-ui.button variant="outline">Outline Button</x-ui.button>
                        <x-ui.button variant="ghost">Ghost Button</x-ui.button>
                        <x-ui.button variant="link">Link Button</x-ui.button>
                    </div>

                    <div class="flex flex-wrap gap-4 justify-center mt-8">
                        <x-ui.button size="sm">Small Button</x-ui.button>
                        <x-ui.button size="default">Default Size</x-ui.button>
                        <x-ui.button size="lg">Large Button</x-ui.button>
                    </div>

                    <div class="mt-8 p-6 bg-card rounded-lg shadow-lg">
                        <h2 class="text-2xl font-semibold text-card-foreground mb-4">Card Example</h2>
                        <p class="text-muted-foreground">This is an example of using Shadcn's color tokens in a card component.</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
