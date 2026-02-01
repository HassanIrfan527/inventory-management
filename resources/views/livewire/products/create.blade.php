<div class="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    @php
        $breadcrumbItem = [
            [
                'name' => 'Inventory',
                'href' => route('inventory'),
                'icon' => 'box',
            ],
            [
                'name' => 'Initialize Asset',
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
            <flux:heading size="xl" level="1" class="text-emerald-950 dark:text-emerald-50 mb-2">Initialize New
                Asset</flux:heading>
            <flux:text class="text-zinc-500">Generate a professional entry for your product catalog with full ERP
                compliance.</flux:text>
        </div>
        <div class="hidden md:flex gap-3">
            <flux:button variant="subtle" wire:click="cancel">Cancel</flux:button>
            <flux:button variant="primary" wire:click="save" class="bg-emerald-600 hover:bg-emerald-700">Initialize
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
                        <h3 class="text-sm font-black uppercase tracking-widest text-zinc-900 dark:text-white">Essential
                            Identity</h3>
                        <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-tighter">Primary catalog
                            details</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <flux:field>
                        <flux:label class="text-[10px] font-black uppercase tracking-widest text-zinc-400">Product Name
                        </flux:label>
                        <flux:input wire:model="form.name" placeholder="Enter professional product name..." />
                        <flux:error name="form.name" />
                    </flux:field>

                    <flux:field>
                        <flux:label class="text-[10px] font-black uppercase tracking-widest text-zinc-400">Description
                        </flux:label>
                        <flux:textarea wire:model="form.description" rows="4"
                            placeholder="Detailed product specifications..." />
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
                        <h3 class="text-sm font-black uppercase tracking-widest text-zinc-900 dark:text-white">
                            Classification & Media</h3>
                        <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-tighter">Organizational tagging
                            and visuals</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <flux:field>
                        <flux:label class="text-[10px] font-black uppercase tracking-widest text-zinc-400">Operational
                            Categories</flux:label>
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
                        <flux:label class="text-[10px] font-black uppercase tracking-widest text-zinc-400">Visual Assets
                        </flux:label>
                        <div class="mt-2">
                            <input type="file" wire:model="form.product_images" multiple
                                class="block w-full text-sm text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all cursor-pointer">
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
            {{-- Financial Engine --}}
            <section
                class="rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <div class="flex items-center gap-3 mb-6">
                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">
                        <flux:icon.banknote class="size-5" />
                    </div>
                    <div>
                        <h3 class="text-sm font-black uppercase tracking-widest text-zinc-900 dark:text-white">Price
                            Engine</h3>
                        <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-tighter">Profitability metrics
                        </p>
                    </div>
                </div>

                <div class="space-y-4">
                    <flux:field>
                        <flux:label class="text-[10px] font-black uppercase tracking-widest text-zinc-400">Unit Cost
                            (Purchase)</flux:label>
                        <flux:input type="number" wire:model="form.cost_price" placeholder="0.00" leading="Rs." />
                        <flux:error name="form.cost_price" />
                    </flux:field>

                    <flux:field>
                        <flux:label class="text-[10px] font-black uppercase tracking-widest text-zinc-400">Retail Value
                        </flux:label>
                        <flux:input type="number" wire:model="form.retail_price" placeholder="0.00" leading="Rs." />
                        <flux:error name="form.retail_price" />
                    </flux:field>

                    <flux:field>
                        <flux:label class="text-[10px] font-black uppercase tracking-widest text-zinc-400">Delivery
                            Charge (Est.)</flux:label>
                        <flux:input type="number" wire:model="form.delivery_charges" placeholder="0.00"
                            leading="Rs." />
                        <flux:error name="form.delivery_charges" />
                    </flux:field>
                </div>
            </section>

            {{-- ERP Inventory Control --}}
            <section
                class="rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <div class="flex items-center gap-3 mb-6">
                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-zinc-950 text-white dark:bg-zinc-800">
                        <flux:icon.command-line class="size-5" />
                    </div>
                    <div>
                        <h3 class="text-sm font-black uppercase tracking-widest text-zinc-900 dark:text-white">ERP
                            Control</h3>
                        <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-tighter">Stock & SKU management
                        </p>
                    </div>
                </div>

                <div class="space-y-4">
                    <flux:field>
                        <flux:label class="text-[10px] font-black uppercase tracking-widest text-zinc-400">Internal SKU
                        </flux:label>
                        <flux:input wire:model="form.sku" placeholder="TECH-PROD-001" />
                        <flux:error name="form.sku" />
                        <flux:description class="text-[9px] uppercase font-bold text-zinc-400">Unique identifier for
                            internal tracking</flux:description>
                    </flux:field>

                    <flux:field>
                        <flux:label class="text-[10px] font-black uppercase tracking-widest text-zinc-400">Current Stock
                        </flux:label>
                        <flux:input type="number" wire:model="form.stock_quantity"
                            placeholder="Leave empty for infinite" />
                        <flux:error name="form.stock_quantity" />
                        <flux:description class="text-[9px] uppercase font-bold text-zinc-400">Current available
                            quantity in warehouse</flux:description>
                    </flux:field>

                    <flux:field>
                        <flux:label class="text-[10px] font-black uppercase tracking-widest text-zinc-400">Operational
                            Status</flux:label>
                        <flux:select wire:model="form.status">
                            @foreach ($statusOptions as $key => $label)
                                <flux:select.option value="{{ $key }}">{{ $label }}</flux:select.option>
                            @endforeach
                        </flux:select>
                        <flux:error name="form.status" />
                    </flux:field>
                </div>
            </section>

            {{-- Staff Intelligence --}}
            <section
                class="rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <div class="flex items-center gap-3 mb-4">
                    <h3 class="text-sm font-black uppercase tracking-widest text-zinc-900 dark:text-white">Internal
                        Feedback</h3>
                </div>
                <flux:textarea wire:model="form.internal_notes" rows="3"
                    placeholder="Operations only notes..." />
                <flux:error name="form.internal_notes" />
            </section>
        </div>
    </div>

    {{-- Mobile Bottom Bar --}}
    <div class="mt-8 flex md:hidden flex-col gap-3">
        <flux:button variant="primary" wire:click="save" class="bg-emerald-600 w-full">Initialize Product
        </flux:button>
        <flux:button variant="subtle" wire:click="cancel" class="w-full">Cancel</flux:button>
    </div>
</div>
