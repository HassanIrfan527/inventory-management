<div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    @php
        $breadcrumbItem = [
            [
                'name' => 'Products',
                'href' => route('inventory'),
                'icon' => 'box',
            ],
            [
                'name' => 'Product Details',
                'href' => route('products.show', $product->id),
                'icon' => 'eye',
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
                    <span class="text-xs text-zinc-400">ID: {{ $product->product_id }}</span>
                    <span class="text-xs text-zinc-300">•</span>
                    <span class="text-xs text-zinc-400">SKU: {{ $product->sku ?? 'Not set' }}</span>
                </div>
             </div>
        </div>
        <div class="flex items-center gap-3">
             @if(!$isEditing)
                <flux:button variant="subtle" icon="pencil" wire:click="enableEdit">Edit</flux:button>
                <flux:modal.trigger name="delete-product-modal">
                    <flux:button variant="subtle" icon="trash" class="text-rose-500 hover:bg-rose-50">Delete</flux:button>
                </flux:modal.trigger>
             @else
                <flux:button variant="ghost" wire:click="cancelEdit">Cancel</flux:button>
                <flux:button variant="primary" wire:click="save" class="bg-emerald-600 hover:bg-emerald-700">Save Changes</flux:button>
             @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        {{-- Main Specs --}}
        <div class="lg:col-span-8 space-y-8">
            {{-- Images --}}
            <section class="rounded-3xl border border-zinc-200 bg-white overflow-hidden shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <div class="p-6 border-b border-zinc-100 dark:border-zinc-800 flex items-center justify-between">
                     <h3 class="text-sm font-bold text-zinc-700 dark:text-zinc-300">Images</h3>
                     @if($isEditing)
                         <input type="file" wire:model="form.new_product_images" multiple class="text-sm text-emerald-600">
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
                                <span class="text-sm text-zinc-400">No images</span>
                            </div>
                        @endforelse
                    </div>
                </div>
            </section>

            {{-- Product Details --}}
            <section class="rounded-3xl border border-zinc-200 bg-white p-8 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                 @if(!$isEditing)
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-sm font-bold text-emerald-600 mb-2">Description</h3>
                            <p class="text-zinc-600 dark:text-zinc-300 leading-relaxed">{{ $product->description }}</p>
                        </div>

                        <div class="flex flex-wrap gap-2">
                             @foreach($product->categories as $cat)
                                <span class="px-3 py-1 rounded-full bg-zinc-100 dark:bg-zinc-800 text-xs font-medium text-zinc-600 dark:text-zinc-400">
                                    {{ $cat->name }}
                                </span>
                             @endforeach
                        </div>
                    </div>
                 @else
                    <div class="space-y-6">
                         <flux:field>
                            <flux:label>Product Name</flux:label>
                            <flux:input wire:model="form.name" />
                         </flux:field>

                         <flux:field>
                            <flux:label>Description</flux:label>
                            <flux:textarea wire:model="form.description" rows="6" />
                         </flux:field>

                         <flux:field>
                            <flux:label>Categories</flux:label>
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
            {{-- Stock Status --}}
            <div class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                 <h3 class="text-sm font-bold text-zinc-700 dark:text-zinc-300 mb-6">Stock Status</h3>

                 <div class="space-y-6">
                    <div class="flex items-center justify-between">
                         <span class="text-sm text-zinc-500">Stock</span>
                         <div class="flex items-center gap-2">
                            @if($product->stock_quantity === null)
                                <span class="text-xl font-black text-emerald-600">∞</span>
                                <span class="px-2 py-0.5 rounded bg-emerald-50 text-emerald-600 text-xs font-medium">Unlimited</span>
                            @elseif($product->stock_quantity > 0)
                                <span class="text-lg font-bold text-zinc-900 dark:text-white">{{ $product->stock_quantity }}</span>
                                <span class="px-2 py-0.5 rounded bg-emerald-50 text-emerald-600 text-xs font-medium">In Stock</span>
                            @else
                                <span class="text-lg font-bold text-rose-500">0</span>
                                <span class="px-2 py-0.5 rounded bg-rose-50 text-rose-600 text-xs font-medium">Out of Stock</span>
                            @endif
                         </div>
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-zinc-50 dark:border-zinc-800">
                         <span class="text-sm text-zinc-500">Status</span>
                         <span @class([
                            'px-3 py-1 rounded-xl text-xs font-medium',
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
                                <flux:label>Stock Quantity</flux:label>
                                <flux:input type="number" wire:model="form.stock_quantity" placeholder="Leave empty for unlimited" />
                            </flux:field>

                            <flux:field>
                                <flux:label>SKU</flux:label>
                                <flux:input wire:model="form.sku" />
                            </flux:field>

                            <flux:field>
                                <flux:label>Status</flux:label>
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

            {{-- Pricing --}}
            <div class="rounded-3xl border border-zinc-200 bg-zinc-950 p-6 shadow-xl text-white ring-1 ring-white/10 transition-all hover:ring-emerald-500/50">
                <h3 class="text-sm font-bold text-zinc-400 mb-6">Pricing</h3>

                <div class="space-y-5">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-zinc-400">Selling Price</span>
                        <span class="text-xl font-bold">Rs. {{ number_format($product->retail_price, 0) }}</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-sm text-zinc-400">Profit Margin</span>
                        <div class="flex items-center gap-2">
                             <div class="h-1.5 w-16 bg-zinc-800 rounded-full overflow-hidden">
                                <div class="h-full bg-emerald-500 rounded-full" style="width: {{ $product->retail_price > 0 ? min(100, (($product->retail_price - $product->purchase_price) / $product->retail_price) * 100) : 0 }}%"></div>
                             </div>
                             <span class="text-sm font-bold text-emerald-400">
                                {{ $product->retail_price > 0 ? round((($product->retail_price - $product->purchase_price) / $product->retail_price) * 100, 1) : 0 }}%
                             </span>
                        </div>
                    </div>

                    @if(!$isEditing)
                         <div class="pt-4 grid grid-cols-2 gap-4 border-t border-white/5">
                            <div>
                                <p class="text-xs text-zinc-500">Cost</p>
                                <p class="text-sm font-medium">Rs. {{ number_format($product->purchase_price, 0) }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-zinc-500">Delivery</p>
                                <p class="text-sm font-medium text-amber-400">Rs. {{ number_format($product->delivery_charges, 0) }}</p>
                            </div>
                         </div>
                    @else
                         <div class="pt-4 space-y-4 border-t border-white/5">
                            <flux:field>
                                <flux:label class="text-sm text-white/50">Cost Price</flux:label>
                                <flux:input type="number" wire:model="form.cost_price" class="bg-white/5 border-white/10 text-white" leading="Rs." />
                            </flux:field>
                            <flux:field>
                                <flux:label class="text-sm text-white/50">Selling Price</flux:label>
                                <flux:input type="number" wire:model="form.retail_price" class="bg-white/5 border-white/10 text-white" leading="Rs." />
                            </flux:field>
                             <flux:field>
                                <flux:label class="text-sm text-white/50">Delivery Charge</flux:label>
                                <flux:input type="number" wire:model="form.delivery_charges" class="bg-white/5 border-white/10 text-white" leading="Rs." />
                            </flux:field>
                         </div>
                    @endif
                </div>
            </div>

            {{-- Internal Notes --}}
            <div class="rounded-3xl border border-zinc-100 bg-zinc-50 p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-800/50">
                 <h3 class="text-sm font-bold text-zinc-600 dark:text-zinc-400 mb-4">Internal Notes</h3>
                 @if(!$isEditing)
                    <p class="text-sm text-zinc-500 dark:text-zinc-400 bg-white dark:bg-zinc-900 p-3 rounded-2xl border border-zinc-100 dark:border-zinc-800 min-h-[4rem]">
                        {{ $product->internal_notes ?? 'No notes added.' }}
                    </p>
                 @else
                    <flux:textarea wire:model="form.internal_notes" rows="4" placeholder="Notes for your team..." />
                 @endif
            </div>
        </div>
    </div>

    {{-- Delete Confirmation --}}
    <flux:modal name="delete-product-modal" class="max-w-md">
        <div class="space-y-6">
            <div class="flex items-start gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-rose-50 text-rose-600">
                    <flux:icon.trash class="size-6" />
                </div>
                <div>
                    <h3 class="text-lg font-bold text-zinc-900 dark:text-white">Delete Product</h3>
                    <p class="text-sm text-zinc-500 mt-1">Are you sure you want to delete <strong class="text-zinc-900 dark:text-white">{{ $product->name }}</strong>? This action cannot be undone.</p>
                </div>
            </div>

            <div class="flex gap-3 justify-end pt-4 border-t border-zinc-100 dark:border-zinc-800">
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button wire:click="deleteProduct" class="bg-rose-500 hover:bg-rose-600 text-white border-0">Delete</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
