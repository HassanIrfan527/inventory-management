<div>
    <div class="flex flex-col gap-6">
        <div class="flex flex-col gap-6">
            <!-- Search & Filters Section -->
            <div class="flex flex-col gap-4 rounded-lg border border-neutral-200 bg-white p-5 dark:border-neutral-700 dark:bg-neutral-900"
                x-data="{ showFilters: false }">

                <!-- Search Bar -->
                <div class="flex gap-3">
                    <div class="flex-1 relative">
                        <input type="text" placeholder="Search products by name or ID..." wire:model.live="search"
                            class="w-full px-4 py-2.5 pl-10 rounded-lg border border-neutral-300 bg-white text-neutral-900 placeholder-neutral-500 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-neutral-600 dark:bg-neutral-800 dark:text-white dark:placeholder-neutral-400 dark:focus:border-blue-400 dark:focus:ring-blue-400/20">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-neutral-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>

                    <!-- Filter Toggle Button -->
                    <button @click="showFilters = !showFilters"
                        class="px-4 py-2.5 rounded-lg border border-neutral-300 bg-white text-neutral-700 font-medium hover:bg-neutral-50 transition-colors dark:border-neutral-600 dark:bg-neutral-800 dark:text-neutral-300 dark:hover:bg-neutral-700">
                        <svg class="w-5 h-5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                    </button>

                    <!-- Add New Product Button -->
                    <flux:modal.trigger name="add-product">
                    <flux:button variant="primary" color="blue" class="flex items-center gap-2" icon="plus">
                        Add New Product
                    </flux:button>
                    </flux:modal.trigger>
                </div>

                <!-- Filter Options (Hidden by default) -->
                <div x-show="showFilters" x-transition
                    class="flex gap-3 pt-3 border-t border-neutral-200 dark:border-neutral-700">
                    <select wire:model.live="sortBy"
                        class="px-3 py-2 rounded-lg border border-neutral-300 bg-white text-neutral-700 text-sm transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-neutral-600 dark:bg-neutral-800 dark:text-neutral-300">
                        <option value="">Sort by...</option>
                        <option value="name">Name (A-Z)</option>
                        <option value="created_at">Newest First</option>
                        <option value="retail_price">Price: High to Low</option>
                        <option value="purchase_price">Cost Price</option>
                    </select>

                    <button wire:click="$refresh"
                        class="px-3 py-2 rounded-lg border border-neutral-300 bg-white text-neutral-700 text-sm font-medium hover:bg-neutral-50 transition-colors dark:border-neutral-600 dark:bg-neutral-800 dark:text-neutral-300 dark:hover:bg-neutral-700">
                        Reset Filters
                    </button>
                </div>
            </div>

            <!-- Products Grid -->
            @if ($products->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                    @foreach ($products as $product)
                        <div
                            class="group rounded-lg border border-neutral-200 bg-white overflow-hidden transition-all hover:shadow-lg hover:border-neutral-300 dark:border-neutral-700 dark:bg-neutral-900 dark:hover:border-neutral-600 dark:hover:shadow-xl">
                            <!-- Product Image -->
                            <div
                                class="relative aspect-square overflow-hidden bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-neutral-800 dark:to-neutral-700">
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-neutral-300 dark:text-neutral-600" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>

                                <!-- Badge -->
                                <div class="absolute top-3 right-3">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                                        In Stock
                                    </span>
                                </div>
                            </div>

                            <!-- Product Info -->
                            <div class="p-4 flex flex-col gap-3">
                                <!-- Product ID -->
                                <div class="flex items-start justify-between gap-2">
                                    <button x-on:click="navigator.clipboard.writeText('{{ $product->product_id }}')"
                                        class="text-xs font-semibold text-blue-600 dark:text-blue-400 uppercase tracking-wider hover:bg-blue-50 dark:hover:bg-blue-900/20 px-2 py-1 rounded transition-colors flex items-center gap-1 cursor-pointer"
                                        title="Click to copy">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                        {{ $product->product_id }}
                                    </button>
                                    <!-- Delete Icon -->
                                    <button
                                        class="absolute top-3 left-3 p-1.5 rounded-lg bg-red-500/90 hover:bg-red-600 text-white transition-colors cursor-pointer"
                                        title="Delete product">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>

                                </div>

                                <!-- Product Name -->
                                <div class="min-h-[2.5rem]">
                                    <h3
                                        class="font-semibold text-neutral-900 dark:text-white line-clamp-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                        {{ $product->name }}
                                    </h3>
                                </div>

                                <!-- Description -->
                                @if ($product->description)
                                    <p class="text-sm text-neutral-600 dark:text-neutral-400 line-clamp-6">
                                        {{ $product->description }}
                                    </p>
                                @endif

                                <!-- Price Info -->
                                <div class="pt-2 border-t border-neutral-200 dark:border-neutral-700 space-y-2">
                                    <div class="flex justify-between items-center">
                                        <span class="text-xs text-neutral-600 dark:text-neutral-400">Retail Price</span>
                                        <span class="font-bold text-lg text-neutral-900 dark:text-white">Rs.
                                            {{ number_format($product->retail_price, 0) }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-xs text-neutral-600 dark:text-neutral-400">Cost Price</span>
                                        <span class="text-sm text-neutral-700 dark:text-neutral-300">Rs.
                                            {{ number_format($product->purchase_price, 0) }}</span>
                                    </div>
                                    @if ($product->delivery_charges > 0)
                                        <div class="flex justify-between items-center">
                                            <span class="text-xs text-neutral-600 dark:text-neutral-400">Delivery</span>
                                            <span class="text-sm text-neutral-700 dark:text-neutral-300">Rs.
                                                {{ number_format($product->delivery_charges, 0) }}</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Margin Info -->
                                <div class="bg-neutral-50 dark:bg-neutral-800/50 rounded p-2">
                                    <div class="flex justify-between items-center">
                                        <span
                                            class="text-xs font-medium text-neutral-600 dark:text-neutral-400">Margin</span>
                                        <span class="font-semibold text-green-600 dark:text-green-400">
                                            {{ round((($product->retail_price - $product->purchase_price) / $product->retail_price) * 100, 1) }}%
                                        </span>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="flex gap-2 pt-2">

                                    <flux:modal.trigger name="edit-product">
                                        <flux:button variant="primary" color="gray" class="flex-1" wire:click.prevent="getProductDetails({{ $product->id }})">
                                            Edit
                                        </flux:button>
                                    </flux:modal.trigger>

                                    <flux:modal.trigger name="view-product">

                                    <flux:button variant="primary" color="blue" class="flex-1" wire:click.prevent="getProductDetails({{ $product->id }})">
                                        View
                                    </flux:button>
                                    </flux:modal.trigger>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="flex justify-center">
                    {{ $products->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div
                    class="rounded-lg border border-neutral-200 bg-white p-12 dark:border-neutral-700 dark:bg-neutral-900">
                    <div class="flex flex-col items-center justify-center gap-4">
                        <div class="rounded-full bg-neutral-100 dark:bg-neutral-800 p-4">
                            <svg class="w-8 h-8 text-neutral-400 dark:text-neutral-600" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                        </div>
                        <div class="text-center">
                            <p class="text-lg font-semibold text-neutral-900 dark:text-white">No products found</p>
                            <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">Try adjusting your search or
                                add a new product</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!-- Modals -->
    <x-modals.view-products-modal :selectedProduct="$selectedProduct" />
    <x-modals.edit-products-modal :selectedProduct="$selectedProduct" />
    <x-modals.add-product-modal>
        <form class="space-y-6" wire:submit.prevent="addProduct">
            @csrf
        <!-- Product Image -->
        <flux:field>
            <flux:label>Product Image</flux:label>
            <label for="file-upload" class="mt-2 flex cursor-pointer justify-center rounded-xl border border-dashed border-neutral-300 px-6 py-10 transition-colors hover:bg-neutral-50 dark:border-neutral-700 dark:hover:bg-neutral-800">
                <div class="text-center">
                    <flux:icon.photo class="mx-auto h-12 w-12 text-neutral-300 dark:text-neutral-600" />
                    <div class="mt-4 flex text-sm leading-6 text-neutral-600 dark:text-neutral-400 justify-center">
                        <span class="font-semibold text-blue-600 dark:text-blue-400">Upload a file</span>
                        <p class="pl-1">or drag and drop</p>
                    </div>
                    <p class="text-xs leading-5 text-neutral-600 dark:text-neutral-400">PNG, JPG, GIF up to 10MB</p>
                    <input id="file-upload" name="file-upload" type="file" class="sr-only" accept="image/*">
                </div>
            </label>
        </flux:field>

        <!-- Product Details -->
        <flux:field>
            <flux:label badge="Required">Product Name</flux:label>
             <flux:input placeholder="e.g. Wireless Headphones" wire:model="product.name" />
        </flux:field>

        <flux:field>
            <flux:label badge="Required">Description</flux:label>
            <flux:textarea rows="3" resize="none" placeholder="Enter product description..." wire:model="product.description" />
        </flux:field>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <flux:field>
                <flux:label badge="Required">Cost Price</flux:label>
                <flux:input type="number" step="0.01" icon="banknotes" placeholder="0.00" wire:model="product.cost_price" />
            </flux:field>

            <flux:field>
                <flux:label badge="Required">Retail Price</flux:label>
                <flux:input type="number" step="0.01" icon="tag" placeholder="0.00" wire:model="product.retail_price" />
            </flux:field>
             <flux:field>
                <flux:label badge="Optional">Delivery Charges</flux:label>
                <flux:input type="number" step="0.01" icon="truck" placeholder="0.00" wire:model="product.delivery_charges" />
            </flux:field>

        </div>

        <flux:button type="submit" variant="primary" color="blue" class="w-full">
            Add Product
        </flux:button>
    </form>
    </x-modals.add-product-modal>

    {{-- <x-modals.delete-modal title="Delete Product"
        message="Are you sure you want to delete this product? This action cannot be undone."
        confirmText="Delete Product" /> --}}

</div>
