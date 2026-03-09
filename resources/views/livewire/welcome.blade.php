<?php

use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.public')] class extends Component {
    public function app_name(): string
    {
        return config('app.name');
    }

    public function title(): string
    {
        return config('app.name') . ' - Inventory, Invoices & Insights for Small Business';
    }
};
?>

<div class="relative isolate overflow-hidden">
    {{-- Hero Section --}}
    <div class="relative pt-10 pb-20 sm:pt-24 sm:pb-32 lg:pb-40 overflow-hidden">
        {{-- Background Gradients --}}
        <div class="absolute inset-0 -z-10 transform-gpu overflow-hidden blur-3xl" aria-hidden="true">
            <div
                class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-emerald-600 to-teal-800 opacity-20 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:gap-y-20 items-center">
                {{-- Left Column: Copy --}}
                <div class="relative z-10 mx-auto max-w-2xl lg:col-span-7 lg:mx-0 lg:pt-4">
                    <div class="mb-8">
                        <div class="inline-flex items-center gap-2 rounded-full bg-emerald-100 dark:bg-emerald-900/30 px-4 py-1.5 text-xs font-bold uppercase tracking-wider text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800">
                            <flux:icon.sparkles class="size-4" />
                            AI-Powered Business OS for Small Product Sellers
                        </div>
                    </div>

                    <h1 class="text-5xl font-extrabold tracking-tight text-zinc-900 dark:text-white sm:text-7xl mb-6">
                        Inventory. Invoices. <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-600">Insights.</span>
                    </h1>

                    <p class="text-lg leading-8 text-zinc-600 dark:text-zinc-400 mb-8 max-w-lg">
                        The all-in-one platform for small businesses to manage products, track inventory, and get paid on time. Simple, powerful, and built for the way you work.
                    </p>

                    <div class="flex flex-wrap items-center gap-4">
                        <flux:button href="{{ route('register') }}" wire:navigate variant="primary"
                            class="shadow-lg shadow-emerald-500/20 px-8 py-3 h-auto text-base bg-emerald-600 hover:bg-emerald-500">
                            Get Started for Free
                        </flux:button>
                        <flux:button href="#how-it-works" variant="ghost" icon-trailing="chevron-down"
                            class="px-6 py-3 h-auto text-base">
                            See How It Works
                        </flux:button>
                    </div>
                    <p class="mt-4 text-sm text-zinc-500 dark:text-zinc-500 italic">
                        No credit card required • 14-day free trial
                    </p>

                    {{-- Hero Integrations Placeholder (Removed as per request, moved to dedicated section) --}}
                </div>

                <div class="mt-16 sm:mt-24 lg:mt-0 lg:col-span-5 relative">
                    {{-- Blob behind card --}}
                    <div class="absolute -top-12 -right-12 -z-10 size-64 rounded-full bg-emerald-500/30 blur-3xl"></div>

                    <flux:card
                        class="space-y-6 border border-zinc-200/50 dark:border-zinc-800/50 bg-white/80 dark:bg-zinc-900/80 backdrop-blur-md shadow-2xl shadow-zinc-200/50 dark:shadow-black/50 ring-1 ring-zinc-900/5 dark:ring-white/10">
                        <div
                            class="flex items-center justify-between gap-3 border-b border-zinc-100 dark:border-zinc-800 pb-4">
                            <div>
                                <flux:heading size="md" class="text-zinc-900 dark:text-zinc-100 font-bold">Business Dashboard</flux:heading>
                                <flux:text size="sm" class="text-zinc-500">Products, orders & revenue</flux:text>
                            </div>
                            <div
                                class="rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-medium text-emerald-600 dark:text-emerald-400 flex items-center gap-1.5 border border-emerald-500/20">
                                <span class="relative flex h-2 w-2">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                                </span>
                                Live
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div
                                class="rounded-xl border border-zinc-100 dark:border-zinc-800 bg-zinc-50/50 dark:bg-zinc-950/50 p-4">
                                <span class="text-zinc-500 text-xs font-medium uppercase tracking-wide">Products</span>
                                <div class="mt-1 text-xl font-bold text-zinc-900 dark:text-white">127</div>
                                <span class="text-xs text-emerald-600 dark:text-emerald-400 mt-1 block">8 low stock</span>
                            </div>

                            <div
                                class="rounded-xl border border-zinc-100 dark:border-zinc-800 bg-zinc-50/50 dark:bg-zinc-950/50 p-4">
                                <span class="text-zinc-500 text-xs font-medium uppercase tracking-wide">Orders</span>
                                <div class="mt-1 text-xl font-bold text-zinc-900 dark:text-white">24</div>
                                <span class="text-xs text-teal-600 dark:text-teal-400 mt-1 block">5 pending</span>
                            </div>

                            <div
                                class="rounded-xl border border-zinc-100 dark:border-zinc-800 bg-zinc-50/50 dark:bg-zinc-950/50 p-4">
                                <span class="text-zinc-500 text-xs font-medium uppercase tracking-wide">Revenue</span>
                                <div class="mt-1 text-xl font-bold text-zinc-900 dark:text-white">$12,450</div>
                                <span class="text-xs text-emerald-600 dark:text-emerald-400 mt-1 block">+24.5%</span>
                            </div>

                            <div
                                class="rounded-xl border border-zinc-100 dark:border-zinc-800 bg-zinc-50/50 dark:bg-zinc-950/50 p-4">
                                <span class="text-zinc-500 text-xs font-medium uppercase tracking-wide">Clients</span>
                                <div class="mt-1 text-xl font-bold text-zinc-900 dark:text-white">48</div>
                                <span class="text-xs text-emerald-600 dark:text-emerald-400 mt-1 block">+6 this month</span>
                            </div>
                        </div>

                        <div class="space-y-3 pt-2">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-zinc-500">Invoice Collection</span>
                                <span class="font-medium text-emerald-600 dark:text-emerald-400">94% On-Time</span>
                            </div>
                            <div class="h-1.5 w-full rounded-full bg-zinc-100 dark:bg-zinc-800 overflow-hidden">
                                <div
                                    class="h-full w-[94%] rounded-full bg-gradient-to-r from-emerald-500 to-teal-500">
                                </div>
                            </div>
                        </div>
                    </flux:card>
                </div>
            </div>
        </div>

        <div class="absolute inset-x-0 bottom-0 -z-10 h-24 bg-gradient-to-t from-white dark:from-zinc-950 sm:h-32">
        </div>
    </div>

    {{-- How It Works Section --}}
    <div id="how-it-works" class="py-24 sm:py-32 bg-white dark:bg-zinc-950">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center mb-16">
                <h2 class="text-base font-semibold leading-7 text-emerald-600 uppercase tracking-wide">Simple Workflow</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-zinc-900 dark:text-white sm:text-4xl">
                    From client to cash in four easy steps.
                </p>
                <p class="mt-6 text-lg leading-8 text-zinc-600 dark:text-zinc-400">
                    {{ $this->app_name() }} streamlines your entire invoicing workflow so you can focus on what matters most - your work.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
                {{-- Step 1 --}}
                <div class="relative group">
                    <div class="flex flex-col items-center text-center">
                        <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-emerald-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <flux:icon.user-plus class="size-8" />
                        </div>
                        <div class="absolute top-8 left-[calc(50%+2rem)] hidden lg:block w-[calc(100%-4rem)] h-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 opacity-30"></div>
                        <span class="text-xs font-bold text-emerald-600 uppercase tracking-widest mb-2">Step 1</span>
                        <h3 class="text-xl font-bold text-zinc-900 dark:text-white">Add Your Clients</h3>
                        <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                            Import contacts or add them manually. Store all client details in one organized place.
                        </p>
                    </div>
                </div>

                {{-- Step 2 --}}
                <div class="relative group">
                    <div class="flex flex-col items-center text-center">
                        <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-teal-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <flux:icon.clipboard-document-list class="size-8" />
                        </div>
                        <div class="absolute top-8 left-[calc(50%+2rem)] hidden lg:block w-[calc(100%-4rem)] h-0.5 bg-gradient-to-r from-teal-500 to-emerald-500 opacity-30"></div>
                        <span class="text-xs font-bold text-teal-600 uppercase tracking-widest mb-2">Step 2</span>
                        <h3 class="text-xl font-bold text-zinc-900 dark:text-white">Add Your Products</h3>
                        <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                            Build your catalog with products, images, and pricing. Track inventory with real-time stock levels.
                        </p>
                    </div>
                </div>

                {{-- Step 3 --}}
                <div class="relative group">
                    <div class="flex flex-col items-center text-center">
                        <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-emerald-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <flux:icon.paper-airplane class="size-8" />
                        </div>
                        <div class="absolute top-8 left-[calc(50%+2rem)] hidden lg:block w-[calc(100%-4rem)] h-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 opacity-30"></div>
                        <span class="text-xs font-bold text-emerald-600 uppercase tracking-widest mb-2">Step 3</span>
                        <h3 class="text-xl font-bold text-zinc-900 dark:text-white">Send Invoices</h3>
                        <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                            Generate professional PDF invoices in seconds. Send via email with one click.
                        </p>
                    </div>
                </div>

                {{-- Step 4 --}}
                <div class="relative group">
                    <div class="flex flex-col items-center text-center">
                        <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-emerald-600 to-teal-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300 ring-4 ring-emerald-500/20">
                            <flux:icon.banknotes class="size-8" />
                        </div>
                        <span class="text-xs font-bold text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-600 uppercase tracking-widest mb-2">Step 4</span>
                        <h3 class="text-xl font-bold text-zinc-900 dark:text-white">Get Paid</h3>
                        <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                            Track payments automatically and never miss a payment again.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Integrations Section --}}
    <div class="py-24 sm:py-32 bg-white dark:bg-zinc-950">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center mb-16">
                <h2 class="text-base font-semibold leading-7 text-emerald-600 uppercase tracking-wide">Works With Your Tools</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-zinc-900 dark:text-white sm:text-4xl">
                    Connect with apps you already use.
                </p>
                <p class="mt-6 text-lg leading-8 text-zinc-600 dark:text-zinc-400">
                    {{ $this->app_name() }} integrates with popular business tools to help you sync contacts, products, and accounting data.
                </p>
            </div>

            <div class="grid grid-cols-2 gap-6 sm:gap-8 md:grid-cols-4 max-w-4xl mx-auto">
                {{-- Google Contacts (Available) --}}
                <div class="group flex flex-col items-center gap-4 transition-all hover:-translate-y-2">
                    <div class="relative">
                        <div
                            class="size-20 rounded-2xl bg-zinc-50 dark:bg-zinc-900 flex items-center justify-center shadow-md group-hover:shadow-xl group-hover:bg-blue-50 dark:group-hover:bg-blue-900/10 transition-all border border-zinc-100 dark:border-zinc-800">
                            <img src="https://www.gstatic.com/images/branding/product/1x/contacts_2022_48dp.png"
                                alt="Google Contacts" class="size-10 group-hover:scale-110 transition-all">
                        </div>
                        <div class="absolute -top-1 -right-1 size-5 rounded-full bg-emerald-500 flex items-center justify-center">
                            <flux:icon.check class="size-3 text-white" />
                        </div>
                    </div>
                    <div class="text-center">
                        <span class="text-xs sm:text-sm font-bold text-zinc-700 dark:text-zinc-200 block">Google Contacts</span>
                        <span class="text-[10px] text-emerald-600 dark:text-emerald-400 font-medium">Available</span>
                    </div>
                </div>

                {{-- HubSpot (Coming Soon) --}}
                <div class="group flex flex-col items-center gap-4 transition-all hover:-translate-y-1 opacity-75">
                    <div class="relative">
                        <div
                            class="size-20 rounded-2xl bg-zinc-50 dark:bg-zinc-900 flex items-center justify-center shadow-md transition-all border border-zinc-100 dark:border-zinc-800">
                            <svg class="size-10 text-[#ff7a59]" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18.164 7.93V5.084a2.198 2.198 0 0 0 1.267-1.984v-.066A2.198 2.198 0 0 0 17.238.841h-.066a2.198 2.198 0 0 0-2.193 2.193v.066c0 .87.506 1.62 1.24 1.974v2.86a5.194 5.194 0 0 0-2.418 1.178L6.076 3.408a2.768 2.768 0 0 0 .066-.535 2.78 2.78 0 1 0-2.78 2.78c.377 0 .733-.08 1.06-.217l7.64 5.576a5.2 5.2 0 0 0-.507 2.235 5.234 5.234 0 0 0 5.228 5.228 5.18 5.18 0 0 0 2.12-.458l2.493 2.493a1.86 1.86 0 1 0 1.14-1.122l-2.47-2.47a5.2 5.2 0 0 0 1.098-3.199 5.234 5.234 0 0 0-5.228-5.228c-.653 0-1.273.134-1.842.355zm-1.38 7.747a2.598 2.598 0 0 1-2.596-2.596 2.598 2.598 0 0 1 2.596-2.596 2.598 2.598 0 0 1 2.596 2.596 2.598 2.598 0 0 1-2.596 2.596z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="text-center">
                        <span class="text-xs sm:text-sm font-bold text-zinc-500 dark:text-zinc-400 block">HubSpot</span>
                        <span class="text-[10px] text-zinc-400 dark:text-zinc-500 font-medium">Coming Soon</span>
                    </div>
                </div>

                {{-- QuickBooks (Coming Soon) --}}
                <div class="group flex flex-col items-center gap-4 transition-all hover:-translate-y-1 opacity-75">
                    <div class="relative">
                        <div
                            class="size-20 rounded-2xl bg-zinc-50 dark:bg-zinc-900 flex items-center justify-center shadow-md transition-all border border-zinc-100 dark:border-zinc-800">
                            <svg class="size-10 text-[#2CA01C]" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm.768 17.095h-1.72V14.39H8.69c-1.404 0-2.542-1.164-2.542-2.6 0-1.436 1.138-2.6 2.542-2.6h.716v1.72h-.716c-.475 0-.86.394-.86.88s.385.88.86.88h2.358V8.537c0-1.404 1.163-2.542 2.6-2.542 1.435 0 2.6 1.138 2.6 2.542v.716h-1.72v-.716c0-.475-.395-.86-.88-.86-.486 0-.88.385-.88.86v6.916h2.357c.475 0 .86-.394.86-.88s-.385-.88-.86-.88h-.716v-1.72h.716c1.404 0 2.542 1.164 2.542 2.6 0 1.436-1.138 2.6-2.542 2.6h-2.357v2.642z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="text-center">
                        <span class="text-xs sm:text-sm font-bold text-zinc-500 dark:text-zinc-400 block">QuickBooks</span>
                        <span class="text-[10px] text-zinc-400 dark:text-zinc-500 font-medium">Coming Soon</span>
                    </div>
                </div>

                {{-- Shopify (Coming Soon) --}}
                <div class="group flex flex-col items-center gap-4 transition-all hover:-translate-y-1 opacity-75">
                    <div class="relative">
                        <div
                            class="size-20 rounded-2xl bg-zinc-50 dark:bg-zinc-900 flex items-center justify-center shadow-md transition-all border border-zinc-100 dark:border-zinc-800">
                            <svg class="size-10 text-[#96bf48]" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M15.337 23.979l7.216-1.561s-2.604-17.613-2.625-17.73c-.018-.116-.114-.192-.211-.192s-1.929-.136-1.929-.136-1.275-1.274-1.439-1.411c-.045-.037-.075-.057-.121-.074l-.914 21.104h.023zm-1.278-17.079l-.674 2.063s-.749-.353-1.657-.353c-1.338 0-1.405.839-1.405 1.05 0 1.153 3.008 1.596 3.008 4.301 0 2.127-1.349 3.497-3.165 3.497-2.181 0-3.297-1.357-3.297-1.357l.584-1.924s1.148.986 2.118.986c.633 0 .893-.499.893-.864 0-1.508-2.467-1.574-2.467-4.048 0-2.082 1.494-4.098 4.513-4.098 1.164 0 1.749.338 1.749.338v.409zm-3.08-5.893c.162.088.303.18.303.18s-1.479.427-2.93.427v-.148c0-.606.258-1.543 1.015-1.543.48 0 .799.223 1.082.632l.53.452zM9.598.315L9.504 0l-.19.033-.12.033c-.02 0-.036.012-.055.02-.022.008-.043.02-.063.028l-.003.001c-.085.045-.158.103-.22.168-.196.21-.334.502-.408.846l-.001.006-.081.377v.024l1.234-.317V.315h.001z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="text-center">
                        <span class="text-xs sm:text-sm font-bold text-zinc-500 dark:text-zinc-400 block">Shopify</span>
                        <span class="text-[10px] text-zinc-400 dark:text-zinc-500 font-medium">Coming Soon</span>
                    </div>
                </div>
            </div>

            <div class="mt-12 text-center">
                <p class="text-sm text-zinc-500 dark:text-zinc-400">
                    More integrations are on the way. <a href="{{ route('contact.us') }}" wire:navigate class="text-emerald-600 hover:text-emerald-500 font-medium">Request an integration</a>
                </p>
            </div>
        </div>
    </div>

    {{-- AI Assistant Section --}}
    <div class="py-24 sm:py-32 bg-zinc-50 dark:bg-zinc-900/30">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-16 items-center">
                {{-- Left: Content --}}
                <div class="max-w-xl">
                    <div class="inline-flex items-center gap-2 rounded-full bg-emerald-100 dark:bg-emerald-900/30 px-3 py-1 text-xs font-bold uppercase tracking-widest text-emerald-700 dark:text-emerald-400 mb-6">
                        <flux:icon.sparkles class="size-4" />
                        AI-Powered
                    </div>

                    <h2 class="text-3xl font-bold tracking-tight text-zinc-900 dark:text-white sm:text-4xl">
                        Meet Scribe, your AI business assistant.
                    </h2>

                    <p class="mt-6 text-lg leading-8 text-zinc-600 dark:text-zinc-400">
                        Ask questions in plain English. Get instant answers about your clients, invoices, and business performance. Scribe understands your data and helps you make smarter decisions.
                    </p>

                    <div class="mt-8 space-y-4">
                        <div class="flex items-start gap-4">
                            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-emerald-600/10 text-emerald-600">
                                <flux:icon.chat-bubble-left-right class="size-5" />
                            </div>
                            <div>
                                <h4 class="font-bold text-zinc-900 dark:text-white">"Show me unpaid invoices"</h4>
                                <p class="text-sm text-zinc-600 dark:text-zinc-400">Instantly see all outstanding payments with client details.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-teal-600/10 text-teal-600">
                                <flux:icon.chart-bar class="size-5" />
                            </div>
                            <div>
                                <h4 class="font-bold text-zinc-900 dark:text-white">"What's my revenue this quarter?"</h4>
                                <p class="text-sm text-zinc-600 dark:text-zinc-400">Get instant financial summaries and trends.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-emerald-600/10 text-emerald-600">
                                <flux:icon.user-group class="size-5" />
                            </div>
                            <div>
                                <h4 class="font-bold text-zinc-900 dark:text-white">"Who are my top clients?"</h4>
                                <p class="text-sm text-zinc-600 dark:text-zinc-400">Identify your most valuable relationships at a glance.</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <flux:button href="{{ route('ai.features') }}" wire:navigate variant="primary" class="shadow-lg shadow-emerald-500/20 bg-emerald-600 hover:bg-emerald-500">
                            Learn More About AI
                        </flux:button>
                    </div>
                </div>

                {{-- Right: Chat Preview --}}
                <div class="mt-16 lg:mt-0">
                    <div class="relative">
                        <div class="absolute -inset-4 bg-gradient-to-r from-emerald-500/20 to-teal-500/20 rounded-[2rem] blur-xl opacity-50"></div>

                        <flux:card class="relative overflow-hidden border border-zinc-200/50 dark:border-zinc-800/50 bg-white/80 dark:bg-zinc-900/80 backdrop-blur-md shadow-2xl">
                            {{-- Chat Header --}}
                            <div class="flex items-center gap-3 p-4 border-b border-zinc-100 dark:border-zinc-800">
                                <div class="w-10 h-10 rounded-xl bg-emerald-600 flex items-center justify-center">
                                    <svg viewBox="0 0 24 24" fill="none" class="w-6 h-6 text-white" stroke="currentColor" stroke-width="1.5">
                                        <path d="m9.06 11.9 8.07-8.06a2.85 2.85 0 1 1 4.03 4.03l-8.06 8.08" />
                                        <path d="M7.07 14.94c-1.66 0-3 1.35-3 3.02 0 1.33-2.5 1.52-2 2.02 1.08 1.1 2.49 2.02 4 2.02 2.2 0 4-1.8 4-4.04a3.01 3.01 0 0 0-3-3.02z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-zinc-900 dark:text-white">Scribe</h4>
                                    <p class="text-xs text-emerald-600">Online</p>
                                </div>
                            </div>

                            {{-- Sample Conversation --}}
                            <div class="p-4 space-y-4 min-h-[200px]">
                                <div class="flex justify-end">
                                    <div class="bg-zinc-900 dark:bg-zinc-100 text-white dark:text-zinc-900 px-4 py-2 rounded-2xl rounded-tr-none max-w-[80%] text-sm">
                                        Show me pending invoices
                                    </div>
                                </div>

                                <div class="flex justify-start">
                                    <div class="bg-zinc-50 dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 px-4 py-2 rounded-2xl rounded-tl-none max-w-[80%]">
                                        <p class="text-sm text-zinc-800 dark:text-zinc-200">You have <strong>4 pending invoices</strong> totaling <strong>$3,200</strong>:</p>
                                        <ul class="mt-2 text-xs text-zinc-600 dark:text-zinc-400 space-y-1">
                                            <li class="flex items-center gap-1"><span class="text-amber-500">&#8226;</span> Acme Corp - $1,200 (due in 3 days)</li>
                                            <li class="flex items-center gap-1"><span class="text-zinc-400">&#8226;</span> TechStart Inc - $850</li>
                                            <li class="flex items-center gap-1"><span class="text-zinc-400">&#8226;</span> Design Co - $650</li>
                                            <li class="flex items-center gap-1"><span class="text-zinc-400">&#8226;</span> Smith & Associates - $500</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </flux:card>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Features Section --}}
    <div id="features" class="py-24 sm:py-32 bg-white dark:bg-zinc-950">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-base font-semibold leading-7 text-emerald-600 uppercase tracking-wide">Everything you need</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-zinc-900 dark:text-white sm:text-4xl">
                    Powerful tools for growing businesses.
                </p>
                <p class="mt-6 text-lg leading-8 text-zinc-600 dark:text-zinc-400">
                    From inventory tracking to invoicing - {{ $this->app_name() }} brings everything into one beautiful, intelligent interface.
                </p>
            </div>

            <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
                <div class="grid grid-cols-1 gap-x-8 gap-y-16 lg:grid-cols-3">
                    {{-- Feature 1: Product & Inventory --}}
                    <div class="flex flex-col group">
                        <div
                            class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-emerald-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <flux:icon.cube class="size-8" />
                        </div>
                        <dt class="flex flex-col gap-y-3 text-xl font-bold leading-7 text-zinc-900 dark:text-white">
                            Product & Inventory
                        </dt>
                        <dd class="mt-1 flex flex-auto flex-col text-base leading-7 text-zinc-600 dark:text-zinc-400">
                            <p class="flex-auto">Manage your product catalog with real-time stock tracking. Get low-stock alerts, track SKUs, and organize with categories.</p>
                            <p class="mt-6">
                                <a href="{{ route('solutions') }}#product-sellers" wire:navigate
                                    class="text-sm font-semibold leading-6 text-emerald-600 hover:text-emerald-500">Learn
                                    more <span aria-hidden="true">→</span></a>
                            </p>
                        </dd>
                    </div>

                    {{-- Feature 2: Orders & Invoicing --}}
                    <div class="flex flex-col group">
                        <div
                            class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-teal-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <flux:icon.document-text class="size-8" />
                        </div>
                        <dt class="flex flex-col gap-y-3 text-xl font-bold leading-7 text-zinc-900 dark:text-white">
                            Orders & Invoicing
                        </dt>
                        <dd class="mt-1 flex flex-auto flex-col text-base leading-7 text-zinc-600 dark:text-zinc-400">
                            <p class="flex-auto">Create orders, generate professional PDF invoices, and track payments. Automatic stock updates when orders are placed.</p>
                            <p class="mt-6">
                                <a href="{{ route('solutions') }}#product-sellers" wire:navigate
                                    class="text-sm font-semibold leading-6 text-teal-600 hover:text-teal-500">Learn
                                    more <span aria-hidden="true">→</span></a>
                            </p>
                        </dd>
                    </div>

                    {{-- Feature 3: Client CRM --}}
                    <div class="flex flex-col group">
                        <div
                            class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-emerald-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <flux:icon.users class="size-8" />
                        </div>
                        <dt class="flex flex-col gap-y-3 text-xl font-bold leading-7 text-zinc-900 dark:text-white">
                            Client CRM
                        </dt>
                        <dd class="mt-1 flex flex-auto flex-col text-base leading-7 text-zinc-600 dark:text-zinc-400">
                            <p class="flex-auto">Keep all your contacts organized - customers, suppliers, and leads. Track orders, invoices, and full interaction history.</p>
                            <p class="mt-6">
                                <a href="{{ route('solutions') }}#use-cases" wire:navigate
                                    class="text-sm font-semibold leading-6 text-emerald-600 hover:text-emerald-500">Learn
                                    more <span aria-hidden="true">→</span></a>
                            </p>
                        </dd>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- CTA Section --}}
    <div class="py-24 sm:py-32 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
            <div
                class="bg-zinc-900 dark:bg-emerald-950 rounded-[3rem] px-8 py-16 sm:px-24 sm:py-24 shadow-2xl relative overflow-hidden text-center">
                {{-- Decorative background --}}
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-600/30 to-transparent pointer-events-none">
                </div>
                <div class="absolute -top-24 -left-24 size-96 bg-emerald-500/20 rounded-full blur-3xl"></div>

                <h2
                    class="text-3xl font-extrabold tracking-tight text-white sm:text-5xl max-w-2xl mx-auto relative z-10">
                    Ready to simplify your business?
                </h2>
                <p class="mx-auto mt-6 max-w-xl text-lg leading-8 text-zinc-300 relative z-10">
                    Join thousands of small businesses managing products, orders, and clients in one place. Start your 14-day free trial today.
                </p>
                <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-6 relative z-10">
                    <flux:button href="{{ route('register') }}" wire:navigate
                        class="w-full sm:w-auto bg-white text-zinc-900 hover:bg-zinc-100 px-10 py-4 text-base font-bold rounded-xl border-none">
                        Get Started Now
                    </flux:button>
                    <a href="{{ route('pricing') }}" wire:navigate
                        class="text-sm font-semibold leading-6 text-white hover:text-emerald-200 transition-colors">
                        View Pricing <span aria-hidden="true">→</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
