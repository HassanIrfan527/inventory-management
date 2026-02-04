@props([
    'heading' => '',
    'subheading' => '',
    'icon' => 'cog-6-tooth',
])

<div class="flex flex-col gap-8">
    {{-- Page Header with Badge --}}
    <div class="flex flex-col gap-2">
        <div class="inline-flex items-center gap-2 rounded-full bg-zinc-100 px-3 py-1 text-[10px] font-bold uppercase tracking-widest text-zinc-600 dark:bg-zinc-800 dark:text-zinc-400 w-fit ring-1 ring-zinc-200 dark:ring-zinc-700">
            <flux:icon name="cog-6-tooth" class="w-3.5 h-3.5" />
            <span>Settings</span>
        </div>
        <flux:heading size="xl" level="1" class="text-zinc-900 dark:text-zinc-50">{{ __('Settings') }}</flux:heading>
        <flux:text size="sm" class="text-zinc-500 dark:text-zinc-400">
            {{ __('Manage your account, preferences, and workspace settings.') }}
        </flux:text>
    </div>

    {{-- Main Layout --}}
    <div class="flex flex-col gap-6 lg:flex-row lg:items-start">
        {{-- Sidebar --}}
        <aside class="w-full lg:w-72 shrink-0">
            <nav class="flex flex-col gap-4">
                {{-- Account Section --}}
                <div class="rounded-2xl border border-zinc-200 bg-white p-4 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                    <h3 class="mb-3 px-3 text-[10px] font-bold uppercase tracking-widest text-zinc-400 dark:text-zinc-500">
                        {{ __('Account') }}
                    </h3>
                    <flux:navlist variant="ghost" class="space-y-1">
                        <flux:navlist.item
                            :href="route('profile.edit')"
                            wire:navigate
                            icon="user"
                            :current="request()->routeIs('profile.edit')"
                        >
                            {{ __('Profile') }}
                        </flux:navlist.item>

                        <flux:navlist.item
                            :href="route('user-password.edit')"
                            wire:navigate
                            icon="key-round"
                            :current="request()->routeIs('user-password.edit')"
                        >
                            {{ __('Password') }}
                        </flux:navlist.item>

                        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                            <flux:navlist.item
                                :href="route('two-factor.show')"
                                wire:navigate
                                icon="shield-check"
                                :current="request()->routeIs('two-factor.show')"
                            >
                                {{ __('Two-Factor Auth') }}
                            </flux:navlist.item>
                        @endif
                    </flux:navlist>
                </div>

                {{-- Preferences Section --}}
                <div class="rounded-2xl border border-zinc-200 bg-white p-4 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                    <h3 class="mb-3 px-3 text-[10px] font-bold uppercase tracking-widest text-zinc-400 dark:text-zinc-500">
                        {{ __('Preferences') }}
                    </h3>
                    <flux:navlist variant="ghost" class="space-y-1">
                        <flux:navlist.item
                            :href="route('appearance.edit')"
                            wire:navigate
                            icon="sun"
                            :current="request()->routeIs('appearance.edit')"
                        >
                            {{ __('Appearance') }}
                        </flux:navlist.item>
                    </flux:navlist>
                </div>

                {{-- Workspace Section --}}
                <div class="rounded-2xl border border-zinc-200 bg-white p-4 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                    <h3 class="mb-3 px-3 text-[10px] font-bold uppercase tracking-widest text-zinc-400 dark:text-zinc-500">
                        {{ __('Workspace') }}
                    </h3>
                    <flux:navlist variant="ghost" class="space-y-1">
                        <flux:navlist.item
                            :href="route('company-info.edit')"
                            wire:navigate
                            icon="building-2"
                            :current="request()->routeIs('company-info.edit')"
                        >
                            {{ __('Company Info') }}
                        </flux:navlist.item>

                        <flux:navlist.item
                            :href="route('product-categories.edit')"
                            wire:navigate
                            icon="tags"
                            :current="request()->routeIs('product-categories.edit')"
                        >
                            {{ __('Product Categories') }}
                        </flux:navlist.item>
                    </flux:navlist>
                </div>
            </nav>
        </aside>

        {{-- Content --}}
        <div class="flex-1 min-w-0">
            <div class="rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900 overflow-hidden">
                {{-- Section Header --}}
                <div class="flex items-center gap-4 border-b border-zinc-100 px-6 py-5 dark:border-zinc-800">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-400">
                        <flux:icon :name="$icon" class="size-5" />
                    </div>
                    <div class="flex flex-col">
                        <flux:heading size="lg">{{ $heading }}</flux:heading>
                        <flux:text size="sm" class="text-zinc-500 dark:text-zinc-400">{{ $subheading }}</flux:text>
                    </div>
                </div>

                {{-- Content --}}
                <div class="p-6">
                    <div class="w-full max-w-2xl">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
