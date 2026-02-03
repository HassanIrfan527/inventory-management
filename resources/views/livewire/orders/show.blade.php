<div class="w-full space-y-8">
     @php
        $breadcrumbItem = [
            [
                'name' => 'Orders',
                'href' => route('orders'),
                'icon' => 'handbag',
            ],
            [
                'name' => 'View Order',
                'href' => route('orders.show', $order->id),
                'icon' => 'eye',
            ],
        ];
    @endphp
    <!-- Breadcrumbs -->
    <x-custom-breadcrumb :items="$breadcrumbItem"></x-custom-breadcrumb>
    {{-- Header --}}
    <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex items-center gap-4">
            <flux:button variant="subtle" icon="arrow-left" wire:navigate href="{{ route('orders') }}" class="shadow-sm border-zinc-200 dark:border-zinc-700" />
            <div>
                <div class="flex items-center gap-4">
                    <flux:heading size="xl" level="1" class="font-black text-zinc-900 dark:text-white">Order {{ $order->order_number }}</flux:heading>

                    @php
                        $statusColor = match($order->status) {
                            'Completed' => 'emerald',
                            'Processing' => 'teal',
                            'Pending' => 'amber',
                            'Cancelled' => 'red',
                            default => 'zinc'
                        };
                    @endphp
                    <flux:badge size="sm" :color="$statusColor" variant="solid" class="shadow-sm uppercase tracking-widest font-bold">
                        {{ $order->status }}
                    </flux:badge>
                </div>
                <div class="mt-2 flex flex-wrap items-center gap-x-4 gap-y-2 text-xs font-medium text-zinc-500 dark:text-zinc-400">
                    <div class="flex items-center gap-1.5">
                        <flux:icon.calendar class="h-3.5 w-3.5" />
                        <span>{{ $order->created_at->format('M d, Y • h:i A') }}</span>
                    </div>
                    <span class="text-zinc-300 dark:text-zinc-700 hidden sm:inline">•</span>
                    <div class="flex items-center gap-1.5">
                        <flux:icon.globe class="h-3.5 w-3.5" />
                        <span class="uppercase tracking-wider">Source: {{ $order->source?->value ?? 'Manual' }}</span>
                    </div>
                    <span class="text-zinc-300 dark:text-zinc-700 hidden sm:inline">•</span>
                    <div class="flex items-center gap-1.5">
                        <flux:icon.credit-card class="h-3.5 w-3.5" />
                        <span class="uppercase tracking-wider">Payment: {{ str_replace('_', ' ', $order->payment_status?->value ?? 'Unpaid') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <flux:dropdown pill>
                <flux:button variant="filled" color="emerald" icon-trailing="chevron-down" size="sm" class="shadow-md">Change Status</flux:button>
                <flux:menu>
                    <flux:menu.item wire:click="updateStatus('Pending')" icon="clock">Pending</flux:menu.item>
                    <flux:menu.item wire:click="updateStatus('Processing')" icon="arrow-path">Processing</flux:menu.item>
                    <flux:menu.item wire:click="updateStatus('Completed')" icon="check-circle">Completed</flux:menu.item>
                    <flux:menu.separator />
                    <flux:menu.item wire:click="updateStatus('Cancelled')" icon="x-circle" class="text-red-500">Cancelled</flux:menu.item>
                </flux:menu>
            </flux:dropdown>

            <flux:button variant="subtle" icon="printer" size="sm" class="border-zinc-200 dark:border-zinc-700">Print</flux:button>

            <flux:button variant="subtle" icon="document-text" size="sm" wire:click="$dispatch('open-generate-invoice-modal', { orderId: {{ $order->id }} })" class="border-zinc-200 dark:border-zinc-700">
                Generate Invoice
            </flux:button>

            <flux:modal.trigger name="delete-order-modal">
                <flux:button variant="ghost" icon="trash" size="sm" class="text-zinc-400 hover:text-red-500" />
            </flux:modal.trigger>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
        {{-- Left Column: Order Items --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-700 dark:bg-zinc-900 transition-all">
                <div class="flex flex-col gap-4 border-b border-zinc-100 px-6 py-5 sm:flex-row sm:items-center sm:justify-between dark:border-zinc-800 bg-zinc-50/50 dark:bg-zinc-800/30">
                    <div class="flex items-center gap-2">
                        <div class="h-4 w-1 rounded-full bg-emerald-500"></div>
                        <h3 class="font-bold text-zinc-900 dark:text-zinc-100">Order Items</h3>
                    </div>

                    {{-- Product Search --}}
                    <div class="relative w-full sm:w-72" x-data="{ open: false }">
                        <flux:input
                            wire:model.live.debounce.300ms="searchProduct"
                            placeholder="Add product by name..."
                            icon="magnifying-glass"
                            size="sm"
                            class="bg-white/80 dark:bg-zinc-800/80 backdrop-blur-sm pr-10"
                            @focus="open = true"
                            @blur.debounce.200ms="open = false"
                        />
                        <div class="absolute right-3 top-1/2 -translate-y-1/2">
                            <flux:icon.plus class="h-3 w-3 text-zinc-400" />
                        </div>

                        @if(!empty($searchResults) && count($searchResults) > 0)
                            <div class="absolute right-0 top-full mt-2 w-full z-50 overflow-hidden rounded-xl border border-zinc-200 bg-white shadow-xl dark:border-zinc-700 dark:bg-zinc-800 animate-in fade-in slide-in-from-top-1">
                                @foreach($searchResults as $product)
                                    <button
                                        wire:click="addProduct({{ $product->id }})"
                                        class="flex w-full items-center justify-between px-5 py-3 text-left text-sm hover:bg-emerald-50 dark:hover:bg-emerald-900/10 transition-colors"
                                    >
                                        <div class="flex flex-col">
                                            <span class="font-bold text-zinc-900 dark:text-zinc-100">{{ $product->name }}</span>
                                            <span class="text-[10px] uppercase tracking-widest text-zinc-500">{{ $product->product_id }}</span>
                                        </div>
                                        <span class="font-black text-emerald-600 dark:text-emerald-400">Rs. {{ number_format($product->retail_price ?? $product->sale_price) }}</span>
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <div class="relative overflow-x-auto">
                    @if($order->products->count() > 0)
                        <table class="w-full text-left text-sm">
                            <thead>
                                <tr class="border-b border-zinc-100 bg-zinc-50/30 dark:bg-zinc-800/20 dark:border-zinc-800">
                                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-zinc-500 dark:text-zinc-400">Item Details</th>
                                    <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-widest text-zinc-500 dark:text-zinc-400">Unit Price</th>
                                    <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest text-zinc-500 dark:text-zinc-400">Quantity</th>
                                    <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-widest text-zinc-500 dark:text-zinc-400">Subtotal</th>
                                    <th class="px-6 py-4 text-right"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-50 dark:divide-zinc-800">
                                @foreach($order->products as $product)
                                    <tr class="group hover:bg-emerald-50/20 dark:hover:bg-emerald-900/5 transition-colors">
                                        <td class="px-6 py-5">
                                            <div class="flex flex-col">
                                                <span class="font-black text-zinc-900 dark:text-zinc-100">{{ $product->name }}</span>
                                                <div class="mt-1 flex items-center gap-2">
                                                    <span class="text-[10px] font-mono font-medium text-zinc-400 bg-zinc-100 dark:bg-zinc-800 px-1.5 py-0.5 rounded">{{ $product->product_id }}</span>
                                                    <span class="text-[10px] font-bold text-zinc-300 dark:text-zinc-600 uppercase">{{ $product->category?->name ?? 'No Category' }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 text-right font-medium text-zinc-600 dark:text-zinc-300">
                                            Rs. {{ number_format($product->pivot->sale_price, 2) }}
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="flex items-center justify-center gap-3" @click.stop>
                                                <button
                                                    wire:click="decrementQuantity({{ $product->id }})"
                                                    class="flex h-7 w-7 items-center justify-center rounded-lg bg-zinc-100 text-zinc-500 hover:bg-zinc-200 dark:bg-zinc-800 dark:text-zinc-400 dark:hover:bg-zinc-700 transition-all border border-zinc-200 dark:border-zinc-700"
                                                >
                                                    <flux:icon.minus class="h-3.5 w-3.5" />
                                                </button>
                                                <span class="min-w-[24px] text-center font-black text-zinc-900 dark:text-zinc-100">{{ $product->pivot->quantity }}</span>
                                                <button
                                                    wire:click="incrementQuantity({{ $product->id }})"
                                                    class="flex h-7 w-7 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-100 dark:bg-emerald-900/30 dark:text-emerald-400 dark:hover:bg-emerald-900/50 transition-all border border-emerald-100 dark:border-emerald-900/30"
                                                >
                                                    <flux:icon.plus class="h-3.5 w-3.5" />
                                                </button>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 text-right font-black text-zinc-900 dark:text-zinc-100">
                                            Rs. {{ number_format($product->pivot->quantity * $product->pivot->sale_price, 2) }}
                                        </td>
                                        <td class="px-6 py-5 text-right">
                                            <button
                                                wire:click="removeProduct({{ $product->id }})"
                                                class="opacity-0 group-hover:opacity-100 text-zinc-300 hover:text-red-500 transition-all duration-200"
                                                title="Remove item"
                                            >
                                                <flux:icon.trash class="h-4.5 w-4.5" />
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="flex flex-col items-center justify-center py-20 text-center">
                            <div class="h-20 w-20 rounded-full bg-zinc-50 dark:bg-zinc-800 flex items-center justify-center mb-4">
                                <flux:icon.shopping-bag class="h-10 w-10 text-zinc-200 dark:text-zinc-700" />
                            </div>
                            <h4 class="text-lg font-bold text-zinc-900 dark:text-white">No Items Yet</h4>
                            <p class="text-sm text-zinc-500 max-w-xs mx-auto mt-1">Use the search above to add products to this order.</p>
                        </div>
                    @endif
                </div>

                {{-- Summary Footer --}}
                <div class="border-t border-zinc-100 bg-zinc-50/30 p-8 dark:border-zinc-800 dark:bg-zinc-800/20">
                    <div class="flex flex-col gap-4 sm:ml-auto sm:w-80">
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-zinc-500 dark:text-zinc-400 font-medium tracking-wide uppercase text-[10px]">Subtotal</span>
                            <span class="font-bold text-zinc-900 dark:text-zinc-100">Rs. {{ number_format($order->subtotal_amount ?? ($order->total_amount - $order->delivery_charge), 2) }}</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-zinc-500 dark:text-zinc-400 font-medium tracking-wide uppercase text-[10px]">Delivery Fee</span>
                            <span class="font-bold text-zinc-900 dark:text-zinc-100">Rs. {{ number_format($order->delivery_charge, 2) }}</span>
                        </div>
                        @if($order->tax_amount > 0)
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-zinc-500 dark:text-zinc-400 font-medium tracking-wide uppercase text-[10px]">Tax</span>
                                <span class="font-bold text-zinc-900 dark:text-zinc-100">Rs. {{ number_format($order->tax_amount, 2) }}</span>
                            </div>
                        @endif
                        @if($order->discount_amount > 0)
                            <div class="flex justify-between items-center text-sm text-red-500">
                                <span class="font-medium tracking-wide uppercase text-[10px]">Discount</span>
                                <span class="font-bold">- Rs. {{ number_format($order->discount_amount, 2) }}</span>
                            </div>
                        @endif

                        <div class="h-px bg-zinc-200 dark:bg-zinc-700 my-2"></div>

                        <div class="flex justify-between items-end">
                            <span class="text-xs font-black uppercase tracking-widest text-emerald-600 dark:text-emerald-400">Grand Total</span>
                            <div class="flex flex-col items-end">
                                <span class="text-2xl font-black text-emerald-800 dark:text-emerald-400 leading-none">Rs. {{ number_format($order->total_amount, 2) }}</span>
                                <span class="text-[10px] text-zinc-400 mt-1 uppercase font-bold tracking-tighter">Including all charges</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Activity / Internal Notes --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-2xl p-6 shadow-sm">
                    <div class="flex items-center gap-2 mb-4">
                        <flux:icon.chat-bubble-bottom-center-text class="h-4 w-4 text-emerald-500" />
                        <h4 class="text-sm font-bold text-zinc-900 dark:text-white uppercase tracking-wider">Customer Notes</h4>
                    </div>
                    <div class="text-sm text-zinc-600 dark:text-zinc-400 leading-relaxed italic">
                        {{ $order->customer_notes ?? 'No customer instructions provided for this order.' }}
                    </div>
                </div>
                <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-2xl p-6 shadow-sm border-l-4 border-l-amber-400">
                    <div class="flex items-center gap-2 mb-4">
                        <flux:icon.shield-check class="h-4 w-4 text-amber-500" />
                        <h4 class="text-sm font-bold text-zinc-900 dark:text-white uppercase tracking-wider">Internal Notes</h4>
                    </div>
                    <div class="text-sm text-zinc-600 dark:text-zinc-400 leading-relaxed font-medium">
                        {{ $order->internal_notes ?? 'No internal staff notes recorded.' }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Column: Customer & Logistics --}}
        <div class="space-y-6">
            {{-- Customer Card --}}
            <div class="rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-700 dark:bg-zinc-900 overflow-hidden">
                <div class="bg-zinc-50 dark:bg-zinc-800/50 px-6 py-4 border-b border-zinc-100 dark:border-zinc-800 flex items-center justify-between">
                    <span class="text-xs font-black uppercase tracking-widest text-zinc-400">Customer Info</span>
                    @if($order->contact)
                        <flux:button size="xs" variant="ghost" icon="user" href="{{ route('contact.show', $order->contact) }}" class="text-emerald-600" />
                    @endif
                </div>

                <div class="p-6">
                    @if($order->contact)
                        <div class="flex items-start gap-4">
                            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-emerald-100 font-black text-emerald-700 text-xl dark:bg-emerald-900/50 dark:text-emerald-300 shadow-inner">
                                {{ substr($order->contact->name, 0, 1) }}
                            </div>
                            <div class="overflow-hidden">
                                <p class="truncate text-lg font-black text-zinc-900 dark:text-zinc-100">{{ $order->contact->name }}</p>
                                <p class="truncate text-xs font-semibold text-emerald-600 dark:text-emerald-400">{{ $order->contact->email ?? 'no-email-provided' }}</p>
                                <p class="mt-2 text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ $order->contact->phone }}</p>
                            </div>
                        </div>

                        <div class="mt-8 space-y-4">
                            <div class="group flex items-start gap-3">
                                <div class="mt-0.5 h-8 w-8 flex items-center justify-center rounded-lg bg-zinc-50 dark:bg-zinc-800 border border-zinc-100 dark:border-zinc-700">
                                    <flux:icon.map-pin class="h-4 w-4 text-zinc-400 group-hover:text-emerald-500 transition-colors" />
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[10px] font-black uppercase tracking-tighter text-zinc-400">Shipping Address</span>
                                    <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300 leading-snug">
                                        {{ $order->address ?? 'No address set' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="py-6 text-center">
                            <div class="h-16 w-16 mx-auto rounded-full bg-zinc-50 dark:bg-zinc-800 flex items-center justify-center mb-4">
                                <flux:icon.user-plus class="h-8 w-8 text-zinc-200" />
                            </div>
                            <h4 class="font-bold text-zinc-900 dark:text-white">Walk-in Customer</h4>
                            <p class="text-xs text-zinc-500 mt-1">No customer profile linked</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Logistics / Tracking Card --}}
            <div class="rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-700 dark:bg-zinc-900 overflow-hidden">
                <div class="bg-zinc-50 dark:bg-zinc-800/50 px-6 py-4 border-b border-zinc-100 dark:border-zinc-800 flex items-center justify-between">
                    <span class="text-xs font-black uppercase tracking-widest text-zinc-400">Shipping</span>
                    <flux:icon.truck class="h-4 w-4 text-zinc-300" />
                </div>

                <div class="p-6 space-y-5">
                    <div class="flex flex-col gap-1">
                        <span class="text-[10px] font-black uppercase tracking-tighter text-zinc-400">Shipping Method</span>
                        <div class="flex items-center gap-2">
                             <flux:badge size="sm" color="zinc" variant="subtle" class="font-bold capitalize">{{ $order->shipping_method ?? 'Not Set' }}</flux:badge>
                        </div>
                    </div>

                    <div class="flex flex-col gap-1">
                        <span class="text-[10px] font-black uppercase tracking-tighter text-zinc-400">Tracking Number</span>
                        <div class="font-mono text-xs font-bold text-zinc-700 dark:text-zinc-300 bg-zinc-100 dark:bg-zinc-800 w-fit px-2 py-1 rounded">
                            {{ $order->tracking_number ?? 'Not available' }}
                        </div>
                    </div>

                    <div class="h-px bg-zinc-100 dark:bg-zinc-800"></div>

                    <div class="space-y-3">
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-zinc-500">Shipped At:</span>
                            <span class="font-bold text-zinc-900 dark:text-zinc-100">{{ $order->shipped_at ? $order->shipped_at->format('M d, Y') : '---' }}</span>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-zinc-500">Delivered At:</span>
                            <span class="font-bold text-zinc-900 dark:text-zinc-100">{{ $order->delivered_at ? $order->delivered_at->format('M d, Y') : '---' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Professional Footer Actions --}}
            <div class="flex flex-col gap-3">
                <flux:button variant="outline" icon="share" class="w-full text-zinc-500 hover:text-emerald-600 transition-colors">Share Tracking Link</flux:button>
                <flux:button variant="outline" icon="envelope" class="w-full text-zinc-500 hover:text-emerald-600 transition-colors">Email Invoice</flux:button>
            </div>
        </div>
    </div>

    {{-- Modals --}}
    <x-modals.delete-modal
        :itemId="$order->id"
        :itemName="$order->order_number"
        title="Delete Order"
        message="Are you sure you want to delete this order? This action cannot be undone."
        wire:confirm="deleteOrder"
    />

    <livewire:invoices.modals.generate-invoice />
</div>
