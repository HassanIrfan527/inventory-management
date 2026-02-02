<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts.public')] #[Title('Pricing | Nexus Flow')] class extends Component
{
    //
};
?>

<div class="relative isolate overflow-hidden">
    {{-- Decorative Background --}}
    <div class="absolute inset-0 -z-10 transform-gpu overflow-hidden blur-3xl" aria-hidden="true">
        <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-emerald-600 to-teal-800 opacity-10 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-24 sm:py-32">
        <div class="mx-auto max-w-2xl text-center mb-16 sm:mb-20">
            <h2 class="text-base font-semibold leading-7 text-emerald-600 uppercase tracking-wide">Simple Pricing</h2>
            <p class="mt-2 text-4xl font-extrabold tracking-tight text-zinc-900 dark:text-white sm:text-6xl">
                One plan. <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-600">Pure power.</span>
            </p>
            <p class="mt-6 text-lg leading-8 text-zinc-600 dark:text-zinc-400">
                Stop worrying about tiers and limits. Nexus Flow Pro gives you everything you need to scale your business for a flat, transparent monthly fee.
            </p>
        </div>

        <div class="mx-auto max-w-lg lg:max-w-none">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-center">
                {{-- Left: Features List --}}
                <div class="lg:col-span-2 space-y-8">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                        <div class="group flex gap-4">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-emerald-600/10 text-emerald-600 group-hover:scale-110 transition-transform">
                                <flux:icon.check class="size-6" />
                            </div>
                            <div>
                                <h3 class="font-bold text-zinc-900 dark:text-white">Unlimited Inventory</h3>
                                <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">Track as many products as your business needs without extra costs.</p>
                            </div>
                        </div>

                        <div class="group flex gap-4">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-emerald-600/10 text-emerald-600 group-hover:scale-110 transition-transform">
                                <flux:icon.check class="size-6" />
                            </div>
                            <div>
                                <h3 class="font-bold text-zinc-900 dark:text-white">Smart Analytics</h3>
                                <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">Get AI-driven insights into your stock levels and sales trends.</p>
                            </div>
                        </div>

                        <div class="group flex gap-4">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-emerald-600/10 text-emerald-600 group-hover:scale-110 transition-transform">
                                <flux:icon.check class="size-6" />
                            </div>
                            <div>
                                <h3 class="font-bold text-zinc-900 dark:text-white">All Integrations</h3>
                                <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">Sync with Shopify, WooCommerce, and more at no extra charge.</p>
                            </div>
                        </div>

                        <div class="group flex gap-4">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-emerald-600/10 text-emerald-600 group-hover:scale-110 transition-transform">
                                <flux:icon.check class="size-6" />
                            </div>
                            <div>
                                <h3 class="font-bold text-zinc-900 dark:text-white">Multi-Warehouse</h3>
                                <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">Manage stock across multiple locations effortlessly.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right: Pricing Card --}}
                <div class="relative group">
                    {{-- Decorative blur --}}
                    <div class="absolute -inset-1 bg-gradient-to-r from-emerald-600 to-teal-600 rounded-[2.5rem] blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
                    
                    <flux:card class="relative bg-white dark:bg-zinc-900 border-none shadow-2xl p-8 rounded-[2.5rem] flex flex-col items-center text-center">
                        <div class="mb-6 rounded-full bg-emerald-100 dark:bg-emerald-900/30 px-4 py-1.5 text-xs font-bold uppercase tracking-wider text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800">
                            Nexus Flow Pro
                        </div>
                        
                        <div class="flex items-baseline gap-1">
                            <span class="text-5xl font-extrabold tracking-tight text-zinc-900 dark:text-white">$9</span>
                            <span class="text-zinc-500 font-medium">/mo</span>
                        </div>
                        
                        <p class="mt-4 text-sm text-zinc-600 dark:text-zinc-400">
                            The complete business toolkit. Billing starts after your 14-day free trial.
                        </p>
                        
                        <flux:button href="{{ route('register') }}" variant="primary" class="mt-8 w-full py-4 text-base font-bold shadow-lg shadow-emerald-500/20 bg-emerald-600 hover:bg-emerald-500">
                            Start Free Trial
                        </flux:button>
                        
                        <div class="mt-6 flex flex-col gap-2 w-full">
                            <div class="flex items-center gap-2 text-xs text-zinc-500 dark:text-zinc-500">
                                <flux:icon.shield-check class="size-4 text-emerald-500" />
                                Secure payment with Stripe
                            </div>
                            <div class="flex items-center gap-2 text-xs text-zinc-500 dark:text-zinc-500">
                                <flux:icon.arrow-path class="size-4 text-emerald-500" />
                                Cancel anytime with one click
                            </div>
                        </div>
                    </flux:card>
                </div>
            </div>
        </div>
        
        {{-- FAQ Section Preview --}}
        <div class="mt-32 max-w-3xl mx-auto border-t border-zinc-200 dark:border-zinc-800 pt-16 text-center">
             <h3 class="text-2xl font-bold text-zinc-900 dark:text-white mb-4">Have more questions?</h3>
             <p class="text-zinc-600 dark:text-zinc-400 mb-8">Reach out to our support team and we'll help you find the best way to utilize Nexus Flow.</p>
             <flux:button href="{{ route('help') }}" variant="ghost" icon-trailing="arrow-right">Visit Help Center</flux:button>
        </div>
    </div>
</div>