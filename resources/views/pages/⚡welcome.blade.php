<?php

use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Title('Welcome to Kinetic Hub')] #[Layout('layouts.public')] class extends Component {
    //
};
?>

<div class="relative isolate overflow-hidden">
    {{--
        DESIGN CHOICE: Hero Section
        - Psychological Trigger: Clarity & Authority.
        - The large, bold headline (H1) immediately establishes what the product is.
        - The subheadline focuses on the emotional benefit (peace of mind, efficiency).
        - CTA (Primary): High contrast blue to draw the eye.
    --}}

    <!-- Hero Section -->
    <div class="relative pt-10 pb-20 sm:pt-16 sm:pb-32 lg:pb-48 bg-gradient-to-b from-zinc-50 to-white dark:from-zinc-950 dark:to-zinc-900">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-12 lg:gap-x-8 lg:gap-y-20">
                <div class="relative z-10 mx-auto max-w-2xl lg:col-span-7 lg:mx-0 lg:pt-4">
                    <div class="hidden sm:mb-8 sm:flex">
                        <div
                            class="relative rounded-full px-3 py-1 text-sm leading-6 text-zinc-600 dark:text-zinc-400 ring-1 ring-zinc-900/10 dark:ring-zinc-100/10 hover:ring-zinc-900/20 transition-all">
                            Announcing our new Intelligent Analytics. <a href="#"
                                class="font-semibold text-blue-600 dark:text-blue-500"><span class="absolute inset-0"
                                    aria-hidden="true"></span>Read more <span aria-hidden="true">&rarr;</span></a>
                        </div>
                    </div>
                    <h1 class="text-5xl font-extrabold tracking-tight text-zinc-900 dark:text-white sm:text-7xl">
                        Inventory Intelligence <span class="text-blue-600">Perfected.</span>
                    </h1>
                    <p class="mt-6 text-lg leading-8 text-zinc-600 dark:text-zinc-400">
                        Kinetic Hub is the all-in-one business operating system designed to give you total control over
                        your inventory, orders, and growth. Fast, intuitive, and remarkably powerful.
                    </p>
                    <div class="mt-10 flex flex-wrap items-center gap-x-6 gap-y-4">
                        <flux:button href="{{ route('register') }}" variant="primary"
                            class="shadow-lg shadow-blue-500/20">
                            Get Started for Free
                        </flux:button>
                        <flux:button href="#features" variant="ghost" icon-trailing="chevron-down">
                            Explore Features
                        </flux:button>
                        <p class="w-full sm:w-auto text-sm text-zinc-500 dark:text-zinc-500 italic">
                            No credit card required • 14-day free trial
                        </p>
                    </div>

                    <!-- Integrations Section -->
                    <div class="mt-12 pt-12 border-t border-zinc-200 dark:border-zinc-800">
                        <p class="text-sm font-semibold text-zinc-900 dark:text-white mb-6 uppercase tracking-widest">Powering your workflow with</p>
                        <div class="flex flex-wrap items-center gap-x-10 gap-y-6">
                            {{-- QuickBooks --}}
                            <div class="group flex items-center gap-2 grayscale hover:grayscale-0 transition-all duration-300">
                                <img src="https://logo.clearbit.com/quickbooks.intuit.com" alt="QuickBooks" class="h-8 w-auto">
                                <span class="text-lg font-bold text-zinc-400 group-hover:text-zinc-900 dark:group-hover:text-white transition-colors">QuickBooks</span>
                            </div>
                            
                            {{-- Shopify --}}
                            <div class="group flex items-center gap-2 grayscale hover:grayscale-0 transition-all duration-300">
                                <img src="https://logo.clearbit.com/shopify.com" alt="Shopify" class="h-8 w-auto text-green-600">
                                <span class="text-lg font-bold text-zinc-400 group-hover:text-zinc-900 dark:group-hover:text-white transition-colors">Shopify</span>
                            </div>

                            {{-- Stripe --}}
                            <div class="group flex items-center gap-2 grayscale hover:grayscale-0 transition-all duration-300">
                                <img src="https://logo.clearbit.com/stripe.com" alt="Stripe" class="h-8 w-auto">
                                <span class="text-lg font-bold text-zinc-400 group-hover:text-zinc-900 dark:group-hover:text-white transition-colors">Stripe</span>
                            </div>

                            {{-- Gmail --}}
                            <div class="group flex items-center gap-2 grayscale hover:grayscale-0 transition-all duration-300">
                                <img src="https://logo.clearbit.com/gmail.com" alt="Gmail" class="h-8 w-auto">
                                <span class="text-lg font-bold text-zinc-400 group-hover:text-zinc-900 dark:group-hover:text-white transition-colors">Gmail</span>
                            </div>
                        </div>
                        <p class="mt-6 text-xs text-zinc-500 dark:text-zinc-500">
                            + 50 more integrations coming soon. <a href="#" class="text-blue-600 font-medium hover:underline">View all →</a>
                        </p>
                    </div>
                </div>

                <div class="mt-20 lg:col-span-5 lg:mt-0 xl:col-span-5">
                    {{--
                        VISUAL: Abstract representation of movement/inventory
                        Psychological Trigger: Dynamic motion suggests progress and efficiency.
                    --}}
                    <div class="relative px-6 py-6 sm:px-0 lg:px-0">
                        <div
                            class="aspect-square rounded-3xl bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center overflow-hidden border border-zinc-200 dark:border-zinc-700 shadow-2xl skew-y-3 -rotate-3 transition-transform hover:rotate-0 hover:skew-y-0 duration-700">
                            <div class="p-8 space-y-4 w-full">
                                <div class="h-8 bg-blue-500/20 rounded-full w-3/4 animate-pulse"></div>
                                <div class="grid grid-cols-3 gap-3">
                                    <div class="h-32 bg-zinc-200 dark:bg-zinc-700 rounded-xl"></div>
                                    <div class="h-32 bg-zinc-200 dark:bg-zinc-700 rounded-xl"></div>
                                    <div class="h-32 bg-blue-500 rounded-xl"></div>
                                </div>
                                <div class="h-24 bg-zinc-200 dark:bg-zinc-700 rounded-xl w-full"></div>
                                <div class="h-8 bg-zinc-200 dark:bg-zinc-700 rounded-full w-1/2"></div>
                            </div>
                        </div>
                        <!-- Floating Badges for Urgency/Value -->
                        <div
                            class="absolute -top-4 -right-4 bg-white dark:bg-zinc-800 p-4 rounded-2xl shadow-xl border border-zinc-100 dark:border-zinc-700 animate-bounce duration-[3000ms]">
                            <flux:icon.bolt class="text-yellow-500 size-6 mb-1" />
                            <span class="block text-xs font-bold uppercase">Real-time Sync</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div id="features" class="py-24 sm:py-32 bg-zinc-50 dark:bg-zinc-950/50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <h2 class="text-base font-semibold leading-7 text-blue-600 uppercase tracking-wide">Everything you need</h2>
            <p class="mt-2 text-3xl font-bold tracking-tight text-zinc-900 dark:text-white sm:text-4xl">
                Powerful tools for every scale.
            </p>
            <p class="mt-6 text-lg leading-8 text-zinc-600 dark:text-zinc-400 max-w-2xl mx-auto">
                Stop juggling spreadhseets. Kinetic Hub brings all your business data into one beautiful, intelligent
                interface.
            </p>

            <div class="mt-20 grid grid-cols-1 gap-12 sm:grid-cols-2 lg:grid-cols-3">
                {{--
                    DESIGN CHOICE: Feature Grid
                    - Clean icons and concise headings for quick scanning.
                    - Subtle hover effects to encourage interaction.
                --}}

                <div
                    class="relative group p-8 bg-white dark:bg-zinc-900 rounded-3xl border border-transparent hover:border-blue-500/20 transition-all hover:shadow-xl">
                    <div
                        class="size-12 rounded-2xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <flux:icon.queue-list class="size-6 text-blue-600 dark:text-blue-400" />
                    </div>
                    <h3 class="text-xl font-bold text-zinc-900 dark:text-white">Smart Inventory</h3>
                    <p class="mt-4 text-zinc-600 dark:text-zinc-400">Track stock levels across multiple warehouses with
                        automated reordering alerts.</p>
                </div>

                <div
                    class="relative group p-8 bg-white dark:bg-zinc-900 rounded-3xl border border-transparent hover:border-blue-500/20 transition-all hover:shadow-xl">
                    <div
                        class="size-12 rounded-2xl bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <flux:icon.chart-bar-square class="size-6 text-indigo-600 dark:text-indigo-400" />
                    </div>
                    <h3 class="text-xl font-bold text-zinc-900 dark:text-white">Predictive Analytics</h3>
                    <p class="mt-4 text-zinc-600 dark:text-zinc-400">Our AI-driven insights help you forecast demand and
                        optimize your procurement cycles.</p>
                </div>

                <div
                    class="relative group p-8 bg-white dark:bg-zinc-900 rounded-3xl border border-transparent hover:border-blue-500/20 transition-all hover:shadow-xl">
                    <div
                        class="size-12 rounded-2xl bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <flux:icon.arrow-path class="size-6 text-emerald-600 dark:text-emerald-400" />
                    </div>
                    <h3 class="text-xl font-bold text-zinc-900 dark:text-white">Seamless Sync</h3>
                    <p class="mt-4 text-zinc-600 dark:text-zinc-400">Integrate with your favorite marketplaces and
                        shipping carriers effortlessly.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="py-24 sm:py-32">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <div
                class="bg-blue-600 rounded-[3rem] px-8 py-16 sm:px-24 sm:py-24 shadow-2xl shadow-blue-500/40 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-400/20 to-transparent pointer-events-none">
                </div>
                <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl max-w-3xl mx-auto">
                    Ready to take back your time?
                </h2>
                <p class="mx-auto mt-6 max-w-xl text-lg leading-8 text-blue-100">
                    Join over 5,000 businesses making better decisions every day.
                </p>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    <flux:button href="{{ route('register') }}"
                        class="bg-white text-blue-600 hover:bg-zinc-100 px-10 py-4 font-bold rounded-2xl">
                        Get Started Now
                    </flux:button>
                    <a href="{{ route('contact.us') }}"
                        class="text-sm font-semibold leading-6 text-white hover:underline transition-all">Talk to Sales
                        <span aria-hidden="true">→</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
