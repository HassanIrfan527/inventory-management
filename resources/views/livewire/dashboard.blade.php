<div class="flex flex-col gap-6">
    {{-- Page Header --}}
    <div class="flex flex-col gap-2">
        <div class="inline-flex items-center gap-2 rounded-full bg-emerald-100 px-3 py-1 text-xs font-medium text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 w-fit">
            <flux:icon name="chart-bar" class="w-3.5 h-3.5" />
            <span>Overview · Dashboard</span>
        </div>
        <flux:heading size="xl" level="1">Dashboard</flux:heading>
        <flux:text size="sm" class="text-zinc-600 dark:text-zinc-400">
            See your key metrics and recent activity at a glance.
        </flux:text>
    </div>

    {{-- Key Metrics --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        {{-- Total Products --}}
        <div class="group relative overflow-hidden rounded-xl border border-zinc-200 bg-white p-6 shadow-sm transition-all hover:shadow-md dark:border-zinc-800 dark:bg-zinc-900">
            <div class="absolute -right-2 -top-2 h-16 w-16 rounded-full bg-gradient-to-br from-blue-500/10 to-indigo-500/10 blur-2xl"></div>
            <div class="relative">
                <div class="flex items-center gap-3 mb-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">
                        <flux:icon name="shopping-bag" class="h-5 w-5" />
                    </div>
                    <span class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Total Products</span>
                </div>
                <div class="text-3xl font-bold text-zinc-900 dark:text-white">
                    {{ $this->stats['total_products'] }}
                </div>
            </div>
        </div>

        {{-- Total Orders --}}
        <div class="group relative overflow-hidden rounded-xl border border-zinc-200 bg-white p-6 shadow-sm transition-all hover:shadow-md dark:border-zinc-800 dark:bg-zinc-900">
            <div class="absolute -right-2 -top-2 h-16 w-16 rounded-full bg-gradient-to-br from-emerald-500/10 to-teal-500/10 blur-2xl"></div>
            <div class="relative">
                <div class="flex items-center gap-3 mb-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-gradient-to-br from-emerald-500 to-teal-600 text-white">
                        <flux:icon name="shopping-cart" class="h-5 w-5" />
                    </div>
                    <span class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Total Orders</span>
                </div>
                <div class="flex items-baseline gap-3">
                    <div class="text-3xl font-bold text-zinc-900 dark:text-white">
                        {{ $this->stats['total_orders'] }}
                    </div>
                    <div class="flex items-center gap-1 rounded-full bg-amber-100 px-2 py-0.5 text-xs font-medium text-amber-700 dark:bg-amber-900/30 dark:text-amber-400">
                        <flux:icon name="clock" class="h-3 w-3" />
                        {{ $this->stats['pending_orders'] }} Pending
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Contacts --}}
        <div class="group relative overflow-hidden rounded-xl border border-zinc-200 bg-white p-6 shadow-sm transition-all hover:shadow-md dark:border-zinc-800 dark:bg-zinc-900">
            <div class="absolute -right-2 -top-2 h-16 w-16 rounded-full bg-gradient-to-br from-purple-500/10 to-pink-500/10 blur-2xl"></div>
            <div class="relative">
                <div class="flex items-center gap-3 mb-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-purple-100 text-purple-600 dark:bg-purple-900/30 dark:text-purple-400">
                        <flux:icon name="users" class="h-5 w-5" />
                    </div>
                    <span class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Total Contacts</span>
                </div>
                <div class="text-3xl font-bold text-zinc-900 dark:text-white">
                    {{ $this->stats['total_contacts'] }}
                </div>
            </div>
        </div>

        {{-- Total Revenue --}}
        <div class="group relative overflow-hidden rounded-xl border border-zinc-200 bg-gradient-to-br from-emerald-500 to-teal-600 p-6 shadow-sm transition-all hover:shadow-lg dark:border-zinc-800">
            <div class="relative">
                <div class="flex items-center gap-3 mb-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-white/20 text-white">
                        <flux:icon name="banknotes" class="h-5 w-5" />
                    </div>
                    <span class="text-sm font-medium text-emerald-100">Total Revenue</span>
                </div>
                <div class="text-3xl font-bold text-white">
                    Rs. {{ number_format($this->stats['total_revenue']) }}
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Recent Orders --}}
        <div class="lg:col-span-2 flex flex-col gap-4">
            <div class="relative h-full overflow-hidden rounded-xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <div class="flex items-center justify-between border-b border-zinc-200 bg-gradient-to-r from-emerald-50/50 to-teal-50/50 px-6 py-4 dark:border-zinc-800 dark:from-emerald-950/20 dark:to-teal-950/20">
                    <div class="flex items-center gap-2">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-400">
                            <flux:icon name="shopping-cart" class="h-4 w-4" />
                        </div>
                        <flux:heading size="lg">Recent Orders</flux:heading>
                    </div>
                    <flux:button href="{{ route('orders') }}" variant="ghost" size="sm" class="hover:!bg-emerald-100 hover:!text-emerald-700 dark:hover:!bg-emerald-900/30 dark:hover:!text-emerald-400">
                        View All →
                    </flux:button>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-800">
                        <thead>
                            <tr class="bg-zinc-50 dark:bg-zinc-800/50">
                                <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wide text-zinc-600 dark:text-zinc-400">
                                    Order ID</th>
                                <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wide text-zinc-600 dark:text-zinc-400">
                                    Customer</th>
                                <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wide text-zinc-600 dark:text-zinc-400">
                                    Status</th>
                                <th class="px-6 py-3.5 text-right text-xs font-semibold uppercase tracking-wide text-zinc-600 dark:text-zinc-400">
                                    Amount</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                            @forelse($this->recentOrders as $order)
                                <tr class="hover:bg-emerald-50/30 transition-colors dark:hover:bg-emerald-950/10">
                                    <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-zinc-900 dark:text-white">
                                        #{{ $order->order_number }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-zinc-600 dark:text-zinc-400">
                                        {{ $order->contact->name ?? 'Unknown' }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm">
                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                                            {{ $order->status === 'completed' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : '' }}
                                            {{ $order->status === 'pending' ? 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400' : '' }}
                                            {{ $order->status === 'cancelled' ? 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' : '' }}
                                            {{ !in_array($order->status, ['completed', 'pending', 'cancelled']) ? 'bg-zinc-100 text-zinc-700 dark:bg-zinc-800 dark:text-zinc-400' : '' }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-right font-semibold text-zinc-900 dark:text-white">
                                        Rs. {{ number_format($order->total_amount) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center gap-2">
                                            <flux:icon name="shopping-cart" class="h-8 w-8 text-zinc-300 dark:text-zinc-600" />
                                            <p class="text-sm text-zinc-500 dark:text-zinc-400">No recent orders found.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Products by Category --}}
        <div class="flex flex-col gap-4">
            <div class="relative h-full overflow-hidden rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <div class="flex items-center gap-2 mb-6">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600 dark:bg-indigo-900/30 dark:text-indigo-400">
                        <flux:icon name="squares-2x2" class="h-4 w-4" />
                    </div>
                    <flux:heading size="lg">Products by Category</flux:heading>
                </div>
                <div class="space-y-4">
                    @forelse($this->productsByCategory as $category)
                        <div>
                            <div class="flex items-center justify-between text-sm mb-2">
                                <span class="font-semibold text-zinc-700 dark:text-zinc-300">{{ $category->name }}</span>
                                <span class="font-mono text-emerald-600 dark:text-emerald-400">{{ $category->products_count }}</span>
                            </div>
                            <div class="h-2.5 w-full bg-zinc-100 dark:bg-zinc-800 rounded-full overflow-hidden">
                                @php
                                    $max = $this->productsByCategory->max('products_count') ?: 1;
                                    $percent = ($category->products_count / $max) * 100;
                                @endphp
                                <div class="h-full bg-gradient-to-r from-emerald-500 to-teal-600 rounded-full transition-all duration-500" style="width: {{ $percent }}%">
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="flex flex-col items-center gap-2 py-6">
                            <flux:icon name="squares-2x2" class="h-8 w-8 text-zinc-300 dark:text-zinc-600" />
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">No categories found.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Product Performance --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Top Selling --}}
        <div class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <div class="flex items-center gap-2 mb-6">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-400">
                    <flux:icon name="arrow-trending-up" class="h-4 w-4" />
                </div>
                <flux:heading size="lg">Top Selling Products</flux:heading>
            </div>
            <div class="space-y-3">
                @forelse($this->topSellingProducts as $index => $product)
                    <div class="flex items-center gap-4 rounded-lg border border-zinc-100 bg-zinc-50/50 p-4 transition-all hover:bg-emerald-50/30 dark:border-zinc-800 dark:bg-zinc-800/30 dark:hover:bg-emerald-950/10">
                        <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-emerald-500 to-teal-600 text-sm font-bold text-white">
                            {{ $index + 1 }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="truncate font-semibold text-zinc-900 dark:text-zinc-100">{{ $product->name }}</div>
                            <div class="text-xs text-zinc-500 dark:text-zinc-400">
                                {{ $product->orders_count }} {{ Str::plural('order', $product->orders_count) }}
                            </div>
                        </div>
                        <div class="font-mono text-sm font-semibold text-emerald-600 dark:text-emerald-400">
                            Rs. {{ number_format($product->retail_price) }}
                        </div>
                    </div>
                @empty
                    <div class="flex flex-col items-center gap-2 py-8">
                        <flux:icon name="chart-bar" class="h-8 w-8 text-zinc-300 dark:text-zinc-600" />
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">No sales data yet.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Least Selling --}}
        <div class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <div class="flex items-center gap-2 mb-6">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-amber-100 text-amber-600 dark:bg-amber-900/30 dark:text-amber-400">
                    <flux:icon name="arrow-trending-down" class="h-4 w-4" />
                </div>
                <flux:heading size="lg">Least Selling Products</flux:heading>
            </div>
            <div class="space-y-3">
                @forelse($this->leastSellingProducts as $index => $product)
                    <div class="flex items-center gap-4 rounded-lg border border-zinc-100 bg-zinc-50/50 p-4 transition-all hover:bg-amber-50/30 dark:border-zinc-800 dark:bg-zinc-800/30 dark:hover:bg-amber-950/10">
                        <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-amber-500 to-orange-600 text-sm font-bold text-white">
                            {{ $index + 1 }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="truncate font-semibold text-zinc-900 dark:text-zinc-100">{{ $product->name }}</div>
                            <div class="text-xs text-zinc-500 dark:text-zinc-400">
                                {{ $product->orders_count }} {{ Str::plural('order', $product->orders_count) }}
                            </div>
                        </div>
                        <div class="font-mono text-sm font-semibold text-zinc-600 dark:text-zinc-400">
                            Rs. {{ number_format($product->retail_price) }}
                        </div>
                    </div>
                @empty
                    <div class="flex flex-col items-center gap-2 py-8">
                        <flux:icon name="chart-bar" class="h-8 w-8 text-zinc-300 dark:text-zinc-600" />
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">No sales data yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
