<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SisaRasa') }}</title>
        <link rel="icon" type="image/svg+xml" href="/favicon.svg">

        @fonts

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-[var(--ink)] antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[var(--paper)]">
            <a href="/" class="flex items-center gap-2 font-semibold text-xl text-[var(--ink)]">
                <x-application-logo class="w-9 h-9" />
                SisaRasa
            </a>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-[var(--paper-card)] border border-[var(--line)] shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
