<div class="min-h-screen">
    <div class="flex min-h-screen flex-col lg:flex-row">
        {{-- Left Side - Form --}}
        <div class="flex w-full flex-col justify-center px-4 py-8 sm:px-6 sm:py-12 lg:w-1/2 lg:px-8 xl:px-16">
            <div class="mx-auto w-full max-w-sm">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="mb-6 flex items-center gap-2" wire:navigate>
                    <span
                        class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-br from-emerald-500 to-teal-600 shadow-md shadow-emerald-500/20">
                        <x-app-logo-icon class="size-5 text-white" />
                    </span>
                    <span class="text-lg font-bold text-zinc-900 dark:text-white">{{ config('app.name') }}</span>
                </a>

                {{-- Registration Form --}}
                <div class="flex flex-col gap-5">
                    <div>
                        <h1 class="text-2xl font-bold tracking-tight text-zinc-900 dark:text-white">Create your account
                        </h1>
                        <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Start your 7-day free trial.</p>
                    </div>

                    {{-- Selected Plan Badge (Mobile) --}}
                    @if ($selectedPlan)
                        <div
                            class="lg:hidden flex items-center justify-between rounded-lg bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 px-3 py-2">
                            <div class="flex items-center gap-2">
                                <flux:icon.check-circle class="size-4 text-emerald-600 dark:text-emerald-400" />
                                <span class="text-sm text-emerald-700 dark:text-emerald-300">
                                    {{ $selectedPlan === 'free' ? 'Free' : $plans->firstWhere('slug', $selectedPlan)?->name }}
                                    plan
                                </span>
                            </div>
                            <button type="button" x-data
                                x-on:click="document.getElementById('mobile-plans').scrollIntoView({ behavior: 'smooth' })"
                                class="text-xs font-medium text-emerald-600 dark:text-emerald-400 hover:underline cursor-pointer">
                                Change
                            </button>
                        </div>
                    @endif

                    <form wire:submit="register" class="flex flex-col gap-4">
                        <flux:input wire:model="name" label="Full name" type="text" required autofocus
                            autocomplete="name" placeholder="John Doe" />
                        <flux:input wire:model="email" label="Email address" type="email" required
                            autocomplete="email" placeholder="john@example.com" />
                        <flux:input wire:model="password" label="Password" type="password" required
                            autocomplete="new-password" placeholder="Create a strong password" viewable />
                        <flux:input wire:model="password_confirmation" label="Confirm password" type="password" required
                            autocomplete="new-password" placeholder="Confirm your password" viewable />

                        <p class="text-xs text-zinc-500 dark:text-zinc-400">
                            By creating an account, you agree to our
                            <a href="{{ route('terms') }}"
                                class="text-emerald-600 dark:text-emerald-400 hover:underline">Terms</a>
                            and
                            <a href="{{ route('privacy') }}"
                                class="text-emerald-600 dark:text-emerald-400 hover:underline">Privacy Policy</a>.
                        </p>

                        <flux:button type="submit" variant="primary"
                            class="w-full !bg-emerald-600 hover:!bg-emerald-500">
                            <span wire:loading.remove wire:target="register">Create account</span>
                            <span wire:loading wire:target="register" class="flex items-center gap-2">
                                <flux:icon.arrow-path class="size-4 animate-spin" />
                                Creating...
                            </span>
                        </flux:button>
                    </form>

                    <p class="text-center text-sm text-zinc-500 dark:text-zinc-400">
                        Already have an account?
                        <flux:link href="{{ route('login') }}" wire:navigate
                            class="font-medium text-emerald-600 dark:text-emerald-400">
                            Sign in
                        </flux:link>
                    </p>
                </div>
            </div>
        </div>

        {{-- Right Side - Plan Selection (Desktop) --}}
        <div
            class="hidden bg-zinc-50 dark:bg-zinc-900/50 lg:flex lg:w-1/2 lg:flex-col lg:justify-center lg:px-8 xl:px-16">
            <div class="mx-auto w-full max-w-sm">
                <div class="space-y-4">
                    <div>
                        <h2 class="text-xl font-bold text-zinc-900 dark:text-white">Choose your plan</h2>
                        <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">You can always change it later.</p>
                    </div>

                    {{-- Plan Cards --}}
                    <div class="space-y-3">
                        {{-- Free Plan --}}
                        <button type="button" wire:click="selectPlan('free')"
                            class="group relative w-full cursor-pointer rounded-xl border-2 p-4 text-left transition-all duration-200 {{ $selectedPlan === 'free' ? 'border-emerald-500 bg-emerald-50/50 dark:bg-emerald-900/10' : 'border-zinc-200 dark:border-zinc-800 hover:border-zinc-300 dark:hover:border-zinc-700 bg-white dark:bg-zinc-900' }}">
                            @if ($selectedPlan === 'free')
                                <div
                                    class="pointer-events-none absolute -inset-px rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 opacity-15 blur-sm">
                                </div>
                            @endif
                            <div class="relative flex items-center justify-between gap-4">
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2">
                                        <h3 class="font-semibold text-zinc-900 dark:text-white">Free</h3>
                                        @if ($selectedPlan === 'free')
                                            <flux:icon.check-circle class="size-4 text-emerald-500" />
                                        @endif
                                    </div>
                                    <p class="mt-0.5 text-xs text-zinc-500 dark:text-zinc-400">100 contacts, 10
                                        invoices/mo</p>
                                    <p class="mt-1 text-xs text-emerald-600 dark:text-emerald-400 font-medium">No credit
                                        card required</p>
                                </div>
                                <div class="text-right shrink-0">
                                    <span class="text-xl font-bold text-zinc-900 dark:text-white">$0</span>
                                    <span class="text-xs text-zinc-500 dark:text-zinc-400">/mo</span>
                                </div>
                            </div>
                        </button>

                        {{-- Pro Plan --}}
                        @php($proPlan = $plans->firstWhere('slug', 'pro'))
                        @if ($proPlan)
                            <button type="button" wire:click="selectPlan('pro')"
                                class="group relative w-full cursor-pointer rounded-xl border-2 p-4 text-left transition-all duration-200 {{ $selectedPlan === 'pro' ? 'border-emerald-500 bg-emerald-50/50 dark:bg-emerald-900/10' : 'border-zinc-200 dark:border-zinc-800 hover:border-zinc-300 dark:hover:border-zinc-700 bg-white dark:bg-zinc-900' }}">
                                @if ($selectedPlan === 'pro')
                                    <div
                                        class="pointer-events-none absolute -inset-px rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 opacity-15 blur-sm">
                                    </div>
                                @endif
                                <div class="relative flex items-center justify-between gap-4">
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2">
                                            <h3 class="font-semibold text-zinc-900 dark:text-white">{{ $proPlan->name }}
                                            </h3>
                                            <span
                                                class="inline-flex items-center rounded-full bg-gradient-to-r from-emerald-600 to-teal-600 px-1.5 py-0.5 text-[10px] font-medium text-white">Popular</span>
                                            @if ($selectedPlan === 'pro')
                                                <flux:icon.check-circle class="size-4 text-emerald-500" />
                                            @endif
                                        </div>
                                        <p class="mt-0.5 text-xs text-zinc-500 dark:text-zinc-400">Unlimited contacts,
                                            API access</p>
                                    </div>
                                    <div class="text-right shrink-0">
                                        <span
                                            class="text-xl font-bold text-zinc-900 dark:text-white">${{ number_format($proPlan->monthly_price / 100, 0) }}</span>
                                        <span class="text-xs text-zinc-500 dark:text-zinc-400">/mo</span>
                                    </div>
                                </div>
                            </button>
                        @endif

                        {{-- Business Plan --}}
                        @php($businessPlan = $plans->firstWhere('slug', 'business'))
                        @if ($businessPlan)
                            <button type="button" wire:click="selectPlan('business')"
                                class="group relative w-full cursor-pointer rounded-xl border-2 p-4 text-left transition-all duration-200 {{ $selectedPlan === 'business' ? 'border-emerald-500 bg-emerald-50/50 dark:bg-emerald-900/10' : 'border-zinc-200 dark:border-zinc-800 hover:border-zinc-300 dark:hover:border-zinc-700 bg-white dark:bg-zinc-900' }}">
                                @if ($selectedPlan === 'business')
                                    <div
                                        class="pointer-events-none absolute -inset-px rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 opacity-15 blur-sm">
                                    </div>
                                @endif
                                <div class="relative flex items-center justify-between gap-4">
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2">
                                            <h3 class="font-semibold text-zinc-900 dark:text-white">
                                                {{ $businessPlan->name }}</h3>
                                            @if ($selectedPlan === 'business')
                                                <flux:icon.check-circle class="size-4 text-emerald-500" />
                                            @endif
                                        </div>
                                        <p class="mt-0.5 text-xs text-zinc-500 dark:text-zinc-400">Team features,
                                            priority support</p>
                                    </div>
                                    <div class="text-right shrink-0">
                                        <span
                                            class="text-xl font-bold text-zinc-900 dark:text-white">${{ number_format($businessPlan->monthly_price / 100, 0) }}</span>
                                        <span class="text-xs text-zinc-500 dark:text-zinc-400">/mo</span>
                                    </div>
                                </div>
                            </button>
                        @endif
                    </div>

                    {{-- Trust Badges --}}
                    <div class="flex items-center justify-center gap-4 pt-2 text-xs text-zinc-400 dark:text-zinc-500">
                        <div class="flex items-center gap-1">
                            <flux:icon.shield-check class="size-3.5" />
                            <span>Secure</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <flux:icon.arrow-path class="size-3.5" />
                            <span>Cancel anytime</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Mobile Plan Selection --}}
    <div id="mobile-plans"
        class="lg:hidden border-t border-zinc-200 dark:border-zinc-800 bg-zinc-50 dark:bg-zinc-900/50 px-4 py-6">
        <div class="mx-auto max-w-sm space-y-4">
            <div class="text-center">
                <h2 class="text-lg font-bold text-zinc-900 dark:text-white">Choose your plan</h2>
            </div>

            {{-- Mobile Plan Cards --}}
            @php($proPlan = $plans->firstWhere('slug', 'pro'))
            @php($businessPlan = $plans->firstWhere('slug', 'business'))
            <div class="grid grid-cols-3 gap-2">
                {{-- Free --}}
                <button type="button" wire:click="selectPlan('free')"
                    class="cursor-pointer rounded-lg border-2 p-3 text-center transition-all {{ $selectedPlan === 'free' ? 'border-emerald-500 bg-emerald-50 dark:bg-emerald-900/20' : 'border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900' }}">
                    <span class="block text-xs font-medium text-zinc-900 dark:text-white">Free</span>
                    <span class="block text-lg font-bold text-zinc-900 dark:text-white">$0</span>
                    <span class="block text-[10px] text-zinc-500">No card</span>
                </button>

                {{-- Pro --}}
                @if ($proPlan)
                    <button type="button" wire:click="selectPlan('pro')"
                        class="cursor-pointer rounded-lg border-2 p-3 text-center transition-all {{ $selectedPlan === 'pro' ? 'border-emerald-500 bg-emerald-50 dark:bg-emerald-900/20' : 'border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900' }}">
                        <span class="block text-xs font-medium text-zinc-900 dark:text-white">Pro</span>
                        <span
                            class="block text-lg font-bold text-zinc-900 dark:text-white">${{ number_format($proPlan->monthly_price / 100, 0) }}</span>
                        <span class="block text-[10px] text-emerald-600">Popular</span>
                    </button>
                @endif

                {{-- Business --}}
                @if ($businessPlan)
                    <button type="button" wire:click="selectPlan('business')"
                        class="cursor-pointer rounded-lg border-2 p-3 text-center transition-all {{ $selectedPlan === 'business' ? 'border-emerald-500 bg-emerald-50 dark:bg-emerald-900/20' : 'border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900' }}">
                        <span class="block text-xs font-medium text-zinc-900 dark:text-white">Business</span>
                        <span
                            class="block text-lg font-bold text-zinc-900 dark:text-white">${{ number_format($businessPlan->monthly_price / 100, 0) }}</span>
                        <span class="block text-[10px] text-zinc-500">Teams</span>
                    </button>
                @endif
            </div>
        </div>
    </div>

    {{-- Change Plan Confirmation Modal --}}
    @if ($showChangePlanModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" wire:click="cancelPlanChange"></div>
            <div
                class="relative w-full max-w-xs rounded-xl bg-white dark:bg-zinc-900 p-5 shadow-xl border border-zinc-200 dark:border-zinc-800">
                <div class="space-y-4">
                    <div>
                        <h3 class="text-base font-semibold text-zinc-900 dark:text-white">Change Plan</h3>
                        <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                            Switch to <strong
                                class="text-zinc-900 dark:text-white">{{ $pendingPlan === 'free' ? 'Free' : $plans->firstWhere('slug', $pendingPlan)?->name }}</strong>?
                        </p>
                    </div>
                    <div class="flex gap-2">
                        <flux:button wire:click="confirmPlanChange" variant="primary"
                            class="flex-1 !bg-emerald-600 hover:!bg-emerald-500">
                            Confirm
                        </flux:button>
                        <flux:button wire:click="cancelPlanChange" variant="ghost" class="flex-1">
                            Cancel
                        </flux:button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
