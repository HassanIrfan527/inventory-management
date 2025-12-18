<x-layouts.app :title="__('Products Inventory')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <!-- Page Header -->
        <div class="flex flex-col gap-2">
            <h1 class="text-3xl font-bold text-neutral-900 dark:text-white">Products Inventory</h1>
            <p class="text-sm text-neutral-600 dark:text-neutral-400">Manage your product inventory and pricing</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Total Products -->
            <div class="rounded-lg border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-900">
                <div class="flex items-center justify-between">
                    <div class="flex flex-col gap-1">
                        <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Total Products</p>
                        <p class="text-2xl font-bold text-neutral-900 dark:text-white">{{ \App\Models\Product::count() }}</p>
                    </div>
                    <div class="rounded-lg bg-blue-100 dark:bg-blue-900/30 p-3">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Avg Retail Price -->
            <div class="rounded-lg border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-900">
                <div class="flex items-center justify-between">
                    <div class="flex flex-col gap-1">
                        <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Avg Retail Price</p>
                        <p class="text-2xl font-bold text-neutral-900 dark:text-white">Rs. {{ number_format(\App\Models\Product::avg('retail_price') ?? 0, 0) }}</p>
                    </div>
                    <div class="rounded-lg bg-green-100 dark:bg-green-900/30 p-3">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Inventory Value -->
            <div class="rounded-lg border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-900">
                <div class="flex items-center justify-between">
                    <div class="flex flex-col gap-1">
                        <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Total Inventory Value</p>
                        <p class="text-2xl font-bold text-neutral-900 dark:text-white">Rs. {{ \App\Models\Product::totalInventoryValue() }}</p>
                    </div>
                    <div class="rounded-lg bg-purple-100 dark:bg-purple-900/30 p-3">
                        <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Section -->
        <livewire:products-table />
    </div>
</x-layouts.app>
