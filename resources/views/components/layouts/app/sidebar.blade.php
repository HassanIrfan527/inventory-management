<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-zinc-50 dark:bg-zinc-900">
    <flux:sidebar
        sticky
        stashable
        class="border-e border-zinc-200/80 bg-zinc-50/90 backdrop-blur-sm dark:border-zinc-800/80 dark:bg-zinc-900/95 transition-all duration-300">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <flux:brand :href="route('dashboard')" :name="config('app.name')" wire:navigate>
            <x-slot name="logo" class="size-8 rounded-md bg-accent-content text-accent-foreground flex items-center justify-center">
                <x-app-logo-icon class="size-5 fill-current text-white dark:text-black" />
            </x-slot>
        </flux:brand>

        <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('Platform')" class="grid">
                <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')"
                    wire:navigate>Dashboard
                </flux:navlist.item>

                <flux:navlist.item icon="user" :href="route('contacts.all')"
                    :current="request()->routeIs('contacts')" wire:navigate>Contacts
                </flux:navlist.item>

                <flux:navlist.item icon="list-ordered" :href="route('orders')" :current="request()->routeIs('orders')"
                    wire:navigate>Orders
                </flux:navlist.item>

                <flux:navlist.item icon="newspaper" :href="route('invoices')" :current="request()->routeIs('invoices')"
                    wire:navigate>Invoices
                </flux:navlist.item>



            </flux:navlist.group>
        </flux:navlist>

        <flux:spacer />
        <flux:separator />


        <flux:navlist variant="outline">
            <flux:navlist.item icon="bot" :href="route('scout')" :current="request()->routeIs('scout')"
                wire:navigate>
                Scout
            </flux:navlist.item>

            <flux:navlist.item icon="box" :href="route('inventory')" :current="request()->routeIs('inventory')"
                wire:navigate>
                Inventory
            </flux:navlist.item>

        </flux:navlist>

        <div class="mt-4 hidden lg:flex items-center justify-between text-xs text-zinc-500 dark:text-zinc-400 px-1">
            <span>{{ __('Appearance') }}</span>

            <flux:dropdown x-data align="end">
                <flux:button
                    variant="subtle"
                    square
                    size="sm"
                    class="h-8 w-8"
                    aria-label="{{ __('Preferred color scheme') }}"
                >
                    <flux:icon.sun x-show="$flux.appearance === 'light'" variant="mini" class="text-zinc-500 dark:text-white" />
                    <flux:icon.moon x-show="$flux.appearance === 'dark'" variant="mini" class="text-zinc-500 dark:text-white" />
                    <flux:icon.moon x-show="$flux.appearance === 'system' && $flux.dark" variant="mini" />
                    <flux:icon.sun x-show="$flux.appearance === 'system' && ! $flux.dark" variant="mini" />
                </flux:button>

                <flux:menu>
                    <flux:menu.item icon="sun" x-on:click="$flux.appearance = 'light'">{{ __('Light') }}</flux:menu.item>
                    <flux:menu.item icon="moon" x-on:click="$flux.appearance = 'dark'">{{ __('Dark') }}</flux:menu.item>
                    <flux:menu.item icon="computer-desktop" x-on:click="$flux.appearance = 'system'">{{ __('System') }}</flux:menu.item>
                </flux:menu>
            </flux:dropdown>
        </div>

        <!-- Desktop User Menu -->
        <flux:dropdown class="hidden lg:block" position="bottom" align="start">
            <flux:profile :name="auth()->user()->name" :initials="auth()->user()->initials()"
                icon:trailing="chevrons-up-down" />

            <flux:menu class="w-[220px]">
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>{{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>

    <!-- Mobile User Menu -->
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        <flux:dropdown position="top" align="end">
            <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>{{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
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
