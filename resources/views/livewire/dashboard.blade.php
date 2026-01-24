<div class="flex flex-col gap-6">
    <div class="flex flex-col gap-2">
        <h1 class="text-3xl font-bold text-neutral-900 dark:text-white">Dashboard</h1>
        <p class="text-sm text-neutral-600 dark:text-neutral-400">See your key metrics and recent activity</p>
    </div>

    {{-- Key Metrics --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div
            class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900 flex flex-col gap-2">
            <div class="flex items-center gap-2 text-zinc-500 dark:text-zinc-400">
                <flux:icon.shopping-bag class="size-4" />
                <span class="text-sm font-medium">Total Products</span>
            </div>
            <div class="text-2xl font-semibold text-zinc-900 dark:text-white">
                {{ $this->stats['total_products'] }}
            </div>
        </div>

        <div
            class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900 flex flex-col gap-2">
            <div class="flex items-center gap-2 text-zinc-500 dark:text-zinc-400">
                <flux:icon.shopping-cart class="size-4" />
                <span class="text-sm font-medium">Total Orders</span>
            </div>
            <div class="flex items-baseline gap-2">
                <div class="text-2xl font-semibold text-zinc-900 dark:text-white">
                    {{ $this->stats['total_orders'] }}
                </div>
                <div class="text-xs text-amber-500 font-medium">
                    {{ $this->stats['pending_orders'] }} Pending
                </div>
            </div>
        </div>

        <div
            class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900 flex flex-col gap-2">
            <div class="flex items-center gap-2 text-zinc-500 dark:text-zinc-400">
                <flux:icon.users class="size-4" />
                <span class="text-sm font-medium">Total Contacts</span>
            </div>
            <div class="text-2xl font-semibold text-zinc-900 dark:text-white">
                {{ $this->stats['total_contacts'] }}
            </div>
        </div>

        <div
            class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900 flex flex-col gap-2">
            <div class="flex items-center gap-2 text-zinc-500 dark:text-zinc-400">
                <flux:icon.banknotes class="size-4" />
                <span class="text-sm font-medium">Total Revenue</span>
            </div>
            <div class="text-2xl font-semibold text-zinc-900 dark:text-white">
                Rs. {{ number_format($this->stats['total_revenue']) }}
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Recent Orders --}}
        <div class="lg:col-span-2 flex flex-col gap-4">
            <div
                class="relative h-full overflow-hidden rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                <div class="flex items-center justify-between mb-4">
                    <flux:heading size="lg">Recent Orders</flux:heading>
                    <flux:button href="{{ route('orders') }}" variant="subtle" size="sm">View All</flux:button>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-700">
                        <thead>
                            <tr>
                                <th class="px-3 py-3.5 text-left text-sm font-semibold text-zinc-900 dark:text-white">
                                    Order ID</th>
                                <th class="px-3 py-3.5 text-left text-sm font-semibold text-zinc-900 dark:text-white">
                                    Customer</th>
                                <th class="px-3 py-3.5 text-left text-sm font-semibold text-zinc-900 dark:text-white">
                                    Status</th>
                                <th class="px-3 py-3.5 text-right text-sm font-semibold text-zinc-900 dark:text-white">
                                    Amount</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                            @forelse($this->recentOrders as $order)
                                <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50">
                                    <td
                                        class="whitespace-nowrap px-3 py-4 text-sm font-medium text-zinc-900 dark:text-white">
                                        {{ $order->order_number }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-zinc-500 dark:text-zinc-400">
                                        {{ $order->contact->name ?? 'Unknown' }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm">
                                        <flux:badge size="sm"
                                            :color="$order->status === 'completed' ? 'green' : ($order->status === 'cancelled' ? 'red' : 'zinc')">
                                            {{ ucfirst($order->status) }}
                                        </flux:badge>
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-3 py-4 text-sm text-right font-mono text-zinc-900 dark:text-white">
                                        Rs. {{ number_format($order->total_amount) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-3 py-4 text-sm text-center text-zinc-500">No recent
                                        orders found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Products by Category --}}
        <div class="flex flex-col gap-4">
            <div
                class="relative h-full overflow-hidden rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                <flux:heading size="lg" class="mb-4">Products by Category</flux:heading>
                <div class="space-y-4">
                    @forelse($this->productsByCategory as $category)
                        <div>
                            <div class="flex items-center justify-between text-sm mb-1">
                                <span class="font-medium text-zinc-700 dark:text-zinc-300">{{ $category->name }}</span>
                                <span class="text-zinc-500">{{ $category->products_count }}</span>
                            </div>
                            <div class="h-2 w-full bg-zinc-100 dark:bg-zinc-800 rounded-full overflow-hidden">
                                @php
                                    $max = $this->productsByCategory->max('products_count') ?: 1;
                                    $percent = ($category->products_count / $max) * 100;
                                @endphp
                                <div class="h-full bg-indigo-500 rounded-full" style="width: {{ $percent }}%">
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-zinc-500 text-sm">No categories found.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Product Performance --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Top Selling --}}
        <div
            class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:heading size="lg" class="mb-4">Top Selling Products</flux:heading>
            <div class="space-y-3">
                @forelse($this->topSellingProducts as $product)
                    <div
                        class="flex items-center justify-between p-3 rounded-lg border border-zinc-100 dark:border-zinc-800 bg-zinc-50/50 dark:bg-zinc-900/50">
                        <div class="min-w-0">
                            <div class="truncate font-medium text-zinc-900 dark:text-zinc-100">{{ $product->name }}
                            </div>
                            <div class="text-xs text-zinc-500">
                                {{ $product->orders_count }} {{ Str::plural('order', $product->orders_count) }}
                            </div>
                        </div>
                        <div class="font-mono text-sm font-medium text-zinc-900 dark:text-zinc-100">
                            Rs. {{ number_format($product->retail_price) }}
                        </div>
                    </div>
                @empty
                    <div class="text-zinc-500 text-sm">No sales data yet.</div>
                @endforelse
            </div>
        </div>

        {{-- Least Selling --}}
        <div
            class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:heading size="lg" class="mb-4">Least Selling Products</flux:heading>
            <div class="space-y-3">
                @forelse($this->leastSellingProducts as $product)
                    <div
                        class="flex items-center justify-between p-3 rounded-lg border border-zinc-100 dark:border-zinc-800 bg-zinc-50/50 dark:bg-zinc-900/50">
                        <div class="min-w-0">
                            <div class="truncate font-medium text-zinc-900 dark:text-zinc-100">{{ $product->name }}
                            </div>
                            <div class="text-xs text-zinc-500">
                                {{ $product->orders_count }} {{ Str::plural('order', $product->orders_count) }}
                            </div>
                        </div>
                        <div class="font-mono text-sm font-medium text-zinc-900 dark:text-zinc-100">
                            Rs. {{ number_format($product->retail_price) }}
                        </div>
                    </div>
                @empty
                    <div class="text-zinc-500 text-sm">No sales data yet.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
