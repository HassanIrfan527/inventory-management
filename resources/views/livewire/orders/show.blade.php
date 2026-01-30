<div class="w-full space-y-8">
    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex items-center gap-3">
            <flux:button variant="ghost" icon="arrow-left" wire:navigate href="{{ route('orders') }}" class="!pl-0 md:!pl-3" />
            <div>
                <div class="flex items-center gap-3">
                    <flux:heading size="xl" level="1">Order {{ $order->order_number }}</flux:heading>
                    <flux:badge size="sm" :color="$order->status === 'Completed' ? 'green' : ($order->status === 'Pending' ? 'yellow' : 'blue')">
                        {{ $order->status }}
                    </flux:badge>
                </div>
                <div class="mt-1 flex items-center gap-2 text-sm text-zinc-500 dark:text-zinc-400">
                    <flux:icon.calendar class="h-4 w-4" />
                    <span>{{ $order->created_at->format('M d, Y • h:i A') }}</span>
                    <span>•</span>
                    <flux:icon.user class="h-4 w-4" />
                    @if($order->contact)
                        <a href="{{ route('contact.show', $order->contact) }}" class="hover:text-indigo-600 hover:underline">
                            {{ $order->contact->name }}
                        </a>
                    @else
                        <span>Guest Customer</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="flex items-center gap-2">
            <flux:dropdown>
                <flux:button variant="filled" icon-trailing="chevron-down">Status: {{ $order->status }}</flux:button>
                <flux:menu>
                    <flux:menu.item wire:click="updateStatus('Pending')" icon="clock">Pending</flux:menu.item>
                    <flux:menu.item wire:click="updateStatus('Processing')" icon="arrow-path">Processing</flux:menu.item>
                    <flux:menu.item wire:click="updateStatus('Completed')" icon="check-circle">Completed</flux:menu.item>
                    <flux:menu.separator />
                    <flux:menu.item wire:click="updateStatus('Cancelled')" icon="x-circle" class="text-red-600">Cancelled</flux:menu.item>
                </flux:menu>
            </flux:dropdown>
            
            <flux:button variant="outline" icon="document-text" wire:click="$dispatch('open-generate-invoice-modal', { orderId: {{ $order->id }} })">
                Invoice
            </flux:button>

            <flux:modal.trigger name="delete-order-modal">
                <flux:button variant="danger" icon="trash">Delete</flux:button>
            </flux:modal.trigger>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
        {{-- Left Column: Order Items --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900">
                <div class="flex items-center justify-between border-b border-zinc-200 px-6 py-4 dark:border-zinc-700 bg-zinc-50/50 dark:bg-zinc-800/50">
                    <h3 class="font-medium text-zinc-900 dark:text-zinc-100">Order Items</h3>
                    
                    {{-- Product Search --}}
                    <div class="relative w-64" x-data="{ open: false }">
                        <flux:input 
                            wire:model.live.debounce.300ms="searchProduct" 
                            placeholder="Add product..." 
                            icon="plus"
                            size="sm"
                            @focus="open = true"
                            @blur.debounce.200ms="open = false" 
                        />
                        
                        @if(!empty($searchResults) && count($searchResults) > 0)
                            <div class="absolute right-0 top-full mt-1 w-full z-50 overflow-hidden rounded-lg border border-zinc-200 bg-white shadow-lg dark:border-zinc-700 dark:bg-zinc-800">
                                @foreach($searchResults as $product)
                                    <button 
                                        wire:click="addProduct({{ $product->id }})"
                                        class="flex w-full items-center justify-between px-4 py-2 text-left text-sm hover:bg-zinc-50 dark:hover:bg-zinc-700"
                                    >
                                        <span class="font-medium text-zinc-900 dark:text-zinc-100">{{ $product->name }}</span>
                                        <span class="text-xs text-zinc-500">Rs. {{ number_format($product->sale_price) }}</span>
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-1">
                    @if($order->products->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm">
                                <thead class="border-b border-zinc-200 bg-zinc-50 dark:bg-zinc-800/50 dark:border-zinc-700">
                                    <tr>
                                        <th class="px-6 py-3 font-medium text-zinc-500 dark:text-zinc-400">Product</th>
                                        <th class="px-6 py-3 text-right font-medium text-zinc-500 dark:text-zinc-400">Price</th>
                                        <th class="px-6 py-3 text-center font-medium text-zinc-500 dark:text-zinc-400">Qty</th>
                                        <th class="px-6 py-3 text-right font-medium text-zinc-500 dark:text-zinc-400">Total</th>
                                        <th class="px-6 py-3 text-right font-medium text-zinc-500 dark:text-zinc-400"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                                    @foreach($order->products as $product)
                                        <tr class="group hover:bg-zinc-50 dark:hover:bg-zinc-800/30 transition-colors">
                                            <td class="px-6 py-4">
                                                <div class="font-medium text-zinc-900 dark:text-zinc-100">{{ $product->name }}</div>
                                                <div class="text-xs text-zinc-500">{{ $product->category?->name ?? 'Uncategorized' }}</div>
                                            </td>
                                            <td class="px-6 py-4 text-right text-zinc-600 dark:text-zinc-300">
                                                Rs. {{ number_format($product->pivot->sale_price) }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center justify-center gap-2">
                                                    <button 
                                                        wire:click="decrementQuantity({{ $product->id }})"
                                                        class="flex h-6 w-6 items-center justify-center rounded bg-zinc-100 text-zinc-600 hover:bg-zinc-200 dark:bg-zinc-800 dark:text-zinc-400 dark:hover:bg-zinc-700 transition"
                                                    >
                                                        <flux:icon.minus class="h-3 w-3" />
                                                    </button>
                                                    <span class="w-8 text-center font-medium text-zinc-900 dark:text-zinc-100">{{ $product->pivot->quantity }}</span>
                                                    <button 
                                                        wire:click="incrementQuantity({{ $product->id }})"
                                                        class="flex h-6 w-6 items-center justify-center rounded bg-zinc-100 text-zinc-600 hover:bg-zinc-200 dark:bg-zinc-800 dark:text-zinc-400 dark:hover:bg-zinc-700 transition"
                                                    >
                                                        <flux:icon.plus class="h-3 w-3" />
                                                    </button>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-right font-medium text-zinc-900 dark:text-zinc-100">
                                                Rs. {{ number_format($product->pivot->quantity * $product->pivot->sale_price) }}
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <button 
                                                    wire:click="removeProduct({{ $product->id }})"
                                                    class="text-zinc-400 hover:text-red-600 transition"
                                                    title="Remove item"
                                                >
                                                    <flux:icon.trash class="h-4 w-4" />
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center py-12 text-center text-zinc-500">
                            <flux:icon.shopping-bag class="h-12 w-12 text-zinc-300 dark:text-zinc-600 mb-3" />
                            <p>No items in this order yet.</p>
                            <p class="text-sm">Use the search bar above to add products.</p>
                        </div>
                    @endif
                </div>

                {{-- Totals --}}
                <div class="border-t border-zinc-200 bg-zinc-50 p-6 dark:border-zinc-700 dark:bg-zinc-800/50">
                    <div class="flex flex-col gap-2 sm:ml-auto sm:w-80">
                        <div class="flex justify-between text-sm text-zinc-600 dark:text-zinc-400">
                            <span>Subtotal</span>
                            <span>Rs. {{ number_format($order->total_amount - $order->delivery_charge) }}</span>
                        </div>
                        <div class="flex justify-between text-sm text-zinc-600 dark:text-zinc-400">
                            <span>Delivery Charge</span>
                            <span>Rs. {{ number_format($order->delivery_charge) }}</span>
                        </div>
                        <div class="border-t border-zinc-200 my-2 dark:border-zinc-700"></div>
                        <div class="flex justify-between text-base font-bold text-zinc-900 dark:text-zinc-100">
                            <span>Total</span>
                            <span>Rs. {{ number_format($order->total_amount) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Column: Customer & Details --}}
        <div class="space-y-6">
            {{-- Customer Card --}}
            <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-700 dark:bg-zinc-900">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-semibold text-zinc-900 dark:text-zinc-100">Customer Details</h3>
                    @if($order->contact)
                        <flux:button size="sm" variant="subtle" icon="arrow-up-right" href="{{ route('contact.show', $order->contact) }}" />
                    @endif
                </div>
                
                @if($order->contact)
                    <div class="flex items-start gap-4">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-indigo-100 font-bold text-indigo-600 dark:bg-indigo-900/50 dark:text-indigo-300">
                            {{ substr($order->contact->name, 0, 1) }}
                        </div>
                        <div class="overflow-hidden">
                            <p class="truncate font-medium text-zinc-900 dark:text-zinc-100">{{ $order->contact->name }}</p>
                            <p class="truncate text-sm text-zinc-500 dark:text-zinc-400">{{ $order->contact->email ?? 'No email' }}</p>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ $order->contact->phone }}</p>
                        </div>
                    </div>
                    
                    <div class="mt-6 space-y-3">
                        <div class="flex items-start gap-3">
                            <flux:icon.map-pin class="mt-0.5 h-4 w-4 text-zinc-400" />
                            <div class="text-sm text-zinc-600 dark:text-zinc-300">
                                @if($order->address)
                                    {{ $order->address }}
                                @else
                                    <span class="text-zinc-400 italic">No delivery address provided</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <div class="py-4 text-center">
                        <p class="text-sm text-zinc-500">Walk-in / Guest Customer</p>
                    </div>
                @endif
            </div>

            {{-- Activity / Notes --}}
            <!-- Placeholder for activity log or notes for the order itself -->
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
