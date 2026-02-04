<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-zinc-50 dark:bg-zinc-900">
    <flux:sidebar sticky stashable x-data="{ collapsed: false }"
        class="border-e border-zinc-200/80 bg-zinc-50/90 backdrop-blur-sm dark:border-zinc-800/80 dark:bg-zinc-900/95 transition-[width] duration-300 ease-in-out overflow-hidden"
        x-bind:style="collapsed ? 'width: 5rem' : 'width: 16rem'">

        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <!-- Header: Logo & Toggle -->
        <div class="flex items-center gap-2 px-3 py-2" x-bind:class="collapsed ? 'justify-center' : 'justify-between'">
            <!-- Full Logo (expanded) -->
            <a href="{{ route('dashboard') }}" wire:navigate
               class="flex items-center gap-2 overflow-hidden transition-all duration-300"
               x-bind:class="collapsed ? 'w-0 opacity-0' : 'w-auto opacity-100'">
                <x-app-logo-icon class="size-8 shrink-0" />
                <span class="text-xl font-bold text-zinc-900 dark:text-white whitespace-nowrap">{{ config('app.name') }}</span>
            </a>

            <!-- Icon Only (collapsed) -->
            <a href="{{ route('dashboard') }}" wire:navigate
               class="flex items-center justify-center transition-all duration-300"
               x-bind:class="collapsed ? 'opacity-100' : 'opacity-0 w-0 absolute'">
                <x-app-logo-icon class="size-9" />
            </a>

            <!-- Collapse toggle (desktop) -->
            <button
                @click="collapsed = !collapsed"
                class="hidden lg:flex items-center justify-center size-8 rounded-lg hover:bg-zinc-200/70 dark:hover:bg-zinc-800 transition-colors shrink-0"
                x-bind:class="collapsed && 'mx-auto'"
                x-bind:title="collapsed ? 'Expand sidebar' : 'Collapse sidebar'"
            >
                <flux:icon.panel-right class="size-4 text-zinc-400 dark:text-zinc-500" />
            </button>
        </div>

        <!-- Main Navigation -->
        <flux:navlist variant="outline" class="mt-6 space-y-0.5">
            <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                <span class="overflow-hidden whitespace-nowrap transition-all duration-300"
                      x-bind:class="collapsed ? 'w-0 opacity-0' : 'w-auto opacity-100'">Dashboard</span>
            </flux:navlist.item>

            <flux:navlist.item icon="box" :href="route('inventory')" :current="request()->routeIs('inventory')" wire:navigate>
                <span class="overflow-hidden whitespace-nowrap transition-all duration-300"
                      x-bind:class="collapsed ? 'w-0 opacity-0' : 'w-auto opacity-100'">Inventory</span>
            </flux:navlist.item>

            <flux:navlist.item icon="banknote" :href="route('orders')" :current="request()->routeIs('orders*')" wire:navigate>
                <span class="overflow-hidden whitespace-nowrap transition-all duration-300"
                      x-bind:class="collapsed ? 'w-0 opacity-0' : 'w-auto opacity-100'">Orders</span>
            </flux:navlist.item>

            <flux:navlist.item icon="users" :href="route('contacts.all')" :current="request()->routeIs('contacts.all')" wire:navigate>
                <span class="overflow-hidden whitespace-nowrap transition-all duration-300"
                      x-bind:class="collapsed ? 'w-0 opacity-0' : 'w-auto opacity-100'">Contacts</span>
            </flux:navlist.item>

            <flux:navlist.item icon="notepad-text" :href="route('invoices')" :current="request()->routeIs('invoices')" wire:navigate>
                <span class="overflow-hidden whitespace-nowrap transition-all duration-300"
                      x-bind:class="collapsed ? 'w-0 opacity-0' : 'w-auto opacity-100'">Invoices</span>
            </flux:navlist.item>
        </flux:navlist>

        <!-- AI Section -->
        <div class="mt-4 px-3">
            <div class="h-px bg-zinc-200 dark:bg-zinc-800"></div>
        </div>

        <flux:navlist variant="outline" class="mt-4">
            <flux:navlist.item icon="sparkles" :href="route('scribe')" :current="request()->routeIs('scribe')" wire:navigate>
                <span class="overflow-hidden whitespace-nowrap transition-all duration-300"
                      x-bind:class="collapsed ? 'w-0 opacity-0' : 'w-auto opacity-100'">Scribe AI</span>
            </flux:navlist.item>
        </flux:navlist>

        <flux:spacer />

        <!-- Resources Section (Help & Docs) -->
        <div class="mb-4">
            <!-- Section Label (only when expanded) -->
            <div class="px-4 mb-2 overflow-hidden transition-all duration-300"
                 x-bind:class="collapsed ? 'h-0 opacity-0' : 'h-auto opacity-100'">
                <span class="text-[10px] uppercase tracking-wider text-zinc-400 dark:text-zinc-500 font-semibold">Resources</span>
            </div>

            <div class="flex flex-col gap-0.5 px-2">
                <a href="{{ route('help') }}" wire:navigate
                   @class([
                       'flex items-center gap-2.5 px-2 py-2 text-sm rounded-lg transition-colors',
                       'text-zinc-500 hover:text-zinc-700 hover:bg-zinc-100 dark:text-zinc-400 dark:hover:text-zinc-200 dark:hover:bg-zinc-800',
                       'bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-200' => request()->routeIs('help'),
                   ])
                   x-bind:class="collapsed && 'justify-center px-0'"
                >
                    <flux:icon name="lifebuoy" class="size-4 shrink-0" />
                    <span class="overflow-hidden whitespace-nowrap transition-all duration-300"
                          x-bind:class="collapsed ? 'w-0 opacity-0' : 'w-auto opacity-100'">Help Center</span>
                </a>

                <a href="{{ route('docs') }}" wire:navigate
                   @class([
                       'flex items-center gap-2.5 px-2 py-2 text-sm rounded-lg transition-colors',
                       'text-zinc-500 hover:text-zinc-700 hover:bg-zinc-100 dark:text-zinc-400 dark:hover:text-zinc-200 dark:hover:bg-zinc-800',
                       'bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-200' => request()->routeIs('docs'),
                   ])
                   x-bind:class="collapsed && 'justify-center px-0'"
                >
                    <flux:icon name="book-open-text" class="size-4 shrink-0" />
                    <span class="overflow-hidden whitespace-nowrap transition-all duration-300"
                          x-bind:class="collapsed ? 'w-0 opacity-0' : 'w-auto opacity-100'">Documentation</span>
                </a>
            </div>
        </div>

        <div class="px-3 mb-4">
            <div class="h-px bg-zinc-200 dark:bg-zinc-800"></div>
        </div>

        <!-- Footer: Theme & Profile -->
        <div class="flex flex-col gap-3 pb-2">
            <!-- Theme Switcher -->
            <div class="flex items-center px-2" x-bind:class="collapsed ? 'justify-center' : 'justify-between'">
                <span class="text-xs font-medium text-zinc-500 dark:text-zinc-400 overflow-hidden whitespace-nowrap transition-all duration-300"
                      x-bind:class="collapsed ? 'w-0 opacity-0' : 'w-auto opacity-100'">Appearance</span>

                <flux:dropdown x-data align="end">
                    <flux:button variant="subtle" square size="sm" class="size-8" aria-label="Preferred color scheme">
                        <flux:icon.sun x-show="$flux.appearance === 'light'" variant="mini" class="text-zinc-500 dark:text-white" />
                        <flux:icon.moon x-show="$flux.appearance === 'dark'" variant="mini" class="text-zinc-500 dark:text-white" />
                        <flux:icon.moon x-show="$flux.appearance === 'system' && $flux.dark" variant="mini" />
                        <flux:icon.sun x-show="$flux.appearance === 'system' && ! $flux.dark" variant="mini" />
                    </flux:button>

                    <flux:menu>
                        <flux:menu.item icon="sun" x-on:click="$flux.appearance = 'light'">Light</flux:menu.item>
                        <flux:menu.item icon="moon" x-on:click="$flux.appearance = 'dark'">Dark</flux:menu.item>
                        <flux:menu.item icon="computer-desktop" x-on:click="$flux.appearance = 'system'">System</flux:menu.item>
                    </flux:menu>
                </flux:dropdown>
            </div>

            <!-- User Menu -->
            <flux:dropdown position="top" align="start">
                <div x-show="!collapsed" class="transition-all duration-300">
                    <flux:profile
                        :name="auth()->user()->name"
                        :initials="auth()->user()->initials()"
                        icon-trailing="chevrons-up-down"
                    />
                </div>

                <div x-show="collapsed" class="flex justify-center transition-all duration-300">
                    <flux:profile :initials="auth()->user()->initials()" />
                </div>

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>Settings</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            Log Out
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </div>
    </flux:sidebar>

    <!-- Mobile Header -->
    <flux:header class="lg:hidden border-b border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-3" inset="left" />

        <flux:spacer />

        <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-2">
            <x-app-logo-icon class="size-7" />
            <span class="font-bold text-zinc-900 dark:text-white">{{ config('app.name') }}</span>
        </a>

        <flux:spacer />

        <flux:dropdown position="bottom" align="end">
            <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />

            <flux:menu>
                <flux:menu.radio.group>
                    <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>Settings</flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        Log Out
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    {{ $slot }}

    @fluxScripts
    <x-toast />
</body>

</html>
