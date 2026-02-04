<?php

use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.public')] class extends Component
{
    public function title(): string
    {
        return 'AI Features | ' . config('app.name');
    }
};
?>

<div class="relative isolate overflow-hidden">
    {{-- Hero Section --}}
    <section class="relative pt-24 pb-32 sm:pt-32 sm:pb-40 overflow-hidden">
        {{-- Animated Background Effects --}}
        <div class="absolute inset-0 -z-10">
            <div class="absolute -top-[30%] -left-[10%] w-[60%] h-[60%] bg-gradient-to-br from-emerald-500/20 to-teal-500/20 rounded-full blur-[120px] animate-pulse"></div>
            <div class="absolute -bottom-[20%] -right-[10%] w-[50%] h-[50%] bg-gradient-to-tl from-teal-500/15 to-emerald-500/15 rounded-full blur-[100px] animate-pulse [animation-delay:2s]"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 rounded-full bg-emerald-100 dark:bg-emerald-900/30 px-4 py-1.5 text-xs font-bold uppercase tracking-widest text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800 mb-8">
                    <flux:icon.sparkles class="size-4" />
                    <span>Artificial Intelligence</span>
                </div>

                {{-- Heading --}}
                <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight text-zinc-900 dark:text-white leading-tight">
                    AI-Powered
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-600">
                        Business Intelligence
                    </span>
                </h1>

                {{-- Subheading --}}
                <p class="mt-8 text-lg sm:text-xl text-zinc-600 dark:text-zinc-400 leading-relaxed max-w-2xl mx-auto">
                    Meet Scribe, your intelligent business assistant. Get predictive insights, automate workflows, and make data-driven decisions with the power of AI.
                </p>

                {{-- CTA Buttons --}}
                <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                    <flux:button href="{{ route('register') }}" wire:navigate variant="primary" class="px-8 py-4 text-base font-bold shadow-lg shadow-emerald-500/20 bg-emerald-600 hover:bg-emerald-500">
                        Get Started Free
                    </flux:button>
                    <flux:button href="#meet-scribe" variant="ghost" icon-trailing="arrow-down" class="px-6 py-4">
                        See Scribe in Action
                    </flux:button>
                </div>
            </div>
        </div>
    </section>

    {{-- Meet Scribe Section --}}
    <section id="meet-scribe" class="py-24 sm:py-32 bg-zinc-50 dark:bg-zinc-900/50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                {{-- Left: Description --}}
                <div>
                    <div class="inline-flex items-center gap-2 rounded-full bg-emerald-100 dark:bg-emerald-900/30 px-4 py-1.5 text-xs font-bold uppercase tracking-widest text-emerald-700 dark:text-emerald-400 mb-6">
                        <flux:icon.sparkles class="size-4" />
                        Your AI Partner
                    </div>

                    <h2 class="text-3xl sm:text-4xl font-extrabold text-zinc-900 dark:text-white">
                        Meet <span class="text-emerald-600">Scribe</span>
                    </h2>

                    <p class="mt-6 text-lg text-zinc-600 dark:text-zinc-400">
                        Scribe is your intelligent business assistant, designed to understand your operations and help you make smarter decisions. Just ask in plain English.
                    </p>

                    {{-- Feature List --}}
                    <div class="mt-10 space-y-6">
                        <div class="flex gap-4">
                            <div class="size-10 rounded-xl bg-emerald-100 dark:bg-emerald-900/20 flex items-center justify-center shrink-0">
                                <flux:icon.chat-bubble-left-right class="size-5 text-emerald-600 dark:text-emerald-400" />
                            </div>
                            <div>
                                <h3 class="font-bold text-zinc-900 dark:text-white">Natural Conversations</h3>
                                <p class="text-sm text-zinc-600 dark:text-zinc-400">No complex queries or syntax. Just ask what you need in everyday language.</p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="size-10 rounded-xl bg-emerald-100 dark:bg-emerald-900/20 flex items-center justify-center shrink-0">
                                <flux:icon.bolt class="size-5 text-emerald-600 dark:text-emerald-400" />
                            </div>
                            <div>
                                <h3 class="font-bold text-zinc-900 dark:text-white">Instant Actions</h3>
                                <p class="text-sm text-zinc-600 dark:text-zinc-400">Create products, search data, generate reports - all through conversation.</p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="size-10 rounded-xl bg-emerald-100 dark:bg-emerald-900/20 flex items-center justify-center shrink-0">
                                <flux:icon.light-bulb class="size-5 text-emerald-600 dark:text-emerald-400" />
                            </div>
                            <div>
                                <h3 class="font-bold text-zinc-900 dark:text-white">Smart Suggestions</h3>
                                <p class="text-sm text-zinc-600 dark:text-zinc-400">Proactive insights based on your data patterns and business trends.</p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="size-10 rounded-xl bg-emerald-100 dark:bg-emerald-900/20 flex items-center justify-center shrink-0">
                                <flux:icon.shield-check class="size-5 text-emerald-600 dark:text-emerald-400" />
                            </div>
                            <div>
                                <h3 class="font-bold text-zinc-900 dark:text-white">Private & Secure</h3>
                                <p class="text-sm text-zinc-600 dark:text-zinc-400">Your data stays yours. Scribe operates within your account boundaries.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right: Chat Interface Mockup --}}
                <div class="relative">
                    {{-- Decorative blur --}}
                    <div class="absolute -inset-4 bg-gradient-to-r from-emerald-500/20 to-teal-500/20 rounded-[2.5rem] blur-xl opacity-50"></div>

                    {{-- Chat Window --}}
                    <div class="relative bg-white dark:bg-zinc-900 rounded-[2rem] border border-zinc-200 dark:border-zinc-800 shadow-2xl overflow-hidden">
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
                            <div class="ml-auto flex items-center gap-1">
                                <span class="relative flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                                </span>
                            </div>
                        </div>

                        {{-- Chat Messages --}}
                        <div class="p-6 space-y-4 min-h-[320px]">
                            {{-- User Message --}}
                            <div class="flex justify-end">
                                <div class="bg-zinc-900 dark:bg-zinc-100 text-white dark:text-zinc-900 px-4 py-3 rounded-2xl rounded-tr-none max-w-[80%]">
                                    Show me low-stock products
                                </div>
                            </div>

                            {{-- Scribe Response --}}
                            <div class="flex justify-start">
                                <div class="bg-zinc-100 dark:bg-zinc-800 text-zinc-800 dark:text-zinc-200 px-4 py-3 rounded-2xl rounded-tl-none max-w-[80%]">
                                    <p class="font-medium">You have 4 items low on stock:</p>
                                    <ul class="mt-2 space-y-1 text-sm">
                                        <li><span class="text-amber-500">&#8226;</span> Wireless Keyboard - <strong>3 left</strong></li>
                                        <li><span class="text-amber-500">&#8226;</span> USB-C Cable - <strong>5 left</strong></li>
                                        <li><span class="text-zinc-400">&#8226;</span> Phone Stand - <strong>8 left</strong></li>
                                    </ul>
                                </div>
                            </div>

                            {{-- User Message --}}
                            <div class="flex justify-end">
                                <div class="bg-zinc-900 dark:bg-zinc-100 text-white dark:text-zinc-900 px-4 py-3 rounded-2xl rounded-tr-none max-w-[80%]">
                                    What are my best sellers this month?
                                </div>
                            </div>

                            {{-- Scribe Response --}}
                            <div class="flex justify-start">
                                <div class="bg-zinc-100 dark:bg-zinc-800 text-zinc-800 dark:text-zinc-200 px-4 py-3 rounded-2xl rounded-tl-none max-w-[80%]">
                                    <p class="font-medium">Your top 3 products this month:</p>
                                    <ul class="mt-2 space-y-1 text-sm">
                                        <li>1. Wireless Mouse - <strong class="text-emerald-600">42 sold</strong></li>
                                        <li>2. USB-C Hub - <strong>28 sold</strong></li>
                                        <li>3. Laptop Stand - <strong>19 sold</strong></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        {{-- Input --}}
                        <div class="p-4 border-t border-zinc-100 dark:border-zinc-800">
                            <div class="flex items-center gap-3 bg-zinc-50 dark:bg-zinc-800 rounded-xl px-4 py-3">
                                <span class="text-zinc-400">Ask Scribe anything...</span>
                                <flux:icon.paper-airplane class="size-5 text-emerald-600 ml-auto" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Dashboard Insights Section --}}
    <section class="py-24 sm:py-32 bg-white dark:bg-zinc-950">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-zinc-900 dark:text-white">
                    Smart Dashboard <span class="text-emerald-600">Insights</span>
                </h2>
                <p class="mt-6 text-lg text-zinc-600 dark:text-zinc-400">
                    Your dashboard comes alive with AI-generated insights, predictions, and actionable intelligence.
                </p>
            </div>

            {{-- Insight Cards Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Revenue Prediction Card --}}
                <div class="group relative rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 p-8 shadow-sm hover:shadow-xl transition-all">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-teal-500/5 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>

                    <div class="relative">
                        <div class="size-12 rounded-2xl bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <flux:icon.chart-bar class="size-6 text-emerald-600 dark:text-emerald-400" />
                        </div>

                        <h3 class="text-xl font-bold text-zinc-900 dark:text-white">Revenue Predictions</h3>
                        <p class="mt-3 text-zinc-600 dark:text-zinc-400">
                            30-day forecasts with confidence scores. Know your expected revenue before it happens.
                        </p>

                        {{-- Sample Stat --}}
                        <div class="mt-6 pt-6 border-t border-zinc-100 dark:border-zinc-800">
                            <div class="flex items-baseline gap-2">
                                <span class="text-2xl font-black text-emerald-600">$24,500</span>
                                <span class="text-sm text-emerald-600 bg-emerald-50 dark:bg-emerald-900/30 px-2 py-0.5 rounded-full">+18.4%</span>
                            </div>
                            <p class="text-xs text-zinc-500 mt-1">Predicted for next 30 days</p>
                        </div>
                    </div>
                </div>

                {{-- Payment Alerts Card --}}
                <div class="group relative rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 p-8 shadow-sm hover:shadow-xl transition-all">
                    <div class="absolute inset-0 bg-gradient-to-br from-amber-500/5 to-orange-500/5 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>

                    <div class="relative">
                        <div class="size-12 rounded-2xl bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <flux:icon.bell-alert class="size-6 text-amber-600 dark:text-amber-400" />
                        </div>

                        <h3 class="text-xl font-bold text-zinc-900 dark:text-white">Payment Alerts</h3>
                        <p class="mt-3 text-zinc-600 dark:text-zinc-400">
                            Proactive late payment warnings. Know which invoices need attention before they become overdue.
                        </p>

                        {{-- Sample Stat --}}
                        <div class="mt-6 pt-6 border-t border-zinc-100 dark:border-zinc-800">
                            <div class="flex items-baseline gap-2">
                                <span class="text-2xl font-black text-amber-600">3</span>
                                <span class="text-sm text-zinc-500">invoices at risk</span>
                            </div>
                            <p class="text-xs text-zinc-500 mt-1">Based on client payment history</p>
                        </div>
                    </div>
                </div>

                {{-- Customer Scoring Card --}}
                <div class="group relative rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 p-8 shadow-sm hover:shadow-xl transition-all">
                    <div class="absolute inset-0 bg-gradient-to-br from-teal-500/5 to-emerald-500/5 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>

                    <div class="relative">
                        <div class="size-12 rounded-2xl bg-teal-100 dark:bg-teal-900/30 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <flux:icon.user-group class="size-6 text-teal-600 dark:text-teal-400" />
                        </div>

                        <h3 class="text-xl font-bold text-zinc-900 dark:text-white">Client Scoring</h3>
                        <p class="mt-3 text-zinc-600 dark:text-zinc-400">
                            AI-powered engagement scores help you identify your most valuable clients and those at risk.
                        </p>

                        {{-- Sample Stat --}}
                        <div class="mt-6 pt-6 border-t border-zinc-100 dark:border-zinc-800">
                            <div class="flex items-baseline gap-2">
                                <span class="text-2xl font-black text-teal-600">87</span>
                                <span class="text-sm text-zinc-500">avg engagement score</span>
                            </div>
                            <p class="text-xs text-zinc-500 mt-1">Across your active clients</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Capabilities Section (Dark) --}}
    <section class="py-24 sm:py-32 bg-zinc-900 dark:bg-black">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-white">
                    What Scribe Can Do
                </h2>
                <p class="mt-6 text-lg text-zinc-400">
                    From simple queries to complex operations, Scribe handles it all.
                </p>
            </div>

            {{-- Capability Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="p-6 rounded-2xl bg-zinc-800/50 border border-zinc-700/50 hover:border-emerald-500/50 transition-colors group">
                    <div class="size-10 rounded-xl bg-emerald-500/10 flex items-center justify-center mb-4 group-hover:bg-emerald-500/20 transition-colors">
                        <flux:icon.magnifying-glass class="size-5 text-emerald-400" />
                    </div>
                    <h3 class="font-bold text-white">Search Data</h3>
                    <p class="text-sm text-zinc-400 mt-1">Find any product, client, or invoice instantly.</p>
                </div>

                <div class="p-6 rounded-2xl bg-zinc-800/50 border border-zinc-700/50 hover:border-emerald-500/50 transition-colors group">
                    <div class="size-10 rounded-xl bg-emerald-500/10 flex items-center justify-center mb-4 group-hover:bg-emerald-500/20 transition-colors">
                        <flux:icon.chart-pie class="size-5 text-emerald-400" />
                    </div>
                    <h3 class="font-bold text-white">Get Summaries</h3>
                    <p class="text-sm text-zinc-400 mt-1">Real-time stats and business overviews.</p>
                </div>

                <div class="p-6 rounded-2xl bg-zinc-800/50 border border-zinc-700/50 hover:border-emerald-500/50 transition-colors group">
                    <div class="size-10 rounded-xl bg-emerald-500/10 flex items-center justify-center mb-4 group-hover:bg-emerald-500/20 transition-colors">
                        <flux:icon.plus-circle class="size-5 text-emerald-400" />
                    </div>
                    <h3 class="font-bold text-white">Create Records</h3>
                    <p class="text-sm text-zinc-400 mt-1">Add products and categories via chat.</p>
                </div>

                <div class="p-6 rounded-2xl bg-zinc-800/50 border border-zinc-700/50 hover:border-emerald-500/50 transition-colors group">
                    <div class="size-10 rounded-xl bg-emerald-500/10 flex items-center justify-center mb-4 group-hover:bg-emerald-500/20 transition-colors">
                        <flux:icon.light-bulb class="size-5 text-emerald-400" />
                    </div>
                    <h3 class="font-bold text-white">Get Insights</h3>
                    <p class="text-sm text-zinc-400 mt-1">AI-powered recommendations and alerts.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Coming Soon Section --}}
    <section class="py-24 sm:py-32 bg-white dark:bg-zinc-950">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <div class="inline-flex items-center gap-2 rounded-full bg-amber-100 dark:bg-amber-900/30 px-4 py-1.5 text-xs font-bold uppercase tracking-widest text-amber-700 dark:text-amber-400 mb-6">
                    <flux:icon.clock class="size-4" />
                    <span>In Development</span>
                </div>

                <h2 class="text-3xl sm:text-4xl font-extrabold text-zinc-900 dark:text-white">
                    Coming Soon
                </h2>
                <p class="mt-6 text-lg text-zinc-600 dark:text-zinc-400">
                    We're constantly improving Scribe. Here's what's next on our roadmap.
                </p>
            </div>

            {{-- Roadmap Items --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <div class="flex gap-4 p-6 rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-zinc-50 dark:bg-zinc-900">
                    <div class="size-10 rounded-xl bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center shrink-0">
                        <flux:icon.document-text class="size-5 text-zinc-400" />
                    </div>
                    <div>
                        <div class="flex items-center gap-2 flex-wrap">
                            <h3 class="font-bold text-zinc-900 dark:text-white">Smart Invoice Suggestions</h3>
                            <span class="text-[10px] font-bold text-amber-600 bg-amber-50 dark:bg-amber-900/30 px-2 py-0.5 rounded">Q2 2026</span>
                        </div>
                        <p class="text-sm text-zinc-600 dark:text-zinc-400 mt-1">AI-generated invoice line items based on order history.</p>
                    </div>
                </div>

                <div class="flex gap-4 p-6 rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-zinc-50 dark:bg-zinc-900">
                    <div class="size-10 rounded-xl bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center shrink-0">
                        <flux:icon.chat-bubble-bottom-center-text class="size-5 text-zinc-400" />
                    </div>
                    <div>
                        <div class="flex items-center gap-2 flex-wrap">
                            <h3 class="font-bold text-zinc-900 dark:text-white">Natural Language Queries</h3>
                            <span class="text-[10px] font-bold text-amber-600 bg-amber-50 dark:bg-amber-900/30 px-2 py-0.5 rounded">Q2 2026</span>
                        </div>
                        <p class="text-sm text-zinc-600 dark:text-zinc-400 mt-1">Ask complex questions like "Show me overdue invoices over $500".</p>
                    </div>
                </div>

                <div class="flex gap-4 p-6 rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-zinc-50 dark:bg-zinc-900">
                    <div class="size-10 rounded-xl bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center shrink-0">
                        <flux:icon.user-circle class="size-5 text-zinc-400" />
                    </div>
                    <div>
                        <div class="flex items-center gap-2 flex-wrap">
                            <h3 class="font-bold text-zinc-900 dark:text-white">Customer Engagement AI</h3>
                            <span class="text-[10px] font-bold text-zinc-500 bg-zinc-100 dark:bg-zinc-800 px-2 py-0.5 rounded">Q3 2026</span>
                        </div>
                        <p class="text-sm text-zinc-600 dark:text-zinc-400 mt-1">Predict customer behavior and lifetime value automatically.</p>
                    </div>
                </div>

                <div class="flex gap-4 p-6 rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-zinc-50 dark:bg-zinc-900">
                    <div class="size-10 rounded-xl bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center shrink-0">
                        <flux:icon.arrow-up-tray class="size-5 text-zinc-400" />
                    </div>
                    <div>
                        <div class="flex items-center gap-2 flex-wrap">
                            <h3 class="font-bold text-zinc-900 dark:text-white">Data Import Mode</h3>
                            <span class="text-[10px] font-bold text-zinc-500 bg-zinc-100 dark:bg-zinc-800 px-2 py-0.5 rounded">Q3 2026</span>
                        </div>
                        <p class="text-sm text-zinc-600 dark:text-zinc-400 mt-1">Paste any data format, Scribe will parse and import it for you.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-24 sm:py-32 bg-gradient-to-br from-emerald-600 to-teal-700">
        <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white">
                Ready to experience AI-powered business management?
            </h2>
            <p class="mt-6 text-lg text-emerald-100">
                Start your free trial today. No credit card required.
            </p>

            <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                <flux:button href="{{ route('register') }}" wire:navigate class="px-8 py-4 text-base font-bold bg-white text-emerald-600 hover:bg-emerald-50 shadow-lg border-none">
                    Start Free Trial
                </flux:button>
                @auth
                    <flux:button href="{{ route('scribe') }}" wire:navigate variant="ghost" class="px-6 py-4 text-white border-white/30 hover:bg-white/10">
                        Open Scribe
                    </flux:button>
                @else
                    <flux:button href="{{ route('login') }}" wire:navigate variant="ghost" class="px-6 py-4 text-white border-white/30 hover:bg-white/10">
                        Sign In to Try
                    </flux:button>
                @endauth
            </div>
        </div>
    </section>
</div>
