<div class="flex h-full w-full flex-1 flex-col gap-8">
    <!-- Page Header -->
    @php
        $breadcrumbItem = [
            [
                'name' => 'Orders',
                'href' => route('orders'),
                'icon' => 'handbag',
            ],
        ];
    @endphp
    <!-- Breadcrumbs -->
    <x-custom-breadcrumb :items="$breadcrumbItem"></x-custom-breadcrumb>

    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex flex-col gap-1">
            <flux:heading size="xl" level="1" class="text-emerald-950 dark:text-emerald-50">Orders Management
            </flux:heading>
            <flux:text size="sm" class="text-zinc-500 dark:text-zinc-400">
                Oversee customer orders, monitor revenue, and manage fulfillment workflows.
            </flux:text>
        </div>
        <div class="flex items-center gap-3">
            <flux:button variant="primary" href="{{ route('orders.create') }}" icon="plus" wire:navigate
                class="bg-emerald-600 hover:bg-emerald-700 dark:bg-emerald-500 dark:hover:bg-emerald-400 text-white shadow-sm transition-all duration-200">
                Create New Order
            </flux:button>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Total Orders -->
        <div class="group relative overflow-hidden rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm transition-all hover:shadow-md dark:border-zinc-800 dark:bg-zinc-900">
            <div class="absolute -right-2 -top-2 h-16 w-16 rounded-full bg-gradient-to-br from-emerald-500/10 to-teal-500/10 blur-2xl"></div>
            <div class="relative flex items-center justify-between">
                <div class="flex flex-col gap-1">
                    <p class="text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Total Orders</p>
                    <p class="text-3xl font-bold text-zinc-900 dark:text-white mt-1">{{ number_format($this->stats['total_orders']) }}</p>
                </div>
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-900/20 dark:text-emerald-400 ring-4 ring-emerald-50/50 dark:ring-emerald-900/10 transition-transform group-hover:scale-110">
                    <flux:icon.handbag class="h-6 w-6" />
                </div>
            </div>
            <div class="mt-4 flex items-center gap-2 text-sm pt-4 border-t border-emerald-50 dark:border-emerald-900/10">
                <span class="flex items-center gap-1 font-medium text-emerald-600 dark:text-emerald-400 shrink-0 whitespace-nowrap">
                    <flux:icon.arrow-up-right class="h-4 w-4" />
                    All orders
                </span>
            </div>
        </div>

        <!-- Revenue -->
        <div class="group relative overflow-hidden rounded-2xl border border-emerald-100 bg-gradient-to-br from-emerald-600 to-teal-700 p-6 shadow-sm transition-all hover:shadow-lg dark:border-zinc-800">
            <div class="relative">
                <div class="flex items-center justify-between mb-3 text-white">
                    <div class="flex flex-col gap-1">
                        <p class="text-xs font-bold uppercase tracking-wider opacity-80">Total Revenue</p>
                        <p class="text-3xl font-black tracking-tight mt-1">Rs. {{ number_format($this->stats['total_revenue']) }}</p>
                    </div>
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-white/20 text-white backdrop-blur-md ring-4 ring-white/10 transition-transform group-hover:rotate-12 group-hover:scale-110">
                        <flux:icon.circle-dollar-sign class="h-7 w-7" />
                    </div>
                </div>
                <div class="flex items-center gap-2 text-white/70 pt-4 border-t border-white/10 mt-3">
                     <flux:icon.banknotes class="h-4 w-4" />
                     Net sales
                </div>
            </div>
        </div>

        <!-- Pending -->
        <div class="group relative overflow-hidden rounded-2xl border border-amber-100 bg-white p-6 shadow-sm transition-all hover:shadow-md dark:border-amber-900/30 dark:bg-zinc-900">
            <div class="flex items-center justify-between">
                <div class="flex flex-col gap-1">
                    <p class="text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Pending</p>
                    <p class="text-3xl font-bold text-zinc-900 dark:text-white mt-1">{{ number_format($this->stats['pending_orders']) }}</p>
                </div>
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-amber-600 dark:bg-amber-900/20 dark:text-amber-400 ring-4 ring-amber-50/50 dark:ring-amber-900/10 transition-transform group-hover:scale-110">
                    <flux:icon.clock class="h-6 w-6" />
                </div>
            </div>
            <div class="mt-4 flex items-center gap-2 text-sm pt-4 border-t border-amber-50 dark:border-amber-900/10">
                <span class="flex items-center gap-1 font-medium text-amber-600 dark:text-amber-400 shrink-0 whitespace-nowrap">
                    <flux:icon.layers class="h-4 w-4" />
                    Awaiting fulfillment
                </span>
            </div>
        </div>

        <!-- Completed -->
        <div class="group relative overflow-hidden rounded-2xl border border-teal-100 bg-white p-6 shadow-sm transition-all hover:shadow-md dark:border-teal-900/30 dark:bg-zinc-900">
            <div class="flex items-center justify-between">
                <div class="flex flex-col gap-1">
                    <p class="text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Completed</p>
                    <p class="text-3xl font-bold text-zinc-900 dark:text-white mt-1">{{ number_format($this->stats['completed_orders']) }}</p>
                </div>
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-teal-50 text-teal-600 dark:bg-teal-900/20 dark:text-teal-400 ring-4 ring-teal-50/50 dark:ring-teal-900/10 transition-transform group-hover:scale-110">
                    <flux:icon.check-circle class="h-6 w-6" />
                </div>
            </div>
            <div class="mt-4 flex items-center gap-2 text-sm pt-4 border-t border-teal-50 dark:border-teal-900/10">
                <span class="flex items-center gap-1 font-medium text-teal-600 dark:text-teal-400 shrink-0 whitespace-nowrap">
                    <flux:icon.check-circle class="h-4 w-4" />
                    Successfully delivered
                </span>
            </div>
        </div>
    </div>

    <!-- Orders Filter & Table Section -->
    <div
        class="flex flex-col overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-700 dark:bg-zinc-900 transition-all">
        <!-- Toolbar -->
        <div
            class="flex flex-col items-center justify-between gap-4 border-b border-zinc-100 p-6 md:flex-row dark:border-zinc-800">
            <div class="flex items-center gap-4">
                <h2 class="text-lg font-bold text-zinc-900 dark:text-white">Recent Orders</h2>
                <flux:badge color="emerald" size="sm" inset="top bottom">{{ $this->orders->total() }} Total</flux:badge>
            </div>

            <div class="flex w-full flex-col gap-3 sm:flex-row sm:w-auto">
                {{-- Search Bar --}}
                <div class="relative w-full sm:w-80">
                    <flux:input wire:model.live.debounce.300ms="search" icon="magnifying-glass" size="sm"
                        placeholder="Search order #, customer..." class="pl-10" />
                </div>

                {{-- Status Filter --}}
                <div class="w-full sm:w-44">
                    <flux:select wire:model.live="statusFilter" size="sm" placeholder="All Statuses">
                        <flux:select.option value="">All Statuses</flux:select.option>
                        <flux:select.option value="Pending">Pending</flux:select.option>
                        <flux:select.option value="Processing">Processing</flux:select.option>
                        <flux:select.option value="Completed">Completed</flux:select.option>
                        <flux:select.option value="Cancelled">Cancelled</flux:select.option>
                    </flux:select>
                </div>

                <flux:button variant="subtle" size="sm" icon="arrow-path" wire:click="refreshOrders"
                    class="hidden sm:flex" title="Refresh list" />
            </div>
        </div>

        <!-- Professional Table -->
        <div x-data="{ expandedRow: null }" class="relative overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-zinc-50 border-b border-zinc-100 dark:bg-zinc-800/50 dark:border-zinc-800">
                        <th
                            class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                            Order ID</th>
                        <th
                            class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                            Customer Details</th>
                        <th
                            class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 text-center">
                            Payment</th>
                        <th
                            class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 text-center">
                            Status</th>
                        <th
                            class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 text-right">
                            Amount</th>
                        <th
                            class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 text-right">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                    @forelse ($this->orders as $order)
                        <tr class="group transition-all hover:bg-emerald-50/30 dark:hover:bg-emerald-900/10 cursor-pointer"
                            @click="expandedRow = expandedRow === {{ $order->id }} ? null : {{ $order->id }}"
                            :class="{ 'bg-emerald-50/50 dark:bg-emerald-900/20': expandedRow === {{ $order->id }} }">
                            {{-- Order ID --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-6 w-6 items-center justify-center transition-transform duration-200"
                                        :class="{ 'rotate-180': expandedRow === {{ $order->id }} }">
                                        <flux:icon.chevron-down class="h-4 w-4 text-zinc-400" />
                                    </div>
                                    <span
                                        class="font-bold text-zinc-900 dark:text-white">{{ $order->order_number }}</span>
                                </div>
                                <div
                                    class="mt-1 flex items-center gap-1 text-[10px] text-zinc-400 uppercase tracking-tighter ml-9">
                                    <flux:icon.calendar class="h-3 w-3" />
                                    {{ $order->created_at->format('M d, Y') }}
                                </div>
                            </td>

                            {{-- Customer --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    @if ($order->contact)
                                        <div
                                            class="flex h-9 w-9 items-center justify-center rounded-full bg-emerald-100 text-emerald-700 font-bold text-xs ring-2 ring-white dark:bg-emerald-900/50 dark:text-emerald-300 dark:ring-zinc-800 transition-transform group-hover:scale-105">
                                            {{ substr($order->contact->name, 0, 1) }}
                                        </div>
                                        <div class="flex flex-col">
                                            <a href="{{ route('contact.show', $order->contact) }}" wire:click.stop
                                                class="font-semibold text-zinc-900 hover:text-emerald-600 dark:text-zinc-100 dark:hover:text-emerald-400 transition-colors">
                                                {{ $order->contact->name }}
                                            </a>
                                            <span
                                                class="text-xs text-zinc-500">{{ $order->contact->email ?? $order->contact->phone }}</span>
                                        </div>
                                    @else
                                        <div
                                            class="flex h-9 w-9 items-center justify-center rounded-full bg-zinc-100 text-zinc-400 dark:bg-zinc-800">
                                            <flux:icon.user class="h-4 w-4" />
                                        </div>
                                        <span class="text-zinc-400 italic text-sm">Guest Customer</span>
                                    @endif
                                </div>
                            </td>

                            {{-- Payment Status --}}
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @php
                                    $paymentColor = match ($order->payment_status?->value ?? 'unpaid') {
                                        'paid' => 'green',
                                        'partially_paid' => 'yellow',
                                        'refunded' => 'red',
                                        default => 'zinc',
                                    };
                                @endphp
                                <flux:badge :color="$paymentColor" size="sm" class="capitalize">
                                    {{ str_replace('_', ' ', $order->payment_status?->value ?? 'Unpaid') }}
                                </flux:badge>
                            </td>

                            {{-- Order Status --}}
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @php
                                    $statusColor = match ($order->status) {
                                        'Completed' => 'emerald',
                                        'Processing' => 'sky',
                                        'Pending' => 'amber',
                                        'Cancelled' => 'red',
                                        default => 'zinc',
                                    };
                                @endphp
                                <flux:badge :color="$statusColor" variant="solid" size="sm" class="capitalize">
                                    {{ $order->status }}
                                </flux:badge>
                            </td>

                            {{-- Total Amount --}}
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="font-bold text-zinc-900 dark:text-white">Rs.
                                    {{ number_format($order->total_amount, 2) }}</div>
                                @if ($order->source)
                                    <div class="mt-0.5 text-[10px] text-zinc-400 uppercase tracking-widest">
                                        {{ $order->source->value }}</div>
                                @endif
                            </td>

                            {{-- Actions --}}
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="flex items-center justify-end gap-2" @click.stop>
                                    <flux:button icon="eye" variant="ghost" size="sm"
                                        href="{{ route('orders.show', $order) }}" wire:navigate
                                        class="text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400"
                                        title="View Details" />

                                    <flux:button icon="document-text" variant="ghost" size="sm"
                                        wire:click="$dispatch('open-generate-invoice-modal', { orderId: {{ $order->id }} })"
                                        class="text-zinc-400 hover:text-teal-600 dark:hover:text-teal-400"
                                        title="Invoice" />

                                    <flux:dropdown>
                                        <flux:button variant="ghost" icon="ellipsis-vertical" size="sm"
                                            class="text-zinc-400" />
                                        <flux:menu>
                                            <flux:menu.item icon="pencil-square"
                                                href="{{ route('orders.show', $order) }}" wire:navigate>Edit Order
                                            </flux:menu.item>
                                            <flux:menu.item icon="printer">Print Packing Slip</flux:menu.item>
                                            <flux:menu.separator />
                                            <flux:menu.item icon="trash" variant="danger">Archive Order
                                            </flux:menu.item>
                                        </flux:menu>
                                    </flux:dropdown>
                                </div>
                            </td>
                        </tr>

                        {{-- Expanded Row with Item Details --}}
                        <tr x-show="expandedRow === {{ $order->id }}" x-cloak
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="bg-zinc-50/50 dark:bg-zinc-800/30">
                            <td colspan="6" class="px-8 py-6">
                                <div class="flex flex-col gap-6">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <div class="h-2 w-8 rounded-full bg-emerald-500"></div>
                                            <h3
                                                class="text-sm font-bold uppercase tracking-wider text-zinc-900 dark:text-white">
                                                Order Inventory Breakdown</h3>
                                        </div>
                                        <div class="flex items-center gap-4 text-xs font-medium text-zinc-500">
                                            <div class="flex items-center gap-1.5">
                                                <flux:icon.map-pin class="h-3.5 w-3.5" />
                                                <span>{{ $order->address ?? 'No shipping address' }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        class="overflow-hidden rounded-xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-700 dark:bg-zinc-900">
                                        <table class="w-full text-left text-sm">
                                            <thead
                                                class="bg-zinc-50 border-b border-zinc-100 dark:bg-zinc-800 dark:border-zinc-800/50">
                                                <tr>
                                                    <th
                                                        class="px-6 py-3 font-semibold text-zinc-600 dark:text-zinc-400">
                                                        Product SKU / Name</th>
                                                    <th
                                                        class="px-6 py-3 text-right font-semibold text-zinc-600 dark:text-zinc-400">
                                                        Unit Price</th>
                                                    <th
                                                        class="px-6 py-3 text-center font-semibold text-zinc-600 dark:text-zinc-400">
                                                        Qty</th>
                                                    <th
                                                        class="px-6 py-3 text-right font-semibold text-zinc-600 dark:text-zinc-400">
                                                        Tax</th>
                                                    <th
                                                        class="px-6 py-3 text-right font-semibold text-zinc-600 dark:text-zinc-400">
                                                        Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                                                @foreach ($order->products as $product)
                                                    <tr
                                                        class="hover:bg-zinc-50/50 dark:hover:bg-zinc-800/50 transition-colors">
                                                        <td class="px-6 py-3.5">
                                                            <div class="font-bold text-zinc-900 dark:text-zinc-100">
                                                                {{ $product->name }}</div>
                                                            <div
                                                                class="text-[10px] text-zinc-400 font-mono tracking-tight">
                                                                {{ $product->product_id }}</div>
                                                        </td>
                                                        <td
                                                            class="px-6 py-3.5 text-right font-medium text-zinc-600 dark:text-zinc-400">
                                                            Rs. {{ number_format($product->pivot->sale_price, 2) }}
                                                        </td>
                                                        <td class="px-6 py-3.5 text-center">
                                                            <span
                                                                class="inline-flex h-6 w-8 items-center justify-center rounded bg-emerald-50 text-emerald-700 font-bold text-xs dark:bg-emerald-900/30 dark:text-emerald-400">
                                                                {{ $product->pivot->quantity }}
                                                            </span>
                                                        </td>
                                                        <td class="px-6 py-3.5 text-right text-zinc-500 font-medium">
                                                            Rs.
                                                            {{ number_format($product->pivot->tax_amount ?? 0, 2) }}
                                                        </td>
                                                        <td
                                                            class="px-6 py-3.5 text-right font-bold text-zinc-900 dark:text-zinc-100">
                                                            Rs.
                                                            {{ number_format($product->pivot->subtotal ?? $product->pivot->quantity * $product->pivot->sale_price, 2) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot class="bg-emerald-50/20 dark:bg-emerald-900/5">
                                                @if ($order->delivery_charge > 0)
                                                    <tr>
                                                        <td colspan="4"
                                                            class="px-6 py-2 text-right text-xs font-bold uppercase tracking-wider text-zinc-500">
                                                            Delivery Charge</td>
                                                        <td
                                                            class="px-6 py-2 text-right text-sm font-bold text-zinc-900 dark:text-zinc-100">
                                                            Rs. {{ number_format($order->delivery_charge, 2) }}</td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td colspan="4" class="px-6 py-4 text-right">
                                                        <span
                                                            class="text-sm font-bold uppercase tracking-widest text-emerald-600 dark:text-emerald-400">Grand
                                                            Total</span>
                                                    </td>
                                                    <td class="px-6 py-4 text-right">
                                                        <span
                                                            class="text-lg font-black text-emerald-700 dark:text-emerald-400">Rs.
                                                            {{ number_format($order->total_amount, 2) }}</span>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center justify-center gap-4">
                                    <div class="relative">
                                        <div
                                            class="absolute -inset-4 rounded-full bg-emerald-50 blur-xl dark:bg-emerald-900/20">
                                        </div>
                                        <flux:icon.handbag
                                            class="relative h-16 w-16 text-emerald-200 dark:text-emerald-800" />
                                    </div>
                                    <div class="max-w-xs mx-auto">
                                        <h3 class="text-xl font-bold text-zinc-900 dark:text-white">No orders recorded
                                        </h3>
                                        <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">
                                            Start by creating your first order to begin tracking orders and inventory
                                            flow.
                                        </p>
                                    </div>
                                    <flux:button href="{{ route('orders.create') }}" wire:navigate variant="primary"
                                        color="emerald" size="base" class="mt-4">
                                        Create First Order
                                    </flux:button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Professional Pagination -->
        <div class="border-t border-zinc-100 bg-zinc-50/30 px-6 py-4 dark:border-zinc-800 dark:bg-zinc-800/10">
            {{ $this->orders->links() }}
        </div>
    </div>

    <!-- Modals -->
    <livewire:invoices.modals.generate-invoice />
</div>
