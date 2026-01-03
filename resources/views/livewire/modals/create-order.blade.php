<flux:modal name="create-order" class="min-w-[20rem] md:min-w-[50rem] space-y-6">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Create New Order</flux:heading>
            <flux:subheading>Step {{ $step }} of 3: {{ match($step) { 1 => 'Customer Information', 2 => 'Order Information', 3 => 'Invoice Generation' } }}</flux:subheading>
        </div>

        <!-- Step Indicator -->
        <div class="relative flex items-center justify-between">
            <div class="absolute top-1/2 left-0 w-full h-0.5 bg-neutral-100 dark:bg-white/5 -translate-y-1/2 -z-0"></div>
            
            @foreach([
                1 => ['label' => 'Customer', 'icon' => 'user'],
                2 => ['label' => 'Order Info', 'icon' => 'shopping-cart'],
                3 => ['label' => 'Invoice', 'icon' => 'document-text']
            ] as $i => $data)
                <div class="relative z-10 flex flex-col items-center gap-2">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center transition-all duration-300 border-2 {{ $step === $i ? 'bg-primary-500 border-primary-500 text-white shadow-lg shadow-primary-500/20 scale-110' : ($step > $i ? 'bg-white dark:bg-neutral-900 border-primary-500 text-primary-500 shadow-sm' : 'bg-white dark:bg-neutral-900 border-neutral-200 dark:border-white/10 text-neutral-400') }}">
                        @if ($step > $i)
                            <flux:icon name="check" variant="outline" size="sm" />
                        @else
                            <span class="text-sm font-bold">{{ $i }}</span>
                        @endif
                    </div>
                    <span class="text-xs font-semibold tracking-wide transition-colors {{ $step >= $i ? 'text-primary-600 dark:text-primary-400' : 'text-neutral-400 dark:text-neutral-500' }}">
                        {{ $data['label'] }}
                    </span>
                </div>
            @endforeach

            <!-- Active Line Overlay -->
            <div class="absolute top-1/2 left-0 h-0.5 bg-primary-500 -translate-y-1/2 transition-all duration-500 ease-in-out -z-0" 
                 style="width: {{ ($step - 1) / 2 * 100 }}%"></div>
        </div>
    </div>

    <form wire:submit.prevent="save" class="space-y-6">
        @if ($step === 1)
            <!-- Step 1: Customer Information -->
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <button type="button" wire:click="$set('customer_selection_type', 'existing')" class="p-4 rounded-xl border-2 transition-all text-left space-y-1 {{ $customer_selection_type === 'existing' ? 'border-primary-500 bg-primary-50/50 dark:bg-primary-950/20' : 'border-neutral-100 dark:border-white/10 hover:border-neutral-200 dark:hover:border-white/20' }}">
                        <flux:heading size="sm" class="flex items-center gap-2">
                            <flux:icon name="users" variant="outline" size="sm" />
                            Existing Customer
                        </flux:heading>
                        <flux:text size="sm">Select from your current contact list.</flux:text>
                    </button>

                    <button type="button" wire:click="$set('customer_selection_type', 'new')" class="p-4 rounded-xl border-2 transition-all text-left space-y-1 {{ $customer_selection_type === 'new' ? 'border-primary-500 bg-primary-50/50 dark:bg-primary-950/20' : 'border-neutral-100 dark:border-white/10 hover:border-neutral-200 dark:hover:border-white/20' }}">
                        <flux:heading size="sm" class="flex items-center gap-2">
                            <flux:icon name="user-plus" variant="outline" size="sm" />
                            New Customer
                        </flux:heading>
                        <flux:text size="sm">Create a new contact for this order.</flux:text>
                    </button>
                </div>

                @if ($customer_selection_type === 'existing')
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
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <flux:input wire:model="new_customer_name" label="Full Name" placeholder="e.g. John Doe" icon="user" />
                        <flux:input wire:model="new_customer_email" label="Email Address" placeholder="john@example.com" icon="envelope" />
                        <flux:input wire:model="new_customer_phone" label="Phone Number" placeholder="0300-1234567" icon="phone" />
                        <flux:input wire:model="new_customer_address" label="Address" placeholder="Enter customer address..." icon="map-pin" />
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <flux:error name="new_customer_name" />
                        <flux:error name="new_customer_email" />
                        <flux:error name="new_customer_phone" />
                        <flux:error name="new_customer_address" />
                    </div>
                @endif
            </div>
        @endif

        @if ($step === 2)
            <!-- Step 2: Order Information (Reused UI) -->
            <div class="space-y-6">
                <!-- Status -->
                <flux:field>
                    <flux:label>Order Status</flux:label>
                    <flux:dropdown class="w-full md:w-1/2">
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

                <!-- Address & Totals -->
                <div class="flex flex-col md:flex-row gap-6">
                    <div class="w-full md:w-1/2 bg-neutral-50 dark:bg-white/5 rounded-xl p-6 border border-neutral-100 dark:border-white/10 flex flex-col gap-4">
                        <flux:heading size="sm">Order Address</flux:heading>
                        <flux:textarea wire:model="address" placeholder="Enter delivery address..." rows="4" class="resize-none" />
                        <flux:error name="address" />
                    </div>

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
            </div>
        @endif

        @if ($step === 3)
            <!-- Step 3: Invoice Generation -->
            <div class="space-y-6">
                <div class="p-6 bg-neutral-50 dark:bg-white/5 rounded-xl border border-neutral-100 dark:border-white/10 space-y-4">
                    <div class="flex items-center gap-3">
                        <flux:checkbox wire:model.live="generate_invoice" label="Generate invoice immediately?" />
                    </div>

                    @if ($generate_invoice)
                        <div class="pt-4 border-t border-neutral-100 dark:border-white/10 space-y-4">
                            <flux:label>Select Invoice Template</flux:label>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <button type="button" wire:click="$set('invoice_template', 'simple')" class="p-4 rounded-xl border-2 transition-all text-left space-y-1 {{ $invoice_template === 'simple' ? 'border-primary-500 bg-primary-50/50 dark:bg-primary-950/20' : 'border-neutral-100 dark:border-white/10 hover:border-neutral-200 dark:hover:border-white/20' }}">
                                    <flux:heading size="sm">Simple Template</flux:heading>
                                    <flux:text size="sm">A clean, straightforward layout focused on the essentials.</flux:text>
                                </button>

                                <button type="button" wire:click="$set('invoice_template', 'modern')" class="p-4 rounded-xl border-2 transition-all text-left space-y-1 {{ $invoice_template === 'modern' ? 'border-primary-500 bg-primary-50/50 dark:bg-primary-950/20' : 'border-neutral-100 dark:border-white/10 hover:border-neutral-200 dark:hover:border-white/20' }}">
                                    <flux:heading size="sm">Modern Template</flux:heading>
                                    <flux:text size="sm">A stylish, premium design with more visual elements.</flux:text>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Order Summary Preview -->
                <div class="p-6 bg-primary-50/30 dark:bg-primary-950/10 rounded-xl border border-primary-100/50 dark:border-primary-500/10 space-y-3">
                    <flux:heading size="sm">Order Summary</flux:heading>
                    <div class="flex justify-between text-sm">
                        <span class="text-neutral-500">Customer:</span>
                        <span class="font-medium">
                            @if($customer_selection_type === 'existing')
                                {{ $this->contacts->firstWhere('id', $contact_id)->name ?? 'None' }}
                            @else
                                {{ $new_customer_name ?: 'New Customer' }}
                            @endif
                        </span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-neutral-500">Items:</span>
                        <span class="font-medium">{{ count($items) }} Items</span>
                    </div>
                    <div class="flex justify-between text-sm pt-2 border-t border-primary-100 dark:border-primary-500/20">
                        <span class="font-bold text-neutral-900 dark:text-white">Final Amount:</span>
                        <span class="font-bold text-primary-600 dark:text-primary-400">Rs. {{ number_format($this->total, 0) }}</span>
                    </div>
                </div>
            </div>
        @endif

        <div class="flex items-center justify-between gap-2 border-t border-neutral-100 dark:border-white/10 pt-6">
            <div>
                @if ($step > 1)
                    <flux:button variant="ghost" wire:click="previousStep" icon="chevron-left">Back</flux:button>
                @endif
            </div>

            <div class="flex gap-2">
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>

                @if ($step < 3)
                    <flux:button variant="primary" wire:click="nextStep" right-icon="chevron-right">Next</flux:button>
                @else
                    <flux:button type="submit" variant="primary" wire:loading.attr="disabled">Create Order</flux:button>
                @endif
            </div>
        </div>
    </form>
</flux:modal>
