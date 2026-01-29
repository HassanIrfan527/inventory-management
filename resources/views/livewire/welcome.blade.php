<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts.public')] #[Title('Welcome to Kinetic Hub')] class extends Component
{
    //
};
?>

<div class="relative isolate overflow-hidden">
    {{-- Hero Section --}}
    <div class="relative pt-10 pb-20 sm:pt-24 sm:pb-32 lg:pb-40 overflow-hidden">
        {{-- Background Gradients --}}
        <div class="absolute inset-0 -z-10 transform-gpu overflow-hidden blur-3xl" aria-hidden="true">
            <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-blue-600 to-indigo-800 opacity-20 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:gap-y-20 items-center">
                {{-- Left Column: Copy --}}
                <div class="relative z-10 mx-auto max-w-2xl lg:col-span-7 lg:mx-0 lg:pt-4">
                    <div class="hidden sm:mb-8 sm:flex">
                        <div class="relative rounded-full px-3 py-1 text-sm leading-6 text-zinc-600 dark:text-zinc-400 ring-1 ring-zinc-900/10 dark:ring-zinc-100/10 hover:ring-zinc-900/20 transition-all">
                            Announcing our new Intelligent Analytics.
                            <a href="#" class="font-semibold text-blue-600 dark:text-blue-500">
                                <span class="absolute inset-0" aria-hidden="true"></span>Read more <span aria-hidden="true">&rarr;</span>
                            </a>
                        </div>
                    </div>

                    <h1 class="text-5xl font-extrabold tracking-tight text-zinc-900 dark:text-white sm:text-7xl mb-6">
                        Inventory Intelligence <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Perfected.</span>
                    </h1>

                    <p class="text-lg leading-8 text-zinc-600 dark:text-zinc-400 mb-8 max-w-lg">
                        Kinetic Hub is the all-in-one business operating system designed to give you total control over
                        your inventory, orders, and growth. Fast, intuitive, and remarkably powerful.
                    </p>

                    <div class="flex flex-wrap items-center gap-4">
                        <flux:button href="{{ route('register') }}" variant="primary" class="shadow-lg shadow-blue-500/20 px-8 py-3 h-auto text-base">
                            Get Started for Free
                        </flux:button>
                        <flux:button href="#features" variant="ghost" icon-trailing="chevron-down" class="px-6 py-3 h-auto text-base">
                            Explore Features
                        </flux:button>
                    </div>
                     <p class="mt-4 text-sm text-zinc-500 dark:text-zinc-500 italic">
                        No credit card required • 14-day free trial
                    </p>

                    {{-- Integrations Preview --}}
                    <div class="mt-12 pt-8 border-t border-zinc-200 dark:border-zinc-800/50">
                        <p class="text-xs font-semibold text-zinc-500 dark:text-zinc-500 uppercase tracking-widest mb-4">Trusted by modern teams</p>
                        <div class="flex gap-6 grayscale opacity-70 hover:opacity-100 transition-opacity duration-300">
                             <img src="https://logo.clearbit.com/shopify.com" alt="Shopify" class="h-6 w-auto">
                             <img src="https://logo.clearbit.com/quickbooks.intuit.com" alt="QuickBooks" class="h-6 w-auto">
                             <img src="https://logo.clearbit.com/stripe.com" alt="Stripe" class="h-6 w-auto">
                        </div>
                    </div>
                </div>

                {{-- Right Column: Live Snapshot (From original welcome) --}}
                <div class="mt-16 sm:mt-24 lg:mt-0 lg:col-span-5 relative">
                     {{-- Blob behind card --}}
                     <div class="absolute -top-12 -right-12 -z-10 size-64 rounded-full bg-blue-500/30 blur-3xl"></div>

                    <flux:card class="space-y-6 border border-zinc-200/50 dark:border-zinc-800/50 bg-white/80 dark:bg-zinc-900/80 backdrop-blur-md shadow-2xl shadow-zinc-200/50 dark:shadow-black/50 ring-1 ring-zinc-900/5 dark:ring-white/10">
                        <div class="flex items-center justify-between gap-3 border-b border-zinc-100 dark:border-zinc-800 pb-4">
                            <div>
                                <flux:heading size="md" class="text-zinc-900 dark:text-zinc-100 font-bold">Live Operations</flux:heading>
                                <flux:text size="sm" class="text-zinc-500">Real-time revenue & stock</flux:text>
                            </div>
                            <div class="rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-medium text-emerald-600 dark:text-emerald-400 flex items-center gap-1.5 border border-emerald-500/20">
                                <span class="relative flex h-2 w-2">
                                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                  <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                                </span>
                                Live
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-2 rounded-xl border border-zinc-100 dark:border-zinc-800 bg-zinc-50/50 dark:bg-zinc-950/50 p-4">
                                <span class="text-zinc-500 text-xs font-medium uppercase tracking-wide">Today's Revenue</span>
                                <div class="mt-1 flex items-baseline gap-2">
                                    <div class="text-2xl font-bold text-zinc-900 dark:text-white">Rs. 84,920</div>
                                    <span class="text-xs font-medium text-emerald-600 dark:text-emerald-400 bg-emerald-100 dark:bg-emerald-500/10 px-1.5 py-0.5 rounded">+18.3%</span>
                                </div>
                            </div>

                            <div class="rounded-xl border border-zinc-100 dark:border-zinc-800 bg-zinc-50/50 dark:bg-zinc-950/50 p-4">
                                <span class="text-zinc-500 text-xs font-medium uppercase tracking-wide">Open Orders</span>
                                <div class="mt-1 text-xl font-bold text-zinc-900 dark:text-white">32</div>
                                <span class="text-xs text-amber-600 dark:text-amber-400 mt-1 block">7 pending ship</span>
                            </div>

                            <div class="rounded-xl border border-zinc-100 dark:border-zinc-800 bg-zinc-50/50 dark:bg-zinc-950/50 p-4">
                                <span class="text-zinc-500 text-xs font-medium uppercase tracking-wide">Low Stock</span>
                                <div class="mt-1 text-xl font-bold text-zinc-900 dark:text-white">12</div>
                                <span class="text-xs text-blue-600 dark:text-blue-400 mt-1 block">Alerts on</span>
                            </div>
                        </div>

                        <div class="space-y-3 pt-2">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-zinc-500">System Health</span>
                                <span class="font-medium text-emerald-600 dark:text-emerald-400">99.9% Uptime</span>
                            </div>
                            <div class="h-1.5 w-full rounded-full bg-zinc-100 dark:bg-zinc-800 overflow-hidden">
                                <div class="h-full w-full rounded-full bg-gradient-to-r from-emerald-500 via-blue-500 to-indigo-500 animate-pulse"></div>
                            </div>
                        </div>
                    </flux:card>
                </div>
            </div>
        </div>

        <div class="absolute inset-x-0 bottom-0 -z-10 h-24 bg-gradient-to-t from-white dark:from-zinc-950 sm:h-32"></div>
    </div>

    {{-- Features Section --}}
    <div id="features" class="py-24 sm:py-32 bg-zinc-50 dark:bg-zinc-900/30">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                 <h2 class="text-base font-semibold leading-7 text-blue-600 uppercase tracking-wide">Everything you need</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-zinc-900 dark:text-white sm:text-4xl">
                    Powerful tools for every scale.
                </p>
                <p class="mt-6 text-lg leading-8 text-zinc-600 dark:text-zinc-400">
                    Stop juggling spreadhseets. Kinetic Hub brings all your business data into one beautiful, intelligent
                    interface.
                </p>
            </div>

            <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
                 <div class="grid grid-cols-1 gap-x-8 gap-y-16 lg:grid-cols-3">
                    {{-- Feature 1 --}}
                    <div class="flex flex-col group">
                         <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <flux:icon.queue-list class="size-8" />
                        </div>
                        <dt class="flex flex-col gap-y-3 text-xl font-bold leading-7 text-zinc-900 dark:text-white">
                            Smart Inventory
                        </dt>
                        <dd class="mt-1 flex flex-auto flex-col text-base leading-7 text-zinc-600 dark:text-zinc-400">
                            <p class="flex-auto">Track stock levels across multiple warehouses with automated reordering alerts and batch tracking.</p>
                             <p class="mt-6">
                                <a href="#" class="text-sm font-semibold leading-6 text-blue-600 hover:text-blue-500">Learn more <span aria-hidden="true">→</span></a>
                            </p>
                        </dd>
                    </div>

                    {{-- Feature 2 --}}
                    <div class="flex flex-col group">
                        <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                             <flux:icon.chart-bar-square class="size-8" />
                        </div>
                        <dt class="flex flex-col gap-y-3 text-xl font-bold leading-7 text-zinc-900 dark:text-white">
                            Predictive Analytics
                        </dt>
                        <dd class="mt-1 flex flex-auto flex-col text-base leading-7 text-zinc-600 dark:text-zinc-400">
                            <p class="flex-auto">Our AI-driven insights help you forecast demand, optimize procurement, and identify top performers.</p>
                            <p class="mt-6">
                                <a href="#" class="text-sm font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Learn more <span aria-hidden="true">→</span></a>
                            </p>
                        </dd>
                    </div>

                    {{-- Feature 3 --}}
                    <div class="flex flex-col group">
                        <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-emerald-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                             <flux:icon.arrow-path class="size-8" />
                        </div>
                        <dt class="flex flex-col gap-y-3 text-xl font-bold leading-7 text-zinc-900 dark:text-white">
                            Seamless Sync
                        </dt>
                        <dd class="mt-1 flex flex-auto flex-col text-base leading-7 text-zinc-600 dark:text-zinc-400">
                            <p class="flex-auto">Integrate with your favorite marketplaces (Shopify, Amazon) and shipping carriers effortlessly.</p>
                             <p class="mt-6">
                                <a href="#" class="text-sm font-semibold leading-6 text-emerald-600 hover:text-emerald-500">Learn more <span aria-hidden="true">→</span></a>
                            </p>
                        </dd>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Social Proof / Scarcity Section (New) --}}
    <div class="py-16 sm:py-24 bg-white dark:bg-zinc-950 border-t border-zinc-200 dark:border-zinc-800">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                     <h2 class="text-3xl font-bold tracking-tight text-zinc-900 dark:text-white sm:text-4xl">
                        Join the fastest growing community.
                    </h2>
                    <p class="mt-4 text-lg text-zinc-600 dark:text-zinc-400">
                        Over <span class="font-bold text-blue-600">5,000+ businesses</span> rely on Kinetic Hub to scale their operations. Don't get left behind.
                    </p>

                    <div class="mt-8 flex items-center gap-4">
                        <div class="flex -space-x-3">
                            <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white dark:ring-zinc-900" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&h=64&w=64" alt=""/>
                            <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white dark:ring-zinc-900" src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&h=64&w=64" alt=""/>
                            <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white dark:ring-zinc-900" src="https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&h=64&w=64" alt=""/>
                            <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white dark:ring-zinc-900" src="https://images.unsplash.com/photo-1502685104226-ee32379fefbe?auto=format&fit=crop&h=64&w=64" alt=""/>
                        </div>
                        <div class="text-sm font-medium text-zinc-900 dark:text-white">
                            <div class="flex items-center text-yellow-500">
                                <flux:icon.star variant="solid" class="size-4" />
                                <flux:icon.star variant="solid" class="size-4" />
                                <flux:icon.star variant="solid" class="size-4" />
                                <flux:icon.star variant="solid" class="size-4" />
                                <flux:icon.star variant="solid" class="size-4" />
                            </div>
                            from 500+ reviews
                        </div>
                    </div>
                </div>

                <div class="relative rounded-2xl bg-zinc-50 dark:bg-zinc-900 p-8 border border-zinc-200 dark:border-zinc-800">
                    <flux:icon.chat-bubble-left-right class="absolute top-8 right-8 size-8 text-zinc-300 dark:text-zinc-700" />
                    <p class="text-lg font-medium text-zinc-900 dark:text-white italic relative z-10">
                        "Since switching to Kinetic Hub, our inventory accuracy has gone up by 95% and we saved 20 hours a week on manual data entry. It's a game changer."
                    </p>
                    <div class="mt-6 flex items-center gap-3">
                         <div class="h-10 w-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold">
                            JD
                        </div>
                        <div>
                            <div class="font-bold text-zinc-900 dark:text-white">John Doe</div>
                            <div class="text-sm text-zinc-500">CEO at TechStream</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- CTA Section --}}
    <div class="py-24 sm:py-32 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
            <div class="bg-zinc-900 dark:bg-blue-950 rounded-[3rem] px-8 py-16 sm:px-24 sm:py-24 shadow-2xl relative overflow-hidden text-center">
                {{-- Decorative background --}}
                <div class="absolute inset-0 bg-gradient-to-br from-blue-600/30 to-transparent pointer-events-none"></div>
                <div class="absolute -top-24 -left-24 size-96 bg-blue-500/20 rounded-full blur-3xl"></div>

                <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-5xl max-w-2xl mx-auto relative z-10">
                    Ready to take back your time?
                </h2>
                <p class="mx-auto mt-6 max-w-xl text-lg leading-8 text-zinc-300 relative z-10">
                    Start your 14-day free trial today. No contracts, cancel anytime.
                </p>
                <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-6 relative z-10">
                    <flux:button href="{{ route('register') }}" class="w-full sm:w-auto bg-white text-zinc-900 hover:bg-zinc-100 px-10 py-4 text-base font-bold rounded-xl border-none">
                        Get Started Now
                    </flux:button>
                    <a href="{{ route('contact.us') }}" class="text-sm font-semibold leading-6 text-white hover:text-blue-200 transition-colors">
                        Contact Sales <span aria-hidden="true">→</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
