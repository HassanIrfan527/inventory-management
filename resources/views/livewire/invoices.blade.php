<div class="flex h-full w-full flex-1 flex-col gap-6">
    <!-- Page Header -->
    <div class="flex flex-col gap-2">
        <div class="flex items-center justify-between">
            <div class="flex flex-col gap-1">
                <flux:heading size="xl" level="1">Invoices</flux:heading>
                <flux:text size="sm" class="text-neutral-600 dark:text-neutral-400">
                    View, manage, and download invoices for orders.
                </flux:text>
            </div>
            <div class="flex items-center gap-2">
                <flux:navlist.item icon="newspaper" :href="route('invoices')" class="md:hidden" />
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-4">
        <!-- Total Invoices -->
        <div class="group relative overflow-hidden rounded-xl border border-neutral-200 bg-white p-6 transition-all hover:shadow-md dark:border-neutral-700 dark:bg-neutral-900">
            <div class="flex items-center justify-between">
                <div class="flex flex-col gap-1">
                    <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Total Invoices</p>
                    <p class="text-2xl font-bold text-neutral-900 dark:text-white">{{ $stats['total'] }}</p>
                </div>
                <div class="rounded-lg bg-blue-50 p-3 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400">
                    <flux:icon.newspaper />
                </div>
            </div>
        </div>

        <!-- Revenue -->
        <div class="group relative overflow-hidden rounded-xl border border-neutral-200 bg-white p-6 transition-all hover:shadow-md dark:border-neutral-700 dark:bg-neutral-900">
            <div class="flex items-center justify-between">
                <div class="flex flex-col gap-1">
                    <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Paid Revenue</p>
                    <p class="text-2xl font-bold text-neutral-900 dark:text-white">Rs. {{ number_format($stats['revenue']) }}</p>
                </div>
                <div class="rounded-lg bg-green-50 p-3 text-green-600 dark:bg-green-900/20 dark:text-green-400">
                    <flux:icon.circle-dollar-sign />
                </div>
            </div>
        </div>

        <!-- Pending -->
        <div class="group relative overflow-hidden rounded-xl border border-neutral-200 bg-white p-6 transition-all hover:shadow-md dark:border-neutral-700 dark:bg-neutral-900">
            <div class="flex items-center justify-between">
                <div class="flex flex-col gap-1">
                    <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Pending</p>
                    <p class="text-2xl font-bold text-neutral-900 dark:text-white">{{ $stats['pending'] }}</p>
                </div>
                <div class="rounded-lg bg-yellow-50 p-3 text-yellow-600 dark:bg-yellow-900/20 dark:text-yellow-400">
                    <flux:icon.clock />
                </div>
            </div>
            <div class="absolute inset-x-0 bottom-0 h-1 bg-yellow-500/20"></div>
        </div>

        <!-- Overdue -->
        <div class="group relative overflow-hidden rounded-xl border border-neutral-200 bg-white p-6 transition-all hover:shadow-md dark:border-neutral-700 dark:bg-neutral-900">
            <div class="flex items-center justify-between">
                <div class="flex flex-col gap-1">
                    <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Overdue</p>
                    <p class="text-2xl font-bold text-neutral-900 dark:text-white">{{ $stats['overdue'] }}</p>
                </div>
                <div class="rounded-lg bg-red-50 p-3 text-red-600 dark:bg-red-900/20 dark:text-red-400">
                    <flux:icon.circle-alert />
                </div>
            </div>
            <div class="absolute inset-x-0 bottom-0 h-1 bg-red-500/20"></div>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="flex flex-col gap-4 rounded-xl border border-neutral-200 bg-white shadow-sm dark:border-neutral-700 dark:bg-neutral-900">
        <!-- Table Header / Toolbar -->
        <div class="flex flex-col justify-between gap-4 border-b border-neutral-200 p-5 md:flex-row md:items-center dark:border-neutral-700">
            <h2 class="text-lg font-semibold text-neutral-900 dark:text-white">All Invoices</h2>
            <div class="flex flex-wrap gap-2">
                <div class="w-full sm:w-64">
                    <flux:input
                        wire:model.live.debounce.300ms="search"
                        icon="magnifying-glass"
                        size="sm"
                        placeholder="Search invoices by number, customer, or order..."
                    />
                </div>

                <flux:select
                    wire:model.live="filterType"
                    size="sm"
                    placeholder="All types"
                    class="min-w-[9rem]"
                >
                    <flux:select.option value="">All types</flux:select.option>
                    <flux:select.option value="customer">Customer</flux:select.option>
                    <flux:select.option value="supplier">Supplier</flux:select.option>
                </flux:select>

                <flux:select
                    wire:model.live="filterStatus"
                    size="sm"
                    placeholder="All statuses"
                    class="min-w-[9rem]"
                >
                    <flux:select.option value="">All statuses</flux:select.option>
                    <flux:select.option value="pending">Pending</flux:select.option>
                    <flux:select.option value="paid">Paid</flux:select.option>
                    <flux:select.option value="overdue">Overdue</flux:select.option>
                </flux:select>
            </div>
        </div>

        <!-- Invoices Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700">
                <thead class="bg-neutral-50 dark:bg-neutral-800/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Invoice Number</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Order</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Date</th>
                        <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 bg-white dark:divide-neutral-700 dark:bg-neutral-900">
                    @forelse ($invoices as $invoice)
                        <tr class="group transition-colors hover:bg-neutral-50 dark:hover:bg-neutral-800/50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-neutral-900 dark:text-white">
                                {{ $invoice->invoice_number }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-500 dark:text-neutral-400">
                                @if($invoice->order && $invoice->order->contact)
                                    <div class="flex items-center gap-2">
                                        <div class="flex h-7 w-7 items-center justify-center rounded-full bg-blue-100 text-xs font-bold text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">
                                            {{ substr($invoice->order->contact->name, 0, 1) }}
                                        </div>
                                        <a href="{{ route('contact.show', $invoice->order->contact) }}" class="font-medium text-blue-600 hover:text-blue-700 hover:underline dark:text-blue-400 dark:hover:text-blue-300">
                                            {{ $invoice->order->contact->name }}
                                        </a>
                                    </div>
                                @else
                                    <span class="text-neutral-400 italic">N/A</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-500 dark:text-neutral-400">
                                @if($invoice->order)
                                    <a href="{{ route('orders') }}" class="inline-flex items-center gap-1 font-medium text-neutral-700 hover:text-blue-600 dark:text-neutral-300 dark:hover:text-blue-400">
                                        <flux:icon.handbag class="h-3.5 w-3.5" />
                                        #{{ $invoice->order->order_number }}
                                    </a>
                                @else
                                    <span class="text-neutral-400 italic">N/A</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-neutral-900 dark:text-white">
                                Rs. {{ number_format($invoice->total_amount) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-0.5 text-xs font-medium
                                    {{ $invoice->status === 'paid' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : '' }}
                                    {{ $invoice->status === 'pending' ? 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400' : '' }}
                                    {{ $invoice->status === 'overdue' ? 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' : '' }}
                                ">
                                    <span class="h-1.5 w-1.5 rounded-full {{ $invoice->status === 'paid' ? 'bg-green-500' : ($invoice->status === 'pending' ? 'bg-yellow-500' : 'bg-red-500') }}"></span>
                                    {{ ucfirst($invoice->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-500 dark:text-neutral-400">
                                {{ $invoice->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-2">
                                    <flux:button wire:click="download({{ $invoice->id }})" variant="subtle" size="sm" icon="download" inset="top bottom" />

                                    <flux:modal.trigger name="invoice-preview-{{ $invoice->id }}">
                                        <flux:button variant="subtle" size="sm" icon="eye" inset="top bottom" />
                                    </flux:modal.trigger>
                                </div>

                                <!-- Preview Modal -->
                                <flux:modal name="invoice-preview-{{ $invoice->id }}" variant="flyout" class="sm:max-w-xl">
                                    <div class="space-y-6">
                                        <div class="flex items-center justify-between">
                                            <flux:heading size="lg">Invoice Preview</flux:heading>
                                            <flux:button wire:click="download({{ $invoice->id }})" variant="primary" color="indigo" size="sm" icon="download">
                                                Download PDF
                                            </flux:button>
                                        </div>

                                        <div class="overflow-hidden rounded-xl border border-neutral-200 bg-neutral-50 shadow-inner dark:border-neutral-700 dark:bg-neutral-800/50">
                                            <div class="flex flex-col gap-6 p-6">
                                                <!-- Header -->
                                                <div class="flex flex-col justify-between gap-4 border-b border-neutral-200 pb-6 sm:flex-row dark:border-neutral-700">
                                                    <div>
                                                        <p class="text-[10px] font-bold uppercase tracking-wider text-neutral-400">Invoice To</p>
                                                        <p class="mt-1 text-base font-bold text-neutral-900 dark:text-white">{{ $invoice->order->contact->name ?? 'N/A' }}</p>
                                                        <p class="mt-1 max-w-[200px] text-xs leading-relaxed text-neutral-500">{{ $invoice->order->address ?? 'No address provided' }}</p>
                                                    </div>
                                                    <div class="sm:text-right">
                                                        <p class="text-[10px] font-bold uppercase tracking-wider text-neutral-400">Invoice Details</p>
                                                        <p class="mt-1 text-lg font-black text-blue-600 dark:text-blue-400">{{ $invoice->invoice_number }}</p>
                                                        <p class="mt-1 text-xs text-neutral-500">{{ $invoice->created_at->format('F d, Y') }}</p>
                                                    </div>
                                                </div>

                                                <!-- Items -->
                                                <div class="space-y-4">
                                                    <div class="grid grid-cols-4 border-b border-neutral-200 pb-2 text-[10px] font-bold uppercase tracking-wider text-neutral-400 dark:border-neutral-700">
                                                        <div class="col-span-2">Item</div>
                                                        <div class="text-center">Qty</div>
                                                        <div class="text-right">Total</div>
                                                    </div>

                                                    @foreach ($invoice->order->products as $product)
                                                        <div class="grid grid-cols-4 items-center gap-2">
                                                            <div class="col-span-2">
                                                                <p class="text-sm font-semibold text-neutral-900 dark:text-white">{{ $product->name }}</p>
                                                                <p class="text-xs text-neutral-400">Rs. {{ number_format($product->pivot->sale_price) }}</p>
                                                            </div>
                                                            <div class="text-center text-sm font-medium text-neutral-600 dark:text-neutral-400">{{ $product->pivot->quantity }}</div>
                                                            <div class="text-right text-sm font-bold text-neutral-900 dark:text-white">Rs. {{ number_format($product->pivot->quantity * $product->pivot->sale_price) }}</div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <!-- Summary -->
                                                <div class="mt-4 flex flex-col gap-2 border-t border-neutral-200 pt-6 dark:border-neutral-700">
                                                    @if($invoice->order->delivery_charge > 0)
                                                        <div class="flex justify-between text-xs font-medium">
                                                            <span class="text-neutral-500">Delivery Charge</span>
                                                            <span class="text-neutral-900 dark:text-white">Rs. {{ number_format($invoice->order->delivery_charge) }}</span>
                                                        </div>
                                                    @endif
                                                    <div class="flex items-end justify-between pt-2">
                                                        <span class="text-xs font-bold uppercase tracking-widest text-neutral-400">Total Amount</span>
                                                        <span class="text-2xl font-black text-neutral-900 dark:text-white">Rs. {{ number_format($invoice->total_amount) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Navigation Aids -->
                                        <div class="space-y-3">
                                            <flux:heading size="sm" class="text-neutral-400 uppercase tracking-widest">Linked Resources</flux:heading>
                                            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                                                <a href="{{ route('orders') }}" class="flex items-center gap-3 rounded-xl border border-neutral-200 bg-white p-3 transition-colors hover:bg-neutral-50 dark:border-neutral-700 dark:bg-neutral-900 dark:hover:bg-neutral-800">
                                                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400">
                                                        <flux:icon.handbag class="h-5 w-5" />
                                                    </div>
                                                    <div>
                                                        <p class="text-[10px] font-bold uppercase text-neutral-400">Order</p>
                                                        <p class="text-sm font-bold text-neutral-900 dark:text-white">{{ $invoice->order->order_number }}</p>
                                                        <p class="text-[10px] text-neutral-500">{{ $invoice->order->status }}</p>
                                                    </div>
                                                </a>

                                                <a href="{{ route('contact.show', $invoice->order->contact) }}" class="flex items-center gap-3 rounded-xl border border-neutral-200 bg-white p-3 transition-colors hover:bg-neutral-50 dark:border-neutral-700 dark:bg-neutral-900 dark:hover:bg-neutral-800">
                                                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-purple-50 text-purple-600 dark:bg-purple-900/20 dark:text-purple-400">
                                                        <flux:icon.user class="h-5 w-5" />
                                                    </div>
                                                    <div>
                                                        <p class="text-[10px] font-bold uppercase text-neutral-400">Customer</p>
                                                        <p class="text-sm font-bold text-neutral-900 dark:text-white">{{ $invoice->order->contact->name }}</p>
                                                        <p class="text-[10px] text-neutral-500">{{ $invoice->order->contact->phone }}</p>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </flux:modal>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center justify-center gap-4">
                                    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-neutral-100 p-4 dark:bg-neutral-800">
                                        <flux:icon.newspaper class="h-8 w-8 text-neutral-300" />
                                    </div>
                                    <div class="max-w-[200px]">
                                        <p class="text-lg font-bold text-neutral-900 dark:text-white">No invoices found</p>
                                        <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">We couldn't find any invoices matching your criteria.</p>
                                    </div>
                                    <flux:button wire:click="$set('search', '')" variant="subtle" size="sm">Clear Search</flux:button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="border-t border-neutral-200 px-6 py-4 dark:border-neutral-700">
            {{ $invoices->links() }}
        </div>
    </div>
</div>
