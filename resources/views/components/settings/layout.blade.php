<div class="flex flex-col gap-6 lg:flex-row lg:items-start">
    <!-- Sidebar -->
    <aside class="w-full max-w-full lg:max-w-xs">
        <div class="rounded-2xl border border-neutral-200 bg-white p-4 shadow-sm dark:border-neutral-700 dark:bg-neutral-900">
            <div class="mb-4 flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-900/40 dark:text-blue-300">
                    <flux:icon.cog class="size-5" />
                </div>
                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-neutral-500 dark:text-neutral-400">Settings</p>
                    <p class="text-sm font-semibold text-neutral-900 dark:text-white">Manage your workspace</p>
                </div>
            </div>

            <flux:navlist variant="ghost" class="mt-2 space-y-1">
                <flux:navlist.item :href="route('profile.edit')" wire:navigate icon="user">
                    {{ __('Profile') }}
                </flux:navlist.item>

                <flux:navlist.item :href="route('company-info.edit')" wire:navigate icon="building-2">
                    {{ __('Company Info') }}
                </flux:navlist.item>

                <flux:navlist.item :href="route('user-password.edit')" wire:navigate icon="key-round">
                    {{ __('Password') }}
                </flux:navlist.item>

                @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                    <flux:navlist.item :href="route('two-factor.show')" wire:navigate icon="shield-check">
                        {{ __('Two-Factor Auth') }}
                    </flux:navlist.item>
                @endif

                <flux:navlist.item :href="route('product-categories.edit')" wire:navigate icon="tags">
                    {{ __('Product Categories') }}
                </flux:navlist.item>
            </flux:navlist>
        </div>
    </aside>

    <!-- Content -->
    <div class="flex-1">
        <div class="rounded-2xl border border-neutral-200 bg-white p-6 shadow-sm dark:border-neutral-700 dark:bg-neutral-900">
            <div class="mb-4 space-y-1">
                <flux:heading>{{ $heading ?? '' }}</flux:heading>
                <flux:subheading>{{ $subheading ?? '' }}</flux:subheading>
            </div>

            <div class="mt-4 w-full max-w-2xl">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
