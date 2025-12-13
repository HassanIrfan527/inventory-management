<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ env('APP_NAME') }}</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="bg-[#FDFDFC] dark:bg-zinc-950 text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <div class="max-w-2xl w-full text-center space-y-6">
            <h1 class="text-4xl font-semibold">Welcome to {{ env('APP_NAME') }}</h1>
            <p class="text-lg text-neutral-600 dark:text-neutral-400">This is an Inventory management system</p>

            @auth

            <a href="{{ route('dashboard') }}" class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Go to Dashboard</a>
            @endauth
            @guest
            <div class="flex gap-4 justify-center flex-wrap">
                <a href="{{ route('login') }}" class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Login</a>
                <a href="{{ route('register') }}" class="inline-block px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">Register</a>
            </div>
            @endguest
        </div>
    </body>
</html>
