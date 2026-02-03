<?php

use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.public')] class extends Component
{
    public function title(): string
    {
        return 'Solutions | ' . config('app.name');
    }
};
?>

<div class="relative isolate overflow-hidden">
    {{-- Hero Section --}}
    <section class="relative pt-16 pb-20 sm:pt-24 sm:pb-32 overflow-hidden">
        {{-- Background Gradients --}}
        <div class="absolute inset-0 -z-10 transform-gpu overflow-hidden blur-3xl" aria-hidden="true">
            <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-emerald-600 to-teal-800 opacity-20 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <div class="inline-flex items-center gap-2 rounded-full bg-emerald-100 dark:bg-emerald-900/30 px-4 py-1.5 text-xs font-bold uppercase tracking-wider text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800 mb-6">
                    <flux:icon.building-storefront class="size-4" />
                    Built for small businesses
                </div>
                <h1 class="text-4xl font-extrabold tracking-tight text-zinc-900 dark:text-white sm:text-6xl">
                    Solutions for Every <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-600">Growing Business</span>
                </h1>
                <p class="mt-6 text-lg leading-8 text-zinc-600 dark:text-zinc-400 max-w-2xl mx-auto">
                    From small retailers to e-commerce stores - {{ config('app.name') }} adapts to your workflow and scales with your ambitions.
                </p>

                {{-- Anchor Navigation Pills --}}
                <div class="mt-10 flex flex-wrap justify-center gap-3">
                    <a href="#product-sellers" class="px-4 py-2 rounded-full text-sm font-semibold bg-emerald-50 text-emerald-700 hover:bg-emerald-100 dark:bg-emerald-900/30 dark:text-emerald-400 dark:hover:bg-emerald-900/50 transition-all border border-emerald-200 dark:border-emerald-800">
                        Why {{ config('app.name') }}
                    </a>
                    <a href="#use-cases" class="px-4 py-2 rounded-full text-sm font-semibold bg-zinc-100 text-zinc-700 hover:bg-zinc-200 dark:bg-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-700 transition-all">
                        Use Cases
                    </a>
                    <a href="#ai-features" class="px-4 py-2 rounded-full text-sm font-semibold bg-zinc-100 text-zinc-700 hover:bg-zinc-200 dark:bg-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-700 transition-all">
                        AI Features
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Why Choose Section --}}
    <section id="product-sellers" class="py-24 sm:py-32 bg-zinc-50 dark:bg-zinc-900/30">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center mb-16">
                <h2 class="text-base font-semibold leading-7 text-emerald-600 uppercase tracking-wide">Why {{ config('app.name') }}</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-zinc-900 dark:text-white sm:text-4xl">
                    Inventory Management Made Simple
                </p>
                <p class="mt-6 text-lg leading-8 text-zinc-600 dark:text-zinc-400">
                    Stop losing track of stock. {{ config('app.name') }} brings your products, inventory, and sales into one powerful system.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                {{-- Pain Points Column --}}
                <div class="space-y-6">
                    <h3 class="text-xl font-bold text-zinc-900 dark:text-white mb-8 flex items-center gap-2">
                        <span class="size-8 rounded-lg bg-rose-100 dark:bg-rose-900/20 flex items-center justify-center">
                            <flux:icon.x-mark class="size-4 text-rose-600 dark:text-rose-400" />
                        </span>
                        Common Frustrations
                    </h3>

                    <div class="flex gap-4 p-6 rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 shadow-sm">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-rose-100 dark:bg-rose-900/20 text-rose-600 dark:text-rose-400">
                            <flux:icon.cube class="size-6" />
                        </div>
                        <div>
                            <h4 class="font-bold text-zinc-900 dark:text-white">Scattered Inventory Data</h4>
                            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">Stock levels live in spreadsheets across different platforms - impossible to get accurate counts.</p>
                        </div>
                    </div>

                    <div class="flex gap-4 p-6 rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 shadow-sm">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-rose-100 dark:bg-rose-900/20 text-rose-600 dark:text-rose-400">
                            <flux:icon.exclamation-triangle class="size-6" />
                        </div>
                        <div>
                            <h4 class="font-bold text-zinc-900 dark:text-white">Stockouts & Overselling</h4>
                            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">No real-time alerts means you find out about low stock when it's already too late.</p>
                        </div>
                    </div>

                    <div class="flex gap-4 p-6 rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 shadow-sm">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-rose-100 dark:bg-rose-900/20 text-rose-600 dark:text-rose-400">
                            <flux:icon.document-text class="size-6" />
                        </div>
                        <div>
                            <h4 class="font-bold text-zinc-900 dark:text-white">Unprofessional Invoices</h4>
                            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">Creating invoices is tedious, and they don't reflect the quality of your business.</p>
                        </div>
                    </div>
                </div>

                {{-- Solutions Column --}}
                <div class="space-y-6">
                    <h3 class="text-xl font-bold text-emerald-600 dark:text-emerald-400 mb-8 flex items-center gap-2">
                        <span class="size-8 rounded-lg bg-emerald-100 dark:bg-emerald-900/20 flex items-center justify-center">
                            <flux:icon.check class="size-4 text-emerald-600 dark:text-emerald-400" />
                        </span>
                        How {{ config('app.name') }} Helps
                    </h3>

                    <div class="flex gap-4 p-6 rounded-2xl bg-white dark:bg-zinc-900 border border-emerald-200 dark:border-emerald-800/50 shadow-lg shadow-emerald-500/5">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-emerald-600 text-white">
                            <flux:icon.cube class="size-6" />
                        </div>
                        <div>
                            <h4 class="font-bold text-zinc-900 dark:text-white">Centralized Product Catalog</h4>
                            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">All products, images, pricing, and SKUs in one searchable location with categories.</p>
                        </div>
                    </div>

                    <div class="flex gap-4 p-6 rounded-2xl bg-white dark:bg-zinc-900 border border-emerald-200 dark:border-emerald-800/50 shadow-lg shadow-emerald-500/5">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-emerald-600 text-white">
                            <flux:icon.bell-alert class="size-6" />
                        </div>
                        <div>
                            <h4 class="font-bold text-zinc-900 dark:text-white">Real-Time Stock Alerts</h4>
                            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">Get notified when stock runs low. Never miss a reorder point again.</p>
                        </div>
                    </div>

                    <div class="flex gap-4 p-6 rounded-2xl bg-white dark:bg-zinc-900 border border-emerald-200 dark:border-emerald-800/50 shadow-lg shadow-emerald-500/5">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-emerald-600 text-white">
                            <flux:icon.document-check class="size-6" />
                        </div>
                        <div>
                            <h4 class="font-bold text-zinc-900 dark:text-white">Professional Invoicing</h4>
                            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">Beautiful, branded PDF invoices generated in seconds. Look established from day one.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Use Cases Section --}}
    <section id="use-cases" class="py-24 sm:py-32 bg-zinc-50 dark:bg-zinc-900/30">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center mb-16">
                <h2 class="text-base font-semibold leading-7 text-emerald-600 uppercase tracking-wide">Use Cases</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-zinc-900 dark:text-white sm:text-4xl">
                    Built for How You Work
                </p>
                <p class="mt-6 text-lg leading-8 text-zinc-600 dark:text-zinc-400">
                    Whatever your business model, {{ config('app.name') }} adapts to your unique workflow.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                {{-- Retailers & E-commerce --}}
                <div class="group flex flex-col p-8 rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 hover:border-emerald-500/50 hover:shadow-xl hover:shadow-emerald-500/10 transition-all duration-300">
                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <flux:icon.shopping-bag class="size-7" />
                    </div>
                    <h3 class="text-xl font-bold text-zinc-900 dark:text-white">Retailers & E-commerce</h3>
                    <p class="mt-3 text-zinc-600 dark:text-zinc-400 flex-auto">
                        Track inventory across channels, manage SKUs, and sync with Shopify or WooCommerce seamlessly.
                    </p>
                    <div class="mt-6 pt-6 border-t border-zinc-100 dark:border-zinc-800">
                        <span class="text-sm font-semibold text-emerald-600 group-hover:text-emerald-500">
                            Boutiques, online stores, resellers
                        </span>
                    </div>
                </div>

                {{-- Wholesalers & Distributors --}}
                <div class="group flex flex-col p-8 rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 hover:border-teal-500/50 hover:shadow-xl hover:shadow-teal-500/10 transition-all duration-300">
                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-2xl bg-teal-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <flux:icon.truck class="size-7" />
                    </div>
                    <h3 class="text-xl font-bold text-zinc-900 dark:text-white">Wholesalers & Distributors</h3>
                    <p class="mt-3 text-zinc-600 dark:text-zinc-400 flex-auto">
                        Manage bulk inventory, track B2B clients, and generate invoices for large orders with ease.
                    </p>
                    <div class="mt-6 pt-6 border-t border-zinc-100 dark:border-zinc-800">
                        <span class="text-sm font-semibold text-teal-600 group-hover:text-teal-500">
                            Distributors, suppliers, wholesalers
                        </span>
                    </div>
                </div>

                {{-- Handmade & Craft Sellers --}}
                <div class="group flex flex-col p-8 rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 hover:border-emerald-500/50 hover:shadow-xl hover:shadow-emerald-500/10 transition-all duration-300">
                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <flux:icon.sparkles class="size-7" />
                    </div>
                    <h3 class="text-xl font-bold text-zinc-900 dark:text-white">Handmade & Craft Sellers</h3>
                    <p class="mt-3 text-zinc-600 dark:text-zinc-400 flex-auto">
                        Track unique handmade items, manage custom orders, and keep your inventory organized across markets.
                    </p>
                    <div class="mt-6 pt-6 border-t border-zinc-100 dark:border-zinc-800">
                        <span class="text-sm font-semibold text-emerald-600 group-hover:text-emerald-500">
                            Etsy sellers, artisans, makers
                        </span>
                    </div>
                </div>

                {{-- Small Business Owners --}}
                <div class="group flex flex-col p-8 rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 hover:border-teal-500/50 hover:shadow-xl hover:shadow-teal-500/10 transition-all duration-300">
                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-2xl bg-teal-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <flux:icon.building-storefront class="size-7" />
                    </div>
                    <h3 class="text-xl font-bold text-zinc-900 dark:text-white">Small Business Owners</h3>
                    <p class="mt-3 text-zinc-600 dark:text-zinc-400 flex-auto">
                        One platform for everything - products, clients, orders, and invoices without the enterprise complexity.
                    </p>
                    <div class="mt-6 pt-6 border-t border-zinc-100 dark:border-zinc-800">
                        <span class="text-sm font-semibold text-teal-600 group-hover:text-teal-500">
                            Local shops, startups, solopreneurs
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- AI Features Section --}}
    <section id="ai-features" class="py-24 sm:py-32 bg-white dark:bg-zinc-950">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            {{-- Hero AI Card --}}
            <div class="relative overflow-hidden rounded-[2.5rem] border border-emerald-500/30 bg-white dark:bg-zinc-900 shadow-2xl p-8 sm:p-12">
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-950/20 dark:to-teal-950/20 opacity-50"></div>
                <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-emerald-500/10 blur-[100px]"></div>

                <div class="relative grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <div class="flex items-center gap-3 mb-6">
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-600 text-white shadow-lg shadow-emerald-500/20">
                                <flux:icon.sparkles class="size-6" />
                            </div>
                            <span class="text-xs font-black uppercase tracking-widest text-emerald-600 dark:text-emerald-400">AI-Powered</span>
                        </div>
                        <h2 class="text-3xl font-extrabold text-zinc-900 dark:text-white sm:text-4xl">
                            Meet Scribe, Your Business Intelligence
                        </h2>
                        <p class="mt-4 text-lg text-zinc-600 dark:text-zinc-400">
                            Ask questions in plain English. Get instant answers about your clients, revenue, and operations. Scribe understands your business.
                        </p>

                        <div class="mt-8 space-y-4">
                            <div class="flex items-start gap-4">
                                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-emerald-600/10 text-emerald-600">
                                    <flux:icon.cube class="size-5" />
                                </div>
                                <div>
                                    <h4 class="font-bold text-zinc-900 dark:text-white">"Show me low-stock products"</h4>
                                    <p class="text-sm text-zinc-600 dark:text-zinc-400">Instantly see items that need restocking with quantities.</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-teal-600/10 text-teal-600">
                                    <flux:icon.document-text class="size-5" />
                                </div>
                                <div>
                                    <h4 class="font-bold text-zinc-900 dark:text-white">"List unpaid invoices over $500"</h4>
                                    <p class="text-sm text-zinc-600 dark:text-zinc-400">Get instant payment summaries filtered how you need.</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-emerald-600/10 text-emerald-600">
                                    <flux:icon.chart-bar class="size-5" />
                                </div>
                                <div>
                                    <h4 class="font-bold text-zinc-900 dark:text-white">"What are my best-selling products this month?"</h4>
                                    <p class="text-sm text-zinc-600 dark:text-zinc-400">Get instant insights on your top performers and trends.</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8">
                            <flux:button href="{{ route('ai.features') }}" wire:navigate variant="primary" class="shadow-lg shadow-emerald-500/20 bg-emerald-600 hover:bg-emerald-500">
                                Learn More About AI
                            </flux:button>
                        </div>
                    </div>

                    {{-- Chat Preview --}}
                    <div class="relative">
                        <div class="absolute -inset-4 bg-gradient-to-r from-emerald-500/20 to-teal-500/20 rounded-[2rem] blur-xl opacity-50"></div>

                        <div class="relative bg-white dark:bg-zinc-900 rounded-[1.5rem] border border-zinc-200 dark:border-zinc-800 shadow-xl overflow-hidden">
                            {{-- Header --}}
                            <div class="flex items-center gap-3 p-4 border-b border-zinc-100 dark:border-zinc-800">
                                <div class="size-10 rounded-full bg-emerald-600 flex items-center justify-center">
                                    <svg viewBox="0 0 24 24" fill="none" class="size-5 text-white" stroke="currentColor" stroke-width="2">
                                        <path d="m9.06 11.9 8.07-8.06a2.85 2.85 0 1 1 4.03 4.03l-8.06 8.08" />
                                        <path d="M7.07 14.94c-1.66 0-3 1.35-3 3.02 0 1.33-2.5 1.52-2 2.02 1.08 1.1 2.49 2.02 4 2.02 2.2 0 4-1.8 4-4.04a3.01 3.01 0 0 0-3-3.02z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold text-zinc-900 dark:text-white">Scribe</p>
                                    <p class="text-xs text-emerald-600 dark:text-emerald-400">Online</p>
                                </div>
                            </div>

                            {{-- Messages --}}
                            <div class="p-4 space-y-4 min-h-[200px]">
                                <div class="flex justify-end">
                                    <div class="bg-zinc-900 dark:bg-zinc-100 text-white dark:text-zinc-900 px-4 py-2.5 rounded-2xl rounded-tr-none max-w-[80%] text-sm">
                                        Show me low stock items
                                    </div>
                                </div>

                                <div class="flex justify-start">
                                    <div class="bg-zinc-100 dark:bg-zinc-800 text-zinc-800 dark:text-zinc-200 px-4 py-3 rounded-2xl rounded-tl-none max-w-[80%]">
                                        <p class="text-sm font-medium">You have 4 items low on stock:</p>
                                        <ul class="mt-2 space-y-1 text-xs text-zinc-600 dark:text-zinc-400">
                                            <li><span class="text-amber-500">&#8226;</span> Wireless Keyboard - <strong>3 left</strong></li>
                                            <li><span class="text-amber-500">&#8226;</span> USB-C Cable - <strong>5 left</strong></li>
                                            <li><span class="text-zinc-400">&#8226;</span> Phone Stand - <strong>8 left</strong></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            {{-- Input --}}
                            <div class="p-3 border-t border-zinc-100 dark:border-zinc-800">
                                <div class="flex items-center gap-3 bg-zinc-50 dark:bg-zinc-800 rounded-xl px-4 py-2.5">
                                    <span class="text-sm text-zinc-400">Ask Scribe anything...</span>
                                    <flux:icon.paper-airplane class="size-4 text-emerald-600 ml-auto" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Get Started Section --}}
    <section id="get-started" class="py-24 sm:py-32 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="bg-zinc-900 dark:bg-emerald-950 rounded-[3rem] px-8 py-16 sm:px-16 sm:py-24 shadow-2xl relative overflow-hidden">
                {{-- Decorative backgrounds --}}
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-600/30 to-transparent pointer-events-none"></div>
                <div class="absolute -top-24 -left-24 size-96 bg-emerald-500/20 rounded-full blur-3xl"></div>

                <div class="relative z-10">
                    <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl text-center max-w-2xl mx-auto">
                        Start Managing Your Business Like a Pro
                    </h2>
                    <p class="mx-auto mt-6 max-w-xl text-lg leading-8 text-zinc-300 text-center">
                        Join thousands of small businesses managing products, orders, and clients in one place.
                    </p>

                    {{-- 3-Step Process --}}
                    <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="text-center">
                            <div class="inline-flex items-center justify-center size-16 rounded-2xl bg-white/10 text-white text-2xl font-black mb-4">1</div>
                            <h3 class="text-lg font-bold text-white">Sign Up Free</h3>
                            <p class="mt-2 text-sm text-zinc-400">Create your account in 30 seconds. No credit card required.</p>
                        </div>

                        <div class="text-center">
                            <div class="inline-flex items-center justify-center size-16 rounded-2xl bg-white/10 text-white text-2xl font-black mb-4">2</div>
                            <h3 class="text-lg font-bold text-white">Add Your Clients</h3>
                            <p class="mt-2 text-sm text-zinc-400">Import existing contacts or start fresh. We make it easy.</p>
                        </div>

                        <div class="text-center">
                            <div class="inline-flex items-center justify-center size-16 rounded-2xl bg-emerald-500/30 text-emerald-400 text-2xl font-black mb-4 ring-2 ring-emerald-500/50">3</div>
                            <h3 class="text-lg font-bold text-white">Get Paid Faster</h3>
                            <p class="mt-2 text-sm text-zinc-400">Send your first invoice and watch the payments roll in.</p>
                        </div>
                    </div>

                    {{-- CTA Buttons --}}
                    <div class="mt-12 flex flex-col sm:flex-row items-center justify-center gap-6">
                        <flux:button href="{{ route('register') }}" wire:navigate class="w-full sm:w-auto bg-white text-zinc-900 hover:bg-zinc-100 px-10 py-4 text-base font-bold rounded-xl border-none">
                            Start Free Trial
                        </flux:button>
                        <a href="{{ route('pricing') }}" wire:navigate class="text-sm font-semibold text-white hover:text-emerald-200 transition-colors">
                            View Pricing <span aria-hidden="true">&rarr;</span>
                        </a>
                    </div>

                    <p class="mt-6 text-center text-sm text-zinc-400">
                        No credit card required &bull; 14-day free trial &bull; Cancel anytime
                    </p>
                </div>
            </div>
        </div>
    </section>
</div>
