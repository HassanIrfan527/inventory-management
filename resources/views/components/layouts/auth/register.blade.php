<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
        {{-- Decorative Background --}}
        <div class="fixed inset-0 -z-10 overflow-hidden" aria-hidden="true">
            <div class="absolute -top-40 -right-40 h-80 w-80 rounded-full bg-emerald-500/5 blur-3xl"></div>
            <div class="absolute -bottom-40 -left-40 h-80 w-80 rounded-full bg-teal-500/5 blur-3xl"></div>
        </div>

        {{ $slot }}

        @fluxScripts
    </body>
</html>
