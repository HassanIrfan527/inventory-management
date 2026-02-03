<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-zinc-50 dark:bg-zinc-900">
    <flux:sidebar sticky stashable x-data="{ collapsed: false }"
        class="border-e border-zinc-200/80 bg-zinc-50/90 backdrop-blur-sm dark:border-zinc-800/80 dark:bg-zinc-900/95 transition-all duration-300 ease-in-out"
        x-bind:class="collapsed ? 'w-20' : 'w-64'">

        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <!-- Header: Logo & Toggle -->
        <div class="flex items-center gap-2 px-2 py-1" :class="collapsed ? 'justify-center' : 'justify-between'">
            <flux:brand :href="route('dashboard')" :name="config('app.name')" wire:navigate x-show="!collapsed" class="transition-opacity duration-300">
                <x-slot name="logo" class="flex items-center justify-center">
                    <x-app-logo-icon class="size-7 fill-emerald-600 dark:fill-emerald-500" />
                </x-slot>
            </flux:brand>

            <!-- Logo Icon Only when collapsed -->
            <div x-show="collapsed" class="flex items-center justify-center">
                <x-app-logo-icon class="size-8 fill-emerald-600 dark:fill-emerald-500" />
            </div>

            <!-- Collapse toggle (desktop) -->
            <flux:button variant="subtle" square size="sm" class="hidden lg:flex" x-on:click="collapsed = !collapsed" x-tooltip="collapsed ? 'Expand' : 'Collapse'">
                <flux:icon.chevrons-left class="size-4" x-show="!collapsed" />
                <flux:icon.chevrons-right class="size-4" x-show="collapsed" />
            </flux:button>
        </div>

        <!-- Main Navigation -->
        <flux:navlist variant="outline" class="mt-8 space-y-1 [&_svg]:transition-all [&_svg]:duration-300" x-bind:class="collapsed ? '[&_svg]:!size-6' : ''">
            <flux:navlist.item icon="box" :href="route('inventory')" :current="request()->routeIs('inventory')" wire:navigate>
                <span x-show="!collapsed" x-transition.opacity.duration.200ms class="truncate font-semibold text-emerald-600 dark:text-emerald-400">Inventory</span>
                <span x-show="collapsed" class="sr-only">Inventory</span>
            </flux:navlist.item>

            <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                <span x-show="!collapsed" x-transition.opacity.duration.200ms class="truncate">Dashboard</span>
            </flux:navlist.item>

            <flux:navlist.item icon="banknote" :href="route('orders')" :current="request()->routeIs('orders*')" wire:navigate>
                 <span x-show="!collapsed" x-transition.opacity.duration.200ms class="truncate">Orders</span>
            </flux:navlist.item>

            <flux:navlist.item icon="users" :href="route('contacts.all')" :current="request()->routeIs('contacts.all')" wire:navigate>
                 <span x-show="!collapsed" x-transition.opacity.duration.200ms class="truncate">Contacts</span>
            </flux:navlist.item>

            <flux:navlist.item icon="notepad-text" :href="route('invoices')" :current="request()->routeIs('invoices')" wire:navigate>
                 <span x-show="!collapsed" x-transition.opacity.duration.200ms class="truncate">Invoices</span>
            </flux:navlist.item>
        </flux:navlist>

        <!-- Tools / Apps Section -->
        <flux:separator class="my-2" />

        <flux:navlist variant="outline" class="[&_svg]:transition-all [&_svg]:duration-300" x-bind:class="collapsed ? '[&_svg]:!size-6' : ''">
            <flux:navlist.item icon="sparkles" :href="route('scribe')" :current="request()->routeIs('scribe')" wire:navigate>
                <span x-show="!collapsed" x-transition.opacity.duration.200ms class="truncate">Omnis AI</span>
            </flux:navlist.item>
        </flux:navlist>

        <flux:spacer />

        <!-- Bottom Actions -->
        <flux:navlist variant="outline" class="mb-2 [&_svg]:transition-all [&_svg]:duration-300" x-bind:class="collapsed ? '[&_svg]:!size-6' : ''">
            <flux:navlist.item icon="lifebuoy" :href="route('help')" :current="request()->routeIs('help')" wire:navigate>
                <span x-show="!collapsed" x-transition.opacity.duration.200ms class="truncate">Get Help</span>
            </flux:navlist.item>

            <flux:navlist.item icon="book-open-text" :href="route('docs')" :current="request()->routeIs('docs')" wire:navigate>
                <span x-show="!collapsed" x-transition.opacity.duration.200ms class="truncate">User Docs</span>
            </flux:navlist.item>
        </flux:navlist>

        <flux:separator class="mb-4" />

        <!-- Footer: Theme & Profile -->
        <div class="flex flex-col gap-4">
             <!-- Theme Switcher -->
            <div class="flex items-center" :class="collapsed ? 'justify-center' : 'justify-between px-2'">
                <span x-show="!collapsed" x-transition.opacity.duration.200ms class="text-xs font-medium text-zinc-500 dark:text-zinc-400">Appearance</span>

                <flux:dropdown x-data align="end">
                    <flux:button variant="subtle" square size="sm" class="h-8 w-8" aria-label="Preferred color scheme">
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
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevrons-up-down"
                    x-show="!collapsed"
                />

                <flux:profile
                   :initials="auth()->user()->initials()"
                   x-show="collapsed"
                />

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

        <div class="flex items-center gap-2">
             <flux:brand :href="route('dashboard')" wire:navigate>
                 <x-app-logo-icon class="size-6 fill-emerald-600 dark:fill-emerald-500" />
            </flux:brand>
        </div>

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
