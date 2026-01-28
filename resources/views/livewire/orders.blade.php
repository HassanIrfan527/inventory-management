<div class="flex h-full w-full flex-1 flex-col gap-6">
    <!-- Page Header -->
    <div class="flex flex-col gap-2">
        <flux:heading size="xl" level="1">Orders</flux:heading>
        <flux:text size="sm" class="text-neutral-600 dark:text-neutral-400">
            View and track customer orders efficiently.
        </flux:text>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <!-- Total Orders -->
        <div
            class="group relative overflow-hidden rounded-xl border border-neutral-200 bg-white p-6 transition-all hover:shadow-md dark:border-neutral-700 dark:bg-neutral-900">
            <div class="flex items-center justify-between">
                <div class="flex flex-col gap-1">
                    <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Total Orders</p>
                    <p class="text-2xl font-bold text-neutral-900 dark:text-white">{{ $totalOrders }}</p>
                </div>
                <div class="rounded-lg bg-blue-50 p-3 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400">
                    <flux:icon.handbag />
                </div>
            </div>
        </div>

        <!-- Revenue -->
        <div
            class="group relative overflow-hidden rounded-xl border border-neutral-200 bg-white p-6 transition-all hover:shadow-md dark:border-neutral-700 dark:bg-neutral-900">
            <div class="flex items-center justify-between">
                <div class="flex flex-col gap-1">
                    <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Total Revenue</p>
                    <p class="text-2xl font-bold text-neutral-900 dark:text-white">Rs.
                        {{ number_format($totalRevenue) }}</p>
                </div>
                <div class="rounded-lg bg-green-50 p-3 text-green-600 dark:bg-green-900/20 dark:text-green-400">
                    <flux:icon.circle-dollar-sign />
                </div>
            </div>
        </div>

        <!-- Pending -->
        <div
            class="group relative overflow-hidden rounded-xl border border-neutral-200 bg-white p-6 transition-all hover:shadow-md dark:border-neutral-700 dark:bg-neutral-900">
            <div class="flex items-center justify-between">
                <div class="flex flex-col gap-1">
                    <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Pending</p>
                    <p class="text-2xl font-bold text-neutral-900 dark:text-white">{{ $pendingOrders }}</p>
                </div>
                <div class="rounded-lg bg-yellow-50 p-3 text-yellow-600 dark:bg-yellow-900/20 dark:text-yellow-400">
                    <flux:icon.clock />
                </div>
            </div>
            <div class="absolute inset-x-0 bottom-0 h-1 bg-yellow-500/20"></div>
        </div>

        <!-- Completed -->
        <div
            class="group relative overflow-hidden rounded-xl border border-neutral-200 bg-white p-6 transition-all hover:shadow-md dark:border-neutral-700 dark:bg-neutral-900">
            <div class="flex items-center justify-between">
                <div class="flex flex-col gap-1">
                    <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Completed</p>
                    <p class="text-2xl font-bold text-neutral-900 dark:text-white">{{ $completedOrders }}</p>
                </div>
                <div class="rounded-lg bg-purple-50 p-3 text-purple-600 dark:bg-purple-900/20 dark:text-purple-400">
                    <flux:icon.circle-check />
                </div>
            </div>
            <div class="absolute inset-x-0 bottom-0 h-1 bg-purple-500/20"></div>
        </div>
    </div>

    <!-- Orders Section -->

    <div
        class="flex flex-col gap-4 rounded-xl border border-neutral-200 bg-white shadow-sm dark:border-neutral-700 dark:bg-neutral-900">
        <!-- Table Header / Toolbar -->
        <div
            class="flex flex-col justify-between gap-4 border-b border-neutral-200 p-5 md:flex-row md:items-center dark:border-neutral-700">
            <h2 class="text-lg font-semibold text-neutral-900 dark:text-white">Recent Orders</h2>
            <div class="flex flex-wrap gap-2">
                <div class="w-full sm:w-72">
                    <flux:input
                        icon="magnifying-glass"
                        size="sm"
                        placeholder="Search orders by ID, customer, or status..."
                    />
                </div>

                <flux:button
                    variant="subtle"
                    size="sm"
                    icon="funnel"
                    class="border border-neutral-200 dark:border-neutral-700"
                >
                    Filter
                </flux:button>

                <flux:modal.trigger name="create-order">
                    <flux:button
                        variant="primary"
                        color="indigo"
                        size="sm"
                        icon="plus"
                    >
                        Create order
                    </flux:button>
                </flux:modal.trigger>
            </div>
        </div>

        <!-- Table -->
        <div x-data="{ expandedRow: null }" class="overflow-x-auto">
            <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700">
                <thead class="bg-neutral-50 dark:bg-neutral-800/50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-neutral-500 dark:text-neutral-400">
                            Order ID</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-neutral-500 dark:text-neutral-400">
                            Customer</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-neutral-500 dark:text-neutral-400">
                            Status</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-neutral-500 dark:text-neutral-400">
                            Total</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-neutral-500 dark:text-neutral-400">
                            Date</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-neutral-500 dark:text-neutral-400">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 bg-white dark:divide-neutral-700 dark:bg-neutral-900">
                    @if ($orders)

                        @foreach ($orders as $order)
                            <!-- Main Row -->
                            <tr @click="expandedRow = expandedRow === {{ $order->id }} ? null : {{ $order->id }}"
                                class="cursor-pointer transition-colors hover:bg-neutral-50 dark:hover:bg-neutral-800/50"
                                :class="{ 'bg-neutral-50 dark:bg-neutral-800/50': expandedRow === {{ $order->id }} }">
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-neutral-900 dark:text-white">
                                    <div class="flex items-center gap-2">
                                        <svg class="h-4 w-4 text-neutral-400 transition-transform duration-200"
                                            :class="{ 'rotate-90': expandedRow === {{ $order->id }} }" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                        {{ $order->order_number }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-500 dark:text-neutral-400">
                                    <div class="flex items-center gap-2">
                                        @if ($order->contact)
                                            <div
                                                class="h-6 w-6 rounded-full bg-neutral-200 flex items-center justify-center text-xs font-bold text-neutral-600 dark:bg-neutral-700 dark:text-neutral-300">
                                                {{ substr($order->contact->name, 0, 1) }}
                                            </div>
                                            <a href="{{ route('contact.show', $order->contact) }}"
                                                class="text-blue-600 underline hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 transition-colors">
                                                {{ $order->contact->name }}
                                            </a>
                                        @else
                                            <div
                                                class="h-6 w-6 rounded-full bg-neutral-100 flex items-center justify-center text-xs font-bold text-neutral-400 dark:bg-neutral-800 dark:text-neutral-500">
                                                ?
                                            </div>
                                            <span class="text-neutral-400 italic">Unknown Customer</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-0.5 text-xs font-medium
                                        {{ $order->status === 'Completed' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : '' }}
                                        {{ $order->status === 'Pending' ? 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400' : '' }}
                                        {{ $order->status === 'Processing' ? 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' : '' }}
                                    ">
                                        <span
                                            class="h-1.5 w-1.5 rounded-full {{ $order->status === 'Completed' ? 'bg-green-500' : ($order->status === 'Pending' ? 'bg-yellow-500' : 'bg-blue-500') }}"></span>
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-neutral-900 dark:text-white">
                                    Rs. {{ number_format($order->total_amount) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-500 dark:text-neutral-400">
                                    {{ $order->created_at }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <div class="flex items-center gap-3">
                                        <!-- View Details (Eye) -->
                                        <button
                                            @click.stop="expandedRow = expandedRow === {{ $order->id }} ? null : {{ $order->id }}"
                                            class="group relative text-neutral-500 hover:text-blue-600 dark:text-neutral-400 dark:hover:text-blue-400">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            <span
                                                class="absolute bottom-full left-1/2 mb-2 -translate-x-1/2 whitespace-nowrap rounded bg-neutral-900 px-2 py-1 text-xs text-white opacity-0 transition-opacity group-hover:opacity-100 dark:bg-white dark:text-neutral-900">View
                                                Details</span>
                                        </button>

                                        <!-- Generate Invoice (Document) -->
                                        <button wire:click.stop="$dispatch('open-generate-invoice-modal', { orderId: {{ $order->id }} })"
                                            class="group relative text-neutral-500 hover:text-purple-600 dark:text-neutral-400 dark:hover:text-purple-400 cursor-pointer">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <span
                                                class="absolute bottom-full left-1/2 mb-2 -translate-x-1/2 whitespace-nowrap rounded bg-neutral-900 px-2 py-1 text-xs text-white opacity-0 transition-opacity group-hover:opacity-100 dark:bg-white dark:text-neutral-900">Generate
                                                Invoice</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Expanded Details Row -->

                            <tr x-show="expandedRow === {{ $order->id }}" x-cloak
                                class="bg-neutral-50 dark:bg-neutral-800/30">
                                <td colspan="6" class="px-0 py-0">
                                    <div class="px-6 py-4">
                                        <div class="mb-3 flex items-center gap-2">
                                            <svg class="h-4 w-4 text-neutral-500" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                            </svg>
                                            <h3 class="text-sm font-semibold text-neutral-900 dark:text-white">
                                                Order Items</h3>
                                        </div>
                                        <div
                                            class="overflow-hidden rounded-lg border border-neutral-200 bg-white shadow-sm dark:border-neutral-700 dark:bg-neutral-900">
                                            <table
                                                class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700">
                                                <thead class="bg-neutral-50 dark:bg-neutral-800">
                                                    <tr>
                                                        <th
                                                            class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-neutral-500 dark:text-neutral-400">
                                                            Product</th>
                                                        <th
                                                            class="px-4 py-2 text-right text-xs font-medium uppercase tracking-wider text-neutral-500 dark:text-neutral-400">
                                                            Price</th>
                                                        <th
                                                            class="px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-neutral-500 dark:text-neutral-400">
                                                            Qty</th>
                                                        <th
                                                            class="px-4 py-2 text-right text-xs font-medium uppercase tracking-wider text-neutral-500 dark:text-neutral-400">
                                                            Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                                                    @foreach ($order->products as $product)
                                                        <tr>
                                                            <td
                                                                class="px-4 py-2.5 text-sm text-neutral-900 dark:text-white">
                                                                <div class="font-medium">{{ $product->name }}
                                                                </div>
                                                            </td>
                                                            <td
                                                                class="px-4 py-2.5 text-right text-sm text-neutral-600 dark:text-neutral-400">
                                                                Rs. {{ number_format($product->pivot->sale_price) }}
                                                            </td>
                                                            <td
                                                                class="px-4 py-2.5 text-center text-sm text-neutral-600 dark:text-neutral-400">
                                                                {{ $product->pivot->quantity }}</td>
                                                            <td
                                                                class="px-4 py-2.5 text-right text-sm font-medium text-neutral-900 dark:text-white">
                                                                Rs.
                                                                {{ number_format($product->pivot->quantity * $product->pivot->sale_price) }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot class="bg-neutral-50 dark:bg-neutral-800/50">
                                                    @if ($order->delivery_charge > 0)
                                                        <tr>
                                                            <td colspan="3"
                                                                class="px-4 py-2 text-right text-xs font-medium uppercase text-neutral-500 dark:text-neutral-400">
                                                                Delivery Charge</td>
                                                            <td
                                                                class="px-4 py-2 text-right text-sm text-neutral-900 dark:text-white">
                                                                Rs. {{ number_format($order->delivery_charge) }}</td>
                                                        </tr>
                                                    @endif
                                                    <tr>
                                                        <td colspan="3"
                                                            class="px-4 py-2 text-right text-xs font-medium uppercase text-neutral-500 dark:text-neutral-400">
                                                            Total Amount</td>
                                                        <td
                                                            class="px-4 py-2 text-right text-sm font-bold text-neutral-900 dark:text-white">
                                                            Rs. {{ number_format($order['total_amount']) }}</td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="px-6 py-12">
                                <div class="flex flex-col items-center justify-center gap-4">
                                    <div class="rounded-full bg-neutral-100 p-4 dark:bg-neutral-800">
                                        <flux:icon.package name="outline/clipboard-list"
                                            class="h-8 w-8 text-neutral-400" />
                                    </div>
                                    <div class="text-center">
                                        <h3 class="text-lg font-semibold text-neutral-900 dark:text-white">
                                            No orders yet
                                        </h3>
                                        <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">
                                            There are no orders to display. Orders will appear here once customers place
                                            them.
                                        </p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Pagination Mockup -->
        <div
            class="flex items-center justify-between border-t border-neutral-200 px-4 py-3 sm:px-6 dark:border-neutral-700">
            <div class="flex flex-1 justify-between sm:hidden">
                <a href="#"
                    class="relative inline-flex items-center rounded-md border border-neutral-300 bg-white px-4 py-2 text-sm font-medium text-neutral-700 hover:bg-neutral-50 dark:border-neutral-600 dark:bg-neutral-800 dark:text-neutral-200 dark:hover:bg-neutral-700">Previous</a>
                <a href="#"
                    class="relative ml-3 inline-flex items-center rounded-md border border-neutral-300 bg-white px-4 py-2 text-sm font-medium text-neutral-700 hover:bg-neutral-50 dark:border-neutral-600 dark:bg-neutral-800 dark:text-neutral-200 dark:hover:bg-neutral-700">Next</a>
            </div>
            <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-neutral-700 dark:text-neutral-300">
                        Showing <span class="font-medium">1</span> to <span class="font-medium">3</span> of
                        <span class="font-medium">{{ $totalOrders }}</span> results
                    </p>
                </div>
                <div>
                    <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                        <a href="#"
                            class="relative inline-flex items-center rounded-l-md px-2 py-2 text-neutral-400 ring-1 ring-inset ring-neutral-300 hover:bg-neutral-50 focus:z-20 focus:outline-offset-0 dark:ring-neutral-600 dark:hover:bg-neutral-700">
                            <span class="sr-only">Previous</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" aria-current="page"
                            class="relative z-10 inline-flex items-center bg-blue-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">1</a>
                        <a href="#"
                            class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-neutral-900 ring-1 ring-inset ring-neutral-300 hover:bg-neutral-50 focus:z-20 focus:outline-offset-0 dark:text-white dark:ring-neutral-600 dark:hover:bg-neutral-700">2</a>
                        <a href="#"
                            class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-neutral-900 ring-1 ring-inset ring-neutral-300 hover:bg-neutral-50 focus:z-20 focus:outline-offset-0 dark:text-white dark:ring-neutral-600 dark:hover:bg-neutral-700">3</a>
                        <a href="#"
                            class="relative inline-flex items-center rounded-r-md px-2 py-2 text-neutral-400 ring-1 ring-inset ring-neutral-300 hover:bg-neutral-50 focus:z-20 focus:outline-offset-0 dark:ring-neutral-600 dark:hover:bg-neutral-700">
                            <span class="sr-only">Next</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <livewire:modals.create-order />
    <livewire:modals.generate-invoice-modal />
</div>
