<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  @class(['dark' => ($appearance ?? 'system') == 'dark'])>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Inline script to detect system dark mode preference and apply it immediately --}}
        <script>
            (function() {
                const appearance = '{{ $appearance ?? "system" }}';

                if (appearance === 'system') {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                    if (prefersDark) {
                        document.documentElement.classList.add('dark');
                    }
                }
            })();
        </script>

        {{-- Inline style to set the HTML background color based on our theme in app.css --}}
        <style>
            html {
                background-color: oklch(1 0 0);
            }

            html.dark {
                background-color: oklch(0.145 0 0);
            }
        </style>

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        @vite(['resources/js/app.ts', "resources/js/pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased bg-gradient-to-br from-blue-50 to-emerald-50 text-gray-800 dark:from-gray-900 dark:to-gray-800 dark:text-gray-200">
        @inertia
        
        {{-- Footer minimal avec liens légaux visibles sur toutes les pages --}}
        <footer class="w-full text-center text-sm text-gray-600 dark:text-gray-400 mt-8 p-4">
            <div class="max-w-4xl mx-auto">
                <a href="{{ url('/legal') }}" class="underline mr-3 hover:text-blue-600 dark:hover:text-blue-400">Mentions légales</a>
                <a href="{{ url('/privacy') }}" class="underline mr-3 hover:text-emerald-600 dark:hover:text-emerald-400">Politique de confidentialité</a>
                <a href="{{ url('/cgu') }}" class="underline hover:text-orange-600 dark:hover:text-orange-400">CGU</a>
            </div>
        </footer>
    </body>
</html>