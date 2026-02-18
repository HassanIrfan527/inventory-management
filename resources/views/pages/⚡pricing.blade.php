<?php

use App\Services\PlanService;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.public')] class extends Component
{
    public Collection $plans;

    public function mount(PlanService $planService): void
    {
        $this->plans = $planService->getActivePlans();
    }

    public function selectPlan(string $slug): void
    {
        session(['selected_plan' => $slug]);
        $this->redirect(route('register'), navigate: true);
    }

    public function title(): string
    {
        return 'Pricing | ' . config('app.name');
    }
};
?>

<div class="relative isolate overflow-hidden" x-data="{ openFaq: null }">
    {{-- Decorative Background --}}
    <div class="absolute inset-0 -z-10 transform-gpu overflow-hidden blur-3xl" aria-hidden="true">
        <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-emerald-600 to-teal-800 opacity-10 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-24 sm:py-32">
        {{-- Hero Section --}}
        <div class="mx-auto max-w-2xl text-center mb-12 sm:mb-16">
            <div class="inline-flex items-center gap-2 rounded-full bg-emerald-100 dark:bg-emerald-900/30 px-4 py-1.5 text-xs font-bold uppercase tracking-wider text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800 mb-6">
                <flux:icon.sparkles class="size-4" />
                7-day free trial
            </div>
            <h1 class="text-4xl font-extrabold tracking-tight text-zinc-900 dark:text-white sm:text-6xl">
                Simple, <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-600">transparent</span> pricing
            </h1>
            <p class="mt-6 text-lg leading-8 text-zinc-600 dark:text-zinc-400">
                Start free, scale as you grow. No hidden fees, no surprises.
            </p>
        </div>

        {{-- Pricing Cards --}}
        <div class="mx-auto max-w-7xl">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                {{-- Free Plan --}}
                <div class="relative rounded-3xl border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 p-8 shadow-sm">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Free</h3>
                        <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Perfect for getting started</p>
                    </div>

                    <div class="flex items-baseline gap-1 mb-6">
                        <span class="text-4xl font-bold tracking-tight text-zinc-900 dark:text-white">$0</span>
                        <span class="text-zinc-500 dark:text-zinc-400 text-sm">/month</span>
                    </div>

                    <flux:button wire:click="selectPlan('free')" variant="ghost" class="w-full mb-8 border border-zinc-300 dark:border-zinc-700 hover:bg-zinc-100 dark:hover:bg-zinc-800">
                        Get Started Free
                    </flux:button>

                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start gap-3">
                            <flux:icon.check class="size-5 text-emerald-500 shrink-0 mt-0.5" />
                            <span class="text-zinc-600 dark:text-zinc-400"><strong class="text-zinc-900 dark:text-white">100</strong> contacts</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <flux:icon.check class="size-5 text-emerald-500 shrink-0 mt-0.5" />
                            <span class="text-zinc-600 dark:text-zinc-400"><strong class="text-zinc-900 dark:text-white">10</strong> invoices/month</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <flux:icon.check class="size-5 text-emerald-500 shrink-0 mt-0.5" />
                            <span class="text-zinc-600 dark:text-zinc-400"><strong class="text-zinc-900 dark:text-white">25</strong> products</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <flux:icon.check class="size-5 text-emerald-500 shrink-0 mt-0.5" />
                            <span class="text-zinc-600 dark:text-zinc-400"><strong class="text-zinc-900 dark:text-white">20</strong> orders/month</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <flux:icon.check class="size-5 text-emerald-500 shrink-0 mt-0.5" />
                            <span class="text-zinc-600 dark:text-zinc-400">Basic analytics</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <flux:icon.check class="size-5 text-emerald-500 shrink-0 mt-0.5" />
                            <span class="text-zinc-600 dark:text-zinc-400">Community support</span>
                        </li>
                    </ul>
                </div>

                {{-- Pro Plan (Highlighted) --}}
                <div class="relative group">
                    {{-- Glow effect --}}
                    <div class="absolute -inset-px bg-gradient-to-r from-emerald-600 to-teal-600 rounded-3xl blur opacity-25 group-hover:opacity-40 transition duration-500"></div>

                    <div class="relative rounded-3xl border-2 border-emerald-500 bg-white dark:bg-zinc-900 p-8 shadow-xl h-full">
                        <div class="absolute -top-4 left-1/2 -translate-x-1/2">
                            <span class="inline-flex items-center rounded-full bg-gradient-to-r from-emerald-600 to-teal-600 px-4 py-1 text-xs font-bold text-white shadow-lg">
                                Most Popular
                            </span>
                        </div>

                        @php($proPlan = $plans->firstWhere('slug', 'pro'))
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">{{ $proPlan->name }}</h3>
                            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">{{ $proPlan->description }}</p>
                        </div>

                        <div class="flex items-baseline gap-1 mb-6">
                            <span class="text-4xl font-bold tracking-tight text-zinc-900 dark:text-white">${{ number_format($proPlan->monthly_price / 100, 0) }}</span>
                            <span class="text-zinc-500 dark:text-zinc-400 text-sm">/month</span>
                        </div>

                        <flux:button wire:click="selectPlan('pro')" variant="primary" class="w-full mb-8 shadow-lg shadow-emerald-500/20 !bg-emerald-600 hover:!bg-emerald-500">
                            Start Free Trial
                        </flux:button>

                        <ul class="space-y-3 text-sm">
                            <li class="flex items-start gap-3">
                                <flux:icon.check class="size-5 text-emerald-500 shrink-0 mt-0.5" />
                                <span class="text-zinc-600 dark:text-zinc-400"><strong class="text-zinc-900 dark:text-white">Unlimited</strong> contacts</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <flux:icon.check class="size-5 text-emerald-500 shrink-0 mt-0.5" />
                                <span class="text-zinc-600 dark:text-zinc-400"><strong class="text-zinc-900 dark:text-white">100</strong> invoices/month</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <flux:icon.check class="size-5 text-emerald-500 shrink-0 mt-0.5" />
                                <span class="text-zinc-600 dark:text-zinc-400"><strong class="text-zinc-900 dark:text-white">250</strong> products</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <flux:icon.check class="size-5 text-emerald-500 shrink-0 mt-0.5" />
                                <span class="text-zinc-600 dark:text-zinc-400"><strong class="text-zinc-900 dark:text-white">200</strong> orders/month</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <flux:icon.check class="size-5 text-emerald-500 shrink-0 mt-0.5" />
                                <span class="text-zinc-600 dark:text-zinc-400">API access <span class="text-zinc-400 dark:text-zinc-500">(1,000 req/mo)</span></span>
                            </li>
                            <li class="flex items-start gap-3">
                                <flux:icon.check class="size-5 text-emerald-500 shrink-0 mt-0.5" />
                                <span class="text-zinc-600 dark:text-zinc-400">Limited integrations <span class="text-zinc-400 dark:text-zinc-500">(2 active)</span></span>
                            </li>
                            <li class="flex items-start gap-3">
                                <flux:icon.check class="size-5 text-emerald-500 shrink-0 mt-0.5" />
                                <span class="text-zinc-600 dark:text-zinc-400">Email support <span class="text-zinc-400 dark:text-zinc-500">(48hr)</span></span>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Business Plan --}}
                @php($businessPlan = $plans->firstWhere('slug', 'business'))
                <div class="relative rounded-3xl border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 p-8 shadow-sm">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">{{ $businessPlan->name }}</h3>
                        <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">{{ $businessPlan->description }}</p>
                    </div>

                    <div class="flex items-baseline gap-1 mb-6">
                        <span class="text-4xl font-bold tracking-tight text-zinc-900 dark:text-white">${{ number_format($businessPlan->monthly_price / 100, 0) }}</span>
                        <span class="text-zinc-500 dark:text-zinc-400 text-sm">/month</span>
                    </div>

                    <flux:button wire:click="selectPlan('business')" variant="ghost" class="w-full mb-8 border border-zinc-300 dark:border-zinc-700 hover:bg-zinc-100 dark:hover:bg-zinc-800">
                        Start Free Trial
                    </flux:button>

                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start gap-3">
                            <flux:icon.check class="size-5 text-emerald-500 shrink-0 mt-0.5" />
                            <span class="text-zinc-600 dark:text-zinc-400"><strong class="text-zinc-900 dark:text-white">Unlimited</strong> everything</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <flux:icon.check class="size-5 text-emerald-500 shrink-0 mt-0.5" />
                            <span class="text-zinc-600 dark:text-zinc-400">Up to <strong class="text-zinc-900 dark:text-white">5 team members</strong></span>
                        </li>
                        <li class="flex items-start gap-3">
                            <flux:icon.check class="size-5 text-emerald-500 shrink-0 mt-0.5" />
                            <span class="text-zinc-600 dark:text-zinc-400">Full API <span class="text-zinc-400 dark:text-zinc-500">(10,000 req/mo)</span></span>
                        </li>
                        <li class="flex items-start gap-3">
                            <flux:icon.check class="size-5 text-emerald-500 shrink-0 mt-0.5" />
                            <span class="text-zinc-600 dark:text-zinc-400"><strong class="text-zinc-900 dark:text-white">All</strong> integrations</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <flux:icon.check class="size-5 text-emerald-500 shrink-0 mt-0.5" />
                            <span class="text-zinc-600 dark:text-zinc-400">Role-based permissions</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <flux:icon.check class="size-5 text-emerald-500 shrink-0 mt-0.5" />
                            <span class="text-zinc-600 dark:text-zinc-400">Priority support <span class="text-zinc-400 dark:text-zinc-500">(24hr)</span></span>
                        </li>
                        <li class="flex items-start gap-3">
                            <flux:icon.check class="size-5 text-emerald-500 shrink-0 mt-0.5" />
                            <span class="text-zinc-600 dark:text-zinc-400">Dedicated onboarding</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Feature Comparison Table --}}
        <div class="mt-24 max-w-5xl mx-auto">
            <h2 class="text-2xl font-bold text-center text-zinc-900 dark:text-white mb-12">Compare all features</h2>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-zinc-200 dark:border-zinc-800">
                            <th class="py-4 px-4 text-left font-medium text-zinc-500 dark:text-zinc-400 w-1/3">Features</th>
                            <th class="py-4 px-4 text-center font-medium text-zinc-500 dark:text-zinc-400">Free</th>
                            <th class="py-4 px-4 text-center font-medium text-emerald-600 dark:text-emerald-400">Pro</th>
                            <th class="py-4 px-4 text-center font-medium text-zinc-500 dark:text-zinc-400">Business</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                        {{-- Contacts & CRM Section --}}
                        <tr class="bg-zinc-50 dark:bg-zinc-800/50">
                            <td colspan="4" class="py-3 px-4 font-semibold text-zinc-900 dark:text-white">Contacts & CRM</td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 text-zinc-600 dark:text-zinc-400">Contact limit</td>
                            <td class="py-3 px-4 text-center text-zinc-900 dark:text-white">100</td>
                            <td class="py-3 px-4 text-center text-zinc-900 dark:text-white">Unlimited</td>
                            <td class="py-3 px-4 text-center text-zinc-900 dark:text-white">Unlimited</td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 text-zinc-600 dark:text-zinc-400">Custom fields</td>
                            <td class="py-3 px-4 text-center text-zinc-900 dark:text-white">3</td>
                            <td class="py-3 px-4 text-center text-zinc-900 dark:text-white">10</td>
                            <td class="py-3 px-4 text-center text-zinc-900 dark:text-white">Unlimited</td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 text-zinc-600 dark:text-zinc-400">Tags</td>
                            <td class="py-3 px-4 text-center text-zinc-900 dark:text-white">5</td>
                            <td class="py-3 px-4 text-center text-zinc-900 dark:text-white">25</td>
                            <td class="py-3 px-4 text-center text-zinc-900 dark:text-white">Unlimited</td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 text-zinc-600 dark:text-zinc-400">Import contacts (CSV)</td>
                            <td class="py-3 px-4 text-center"><flux:icon.x-mark class="size-5 text-zinc-300 dark:text-zinc-600 mx-auto" /></td>
                            <td class="py-3 px-4 text-center"><flux:icon.check class="size-5 text-emerald-500 mx-auto" /></td>
                            <td class="py-3 px-4 text-center"><flux:icon.check class="size-5 text-emerald-500 mx-auto" /></td>
                        </tr>

                        {{-- Invoicing Section --}}
                        <tr class="bg-zinc-50 dark:bg-zinc-800/50">
                            <td colspan="4" class="py-3 px-4 font-semibold text-zinc-900 dark:text-white">Invoicing</td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 text-zinc-600 dark:text-zinc-400">Invoices per month</td>
                            <td class="py-3 px-4 text-center text-zinc-900 dark:text-white">10</td>
                            <td class="py-3 px-4 text-center text-zinc-900 dark:text-white">100</td>
                            <td class="py-3 px-4 text-center text-zinc-900 dark:text-white">Unlimited</td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 text-zinc-600 dark:text-zinc-400">PDF generation</td>
                            <td class="py-3 px-4 text-center"><flux:icon.check class="size-5 text-emerald-500 mx-auto" /></td>
                            <td class="py-3 px-4 text-center"><flux:icon.check class="size-5 text-emerald-500 mx-auto" /></td>
                            <td class="py-3 px-4 text-center"><flux:icon.check class="size-5 text-emerald-500 mx-auto" /></td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 text-zinc-600 dark:text-zinc-400">Custom templates</td>
                            <td class="py-3 px-4 text-center"><flux:icon.x-mark class="size-5 text-zinc-300 dark:text-zinc-600 mx-auto" /></td>
                            <td class="py-3 px-4 text-center"><flux:icon.check class="size-5 text-emerald-500 mx-auto" /></td>
                            <td class="py-3 px-4 text-center"><flux:icon.check class="size-5 text-emerald-500 mx-auto" /></td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 text-zinc-600 dark:text-zinc-400">Remove branding</td>
                            <td class="py-3 px-4 text-center"><flux:icon.x-mark class="size-5 text-zinc-300 dark:text-zinc-600 mx-auto" /></td>
                            <td class="py-3 px-4 text-center"><flux:icon.check class="size-5 text-emerald-500 mx-auto" /></td>
                            <td class="py-3 px-4 text-center"><flux:icon.check class="size-5 text-emerald-500 mx-auto" /></td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 text-zinc-600 dark:text-zinc-400">White-label</td>
                            <td class="py-3 px-4 text-center"><flux:icon.x-mark class="size-5 text-zinc-300 dark:text-zinc-600 mx-auto" /></td>
                            <td class="py-3 px-4 text-center"><flux:icon.x-mark class="size-5 text-zinc-300 dark:text-zinc-600 mx-auto" /></td>
                            <td class="py-3 px-4 text-center"><flux:icon.check class="size-5 text-emerald-500 mx-auto" /></td>
                        </tr>

                        {{-- Orders & Products Section --}}
                        <tr class="bg-zinc-50 dark:bg-zinc-800/50">
                            <td colspan="4" class="py-3 px-4 font-semibold text-zinc-900 dark:text-white">Orders & Products</td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 text-zinc-600 dark:text-zinc-400">Products</td>
                            <td class="py-3 px-4 text-center text-zinc-900 dark:text-white">25</td>
                            <td class="py-3 px-4 text-center text-zinc-900 dark:text-white">250</td>
                            <td class="py-3 px-4 text-center text-zinc-900 dark:text-white">Unlimited</td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 text-zinc-600 dark:text-zinc-400">Orders per month</td>
                            <td class="py-3 px-4 text-center text-zinc-900 dark:text-white">20</td>
                            <td class="py-3 px-4 text-center text-zinc-900 dark:text-white">200</td>
                            <td class="py-3 px-4 text-center text-zinc-900 dark:text-white">Unlimited</td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 text-zinc-600 dark:text-zinc-400">Categories</td>
                            <td class="py-3 px-4 text-center text-zinc-900 dark:text-white">5</td>
                            <td class="py-3 px-4 text-center text-zinc-900 dark:text-white">25</td>
                            <td class="py-3 px-4 text-center text-zinc-900 dark:text-white">Unlimited</td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 text-zinc-600 dark:text-zinc-400">Product images</td>
                            <td class="py-3 px-4 text-center text-zinc-900 dark:text-white">1/product</td>
                            <td class="py-3 px-4 text-center text-zinc-900 dark:text-white">5/product</td>
                            <td class="py-3 px-4 text-center text-zinc-900 dark:text-white">10/product</td>
                        </tr>

                        {{-- API & Integrations Section --}}
                        <tr class="bg-zinc-50 dark:bg-zinc-800/50">
                            <td colspan="4" class="py-3 px-4 font-semibold text-zinc-900 dark:text-white">API & Integrations</td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 text-zinc-600 dark:text-zinc-400">REST API</td>
                            <td class="py-3 px-4 text-center"><flux:icon.x-mark class="size-5 text-zinc-300 dark:text-zinc-600 mx-auto" /></td>
                            <td class="py-3 px-4 text-center text-zinc-900 dark:text-white">Limited</td>
                            <td class="py-3 px-4 text-center text-zinc-900 dark:text-white">Full</td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 text-zinc-600 dark:text-zinc-400">API requests/month</td>
                            <td class="py-3 px-4 text-center text-zinc-400">-</td>
                            <td class="py-3 px-4 text-center text-zinc-900 dark:text-white">1,000</td>
                            <td class="py-3 px-4 text-center text-zinc-900 dark:text-white">10,000</td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 text-zinc-600 dark:text-zinc-400">Webhooks</td>
                            <td class="py-3 px-4 text-center"><flux:icon.x-mark class="size-5 text-zinc-300 dark:text-zinc-600 mx-auto" /></td>
                            <td class="py-3 px-4 text-center text-zinc-900 dark:text-white">5</td>
                            <td class="py-3 px-4 text-center text-zinc-900 dark:text-white">Unlimited</td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 text-zinc-600 dark:text-zinc-400">Google Contacts</td>
                            <td class="py-3 px-4 text-center"><flux:icon.x-mark class="size-5 text-zinc-300 dark:text-zinc-600 mx-auto" /></td>
                            <td class="py-3 px-4 text-center"><flux:icon.check class="size-5 text-emerald-500 mx-auto" /></td>
                            <td class="py-3 px-4 text-center"><flux:icon.check class="size-5 text-emerald-500 mx-auto" /></td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 text-zinc-600 dark:text-zinc-400">HubSpot</td>
                            <td class="py-3 px-4 text-center"><flux:icon.x-mark class="size-5 text-zinc-300 dark:text-zinc-600 mx-auto" /></td>
                            <td class="py-3 px-4 text-center"><flux:icon.x-mark class="size-5 text-zinc-300 dark:text-zinc-600 mx-auto" /></td>
                            <td class="py-3 px-4 text-center"><flux:icon.check class="size-5 text-emerald-500 mx-auto" /></td>
                        </tr>

                        {{-- Team & Collaboration Section --}}
                        <tr class="bg-zinc-50 dark:bg-zinc-800/50">
                            <td colspan="4" class="py-3 px-4 font-semibold text-zinc-900 dark:text-white">Team & Collaboration</td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 text-zinc-600 dark:text-zinc-400">Team members</td>
                            <td class="py-3 px-4 text-center text-zinc-900 dark:text-white">1</td>
                            <td class="py-3 px-4 text-center text-zinc-900 dark:text-white">1</td>
                            <td class="py-3 px-4 text-center text-zinc-900 dark:text-white">5</td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 text-zinc-600 dark:text-zinc-400">Role permissions</td>
                            <td class="py-3 px-4 text-center"><flux:icon.x-mark class="size-5 text-zinc-300 dark:text-zinc-600 mx-auto" /></td>
                            <td class="py-3 px-4 text-center"><flux:icon.x-mark class="size-5 text-zinc-300 dark:text-zinc-600 mx-auto" /></td>
                            <td class="py-3 px-4 text-center"><flux:icon.check class="size-5 text-emerald-500 mx-auto" /></td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 text-zinc-600 dark:text-zinc-400">Audit log</td>
                            <td class="py-3 px-4 text-center"><flux:icon.x-mark class="size-5 text-zinc-300 dark:text-zinc-600 mx-auto" /></td>
                            <td class="py-3 px-4 text-center"><flux:icon.x-mark class="size-5 text-zinc-300 dark:text-zinc-600 mx-auto" /></td>
                            <td class="py-3 px-4 text-center"><flux:icon.check class="size-5 text-emerald-500 mx-auto" /></td>
                        </tr>

                        {{-- Support Section --}}
                        <tr class="bg-zinc-50 dark:bg-zinc-800/50">
                            <td colspan="4" class="py-3 px-4 font-semibold text-zinc-900 dark:text-white">Support</td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 text-zinc-600 dark:text-zinc-400">Documentation</td>
                            <td class="py-3 px-4 text-center"><flux:icon.check class="size-5 text-emerald-500 mx-auto" /></td>
                            <td class="py-3 px-4 text-center"><flux:icon.check class="size-5 text-emerald-500 mx-auto" /></td>
                            <td class="py-3 px-4 text-center"><flux:icon.check class="size-5 text-emerald-500 mx-auto" /></td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 text-zinc-600 dark:text-zinc-400">Email support</td>
                            <td class="py-3 px-4 text-center"><flux:icon.x-mark class="size-5 text-zinc-300 dark:text-zinc-600 mx-auto" /></td>
                            <td class="py-3 px-4 text-center text-zinc-900 dark:text-white">48hr</td>
                            <td class="py-3 px-4 text-center text-zinc-900 dark:text-white">24hr</td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 text-zinc-600 dark:text-zinc-400">Priority support</td>
                            <td class="py-3 px-4 text-center"><flux:icon.x-mark class="size-5 text-zinc-300 dark:text-zinc-600 mx-auto" /></td>
                            <td class="py-3 px-4 text-center"><flux:icon.x-mark class="size-5 text-zinc-300 dark:text-zinc-600 mx-auto" /></td>
                            <td class="py-3 px-4 text-center"><flux:icon.check class="size-5 text-emerald-500 mx-auto" /></td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 text-zinc-600 dark:text-zinc-400">Onboarding call</td>
                            <td class="py-3 px-4 text-center"><flux:icon.x-mark class="size-5 text-zinc-300 dark:text-zinc-600 mx-auto" /></td>
                            <td class="py-3 px-4 text-center"><flux:icon.x-mark class="size-5 text-zinc-300 dark:text-zinc-600 mx-auto" /></td>
                            <td class="py-3 px-4 text-center"><flux:icon.check class="size-5 text-emerald-500 mx-auto" /></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- FAQ Section --}}
        <div class="mt-24 max-w-3xl mx-auto">
            <h2 class="text-2xl font-bold text-center text-zinc-900 dark:text-white mb-12">Frequently asked questions</h2>

            <div class="space-y-4">
                {{-- FAQ Item 1 --}}
                <div class="border border-zinc-200 dark:border-zinc-800 rounded-xl overflow-hidden">
                    <button
                        @click="openFaq = openFaq === 1 ? null : 1"
                        class="flex w-full items-center justify-between px-6 py-4 text-left bg-white dark:bg-zinc-900 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors"
                    >
                        <span class="font-medium text-zinc-900 dark:text-white">Can I change plans anytime?</span>
                        <flux:icon.chevron-down
                            class="size-5 text-zinc-400 transition-transform duration-200"
                            ::class="openFaq === 1 ? 'rotate-180' : ''"
                        />
                    </button>
                    <div
                        x-show="openFaq === 1"
                        x-collapse
                        x-cloak
                        class="px-6 pb-4 bg-white dark:bg-zinc-900"
                    >
                        <p class="text-zinc-600 dark:text-zinc-400">Yes! Upgrade or downgrade at any time. Changes take effect on your next billing cycle. You'll only be charged the prorated difference when upgrading.</p>
                    </div>
                </div>

                {{-- FAQ Item 2 --}}
                <div class="border border-zinc-200 dark:border-zinc-800 rounded-xl overflow-hidden">
                    <button
                        @click="openFaq = openFaq === 2 ? null : 2"
                        class="flex w-full items-center justify-between px-6 py-4 text-left bg-white dark:bg-zinc-900 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors"
                    >
                        <span class="font-medium text-zinc-900 dark:text-white">What happens if I exceed my limits?</span>
                        <flux:icon.chevron-down
                            class="size-5 text-zinc-400 transition-transform duration-200"
                            ::class="openFaq === 2 ? 'rotate-180' : ''"
                        />
                    </button>
                    <div
                        x-show="openFaq === 2"
                        x-collapse
                        x-cloak
                        class="px-6 pb-4 bg-white dark:bg-zinc-900"
                    >
                        <p class="text-zinc-600 dark:text-zinc-400">You'll receive a notification when approaching limits. Exceeding limits will prompt an upgrade suggestion, but we won't cut off your access mid-month. Your data is always safe.</p>
                    </div>
                </div>

                {{-- FAQ Item 3 --}}
                <div class="border border-zinc-200 dark:border-zinc-800 rounded-xl overflow-hidden">
                    <button
                        @click="openFaq = openFaq === 3 ? null : 3"
                        class="flex w-full items-center justify-between px-6 py-4 text-left bg-white dark:bg-zinc-900 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors"
                    >
                        <span class="font-medium text-zinc-900 dark:text-white">Is there a yearly discount?</span>
                        <flux:icon.chevron-down
                            class="size-5 text-zinc-400 transition-transform duration-200"
                            ::class="openFaq === 3 ? 'rotate-180' : ''"
                        />
                    </button>
                    <div
                        x-show="openFaq === 3"
                        x-collapse
                        x-cloak
                        class="px-6 pb-4 bg-white dark:bg-zinc-900"
                    >
                        <p class="text-zinc-600 dark:text-zinc-400">Yes! Pay annually and get 2 months free. Pro: $120/year ($10/mo, save $24). Business: $290/year (~$24/mo, save $58).</p>
                    </div>
                </div>

                {{-- FAQ Item 4 --}}
                <div class="border border-zinc-200 dark:border-zinc-800 rounded-xl overflow-hidden">
                    <button
                        @click="openFaq = openFaq === 4 ? null : 4"
                        class="flex w-full items-center justify-between px-6 py-4 text-left bg-white dark:bg-zinc-900 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors"
                    >
                        <span class="font-medium text-zinc-900 dark:text-white">Do you offer refunds?</span>
                        <flux:icon.chevron-down
                            class="size-5 text-zinc-400 transition-transform duration-200"
                            ::class="openFaq === 4 ? 'rotate-180' : ''"
                        />
                    </button>
                    <div
                        x-show="openFaq === 4"
                        x-collapse
                        x-cloak
                        class="px-6 pb-4 bg-white dark:bg-zinc-900"
                    >
                        <p class="text-zinc-600 dark:text-zinc-400">Yes, we offer a 30-day money-back guarantee on all paid plans. No questions asked.</p>
                    </div>
                </div>

                {{-- FAQ Item 5 --}}
                <div class="border border-zinc-200 dark:border-zinc-800 rounded-xl overflow-hidden">
                    <button
                        @click="openFaq = openFaq === 5 ? null : 5"
                        class="flex w-full items-center justify-between px-6 py-4 text-left bg-white dark:bg-zinc-900 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors"
                    >
                        <span class="font-medium text-zinc-900 dark:text-white">What payment methods do you accept?</span>
                        <flux:icon.chevron-down
                            class="size-5 text-zinc-400 transition-transform duration-200"
                            ::class="openFaq === 5 ? 'rotate-180' : ''"
                        />
                    </button>
                    <div
                        x-show="openFaq === 5"
                        x-collapse
                        x-cloak
                        class="px-6 pb-4 bg-white dark:bg-zinc-900"
                    >
                        <p class="text-zinc-600 dark:text-zinc-400">We accept all major credit cards, PayPal, and bank transfers for annual plans. All payments are securely processed through Stripe.</p>
                    </div>
                </div>

                {{-- FAQ Item 6 --}}
                <div class="border border-zinc-200 dark:border-zinc-800 rounded-xl overflow-hidden">
                    <button
                        @click="openFaq = openFaq === 6 ? null : 6"
                        class="flex w-full items-center justify-between px-6 py-4 text-left bg-white dark:bg-zinc-900 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors"
                    >
                        <span class="font-medium text-zinc-900 dark:text-white">Is my data secure?</span>
                        <flux:icon.chevron-down
                            class="size-5 text-zinc-400 transition-transform duration-200"
                            ::class="openFaq === 6 ? 'rotate-180' : ''"
                        />
                    </button>
                    <div
                        x-show="openFaq === 6"
                        x-collapse
                        x-cloak
                        class="px-6 pb-4 bg-white dark:bg-zinc-900"
                    >
                        <p class="text-zinc-600 dark:text-zinc-400">Absolutely. We use industry-standard encryption, regular backups, and your data is never shared with third parties. Two-factor authentication is available on all plans.</p>
                    </div>
                </div>

                {{-- FAQ Item 7 --}}
                <div class="border border-zinc-200 dark:border-zinc-800 rounded-xl overflow-hidden">
                    <button
                        @click="openFaq = openFaq === 7 ? null : 7"
                        class="flex w-full items-center justify-between px-6 py-4 text-left bg-white dark:bg-zinc-900 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors"
                    >
                        <span class="font-medium text-zinc-900 dark:text-white">Can I export my data?</span>
                        <flux:icon.chevron-down
                            class="size-5 text-zinc-400 transition-transform duration-200"
                            ::class="openFaq === 7 ? 'rotate-180' : ''"
                        />
                    </button>
                    <div
                        x-show="openFaq === 7"
                        x-collapse
                        x-cloak
                        class="px-6 pb-4 bg-white dark:bg-zinc-900"
                    >
                        <p class="text-zinc-600 dark:text-zinc-400">Yes, all plans can export data. Pro and Business have additional export formats (JSON, bulk CSV). Your data is always yours.</p>
                    </div>
                </div>

                {{-- FAQ Item 8 --}}
                <div class="border border-zinc-200 dark:border-zinc-800 rounded-xl overflow-hidden">
                    <button
                        @click="openFaq = openFaq === 8 ? null : 8"
                        class="flex w-full items-center justify-between px-6 py-4 text-left bg-white dark:bg-zinc-900 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors"
                    >
                        <span class="font-medium text-zinc-900 dark:text-white">What happens if I downgrade?</span>
                        <flux:icon.chevron-down
                            class="size-5 text-zinc-400 transition-transform duration-200"
                            ::class="openFaq === 8 ? 'rotate-180' : ''"
                        />
                    </button>
                    <div
                        x-show="openFaq === 8"
                        x-collapse
                        x-cloak
                        class="px-6 pb-4 bg-white dark:bg-zinc-900"
                    >
                        <p class="text-zinc-600 dark:text-zinc-400">Your data is preserved. You simply won't be able to add new items beyond the lower plan's limits until you delete some or upgrade again. We never delete your data automatically.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Enterprise CTA --}}
        <div class="mt-24 max-w-4xl mx-auto">
            <div class="relative rounded-3xl bg-gradient-to-br from-zinc-900 to-zinc-800 dark:from-zinc-800 dark:to-zinc-900 p-8 sm:p-12 overflow-hidden">
                {{-- Decorative elements --}}
                <div class="absolute top-0 right-0 -mt-8 -mr-8 w-64 h-64 bg-emerald-500/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -mb-8 -ml-8 w-64 h-64 bg-teal-500/10 rounded-full blur-3xl"></div>

                <div class="relative grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                    <div>
                        <h3 class="text-2xl font-bold text-white mb-4">Need more than 5 team members?</h3>
                        <p class="text-zinc-400 mb-6">Get a custom plan tailored to your organization's needs with unlimited team members, custom API limits, and dedicated infrastructure.</p>
                        <ul class="space-y-3 text-sm">
                            <li class="flex items-center gap-3 text-zinc-300">
                                <flux:icon.check class="size-5 text-emerald-400 shrink-0" />
                                Unlimited team members
                            </li>
                            <li class="flex items-center gap-3 text-zinc-300">
                                <flux:icon.check class="size-5 text-emerald-400 shrink-0" />
                                Custom API limits
                            </li>
                            <li class="flex items-center gap-3 text-zinc-300">
                                <flux:icon.check class="size-5 text-emerald-400 shrink-0" />
                                Dedicated infrastructure
                            </li>
                            <li class="flex items-center gap-3 text-zinc-300">
                                <flux:icon.check class="size-5 text-emerald-400 shrink-0" />
                                SLA guarantees
                            </li>
                        </ul>
                    </div>
                    <div class="flex flex-col items-center lg:items-end">
                        <flux:button href="{{ route('contact.us') }}" wire:navigate variant="primary" size="lg" class="shadow-lg shadow-emerald-500/20 bg-emerald-600 hover:bg-emerald-500">
                            Contact Sales
                        </flux:button>
                        <p class="mt-4 text-sm text-zinc-500">Custom pricing available</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Final CTA --}}
        <div class="mt-24 text-center">
            <h2 class="text-3xl font-bold text-zinc-900 dark:text-white mb-4">Start your free trial today</h2>
            <p class="text-zinc-600 dark:text-zinc-400 mb-8 max-w-xl mx-auto">
                7 days free, full access to Pro features. No credit card required.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <flux:button href="{{ route('register') }}" wire:navigate variant="primary" size="lg" class="shadow-lg shadow-emerald-500/20 bg-emerald-600 hover:bg-emerald-500">
                    Get Started Free
                </flux:button>
                <flux:button href="{{ route('contact.us') }}" wire:navigate variant="ghost" size="lg" icon-trailing="arrow-right">
                    Talk to Sales
                </flux:button>
            </div>
            <div class="mt-8 flex items-center justify-center gap-6 text-sm text-zinc-500 dark:text-zinc-400">
                <div class="flex items-center gap-2">
                    <flux:icon.shield-check class="size-4 text-emerald-500" />
                    Secure payment
                </div>
                <div class="flex items-center gap-2">
                    <flux:icon.arrow-path class="size-4 text-emerald-500" />
                    Cancel anytime
                </div>
                <div class="flex items-center gap-2">
                    <flux:icon.clock class="size-4 text-emerald-500" />
                    30-day guarantee
                </div>
            </div>
        </div>
    </div>
</div>
