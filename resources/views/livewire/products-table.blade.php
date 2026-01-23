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
            </div>

            <!-- Category Filter Pills -->
            @if ($categories->count() > 0)
                <div class="flex gap-2 overflow-x-auto pb-2 -mx-1 px-1 no-scrollbar">
                    <button wire:click="$set('selectedCategory', null)"
                        class="whitespace-nowrap px-3 py-1.5 rounded-full text-sm font-medium transition-all border
                                {{ is_null($selectedCategory)
                                    ? 'bg-blue-600 border-blue-600 text-white shadow-sm'
                                    : 'bg-white border-neutral-300 text-neutral-600 hover:bg-neutral-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700' }}">
                        All Products
                    </button>

                    @foreach ($categories as $category)
                        <button wire:click="toggleCategory({{ $category->id }})"
                            wire:key="cat-filter-{{ $category->id }}"
                            class="whitespace-nowrap px-3 py-1.5 rounded-full text-sm font-medium transition-all border
                                    {{ $selectedCategory === $category->id
                                        ? 'bg-blue-600 border-blue-600 text-white shadow-sm'
                                        : 'bg-white border-neutral-300 text-neutral-600 hover:bg-neutral-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700' }}">
                            {{ $category->name }}
                        </button>
                    @endforeach
                </div>
            @endif

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
                    <div wire:key="product-{{ $product->id }}"
                        class="group rounded-lg border border-neutral-200 bg-white overflow-hidden transition-all hover:shadow-lg hover:border-neutral-300 dark:border-neutral-700 dark:bg-neutral-900 dark:hover:border-neutral-600 dark:hover:shadow-xl relative">
                        <!-- Product Image -->
                        <div
                            class="relative aspect-square overflow-hidden bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-neutral-800 dark:to-neutral-700">
                            @if ($product->images->first()->image_path ?? false)
                                <img src="{{ Storage::url($product->images->first()->image_path) }}" alt="{{ $product->name }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <svg class="w-20 h-20 text-neutral-300 dark:text-neutral-600" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif

                            <!-- Checkbox -->
                            <div class="absolute top-3 left-3 z-10">
                                <input type="checkbox" wire:model.live="selectedProducts" value="{{ $product->id }}"
                                    class="w-5 h-5 rounded border-neutral-300 text-blue-600 focus:ring-blue-500 bg-white/90 backdrop-blur-sm cursor-pointer transition-colors dark:border-neutral-600 dark:bg-neutral-800/90 dark:checked:bg-blue-500">
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
                                <p class="text-sm text-neutral-600 dark:text-neutral-400 line-clamp-2">
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

                                <button
                                    class="flex-1 rounded-lg border border-neutral-300 bg-white px-3 py-1.5 text-sm font-medium text-neutral-700 hover:bg-neutral-50 dark:border-neutral-600 dark:bg-neutral-800 dark:text-neutral-300 dark:hover:bg-neutral-700"
                                    wire:click="$dispatch('edit-product', { id: {{ $product->id }} })">
                                    Edit
                                </button>

                                <flux:modal.trigger name="delete-product-{{ $product->id }}">
                                    <button
                                        class="flex items-center justify-center rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-red-600 hover:bg-red-100 hover:text-red-700 dark:border-red-900/30 dark:bg-red-900/20 dark:text-red-400 dark:hover:bg-red-900/40 transition-colors"
                                        title="Delete product">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </flux:modal.trigger>

                                <flux:modal name="delete-product-{{ $product->id }}" class="max-w-md">
                                    <div class="space-y-6">
                                        <div class="flex items-start text-left gap-4">
                                            <div class="rounded-full bg-red-50 p-3 dark:bg-red-950 shrink-0">
                                                <flux:icon icon="trash-2"
                                                    class="h-6 w-6 text-red-600 dark:text-red-400" />
                                            </div>
                                            <div class="space-y-2">
                                                <flux:heading size="lg">Delete Product</flux:heading>
                                                <flux:text class="leading-relaxed">
                                                    Are you sure you want to delete
                                                    <strong>{{ $product->name }}</strong>?
                                                    This action will permanently remove it from your inventory.
                                                </flux:text>
                                            </div>
                                        </div>

                                        <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 pt-4">
                                            <flux:modal.close>
                                                <flux:button variant="ghost" class="w-full sm:w-auto">Cancel
                                                </flux:button>
                                            </flux:modal.close>
                                            <flux:button type="submit" variant="primary" color="danger"
                                                wire:click="deleteProduct({{ $product->id }})"
                                                class="w-full sm:w-auto">
                                                Delete Product
                                            </flux:button>
                                        </div>
                                    </div>
                                </flux:modal>

                                <button
                                    class="flex-1 rounded-lg bg-blue-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600"
                                    wire:click="$dispatch('view-product', { id: {{ $product->id }} })">
                                    View
                                </button>
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

    <!-- Floating Bottom Bar -->
    @if (count($selectedProducts) > 0)
        <div class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50 animate-in slide-in-from-bottom-4 duration-200">
            <div
                class="flex items-center gap-4 rounded-xl border border-neutral-200 bg-white/90 p-4 shadow-xl backdrop-blur-md dark:border-neutral-700 dark:bg-neutral-900/90">
                <div class="flex items-center gap-3 border-r border-neutral-200 pr-4 dark:border-neutral-700">
                    <span
                        class="flex h-6 w-6 items-center justify-center rounded-full bg-blue-600 text-xs font-bold text-white">
                        {{ count($selectedProducts) }}
                    </span>
                    <span class="text-sm font-medium text-neutral-900 dark:text-white">Selected</span>
                </div>

                <div class="flex items-center gap-2">
                    <flux:modal.trigger name="bulk-change-category">
                        <button
                            class="flex items-center gap-2 rounded-lg bg-white px-3 py-1.5 text-sm font-medium text-neutral-700 hover:bg-neutral-50 border border-neutral-200 dark:bg-neutral-800 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:border-neutral-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            Change Category
                        </button>
                    </flux:modal.trigger>

                    <button wire:click="clearSelection"
                        class="ml-2 rounded-lg p-1.5 text-neutral-500 hover:bg-neutral-100 dark:text-neutral-400 dark:hover:bg-neutral-800 transition-colors"
                        title="Clear selection">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Bulk Change Category Modal -->
    <flux:modal name="bulk-change-category" class="max-w-md">
        <div class="space-y-6">
            <div class="flex items-start text-left gap-4">
                <div class="rounded-full bg-blue-50 p-3 dark:bg-blue-900/30 shrink-0">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                </div>
                <div class="space-y-2">
                    <flux:heading size="lg">Change Category</flux:heading>
                    <flux:text class="leading-relaxed">
                        Select a new category for the <strong>{{ count($selectedProducts) }}</strong> selected
                        products.
                    </flux:text>
                </div>
            </div>

            <div class="space-y-4">
                <div class="space-y-2">
                    <flux:label>New Category</flux:label>
                    <flux:dropdown>
                        <flux:button class="min-w-[12rem] justify-between bg-white dark:bg-neutral-800 border-neutral-200 dark:border-neutral-700 hover:bg-neutral-50 dark:hover:bg-neutral-700" icon="tag" variant="outline" right-icon="chevron-down">
                            <span class="truncate">
                                {{ $categories->firstWhere('id', $targetCategory)->name ?? 'Select category...' }}
                            </span>
                        </flux:button>

                        <flux:menu class="max-h-60 overflow-y-auto min-w-[12rem]" anchor="bottom start">
                            @foreach ($categories as $category)
                                <flux:menu.item wire:click="$set('targetCategory', {{ $category->id }})">
                                    {{ $category->name }}
                                </flux:menu.item>
                            @endforeach
                        </flux:menu>
                    </flux:dropdown>
                    <flux:error name="targetCategory" />
                </div>
            </div>

            <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 pt-4">
                <flux:modal.close>
                    <flux:button variant="ghost" class="w-full sm:w-auto">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary" color="blue" wire:click="bulkChangeCategory"
                    class="w-full sm:w-auto">
                    Update Category
                </flux:button>
            </div>
        </div>
    </flux:modal>
    <!-- Modals -->


</div>
