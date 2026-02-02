<div class="flex flex-col gap-8" x-data="{ view: @entangle('viewMode') }">
    {{-- Page Header --}}
    <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex flex-col gap-2">
            <div
                class="inline-flex items-center gap-2 rounded-full bg-emerald-100 px-3 py-1 text-[10px] font-bold uppercase tracking-widest text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 w-fit ring-1 ring-emerald-200 dark:ring-emerald-800">
                <flux:icon name="chart-bar" class="w-3.5 h-3.5" />
                <span>Executive Intelligence · Insights Hub</span>
            </div>
            <flux:heading size="xl" level="1" class="text-emerald-950 dark:text-emerald-50">Business Overview</flux:heading>
            <flux:text size="sm" class="text-zinc-500 dark:text-zinc-400">
                Real-time performance monitoring and predictive data analytics.
            </flux:text>
        </div>

        {{-- Mode Toggle --}}
        <div class="flex h-11 w-full items-center gap-1 rounded-xl bg-zinc-100 p-1 dark:bg-zinc-800 sm:w-80">
            <button @click="view = 'static'"
                :class="view === 'static' ? 'bg-white shadow-sm text-zinc-900 dark:bg-zinc-700 dark:text-white' : 'text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-200'"
                class="flex flex-1 items-center justify-center gap-2 rounded-lg py-1.5 text-xs font-bold transition-all duration-200">
                <flux:icon name="layout-grid" class="size-4" />
                Daily Stats
            </button>
            <button @click="view = 'ai'"
                :class="view === 'ai' ? 'bg-emerald-600 shadow-sm text-white' : 'text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-200'"
                class="flex flex-1 items-center justify-center gap-2 rounded-lg py-1.5 text-xs font-bold transition-all duration-200">
                <flux:icon.sparkles class="size-4" />
                AI Intelligence
            </button>
        </div>
    </div>

    {{-- Standard View --}}
    <div x-show="view === 'static'" x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        class="flex flex-col gap-8">

        {{-- Key Metrics --}}
        <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-4">
            {{-- Total Products --}}
            <div class="group relative overflow-hidden rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm transition-all hover:shadow-md dark:border-zinc-800 dark:bg-zinc-900">
                <div class="absolute -right-2 -top-2 h-16 w-16 rounded-full bg-gradient-to-br from-blue-500/10 to-indigo-500/10 blur-2xl"></div>
                <div class="relative flex items-center justify-between">
                    <div class="flex flex-col gap-1">
                        <p class="text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Inventory Items</p>
                        <p class="text-3xl font-bold text-zinc-900 dark:text-white mt-1">{{ number_format($this->stats['total_products']) }}</p>
                    </div>
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400 ring-4 ring-blue-50/50 dark:ring-blue-900/10 transition-transform group-hover:scale-110">
                        <flux:icon name="shopping-bag" class="h-6 w-6" />
                    </div>
                </div>
                <div class="mt-4 flex items-center gap-2 text-sm pt-4 border-t border-blue-50 dark:border-blue-900/10">
                    <span class="flex items-center gap-1 font-medium text-blue-600 dark:text-blue-400 shrink-0 whitespace-nowrap text-[10px] font-black uppercase tracking-widest">
                        <flux:icon name="check" class="h-3.5 w-3.5" />
                        In-Stock
                    </span>
                    <span class="text-zinc-400 truncate text-[10px] uppercase font-bold tracking-widest leading-none">Global catalog</span>
                </div>
            </div>

            {{-- Total Orders --}}
            <div class="group relative overflow-hidden rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm transition-all hover:shadow-md dark:border-zinc-800 dark:bg-zinc-900">
                <div class="absolute -right-2 -top-2 h-16 w-16 rounded-full bg-gradient-to-br from-emerald-500/10 to-teal-500/10 blur-2xl"></div>
                <div class="relative flex items-center justify-between">
                    <div class="flex flex-col gap-1">
                        <p class="text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Total Orders</p>
                        <div class="flex items-baseline gap-2 mt-1">
                            <p class="text-3xl font-bold text-zinc-900 dark:text-white">{{ number_format($this->stats['total_orders']) }}</p>
                            <span class="text-xs font-bold text-emerald-600">+12%</span>
                        </div>
                    </div>
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-900/20 dark:text-emerald-400 ring-4 ring-emerald-50/50 dark:ring-emerald-900/10 transition-transform group-hover:scale-110">
                        <flux:icon name="shopping-cart" class="h-6 w-6" />
                    </div>
                </div>
                <div class="mt-4 flex items-center gap-2 text-sm pt-4 border-t border-emerald-50 dark:border-emerald-900/10">
                    <span class="flex items-center gap-1 font-medium text-amber-600 shrink-0 whitespace-nowrap text-[10px] font-black uppercase tracking-widest">
                        <flux:icon name="clock" class="h-3.5 w-3.5" />
                        {{ $this->stats['pending_orders'] }} Pending
                    </span>
                    <span class="text-zinc-400 truncate text-[10px] uppercase font-bold tracking-widest leading-none">Current backlog</span>
                </div>
            </div>

            {{-- Total Contacts --}}
            <div class="group relative overflow-hidden rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm transition-all hover:shadow-md dark:border-zinc-800 dark:bg-zinc-900">
                <div class="absolute -right-2 -top-2 h-16 w-16 rounded-full bg-gradient-to-br from-purple-500/10 to-pink-500/10 blur-2xl"></div>
                <div class="relative flex items-center justify-between">
                    <div class="flex flex-col gap-1">
                        <p class="text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Network & Contacts</p>
                        <p class="text-3xl font-bold text-zinc-900 dark:text-white mt-1">{{ number_format($this->stats['total_contacts']) }}</p>
                    </div>
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-purple-50 text-purple-600 dark:bg-purple-900/20 dark:text-purple-400 ring-4 ring-purple-50/50 dark:ring-purple-900/10 transition-transform group-hover:scale-110">
                        <flux:icon name="users" class="h-6 w-6" />
                    </div>
                </div>
                <div class="mt-4 flex items-center gap-2 text-sm pt-4 border-t border-purple-50 dark:border-purple-900/10">
                    <span class="flex items-center gap-1 font-medium text-purple-600 dark:text-purple-400 shrink-0 whitespace-nowrap text-[10px] font-black uppercase tracking-widest">
                        <flux:icon name="activity" class="h-3.5 w-3.5" />
                        Active
                    </span>
                    <span class="text-zinc-400 truncate text-[10px] uppercase font-bold tracking-widest leading-none">Customers/Suppliers</span>
                </div>
            </div>

            {{-- Total Revenue --}}
            <div class="group relative overflow-hidden rounded-2xl border border-emerald-100 bg-gradient-to-br from-emerald-600 to-teal-700 p-6 shadow-sm transition-all hover:shadow-lg dark:border-zinc-800">
                <div class="relative">
                    <div class="flex items-center justify-between mb-3 text-white">
                        <div class="flex flex-col gap-1">
                            <p class="text-xs font-bold uppercase tracking-wider opacity-80">Total Revenue</p>
                            <p class="text-3xl font-black tracking-tight mt-1">Rs. {{ number_format($this->stats['total_revenue']) }}</p>
                        </div>
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-white/20 text-white backdrop-blur-md ring-4 ring-white/10 transition-transform group-hover:rotate-12 group-hover:scale-110">
                            <flux:icon name="banknotes" class="h-7 w-7" />
                        </div>
                    </div>
                    <div class="flex items-center gap-2 text-white/70 pt-4 border-t border-white/10 mt-3 text-[10px] font-black uppercase tracking-widest leading-none">
                         <flux:icon name="check-circle" class="h-4 w-4" />
                         Verified Sales
                    </div>
                </div>
            </div>
        </div>

        {{-- Tables Section --}}
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            {{-- Recent Orders --}}
            <div class="lg:col-span-2">
                <div class="flex flex-col overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900 transition-all">
                    <div class="flex items-center justify-between border-b border-zinc-100 p-6 dark:border-zinc-800">
                        <div class="flex items-center gap-4">
                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-400">
                                <flux:icon name="shopping-cart" class="size-5" />
                            </div>
                            <div class="flex flex-col">
                                <h2 class="text-lg font-bold text-zinc-900 dark:text-white leading-none">Transaction Log</h2>
                                <flux:text size="xs" class="mt-1">Overview of latest platform activity</flux:text>
                            </div>
                        </div>
                        <flux:button href="{{ route('orders') }}" variant="subtle" size="sm" class="font-bold uppercase tracking-widest text-[10px]">View Analytics →</flux:button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-zinc-50 border-b border-zinc-100 dark:bg-zinc-800/50 dark:border-zinc-800">
                                <tr>
                                    <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 whitespace-nowrap">ID Ref</th>
                                    <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Entity</th>
                                    <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 text-center">Status</th>
                                    <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 text-right">Value</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                                @forelse($this->recentOrders as $order)
                                    <tr class="group transition-all hover:bg-emerald-50/30 dark:hover:bg-emerald-900/10 cursor-pointer">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="font-bold text-emerald-600 dark:text-emerald-400">#{{ $order->order_number }}</span>
                                            <div class="text-[9px] text-zinc-400 mt-1 uppercase font-black tracking-tighter">Recorded Activity</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="font-bold text-zinc-700 dark:text-zinc-300">{{ $order->contact->name ?? 'Unknown Entity' }}</span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            @php
                                                $statusColor = match ($order->status) {
                                                    'completed' => 'emerald',
                                                    'pending' => 'amber',
                                                    'cancelled' => 'rose',
                                                    default => 'zinc',
                                                };
                                            @endphp
                                            <flux:badge :color="$statusColor" variant="solid" size="sm" class="capitalize tracking-tight">
                                                {{ $order->status }}
                                            </flux:badge>
                                        </td>
                                        <td class="px-6 py-4 text-right font-black text-zinc-900 dark:text-white">
                                            Rs. {{ number_format($order->total_amount, 2) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-20 text-center">
                                            <flux:text class="dark:text-zinc-500">No recent transactions recorded.</flux:text>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Categories Section --}}
            <div class="flex flex-col gap-5">
                <div class="flex flex-col h-full overflow-hidden rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900 transition-all">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600 dark:bg-indigo-900/30 dark:text-indigo-400">
                            <flux:icon name="squares-2x2" class="size-5" />
                        </div>
                        <div class="flex flex-col">
                            <h2 class="text-base font-bold text-zinc-900 dark:text-white leading-none">Catalog Density</h2>
                            <flux:text size="xs" class="mt-1">Distribution across sectors</flux:text>
                        </div>
                    </div>

                    <div class="flex flex-col gap-6">
                        @forelse($this->productsByCategory as $category)
                            <div class="flex flex-col gap-2">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold text-zinc-700 dark:text-zinc-300 uppercase tracking-tight">{{ $category->name }}</span>
                                    <span class="text-[10px] font-black text-emerald-600 dark:text-emerald-400">{{ $category->products_count }} Items</span>
                                </div>
                                <div class="h-1.5 w-full bg-zinc-100 rounded-full dark:bg-zinc-800 overflow-hidden">
                                    @php
                                        $max = $this->productsByCategory->max('products_count') ?: 1;
                                        $percent = ($category->products_count / $max) * 100;
                                    @endphp
                                    <div class="h-full bg-gradient-to-r from-emerald-500 to-teal-600 rounded-full" style="width: {{ $percent }}%"></div>
                                </div>
                            </div>
                        @empty
                            <flux:text class="text-center py-10 opacity-50">Discovery phase needed.</flux:text>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- AI Intelligence View --}}
    <div x-show="view === 'ai'" x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        class="flex flex-col gap-8">

        {{-- AI Insights Header --}}
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            {{-- Predictive Revenue --}}
            <div class="lg:col-span-2 relative overflow-hidden rounded-2xl border border-emerald-500/30 bg-white shadow-xl dark:bg-zinc-900 p-8 group">
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-950/20 dark:to-teal-950/20 opacity-50"></div>
                <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-emerald-500/10 blur-[100px] group-hover:bg-emerald-500/20 transition-all duration-700"></div>

                <div class="relative">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-600 text-white shadow-lg shadow-emerald-500/20 ring-4 ring-emerald-500/10">
                            <flux:icon name="sparkles" class="size-6" />
                        </div>
                        <div class="flex flex-col">
                            <h2 class="text-xl font-black text-zinc-900 dark:text-white tracking-tight">Predictive Revenue Forecast</h2>
                            <flux:text size="sm" class="text-emerald-600 dark:text-emerald-400 font-bold uppercase tracking-widest text-[10px]">AI-Generated Estimation · Next 30 Days</flux:text>
                        </div>
                    </div>

                    <div class="flex flex-col gap-8 sm:flex-row sm:items-end sm:justify-between">
                        <div class="flex flex-col gap-2">
                            <flux:text size="xs" class="font-bold uppercase tracking-widest text-zinc-400">Estimated Collection</flux:text>
                            <div class="flex items-baseline gap-3">
                                <span class="text-5xl font-black text-zinc-900 dark:text-white tracking-tighter">Rs. 842,500</span>
                                <span class="flex items-center gap-1 text-sm font-bold text-emerald-600 bg-emerald-50 dark:bg-emerald-900/40 px-3 py-1 rounded-full">
                                    <flux:icon name="arrow-up" class="size-3" />
                                    18.4%
                                </span>
                            </div>
                        </div>

                        <div class="flex -space-x-4">
                            @for ($i = 0; $i < 4; $i++)
                                <div class="h-10 w-10 rounded-full border-4 border-white dark:border-zinc-900 dark:bg-zinc-800 bg-zinc-100 flex items-center justify-center overflow-hidden ring-2 ring-emerald-500/20">
                                    <img src="https://i.pravatar.cc/100?img={{ 30 + $i }}" class="h-full w-full object-cover grayscale opacity-80" />
                                </div>
                            @endfor
                            <div class="h-10 w-10 rounded-full border-4 border-white dark:border-zinc-900 bg-emerald-600 flex items-center justify-center text-[10px] font-black text-white ring-2 ring-emerald-500/20">
                                +8
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-6 pt-8 border-t border-zinc-100 dark:border-zinc-800">
                        <div class="flex flex-col gap-1">
                            <flux:text size="xs" class="uppercase tracking-widest font-black text-zinc-400">Confidence Score</flux:text>
                            <span class="text-lg font-bold text-emerald-600 dark:text-emerald-400">94.2%</span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <flux:text size="xs" class="uppercase tracking-widest font-black text-zinc-400">Growth Index</flux:text>
                            <span class="text-lg font-bold text-teal-600 dark:text-teal-400">+4.8 Index</span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <flux:text size="xs" class="uppercase tracking-widest font-black text-zinc-400">Risk Profile</flux:text>
                            <span class="text-lg font-bold text-zinc-500">Optimistic</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Intelligence Snapshot --}}
            <div class="flex flex-col gap-6">
                {{-- Inventory Risk --}}
                <div class="flex flex-col gap-4 rounded-2xl bg-zinc-900 p-6 dark:bg-zinc-800/50 dark:border dark:border-zinc-800">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="p-2 border border-rose-500/30 rounded-lg bg-rose-500/10">
                                <flux:icon name="exclamation-triangle" class="size-4 text-rose-500" />
                            </div>
                            <span class="text-xs font-black uppercase tracking-widest text-white">Stock Risk Alert</span>
                        </div>
                        <span class="text-[10px] font-bold text-zinc-400">Live</span>
                    </div>
                    <div class="flex flex-col">
                        <h4 class="text-base font-bold text-white">High Out-of-Stock Probability</h4>
                        <flux:text size="xs" class="mt-1 text-zinc-400">3 SKUs are trending towards depletion in <span class="text-rose-400">48-72 hours</span>.</flux:text>
                    </div>
                    <flux:button variant="subtle" size="sm" class="w-full bg-white/5 border-none text-white hover:bg-white/10 mt-2">Restock Analysis →</flux:button>
                </div>

                {{-- Customer Intent --}}
                <div class="flex flex-col gap-4 rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900 transition-all">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="p-2 border border-emerald-500/30 rounded-lg bg-emerald-500/10">
                                <flux:icon name="sparkles" class="size-4 text-emerald-600 dark:text-emerald-400" />
                            </div>
                            <span class="text-xs font-black uppercase tracking-widest text-zinc-500">Market Intelligence</span>
                        </div>
                        <span class="text-[10px] font-bold text-emerald-600 bg-emerald-100 dark:bg-emerald-900/30 px-2 py-0.5 rounded">New</span>
                    </div>
                    <div>
                        <h4 class="text-base font-bold text-zinc-900 dark:text-white">Customer Retention Up</h4>
                        <flux:text size="xs" class="mt-1">Returning customer rate increased by <span class="font-black text-emerald-600">6.2%</span> this week.</flux:text>
                    </div>
                </div>
            </div>
        </div>

        {{-- Expanded AI Insight Sections --}}
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
            {{-- Performance Benchmarks --}}
            <div class="flex flex-col overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <div class="flex items-center justify-between p-6 border-b border-zinc-100 dark:border-zinc-800">
                    <div class="flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-zinc-100 text-zinc-600 dark:bg-zinc-800 dark:text-zinc-400">
                            <flux:icon name="presentation-chart-line" class="size-5" />
                        </div>
                        <div class="flex flex-col">
                            <h2 class="text-base font-bold text-zinc-900 dark:text-white leading-none">AI Intelligence Feed</h2>
                            <flux:text size="xs" class="mt-1">Anomaly detection and insights</flux:text>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col divide-y divide-zinc-100 dark:divide-zinc-800">
                    {{-- Row 1 --}}
                    <div class="p-6 transition-all hover:bg-emerald-50/10 dark:hover:bg-emerald-900/5 group">
                        <div class="flex items-start justify-between">
                            <div class="flex flex-col">
                                <span class="text-xs font-black uppercase tracking-widest text-emerald-600 dark:text-emerald-400 mb-2">High Impact</span>
                                <h3 class="text-base font-bold text-zinc-900 dark:text-white group-hover:text-emerald-600 transition-colors">Abnormal Sales Volume Detected</h3>
                                <p class="text-sm text-zinc-500 mt-2">Product "Enterprise Workstation" is selling 4x faster than usual seasonal average.</p>
                            </div>
                        </div>
                    </div>
                    {{-- Row 2 --}}
                    <div class="p-6 transition-all hover:bg-amber-50/10 dark:hover:bg-amber-900/5 group">
                        <div class="flex items-start justify-between">
                            <div class="flex flex-col">
                                <span class="text-xs font-black uppercase tracking-widest text-amber-600 dark:text-amber-400 mb-2">Optimization Opportunity</span>
                                <h3 class="text-base font-bold text-zinc-900 dark:text-white group-hover:text-amber-600 transition-colors">Shipping Cost Efficiency</h3>
                                <p class="text-sm text-zinc-500 mt-2">Switching orders over Rs. 50k to "Express Courier" will reduce logistics cost by 12%.</p>
                            </div>
                        </div>
                    </div>
                    {{-- Row 3 --}}
                    <div class="p-6 transition-all hover:bg-purple-50/10 dark:hover:bg-purple-900/5 group">
                        <div class="flex items-start justify-between">
                            <div class="flex flex-col">
                                <span class="text-xs font-black uppercase tracking-widest text-purple-600 dark:text-purple-400 mb-2">Strategic Insight</span>
                                <h3 class="text-base font-bold text-zinc-900 dark:text-white group-hover:text-purple-600 transition-colors">Customer Lifetime Expanding</h3>
                                <p class="text-sm text-zinc-500 mt-2">New subscription-based revenue stream is projected to generate 30% of total revenue by Q3.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Operational Health Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                 <div class="flex flex-col gap-6 rounded-2xl border border-zinc-200 bg-white p-8 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-100 text-sky-600 dark:bg-sky-900/40 dark:text-sky-400">
                        <flux:icon name="clock" class="size-6" />
                    </div>
                    <div class="flex flex-col">
                        <flux:text size="sm" class="font-bold uppercase tracking-widest text-zinc-400">Order Cycle Time</flux:text>
                        <span class="text-3xl font-black text-zinc-900 dark:text-white mt-1">1.4 Days</span>
                        <div class="flex items-center gap-1 mt-2 text-xs font-bold text-emerald-600">
                            <flux:icon name="arrow-down" class="size-3" />
                            <span>8% Faster</span>
                        </div>
                    </div>
                 </div>

                 <div class="flex flex-col gap-6 rounded-2xl border border-zinc-200 bg-white p-8 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-rose-100 text-rose-600 dark:bg-rose-900/40 dark:text-rose-400">
                        <flux:icon name="shield-check" class="size-6" />
                    </div>
                    <div class="flex flex-col">
                        <flux:text size="sm" class="font-bold uppercase tracking-widest text-zinc-400">Security Index</flux:text>
                        <span class="text-3xl font-black text-zinc-900 dark:text-white mt-1">99.9%</span>
                        <div class="flex items-center gap-1 mt-2 text-xs font-bold text-zinc-400">
                            <flux:icon name="check-circle" class="size-3" />
                            <span>Optimal Level</span>
                        </div>
                    </div>
                 </div>

                 <div class="flex flex-col gap-6 rounded-2xl border border-zinc-200 bg-white p-8 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-100 text-amber-600 dark:bg-amber-900/40 dark:text-amber-400">
                        <flux:icon name="user-plus" class="size-6" />
                    </div>
                    <div class="flex flex-col">
                        <flux:text size="sm" class="font-bold uppercase tracking-widest text-zinc-400">Acquisition Cost</flux:text>
                        <span class="text-3xl font-black text-zinc-900 dark:text-white mt-1">Rs. 1,240</span>
                        <div class="flex items-center gap-1 mt-2 text-xs font-bold text-rose-600">
                            <flux:icon name="arrow-up" class="size-3" />
                            <span>2% Higher</span>
                        </div>
                    </div>
                 </div>

                 <div class="flex flex-col gap-6 rounded-2xl border border-zinc-200 bg-white p-8 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-600 dark:bg-indigo-900/40 dark:text-indigo-400">
                        <flux:icon name="briefcase" class="size-6" />
                    </div>
                    <div class="flex flex-col">
                        <flux:text size="sm" class="font-bold uppercase tracking-widest text-zinc-400">Resource Load</flux:text>
                        <span class="text-3xl font-black text-zinc-900 dark:text-white mt-1">64.2%</span>
                        <div class="flex items-center gap-1 mt-2 text-xs font-bold text-zinc-400">
                            <flux:icon name="info" class="size-3" />
                            <span>Normal Range</span>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    </div>
</div>
