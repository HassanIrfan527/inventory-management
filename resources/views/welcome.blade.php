<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @fluxAppearance
    </head>
    <body class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 text-slate-100 flex items-center justify-center px-6 py-10">
        <div class="mx-auto flex w-full max-w-5xl flex-col gap-10 lg:flex-row lg:items-center">
            <!-- Hero copy -->
            <div class="flex-1 space-y-6">
                <flux:heading size="xl" level="1" class="text-4xl sm:text-5xl font-semibold tracking-tight">
                    <span class="block text-slate-300 text-sm font-medium mb-3">Inventory, orders & invoices</span>
                    <span class="block">Run {{ config('app.name') }} like a pro.</span>
                </flux:heading>

                <flux:text class="text-base sm:text-lg text-slate-300/80 max-w-xl">
                    A fast, modern back-office for product, order, and contact management.
                    Designed for teams that want a clean, high-conversion workspace without the clutter.
                </flux:text>

                <div class="flex flex-wrap items-center gap-3 pt-2">
                    @auth
                        <flux:button
                            variant="primary"
                            color="indigo"
                            :href="route('dashboard')"
                            icon="cursor-arrow-rays"
                        >
                            Go to dashboard
                        </flux:button>
                    @endauth

                    @guest
                        <flux:button
                            variant="primary"
                            color="indigo"
                            :href="route('register')"
                            icon="bolt"
                        >
                            Get started free
                        </flux:button>

                        <flux:button
                            variant="outline"
                            :href="route('login')"
                        >
                            Sign in
                        </flux:button>
                    @endguest

                    <span class="text-xs text-slate-400">
                        No installs. Just log in and start tracking inventory.
                    </span>
                </div>
            </div>

            <!-- Right column: product snapshot -->
            <div class="flex-1 max-w-md lg:max-w-none">
                <flux:card class="space-y-5 border border-slate-800/60 bg-slate-900/70 shadow-xl shadow-slate-950/40">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <flux:heading size="md" class="text-slate-50">Live operations snapshot</flux:heading>
                            <flux:text size="sm" class="text-slate-300/80">See revenue, orders, and stock at a glance.</flux:text>
                        </div>
                        <div class="rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-medium text-emerald-300 flex items-center gap-1">
                            <span class="size-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            Live
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-3 text-sm">
                        <div class="rounded-xl border border-slate-700/80 bg-slate-900/80 px-3 py-3 space-y-1">
                            <span class="text-slate-400 text-xs">Today revenue</span>
                            <div class="text-slate-50 text-lg font-semibold">Rs. 84,920</div>
                            <span class="text-emerald-400 text-xs">+18.3% vs. yesterday</span>
                        </div>
                        <div class="rounded-xl border border-slate-700/80 bg-slate-900/80 px-3 py-3 space-y-1">
                            <span class="text-slate-400 text-xs">Open orders</span>
                            <div class="text-slate-50 text-lg font-semibold">32</div>
                            <span class="text-amber-300 text-xs">7 pending shipment</span>
                        </div>
                        <div class="rounded-xl border border-slate-700/80 bg-slate-900/80 px-3 py-3 space-y-1">
                            <span class="text-slate-400 text-xs">Low stock</span>
                            <div class="text-slate-50 text-lg font-semibold">12</div>
                            <span class="text-slate-400 text-xs">Auto-alerts enabled</span>
                        </div>
                    </div>

                    <div class="space-y-3 pt-1">
                        <div class="flex items-center justify-between text-xs text-slate-300/80">
                            <span>Inventory health</span>
                            <span class="font-medium text-emerald-300">Stable</span>
                        </div>
                        <div class="h-1.5 w-full rounded-full bg-slate-800 overflow-hidden">
                            <div class="h-full w-3/4 rounded-full bg-gradient-to-r from-emerald-400 via-sky-400 to-indigo-400"></div>
                        </div>
                    </div>
                </flux:card>
            </div>
        </div>

        @fluxScripts
    </body>
</html>
