<div class="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    @php
        $breadcrumbItem = [
            [
                'name' => 'Products',
                'href' => route('inventory'),
                'icon' => 'box',
            ],
            [
                'name' => 'Add Product',
                'href' => route('products.create'),
                'icon' => 'plus',
            ],
        ];
    @endphp
    <!-- Breadcrumbs -->
    <x-custom-breadcrumb :items="$breadcrumbItem"></x-custom-breadcrumb>

    {{-- Page Header --}}
    <div class="mb-8 mt-4 flex items-center justify-between">
        <div>
            <flux:heading size="xl" level="1" class="text-emerald-950 dark:text-emerald-50 mb-2">Add New
                Product</flux:heading>
            <flux:text class="text-zinc-500">Add a new product to your inventory.</flux:text>
        </div>
        <div class="hidden md:flex gap-3">
            <flux:button variant="subtle" wire:click="cancel">Cancel</flux:button>
            <flux:button variant="primary" wire:click="save" class="bg-emerald-600 hover:bg-emerald-700">Save
                Product</flux:button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Left Column: Forms --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Essential Information --}}
            <section
                class="rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <div class="flex items-center gap-3 mb-6">
                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-400">
                        <flux:icon.identification class="size-5" />
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-zinc-900 dark:text-white">Basic Information</h3>
                        <p class="text-xs text-zinc-400">Product details</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <flux:field>
                        <flux:label>Product Name</flux:label>
                        <flux:input wire:model="form.name" placeholder="Product name" />
                        <flux:error name="form.name" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Description</flux:label>
                        <flux:textarea wire:model="form.description" rows="4"
                            placeholder="Product description..." />
                        <flux:error name="form.description" />
                    </flux:field>
                </div>
            </section>

            {{-- Category & Media --}}
            <section
                class="rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <div class="flex items-center gap-3 mb-6">
                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-zinc-50 text-zinc-600 dark:bg-zinc-800 dark:text-zinc-400">
                        <flux:icon.tag class="size-5" />
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-zinc-900 dark:text-white">
                            Category & Images</h3>
                        <p class="text-xs text-zinc-400">Organize and add photos</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <flux:field>
                        <flux:label>Categories</flux:label>
                        <flux:select wire:model="form.categories" multiple searchable
                            placeholder="Select categories...">
                            @foreach ($categories as $category)
                                <flux:select.option value="{{ $category->id }}">{{ $category->name }}
                                </flux:select.option>
                            @endforeach
                        </flux:select>
                        <flux:error name="form.categories" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Product Images</flux:label>
                        <div class="mt-2">
                            <input type="file" wire:model="form.product_images" multiple
                                class="block w-full text-sm text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-medium file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all cursor-pointer">
                        </div>
                        <flux:error name="form.product_images" />

                        {{-- Previews --}}
                        @if ($form->product_images)
                            <div class="mt-4 grid grid-cols-4 gap-4">
                                @foreach ($form->product_images as $image)
                                    <div
                                        class="relative aspect-square overflow-hidden rounded-xl border border-zinc-100 dark:border-zinc-800">
                                        <img src="{{ $image->temporaryUrl() }}" class="h-full w-full object-cover">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </flux:field>
                </div>
            </section>
        </div>

        {{-- Right Column: Pricing & Logistics --}}
        <div class="space-y-6">
            {{-- Pricing --}}
            <section
                class="rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <div class="flex items-center gap-3 mb-6">
                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-400">
                        <flux:icon.banknote class="size-5" />
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-zinc-900 dark:text-white">Pricing</h3>
                        <p class="text-xs text-zinc-400">Set your prices</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <flux:field>
                        <flux:label>Cost Price</flux:label>
                        <flux:input type="number" wire:model="form.cost_price" placeholder="0.00" leading="Rs." />
                        <flux:error name="form.cost_price" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Selling Price</flux:label>
                        <flux:input type="number" wire:model="form.retail_price" placeholder="0.00" leading="Rs." />
                        <flux:error name="form.retail_price" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Delivery Charge</flux:label>
                        <flux:input type="number" wire:model="form.delivery_charges" placeholder="0.00"
                            leading="Rs." />
                        <flux:error name="form.delivery_charges" />
                    </flux:field>
                </div>
            </section>

            {{-- Inventory --}}
            <section
                class="rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <div class="flex items-center gap-3 mb-6">
                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-zinc-100 text-zinc-600 dark:bg-zinc-800 dark:text-zinc-400">
                        <flux:icon.box class="size-5" />
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-zinc-900 dark:text-white">Inventory</h3>
                        <p class="text-xs text-zinc-400">Stock and tracking</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <flux:field>
                        <flux:label>SKU</flux:label>
                        <flux:input wire:model="form.sku" placeholder="e.g. PROD-001" />
                        <flux:error name="form.sku" />
                        <flux:description>Unique product code</flux:description>
                    </flux:field>

                    <flux:field>
                        <flux:label>Stock Quantity</flux:label>
                        <flux:input type="number" wire:model="form.stock_quantity"
                            placeholder="Leave empty for unlimited" />
                        <flux:error name="form.stock_quantity" />
                        <flux:description>Available quantity</flux:description>
                    </flux:field>

                    <flux:field>
                        <flux:label>Status</flux:label>
                        <flux:select wire:model="form.status">
                            @foreach ($statusOptions as $key => $label)
                                <flux:select.option value="{{ $key }}">{{ $label }}</flux:select.option>
                            @endforeach
                        </flux:select>
                        <flux:error name="form.status" />
                    </flux:field>
                </div>
            </section>

            {{-- Internal Notes --}}
            <section
                class="rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <div class="flex items-center gap-3 mb-4">
                    <h3 class="text-sm font-bold text-zinc-900 dark:text-white">Internal Notes</h3>
                </div>
                <flux:textarea wire:model="form.internal_notes" rows="3"
                    placeholder="Notes for your team..." />
                <flux:error name="form.internal_notes" />
            </section>
        </div>
    </div>

    {{-- Mobile Bottom Bar --}}
    <div class="mt-8 flex md:hidden flex-col gap-3">
        <flux:button variant="primary" wire:click="save" class="bg-emerald-600 w-full">Save Product
        </flux:button>
        <flux:button variant="subtle" wire:click="cancel" class="w-full">Cancel</flux:button>
    </div>
</div>
