<div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    @php
        $breadcrumbItem = [
            [
                'name' => 'Inventory',
                'href' => route('inventory'),
                'icon' => 'box',
            ],
            [
                'name' => 'View Product',
                'href' => route('products.show', $product->id),
                'icon' => 'presentation-chart-line',
            ],
        ];
    @endphp
    <!-- Breadcrumbs -->
    <x-custom-breadcrumb :items="$breadcrumbItem"></x-custom-breadcrumb>

    {{-- Page Header --}}
    <div class="mb-8 mt-4 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
             <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-600 text-white shadow-lg shadow-emerald-500/20">
                <flux:icon.package class="size-7" />
             </div>
             <div>
                <flux:heading size="xl" level="1" class="text-zinc-900 dark:text-white">{{ $product->name }}</flux:heading>
                <div class="flex items-center gap-2 mt-1">
                    <span class="text-[10px] font-black uppercase tracking-widest text-zinc-400">System ID: {{ $product->product_id }}</span>
                    <span class="text-[10px] text-zinc-300">•</span>
                    <span class="text-[10px] font-black uppercase tracking-widest text-zinc-400">SKU: {{ $product->sku ?? 'UNDEFINED' }}</span>
                </div>
             </div>
        </div>
        <div class="flex items-center gap-3">
             @if(!$isEditing)
                <flux:button variant="subtle" icon="pencil" wire:click="enableEdit">Modify Specs</flux:button>
                <flux:modal.trigger name="delete-product-modal">
                    <flux:button variant="subtle" icon="trash" class="text-rose-500 hover:bg-rose-50">Decommission</flux:button>
                </flux:modal.trigger>
             @else
                <flux:button variant="ghost" wire:click="cancelEdit">Cancel Changes</flux:button>
                <flux:button variant="primary" wire:click="save" class="bg-emerald-600 hover:bg-emerald-700">Sync Changes</flux:button>
             @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        {{-- Main Specs --}}
        <div class="lg:col-span-8 space-y-8">
            {{-- Visualization --}}
            <section class="rounded-3xl border border-zinc-200 bg-white overflow-hidden shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <div class="p-6 border-b border-zinc-100 dark:border-zinc-800 flex items-center justify-between">
                     <h3 class="text-xs font-black uppercase tracking-widest text-zinc-500">Visual Identity</h3>
                     @if($isEditing)
                         <input type="file" wire:model="form.new_product_images" multiple class="text-[10px] font-bold text-emerald-600">
                     @endif
                </div>
                <div class="p-8">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @forelse($product->images as $image)
                            <div class="group relative aspect-square overflow-hidden rounded-2xl border border-zinc-100 dark:border-zinc-800">
                                <img src="{{ Storage::url($image->image_path) }}" class="h-full w-full object-cover transition-transform group-hover:scale-110">
                            </div>
                        @empty
                            <div class="col-span-4 flex flex-col items-center justify-center py-12 bg-zinc-50 dark:bg-zinc-950 rounded-2xl border-2 border-dashed border-zinc-200 dark:border-zinc-800">
                                <flux:icon.photo class="size-12 text-zinc-200 mb-2" />
                                <span class="text-xs font-bold text-zinc-400">No high-res assets available</span>
                            </div>
                        @endforelse
                    </div>
                </div>
            </section>

            {{-- Product Intel --}}
            <section class="rounded-3xl border border-zinc-200 bg-white p-8 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                 @if(!$isEditing)
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-xs font-black uppercase tracking-widest text-emerald-600 mb-2">Detailed Specifications</h3>
                            <p class="text-zinc-600 dark:text-zinc-300 leading-relaxed">{{ $product->description }}</p>
                        </div>

                        <div class="flex flex-wrap gap-2">
                             @foreach($product->categories as $cat)
                                <span class="px-3 py-1 rounded-full bg-zinc-100 dark:bg-zinc-800 text-[10px] font-black uppercase tracking-widest text-zinc-600 dark:text-zinc-400">
                                    {{ $cat->name }}
                                </span>
                             @endforeach
                        </div>
                    </div>
                 @else
                    <div class="space-y-6">
                         <flux:field>
                            <flux:label class="text-[10px] font-black uppercase tracking-widest text-zinc-400">Asset Title</flux:label>
                            <flux:input wire:model="form.name" />
                         </flux:field>

                         <flux:field>
                            <flux:label class="text-[10px] font-black uppercase tracking-widest text-zinc-400">Specifications</flux:label>
                            <flux:textarea wire:model="form.description" rows="6" />
                         </flux:field>

                         <flux:field>
                            <flux:label class="text-[10px] font-black uppercase tracking-widest text-zinc-400">Classification</flux:label>
                            <flux:select wire:model="form.categories" multiple searchable>
                                @foreach($categories as $category)
                                    <flux:select.option value="{{ $category->id }}">{{ $category->name }}</flux:select.option>
                                @endforeach
                            </flux:select>
                         </flux:field>
                    </div>
                 @endif
            </section>
        </div>

        {{-- Sidebar Stats --}}
        <div class="lg:col-span-4 space-y-6">
            {{-- Inventory Status --}}
            <div class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                 <h3 class="text-xs font-black uppercase tracking-widest text-zinc-400 mb-6">Inventory Status</h3>

                 <div class="space-y-6">
                    <div class="flex items-center justify-between">
                         <span class="text-xs font-bold text-zinc-500">Stock Level</span>
                         <div class="flex items-center gap-2">
                            @if($product->stock_quantity === null)
                                <span class="text-xl font-black text-emerald-600">∞</span>
                                <span class="px-2 py-0.5 rounded bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase">Persistent</span>
                            @elseif($product->stock_quantity > 0)
                                <span class="text-lg font-black text-zinc-900 dark:text-white">{{ $product->stock_quantity }}</span>
                                <span class="px-2 py-0.5 rounded bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-widest">In Stock</span>
                            @else
                                <span class="text-lg font-black text-rose-500">0</span>
                                <span class="px-2 py-0.5 rounded bg-rose-50 text-rose-600 text-[10px] font-black uppercase tracking-widest">Depleted</span>
                            @endif
                         </div>
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-zinc-50 dark:border-zinc-800">
                         <span class="text-xs font-bold text-zinc-500">Market Status</span>
                         <span @class([
                            'px-3 py-1 rounded-xl text-[10px] font-black uppercase tracking-widest',
                            'bg-emerald-500 text-white' => $product->status === 'active',
                            'bg-zinc-200 text-zinc-600' => $product->status === 'inactive',
                            'bg-amber-100 text-amber-700' => $product->status === 'archived',
                         ])>
                            {{ ucfirst($product->status) }}
                         </span>
                    </div>

                    @if($isEditing)
                         <div class="pt-4 space-y-4">
                            <flux:field>
                                <flux:label class="text-[10px] font-black uppercase tracking-widest text-zinc-400">Update Stock</flux:label>
                                <flux:input type="number" wire:model="form.stock_quantity" placeholder="∞ if empty" />
                            </flux:field>

                            <flux:field>
                                <flux:label class="text-[10px] font-black uppercase tracking-widest text-zinc-400">Change SKU</flux:label>
                                <flux:input wire:model="form.sku" />
                            </flux:field>

                            <flux:field>
                                <flux:label class="text-[10px] font-black uppercase tracking-widest text-zinc-400">Update Status</flux:label>
                                <flux:select wire:model="form.status">
                                    @foreach($statusOptions as $key => $label)
                                        <flux:select.option value="{{ $key }}">{{ $label }}</flux:select.option>
                                    @endforeach
                                </flux:select>
                            </flux:field>
                         </div>
                    @endif
                 </div>
            </div>

            {{-- Financial Performance --}}
            <div class="rounded-3xl border border-zinc-200 bg-zinc-950 p-6 shadow-xl text-white ring-1 ring-white/10 transition-all hover:ring-emerald-500/50">
                <h3 class="text-xs font-black uppercase tracking-widest text-zinc-500 mb-6">Commercial Engine</h3>

                <div class="space-y-5">
                    <div class="flex justify-between items-center">
                        <span class="text-[10px] font-black uppercase tracking-widest text-zinc-400">Retail Value</span>
                        <span class="text-xl font-black">Rs. {{ number_format($product->retail_price, 0) }}</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-[10px] font-black uppercase tracking-widest text-zinc-400">Margin Efficiency</span>
                        <div class="flex items-center gap-2">
                             <div class="h-1.5 w-16 bg-zinc-800 rounded-full overflow-hidden">
                                <div class="h-full bg-emerald-500 rounded-full" style="width: {{ $product->retail_price > 0 ? min(100, (($product->retail_price - $product->purchase_price) / $product->retail_price) * 100) : 0 }}%"></div>
                             </div>
                             <span class="text-xs font-black text-emerald-400">
                                {{ $product->retail_price > 0 ? round((($product->retail_price - $product->purchase_price) / $product->retail_price) * 100, 1) : 0 }}%
                             </span>
                        </div>
                    </div>

                    @if(!$isEditing)
                         <div class="pt-4 grid grid-cols-2 gap-4 border-t border-white/5">
                            <div>
                                <p class="text-[8px] font-black uppercase tracking-widest text-zinc-500">Unit Cost</p>
                                <p class="text-xs font-bold">Rs. {{ number_format($product->purchase_price, 0) }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-[8px] font-black uppercase tracking-widest text-zinc-500">Logistics Fee</p>
                                <p class="text-xs font-bold text-amber-400">Rs. {{ number_format($product->delivery_charges, 0) }}</p>
                            </div>
                         </div>
                    @else
                         <div class="pt-4 space-y-4 border-t border-white/5">
                            <flux:field>
                                <flux:label class="text-[10px] font-black uppercase tracking-widest text-white/50">Unit Cost</flux:label>
                                <flux:input type="number" wire:model="form.cost_price" class="bg-white/5 border-white/10 text-white" leading="Rs." />
                            </flux:field>
                            <flux:field>
                                <flux:label class="text-[10px] font-black uppercase tracking-widest text-white/50">Retail price</flux:label>
                                <flux:input type="number" wire:model="form.retail_price" class="bg-white/5 border-white/10 text-white" leading="Rs." />
                            </flux:field>
                             <flux:field>
                                <flux:label class="text-[10px] font-black uppercase tracking-widest text-white/50">Delivery Charge</flux:label>
                                <flux:input type="number" wire:model="form.delivery_charges" class="bg-white/5 border-white/10 text-white" leading="Rs." />
                            </flux:field>
                         </div>
                    @endif
                </div>
            </div>

            {{-- Internal Strategy --}}
            <div class="rounded-3xl border border-zinc-100 bg-zinc-50 p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-800/50">
                 <h3 class="text-xs font-black uppercase tracking-widest text-zinc-400 mb-4">Strategic Intel</h3>
                 @if(!$isEditing)
                    <p class="text-[10px] font-bold text-zinc-500 dark:text-zinc-400 bg-white dark:bg-zinc-900 p-3 rounded-2xl border border-zinc-100 dark:border-zinc-800 min-h-[4rem]">
                        {{ $product->internal_notes ?? 'No internal tactical notes defined for this asset.' }}
                    </p>
                 @else
                    <flux:textarea wire:model="form.internal_notes" rows="4" placeholder="Operational briefing..." />
                 @endif
            </div>
        </div>
    </div>

    {{-- Decommission Confirmation --}}
    <flux:modal name="delete-product-modal" class="max-w-md">
        <div class="space-y-6">
            <div class="flex items-start gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-rose-50 text-rose-600">
                    <flux:icon.trash class="size-6" />
                </div>
                <div>
                    <h3 class="text-lg font-black uppercase tracking-tight text-zinc-900 dark:text-white">Decommission Asset</h3>
                    <p class="text-xs font-medium text-zinc-500 mt-1">You are about to permanently remove <strong class="text-zinc-900 dark:text-white">{{ $product->name }}</strong> from the operational catalog. This action cannot be reversed.</p>
                </div>
            </div>

            <div class="flex gap-3 justify-end pt-4 border-t border-zinc-100 dark:border-zinc-800">
                <flux:modal.close>
                    <flux:button variant="ghost" class="text-[10px] font-black uppercase tracking-widest">Abort</flux:button>
                </flux:modal.close>
                <flux:button wire:click="deleteProduct" class="bg-rose-500 hover:bg-rose-600 text-white text-[10px] font-black uppercase tracking-widest border-0">Confirm Removal</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
