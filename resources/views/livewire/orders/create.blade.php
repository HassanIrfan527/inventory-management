<div class="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

    @php
        $breadcrumbItem = [
            [
                'name' => 'Orders',
                'href' => route('orders'),
                'icon' => 'handbag',
            ],
            [
                'name' => 'Create Order',
                'href' => route('orders.create'),
                'icon' => 'circle-plus',
            ],
        ];
    @endphp
    <!-- Breadcrumbs -->
    <x-custom-breadcrumb :items="$breadcrumbItem"></x-custom-breadcrumb>

    {{-- Header / Steps --}}
    <div class="mb-8 mt-4">
        <flux:heading size="xl" level="1" class="text-emerald-950 dark:text-emerald-50 mb-2">Create New Order</flux:heading>
        <div class="flex items-center justify-between">
            <flux:text class="text-zinc-500">Complete the steps to create your order.</flux:text>
            <flux:button variant="subtle" icon="x-mark" href="{{ route('orders') }}" wire:navigate class="md:hidden">Close</flux:button>
        </div>

        <!-- Wizard Steps -->
        <div class="mt-8">
            <div class="relative flex items-center justify-between w-full">
                <div class="absolute left-0 top-1/2 -z-10 h-0.5 w-full -translate-y-1/2 bg-zinc-200 dark:bg-zinc-700"></div>

                <!-- Step 1 -->
                <div class="flex flex-col items-center gap-2 bg-white px-2 dark:bg-zinc-800">
                    <div @class([
                        'flex h-10 w-10 items-center justify-center rounded-full border-2 transition-colors',
                        'border-emerald-500 bg-emerald-500 text-white' => $step >= 1,
                        'border-zinc-300 bg-white text-zinc-400 dark:border-zinc-600 dark:bg-zinc-800' => $step < 1
                    ])>
                        @if($step > 1) <flux:icon.check class="h-5 w-5" /> @else <span class="font-bold">1</span> @endif
                    </div>
                    <span @class(['text-xs font-bold uppercase tracking-wider', 'text-emerald-600 dark:text-emerald-400' => $step >= 1, 'text-zinc-400' => $step < 1])>Customer</span>
                </div>

                <!-- Step 2 -->
                <div class="flex flex-col items-center gap-2 bg-white px-2 dark:bg-zinc-800">
                    <div @class([
                        'flex h-10 w-10 items-center justify-center rounded-full border-2 transition-colors',
                        'border-emerald-500 bg-emerald-500 text-white' => $step >= 2,
                        'border-zinc-300 bg-white text-zinc-400 dark:border-zinc-600 dark:bg-zinc-800' => $step < 2
                    ])>
                        @if($step > 2) <flux:icon.check class="h-5 w-5" /> @else <span class="font-bold">2</span> @endif
                    </div>
                    <span @class(['text-xs font-bold uppercase tracking-wider', 'text-emerald-600 dark:text-emerald-400' => $step >= 2, 'text-zinc-400' => $step < 2])>Items</span>
                </div>

                <!-- Step 3 -->
                <div class="flex flex-col items-center gap-2 bg-white px-2 dark:bg-zinc-800">
                    <div @class([
                        'flex h-10 w-10 items-center justify-center rounded-full border-2 transition-colors',
                        'border-emerald-500 bg-emerald-500 text-white' => $step >= 3,
                        'border-zinc-300 bg-white text-zinc-400 dark:border-zinc-600 dark:bg-zinc-800' => $step < 3
                    ])>
                        <span class="font-bold">3</span>
                    </div>
                    <span @class(['text-xs font-bold uppercase tracking-wider', 'text-emerald-600 dark:text-emerald-400' => $step >= 3, 'text-zinc-400' => $step < 3])>Review</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Content Area --}}
    <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-2xl shadow-sm overflow-hidden">

        {{-- STEP 1: CUSTOMER --}}
        @if($step === 1)
        <div class="p-8 animate-in fade-in slide-in-from-right-4 duration-300">
            <h2 class="text-lg font-bold text-zinc-900 dark:text-white mb-6">Who is this order for?</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div
                    wire:click="setCustomerType('existing')"
                    @class([
                        'cursor-pointer rounded-xl border-2 p-6 transition-all hover:border-emerald-500/50',
                        'border-emerald-500 bg-emerald-50/50 dark:bg-emerald-900/10' => $customer_type === 'existing',
                        'border-zinc-100 bg-white dark:border-zinc-800 dark:bg-zinc-900' => $customer_type !== 'existing'
                    ])
                >
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-emerald-100 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-400">
                            <flux:icon.users class="h-6 w-6" />
                        </div>
                        <div>
                            <h3 class="font-bold text-zinc-900 dark:text-white">Existing Customer</h3>
                            <p class="text-xs text-zinc-500">Select from your contact list</p>
                        </div>
                    </div>
                </div>

                <div
                    wire:click="setCustomerType('new')"
                    @class([
                        'cursor-pointer rounded-xl border-2 p-6 transition-all hover:border-emerald-500/50',
                        'border-emerald-500 bg-emerald-50/50 dark:bg-emerald-900/10' => $customer_type === 'new',
                        'border-zinc-100 bg-white dark:border-zinc-800 dark:bg-zinc-900' => $customer_type !== 'new'
                    ])
                >
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-emerald-100 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-400">
                            <flux:icon.user-plus class="h-6 w-6" />
                        </div>
                        <div>
                            <h3 class="font-bold text-zinc-900 dark:text-white">New Customer</h3>
                            <p class="text-xs text-zinc-500">Create a new profile instantly</p>
                        </div>
                    </div>
                </div>
            </div>

            @if($customer_type === 'existing')
                <div class="max-w-xl">
                    <flux:field>
                        <flux:label>Search & Select Customer</flux:label>
                        <flux:select wire:model="contact_id" placeholder="Start typing name..." searchable>
                            @foreach($this->contacts as $contact)
                                <flux:select.option value="{{ $contact->id }}" wire:click="selectContact({{ $contact->id }})">{{ $contact->name }} ({{ $contact->phone }})</flux:select.option>
                            @endforeach
                        </flux:select>
                        <flux:error name="contact_id" />
                    </flux:field>

                    @if($contact_id)
                        <div class="mt-6 rounded-lg bg-zinc-50 p-4 border border-zinc-100 dark:bg-zinc-800/50 dark:border-zinc-700">
                            <div class="flex items-center gap-3 mb-2">
                                <flux:icon.map-pin class="h-4 w-4 text-emerald-500" />
                                <span class="text-sm font-bold text-zinc-700 dark:text-zinc-300">Delivery Address</span>
                            </div>
                            <flux:textarea wire:model="address" rows="3" placeholder="Verify delivery address..." />
                        </div>
                    @endif
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <flux:input wire:model="new_customer_name" label="Full Name" placeholder="e.g. Jane Doe" />
                    <flux:input wire:model="new_customer_phone" label="Phone Number" placeholder="e.g. 0300 1234567" />
                    <flux:input wire:model="new_customer_email" label="Email Address (Optional)" placeholder="jane@example.com" />
                    <div class="md:col-span-2">
                        <flux:textarea wire:model="new_customer_address" label="Address" placeholder="Full delivery address" />
                    </div>
                </div>
            @endif
        </div>
        @endif

        {{-- STEP 2: ITEMS --}}
        @if($step === 2)
        <div class="p-8 animate-in fade-in slide-in-from-right-4 duration-300">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-bold text-zinc-900 dark:text-white">Add Products</h2>
                <flux:button size="sm" icon="plus" wire:click="addItem" class="text-emerald-600 bg-emerald-50 hover:bg-emerald-100 dark:bg-emerald-900/20 dark:text-emerald-400">Add Line Item</flux:button>
            </div>

            <div class="space-y-4">
                {{-- Header Row --}}
                <div class="hidden md:grid grid-cols-12 gap-4 px-4 py-2 bg-zinc-50 dark:bg-zinc-800/50 rounded-lg text-xs font-bold uppercase tracking-wider text-zinc-500">
                    <div class="col-span-5">Product</div>
                    <div class="col-span-2 text-center">Qty</div>
                    <div class="col-span-3 text-right">Price</div>
                    <div class="col-span-2 text-right">Total</div>
                </div>

                @foreach($items as $index => $item)
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center p-4 rounded-xl border border-zinc-100 dark:border-zinc-700/50 hover:border-emerald-200 dark:hover:border-emerald-900/50 transition-colors">
                        {{-- Product Select --}}
                        <div class="col-span-12 md:col-span-5">
                            <flux:select wire:model="items.{{ $index }}.product_id" searchable placeholder="Select product...">
                                @foreach($this->products as $product)
                            <flux:select.option value="{{ $product->id }}" wire:click="updateItemProduct({{ $index }}, {{ $product->id }})">
                                        {{ $product->name }}
                                    </flux:select.option>
                                @endforeach
                            </flux:select>
                            <flux:error name="items.{{ $index }}.product_id" />
                        </div>

                        {{-- Qty --}}
                        <div class="col-span-6 md:col-span-2">
                             <flux:input type="number" wire:model.live="items.{{ $index }}.quantity" min="1" class="text-center" />
                        </div>

                        {{-- Price --}}
                        <div class="col-span-6 md:col-span-3">
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-zinc-400 text-xs">Rs.</span>
                                <flux:input type="number" wire:model.live="items.{{ $index }}.price" min="0" class="pl-8 text-right" />
                            </div>
                        </div>

                        {{-- Line Total & Remove --}}
                        <div class="col-span-12 md:col-span-2 flex items-center justify-between md:justify-end gap-4">
                            <span class="font-bold text-zinc-900 dark:text-white">
                                Rs. {{ number_format(((float)$item['quantity'] * (float)$item['price']), 2) }}
                            </span>
                            <flux:button icon="trash" variant="ghost" size="sm" class="text-zinc-400 hover:text-red-500" wire:click="removeItem({{ $index }})" />
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 flex justify-end">
                <div class="w-full md:w-80 space-y-3 bg-zinc-50 dark:bg-zinc-800/30 p-6 rounded-xl border border-zinc-100 dark:border-zinc-700">
                    <div class="flex justify-between text-sm">
                        <span class="text-zinc-500">Subtotal</span>
                        <span class="font-bold text-zinc-900 dark:text-white">Rs. {{ number_format($this->subtotal, 2) }}</span>
                    </div>
                    {{-- Future: Tax/Discount inputs could go here --}}
                </div>
            </div>
        </div>
        @endif

        {{-- STEP 3: REVIEW --}}
        @if($step === 3)
        <div class="p-8 animate-in fade-in slide-in-from-right-4 duration-300">
            <h2 class="text-lg font-bold text-zinc-900 dark:text-white mb-6">Final Review & Details</h2>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Logistics Column --}}
                <div class="lg:col-span-2 space-y-6">
                     <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <flux:select wire:model="status" label="Order Status">
                            <flux:select.option value="Pending">Pending</flux:select.option>
                            <flux:select.option value="Processing">Processing</flux:select.option>
                            <flux:select.option value="Completed">Completed</flux:select.option>
                        </flux:select>

                        <flux:select wire:model="payment_status" label="Payment Status">
                            <flux:select.option value="UNPAID">Unpaid</flux:select.option>
                            <flux:select.option value="PARTIALLY_PAID">Partially Paid</flux:select.option>
                            <flux:select.option value="PAID">Paid</flux:select.option>
                        </flux:select>
                     </div>

                     <flux:textarea wire:model="customer_notes" label="Customer Notes" placeholder="Any special instructions needed for this order?" />
                     <flux:textarea wire:model="internal_notes" label="Internal Notes" placeholder="Staff-only notes..." />
                </div>

                {{-- Summary Card --}}
                <div class="lg:col-span-1">
                    <div class="rounded-xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-700 dark:bg-zinc-900 p-6">
                        <h3 class="font-bold text-zinc-900 dark:text-white mb-4">Summary</h3>

                        <div class="space-y-3 text-sm border-b border-zinc-100 dark:border-zinc-800 pb-4 mb-4">
                            <div class="flex justify-between">
                                <span class="text-zinc-500">Items ({{ count($items) }})</span>
                                <span class="font-medium">Rs. {{ number_format($this->subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-zinc-500">Delivery</span>
                                <div class="w-20">
                                    <flux:input type="number" wire:model.live="delivery_charge" size="sm" class="text-right py-0 h-6" />
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-zinc-500">Discount</span>
                                <div class="w-20">
                                    <flux:input type="number" wire:model.live="discount" size="sm" class="text-right py-0 h-6" />
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between items-end">
                            <span class="font-black text-emerald-600 dark:text-emerald-400">TOTAL</span>
                            <span class="text-xl font-black text-zinc-900 dark:text-white">Rs. {{ number_format($this->total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        {{-- Footer / Navigation --}}
        <div class="flex items-center justify-between border-t border-zinc-200 bg-zinc-50 px-8 py-4 dark:border-zinc-700 dark:bg-zinc-800/50">
            <div>
                @if($step > 1)
                    <flux:button variant="ghost" wire:click="previousStep" icon="arrow-left">Back</flux:button>
                @else
                    <flux:button variant="ghost" href="{{ route('orders') }}" wire:navigate>Cancel</flux:button>
                @endif
            </div>

            <div>
                @if($step < 3)
                    <flux:button variant="primary" wire:click="nextStep" class="bg-emerald-600 hover:bg-emerald-700 text-white border-0" icon-trailing="arrow-right">Next Step</flux:button>
                @else
                    <flux:button variant="primary" wire:click="save" class="bg-emerald-600 hover:bg-emerald-700 text-white border-0" icon="check">Create Order</flux:button>
                @endif
            </div>
        </div>
    </div>
</div>
