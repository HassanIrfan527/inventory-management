<flux:modal name="create-order" class="min-w-[20rem] md:min-w-[50rem] space-y-6">
    <div>
        <flux:heading size="lg">Create New Order</flux:heading>
        <flux:subheading>Fill in the details to create a new customer order.</flux:subheading>
    </div>

    <form wire:submit.prevent="save" class="space-y-6">
        <!-- Customer & Status -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <flux:field>
                <flux:label>Customer</flux:label>
                <flux:dropdown class="w-full">
                    <flux:button class="w-full justify-between" icon="user" variant="outline" right-icon="chevron-down">
                        <span class="truncate">
                            {{ $contact_id ? ($this->contacts->firstWhere('id', $contact_id)->name ?? 'Unknown Customer') : 'Select Customer' }}
                        </span>
                    </flux:button>

                    <flux:menu class="max-h-60 overflow-y-auto w-full max-w-xs md:max-w-sm" anchor="start">
                        @foreach ($this->contacts as $contact)
                            <flux:menu.item wire:click="$set('contact_id', '{{ $contact->id }}')">
                                <span class="truncate block">
                                    {{ $contact->name }}
                                </span>
                            </flux:menu.item>
                        @endforeach
                    </flux:menu>
                </flux:dropdown>
                <flux:error name="contact_id" />
            </flux:field>

            <flux:field>
                <flux:label>Status</flux:label>
                <flux:dropdown class="w-full">
                    @php
                        $statusIcon = match($status) {
                            'Pending' => 'clock',
                            'Processing' => 'arrow-path',
                            'Completed' => 'check-circle',
                            default => 'clock'
                        };
                    @endphp
                    <flux:button class="w-full justify-between" :icon="$statusIcon" variant="outline" right-icon="chevron-down">
                        <span class="truncate">{{ $status }}</span>
                    </flux:button>

                    <flux:menu class="w-full max-w-xs" anchor="start">
                        <flux:menu.item icon="clock" wire:click="$set('status', 'Pending')">Pending</flux:menu.item>
                        <flux:menu.item icon="arrow-path" wire:click="$set('status', 'Processing')">Processing</flux:menu.item>
                        <flux:menu.item icon="check-circle" wire:click="$set('status', 'Completed')">Completed</flux:menu.item>
                    </flux:menu>
                </flux:dropdown>
                <flux:error name="status" />
            </flux:field>
        </div>

        <flux:separator />

        <!-- Order Items -->
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <flux:heading size="base">Order Items</flux:heading>
                <flux:button size="sm" icon="plus" wire:click="addItem">Add Item</flux:button>
            </div>

            <div class="space-y-3">
                @foreach ($items as $index => $item)
                    <div class="grid grid-cols-12 gap-2 items-start" wire:key="item-{{ $index }}">
                        <div class="col-span-12 md:col-span-5">
                            <flux:dropdown class="w-full">
                                <flux:button class="w-full justify-between" icon="tag" variant="outline" right-icon="chevron-down">
                                    <span class="truncate">
                                        {{ $item['product_id'] ? $this->products->firstWhere('id', $item['product_id'])?->name : 'Select Product' }}
                                    </span>
                                </flux:button>

                                <flux:menu class="max-h-60 overflow-y-auto w-full max-w-xs md:max-w-md" anchor="start">
                                    @foreach ($this->products as $product)
                                        <flux:menu.item wire:click="updateItemProduct({{ $index }}, '{{ $product->id }}')">
                                            <span class="truncate block">
                                                {{ $product->name }}
                                            </span>
                                        </flux:menu.item>
                                    @endforeach
                                </flux:menu>
                            </flux:dropdown>
                            <flux:error name="items.{{ $index }}.product_id" />
                        </div>

                        <div class="col-span-4 md:col-span-2">
                            <flux:input type="number" min="1" wire:model.live="items.{{ $index }}.quantity" placeholder="Qty" icon="hashtag" />
                            <flux:error name="items.{{ $index }}.quantity" />
                        </div>

                        <div class="col-span-6 md:col-span-3">
                            <flux:input type="number" min="0" wire:model.live="items.{{ $index }}.price" icon="currency-rupee" placeholder="Price" />
                            <flux:error name="items.{{ $index }}.price" />
                        </div>

                        <div class="col-span-2 md:col-span-2 flex items-center justify-end gap-2 h-10">
                            {{-- Subtotal Display --}}
                            <div class="text-sm font-medium text-neutral-600 dark:text-neutral-400 hidden md:block">
                                Rs. {{ number_format(floatval($item['quantity']) * floatval($item['price']), 0) }}
                            </div>

                            @if(count($items) > 1)
                                <flux:button square variant="subtle" color="red" size="sm" icon="trash" wire:click="removeItem({{ $index }})" />
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <flux:separator variant="subtle" />

        <!-- Totals & Actions -->
        <!-- Totals & Actions -->
        <!-- Address & Totals -->
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Address Card -->
            <div class="w-full md:w-1/2 bg-neutral-50 dark:bg-white/5 rounded-xl p-6 border border-neutral-100 dark:border-white/10 flex flex-col gap-4">
                <flux:heading size="sm">Order Address</flux:heading>
                <flux:textarea wire:model="address" placeholder="Enter delivery address..." rows="4" class="resize-none" />
                <flux:error name="address" />
            </div>

            <!-- Totals Card -->
            <div class="w-full md:w-1/2 bg-neutral-50 dark:bg-white/5 rounded-xl p-6 border border-neutral-100 dark:border-white/10 space-y-4">
                <div class="flex justify-between items-center text-sm">
                    <span class="text-neutral-500 dark:text-neutral-400">Total Amount (Products)</span>
                    <span class="font-medium text-neutral-900 dark:text-white">Rs. {{ number_format($this->itemsTotal, 0) }}</span>
                </div>
                
                <div class="flex justify-between items-center">
                    <span class="text-sm text-neutral-500 dark:text-neutral-400">Delivery Charge</span>
                    <div class="w-24">
                         <flux:input type="number" step="1" wire:model.live="delivery_charge" placeholder="0" size="sm" class="text-right" />
                    </div>
                </div>

                <flux:separator variant="subtle" />

                <div class="flex justify-between items-center">
                    <span class="text-lg font-bold text-neutral-900 dark:text-white">Total</span>
                    <span class="text-xl font-bold text-neutral-900 dark:text-white">
                        Rs. {{ number_format($this->total, 0) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-2">
            <flux:modal.close>
                <flux:button variant="ghost">Cancel</flux:button>
            </flux:modal.close>
            <flux:button type="submit" variant="primary" wire:loading.attr="disabled">Create Order</flux:button>
        </div>
    </form>
</flux:modal>
