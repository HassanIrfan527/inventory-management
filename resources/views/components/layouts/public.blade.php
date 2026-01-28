<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name', 'Kinetic Hub') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxStyles
</head>
<body class="bg-white dark:bg-zinc-950 text-zinc-900 dark:text-zinc-100 antialiased font-sans min-h-screen flex flex-col selection:bg-blue-100 selection:text-blue-900 dark:selection:bg-blue-900 dark:selection:text-blue-100">

    <!-- Header / Navbar -->
    <header class="w-full border-b border-zinc-200/50 dark:border-zinc-800/50 bg-white/70 dark:bg-zinc-950/70 backdrop-blur-xl sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-2">
                    <a href="{{ route('home') }}" class="flex items-center gap-2.5 font-bold text-2xl tracking-tight text-zinc-900 dark:text-white group">
                        <x-app-logo class="h-9 w-auto fill-blue-600 dark:fill-blue-500 group-hover:scale-110 transition-transform" />
                        Kinetic Hub
                    </a>
                </div>

                <!-- Desktop Menu -->
                <nav class="hidden md:flex items-center space-x-1">
                    <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">Home</x-nav-link>
                    <x-nav-link href="#features">Features</x-nav-link>
                    <x-nav-link href="{{ route('contact.us') }}" :active="request()->routeIs('contact.us')">Contact</x-nav-link>
                </nav>

                <!-- CTA -->
                <div class="hidden md:flex items-center gap-6">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-zinc-600 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white transition-colors">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-zinc-600 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white transition-colors">Log in</a>
                        <flux:button href="{{ route('register') }}" variant="primary" size="sm" class="px-5 py-2.5 shadow-lg shadow-blue-500/20">
                            Get Started
                        </flux:button>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="-mr-2 flex items-center md:hidden">
                     <flux:dropdown px="4">
                        <flux:button icon="bars-3" variant="ghost" />

                        <flux:menu class="min-w-48">
                            <flux:menu.item href="{{ route('home') }}" icon="home">Home</flux:menu.item>
                            <flux:menu.item href="#features" icon="sparkles">Features</flux:menu.item>
                            <flux:menu.item href="{{ route('contact.us') }}" icon="envelope">Contact</flux:menu.item>
                            <flux:menu.separator />
                             @auth
                                <flux:menu.item href="{{ route('dashboard') }}" icon="squares-2x2">Dashboard</flux:menu.item>
                            @else
                                <flux:menu.item href="{{ route('login') }}" icon="arrow-right-start-on-rectangle">Log in</flux:menu.item>
                                <flux:menu.item href="{{ route('register') }}">Register</flux:menu.item>
                            @endauth
                        </flux:menu>
                    </flux:dropdown>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-zinc-50 dark:bg-zinc-900/50 border-t border-zinc-200 dark:border-zinc-800 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 lg:gap-8">
                <div class="col-span-1 md:col-span-5">
                    <div class="flex items-center gap-2.5 font-bold text-2xl tracking-tight text-zinc-900 dark:text-white mb-6">
                        <x-app-logo class="h-8 w-auto fill-blue-600 dark:fill-blue-500" />
                        Kinetic Hub
                    </div>
                    <p class="text-zinc-600 dark:text-zinc-400 text-base leading-relaxed max-w-sm">
                        The all-in-one intelligent business operating system designed for clarity, efficiency, and exponential growth.
                    </p>
                </div>

                <div class="col-span-1 md:col-span-2 md:col-start-8">
                    <h3 class="text-sm font-bold text-zinc-900 dark:text-white uppercase tracking-widest mb-6">Product</h3>
                    <ul class="space-y-4">
                        <li><a href="#features" class="text-zinc-500 hover:text-blue-600 dark:text-zinc-400 dark:hover:text-blue-400 text-sm font-medium transition-colors">Features</a></li>
                        <li><a href="#" class="text-zinc-500 hover:text-blue-600 dark:text-zinc-400 dark:hover:text-blue-400 text-sm font-medium transition-colors">Pricing</a></li>
                        <li><a href="#" class="text-zinc-500 hover:text-blue-600 dark:text-zinc-400 dark:hover:text-blue-400 text-sm font-medium transition-colors">Changelog</a></li>
                    </ul>
                </div>

                <div class="col-span-1 md:col-span-2">
                     <h3 class="text-sm font-bold text-zinc-900 dark:text-white uppercase tracking-widest mb-6">Company</h3>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-zinc-500 hover:text-blue-600 dark:text-zinc-400 dark:hover:text-blue-400 text-sm font-medium transition-colors">About</a></li>
                        <li><a href="{{ route('contact.us') }}" class="text-zinc-500 hover:text-blue-600 dark:text-zinc-400 dark:hover:text-blue-400 text-sm font-medium transition-colors">Contact</a></li>
                        <li><a href="#" class="text-zinc-500 hover:text-blue-600 dark:text-zinc-400 dark:hover:text-blue-400 text-sm font-medium transition-colors">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-20 pt-8 border-t border-zinc-200 dark:border-zinc-800 flex flex-col md:flex-row justify-between items-center gap-6">
                <p class="text-zinc-500 dark:text-zinc-500 text-sm">&copy; {{ date('Y') }} Kinetic Hub. Crafted with precision.</p>
                <div class="flex gap-6">
                    {{-- Social Icons Placeholder --}}
                    <a href="#" class="text-zinc-400 hover:text-blue-600 transition-colors"><flux:icon name="magnifying-glass" class="size-5" /></a>
                    <a href="#" class="text-zinc-400 hover:text-blue-600 transition-colors"><flux:icon name="magnifying-glass" class="size-5" /></a>
                </div>
            </div>
        </div>
    </footer>

    @fluxScripts
</body>
</html>
