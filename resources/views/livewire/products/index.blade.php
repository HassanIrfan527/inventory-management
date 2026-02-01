<div class="flex h-full w-full flex-1 flex-col gap-6">
    <!-- Page Header & Stats -->
    @php
        $breadcrumbItem = [
            [
                'name' => 'Inventory',
                'href' => route('inventory'),
                'icon' => 'box',
            ],
        ];
    @endphp
    <!-- Breadcrumbs -->
    <x-custom-breadcrumb :items="$breadcrumbItem"></x-custom-breadcrumb>

    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex flex-col gap-1">
            <flux:heading size="xl" level="1" class="text-emerald-950 dark:text-emerald-50 mb-1">Product
                Inventory</flux:heading>
            <flux:text size="sm" class="text-zinc-600 dark:text-zinc-400">
                Strategic oversight of your global product catalog and valuation.
            </flux:text>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
        <!-- Total Products -->
        <div
            class="group relative overflow-hidden rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm transition-all hover:shadow-md dark:border-zinc-800 dark:bg-zinc-900">
            <div
                class="absolute -right-2 -top-2 h-16 w-16 rounded-full bg-gradient-to-br from-blue-500/10 to-indigo-500/10 blur-2xl">
            </div>
            <div class="relative flex items-center justify-between">
                <div class="flex flex-col gap-1">
                    <p class="text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Total
                        Products</p>
                    <p class="text-3xl font-bold text-zinc-900 dark:text-white mt-1">{{ number_format($totalProducts) }}
                    </p>
                </div>
                <div
                    class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400 ring-4 ring-blue-50/50 dark:ring-blue-900/10 transition-transform group-hover:scale-110">
                    <flux:icon.box class="h-6 w-6" />
                </div>
            </div>
            <div class="mt-4 flex items-center gap-2 text-sm pt-4 border-t border-zinc-50 dark:border-zinc-800/50">
                <span
                    class="flex items-center gap-1 font-medium text-emerald-600 dark:text-emerald-400 shrink-0 whitespace-nowrap">
                    <flux:icon.activity class="h-4 w-4" />
                    <span>Active</span>
                </span>
                <span class="text-zinc-400 truncate text-[10px] font-bold uppercase tracking-widest">Global
                    Catalog</span>
            </div>
        </div>

        <!-- Profit Margin -->
        <div
            class="group relative overflow-hidden rounded-2xl border border-amber-100 bg-white p-6 shadow-sm transition-all hover:shadow-md dark:border-amber-900/30 dark:bg-zinc-900">
            <div
                class="absolute -right-2 -top-2 h-16 w-16 rounded-full bg-gradient-to-br from-amber-500/10 to-orange-500/10 blur-2xl">
            </div>
            <div class="relative flex items-center justify-between">
                <div class="flex flex-col gap-1">
                    <p class="text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Avg.
                        Profit Margin</p>
                    <p class="text-3xl font-bold text-zinc-900 dark:text-white mt-1">{{ round($avg_margin, 1) }}%</p>
                </div>
                <div
                    class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-amber-600 dark:bg-amber-900/20 dark:text-amber-400 ring-4 ring-amber-50/50 dark:ring-amber-900/10 transition-transform group-hover:scale-110">
                    <flux:icon.trending-up class="h-6 w-6" />
                </div>
            </div>
            <div class="mt-4 flex items-center gap-2 text-sm pt-4 border-t border-amber-50 dark:border-amber-900/10">
                <span
                    class="flex items-center gap-1 font-medium text-amber-600 dark:text-amber-400 shrink-0 whitespace-nowrap text-[10px] font-black uppercase tracking-widest">
                    <flux:icon.chart-bar-stacked class="h-4 w-4" />
                    Optimized
                </span>
                <span class="text-zinc-400 truncate text-[10px] font-bold uppercase tracking-widest leading-none">Yield
                    metric</span>
            </div>
        </div>

        <!-- Inventory Value -->
        <div
            class="group relative overflow-hidden rounded-2xl border border-emerald-100 bg-gradient-to-br from-emerald-600 to-teal-700 p-6 shadow-sm transition-all hover:shadow-lg dark:border-zinc-800">
            <div class="relative">
                <div class="flex items-center justify-between mb-3 text-white">
                    <div class="flex flex-col gap-1">
                        <p class="text-xs font-bold uppercase tracking-wider opacity-80">Inventory Valuation</p>
                        <p class="text-2xl font-black tracking-tight mt-1">Rs. {{ number_format($totalInventoryValue) }}
                        </p>
                    </div>
                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-white/20 text-white backdrop-blur-md ring-4 ring-white/10 transition-transform group-hover:rotate-12 group-hover:scale-110">
                        <flux:icon.banknote class="h-7 w-7" />
                    </div>
                </div>
                <div
                    class="flex items-center gap-2 text-white/70 pt-4 border-t border-white/10 mt-3 text-[10px] font-black uppercase tracking-widest leading-none">
                    <flux:icon.shield-check class="h-4 w-4" />
                    Total Asset Value
                </div>
            </div>
        </div>
    </div>
    <!-- Intelligent Toolbar -->
    <div class="flex flex-col gap-5 rounded-2xl border border-zinc-200 bg-white p-5 shadow-sm dark:border-zinc-800 dark:bg-zinc-900"
        x-data="{ showFilters: false }">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
            <!-- Search -->
            <div class="relative flex-1">
                <flux:input wire:model.live.debounce.300ms="search" icon="magnifying-glass"
                    placeholder="Search by name, SKU or ID..." variant="filled" class="w-full" />
            </div>

            <div class="flex items-center gap-2">
                <!-- Filter Toggle -->
                <button @click="showFilters = !showFilters"
                    :class="showFilters ?
                        'bg-zinc-100 text-zinc-900 border-zinc-300 dark:bg-zinc-800 dark:text-white dark:border-zinc-700' :
                        'text-zinc-600 border-zinc-200 hover:bg-zinc-50 dark:text-zinc-400 dark:border-zinc-800 dark:hover:bg-zinc-800'"
                    class="flex items-center gap-2 rounded-xl border px-3 py-2 text-sm font-bold transition-all duration-200">
                    <flux:icon.funnel class="size-4" />
                    <span>Filter</span>
                    <div x-show="showFilters" x-transition class="size-1.5 rounded-full bg-emerald-500"></div>
                </button>

                <div class="h-6 w-px bg-zinc-200 dark:bg-zinc-800 mx-1"></div>

                <!-- Add Button -->
                <flux:button href="{{ route('products.create') }}" wire:navigate variant="primary" icon="plus"
                    class="bg-emerald-600 hover:bg-emerald-700 shadow-lg shadow-emerald-500/20">
                    Add Product
                </flux:button>
            </div>
        </div>

        <!-- Advanced Filters Drawer -->
        <div x-show="showFilters" x-collapse>
            <div class="flex flex-wrap items-center gap-3 pt-5 border-t border-zinc-100 dark:border-zinc-800">
                <div class="flex items-center gap-2">
                    <span class="text-[10px] font-black uppercase tracking-widest text-zinc-400">Sort by:</span>
                    <flux:dropdown>
                        <flux:button size="sm" variant="subtle" icon-trailing="chevron-down" class="font-bold">
                            {{ collect(['name' => 'Name', 'created_at' => 'Newest', 'retail_price' => 'Price', 'purchase_price' => 'Cost'])->get($sortBy, 'Default') }}
                        </flux:button>
                        <flux:menu>
                            <flux:menu.radio.group wire:model.live="sortBy">
                                <flux:menu.radio value="name">Name (A-Z)</flux:menu.radio>
                                <flux:menu.radio value="created_at">Newest First</flux:menu.radio>
                                <flux:menu.radio value="retail_price">Price: High to Low</flux:menu.radio>
                                <flux:menu.radio value="purchase_price">Cost Price</flux:menu.radio>
                            </flux:menu.radio.group>
                        </flux:menu>
                    </flux:dropdown>
                </div>

                <div class="h-4 w-px bg-zinc-200 dark:bg-zinc-800 mx-1"></div>

                @if ($sortBy || $selectedCategory)
                    <button wire:click="resetFilters"
                        class="text-[10px] font-black uppercase tracking-widest text-rose-500 hover:text-rose-600 transition-colors flex items-center gap-1">
                        <flux:icon.x-circle class="size-3" />
                        Reset All
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Category High-Density Navigation -->
    @if ($categories->count() > 0)
        <div class="flex items-center gap-2 overflow-x-auto pb-2 no-scrollbar scroll-smooth">
            <button wire:click="$set('selectedCategory', null)"
                class="group relative flex shrink-0 items-center gap-2 rounded-xl border px-4 py-2 text-xs font-black uppercase tracking-widest transition-all duration-300
                            {{ is_null($selectedCategory)
                                ? 'border-emerald-600 bg-emerald-600 text-white shadow-md shadow-emerald-500/20'
                                : 'border-zinc-200 bg-white text-zinc-500 hover:border-zinc-300 hover:bg-zinc-50 dark:border-zinc-800 dark:bg-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800' }}">
                All Items
            </button>

            @foreach ($categories as $category)
                <button wire:click="toggleCategory({{ $category->id }})" wire:key="cat-filter-{{ $category->id }}"
                    class="group relative flex shrink-0 items-center gap-2 rounded-xl border px-4 py-2 text-xs font-black uppercase tracking-widest transition-all duration-300
                                {{ $selectedCategory === $category->id
                                    ? 'border-emerald-600 bg-emerald-600 text-white shadow-md shadow-emerald-500/20'
                                    : 'border-zinc-200 bg-white text-zinc-500 hover:border-zinc-300 hover:bg-zinc-50 dark:border-zinc-800 dark:bg-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800' }}">
                    {{ $category->name }}
                </button>
            @endforeach
        </div>
    @endif

    <!-- Products Evolution View -->
    @if ($products->count() > 0)
        @switch($viewType)
            @case(App\Enums\ProductView::List)
                <!-- List View (Professional ERP Style) -->
                <div
                    class="overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                    <div class="overflow-x-auto no-scrollbar">
                        <table class="w-full text-left text-sm text-zinc-600 dark:text-zinc-400 border-collapse">
                            <thead
                                class="bg-zinc-50/50 text-[10px] font-black uppercase tracking-widest text-zinc-500 dark:bg-zinc-950/50 dark:text-zinc-400">
                                <tr>
                                    <th class="px-6 py-4">
                                        <input type="checkbox" wire:click="toggleAll"
                                            class="size-4 rounded border-zinc-300 text-emerald-600 focus:ring-emerald-500/50 dark:border-zinc-700 dark:bg-zinc-800">
                                    </th>
                                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest">Product Detail</th>
                                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-center">Stock
                                    </th>
                                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest">Classification</th>
                                    <th class="px-6 py-4 text-right text-[10px] font-black uppercase tracking-widest">Pricing
                                    </th>
                                    <th class="px-6 py-4 text-center text-[10px] font-black uppercase tracking-widest">Incentive
                                    </th>
                                    <th class="px-6 py-4 text-right text-[10px] font-black uppercase tracking-widest">Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                                @foreach ($products as $product)
                                    <tr wire:key="product-row-{{ $product->id }}"
                                        class="group hover:bg-emerald-50/30 dark:hover:bg-emerald-900/5 transition-colors">
                                        <td class="px-6 py-4">
                                            <input type="checkbox" wire:model.live="selectedProducts"
                                                value="{{ $product->id }}"
                                                class="size-4 rounded border-zinc-300 text-emerald-600 focus:ring-emerald-500/50 dark:border-zinc-700 dark:bg-zinc-800">
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-4">
                                                <div
                                                    class="size-12 shrink-0 overflow-hidden rounded-xl bg-zinc-100 dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700">
                                                    @if ($product->images->first()->image_path ?? false)
                                                        <img src="{{ Storage::url($product->images->first()->image_path) }}"
                                                            alt="{{ $product->name }}" class="h-full w-full object-cover">
                                                    @else
                                                        <div class="flex h-full w-full items-center justify-center">
                                                            <flux:icon.photo class="size-5 text-zinc-300 dark:text-zinc-600" />
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="flex flex-col">
                                                    <span
                                                        class="font-bold text-zinc-950 dark:text-white group-hover:text-emerald-600 transition-colors">{{ $product->name }}</span>
                                                    <span
                                                        class="text-[10px] text-zinc-400 uppercase tracking-wider font-medium line-clamp-1">{{ Str::limit($product->description, 40) }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 font-mono text-[10px] font-black text-zinc-500">
                                            {{ $product->product_id }}</td>
                                        <td class="px-6 py-4">
                                            <div class="flex flex-wrap gap-1">
                                                @foreach ($product->categories as $cat)
                                                    <span
                                                        class="inline-flex items-center rounded-lg bg-zinc-100 px-2 py-0.5 text-[10px] font-black uppercase tracking-widest text-zinc-600 dark:bg-zinc-800 dark:text-zinc-400">
                                                        {{ $cat->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex flex-col items-end">
                                                <span class="font-black text-zinc-950 dark:text-white">Rs.
                                                    {{ number_format($product->retail_price, 0) }}</span>
                                                <span class="text-[10px] text-zinc-400 font-bold">Cost: Rs.
                                                    {{ number_format($product->purchase_price, 0) }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span
                                                class="inline-flex size-10 items-center justify-center rounded-xl bg-emerald-50 text-xs font-black text-emerald-700 dark:bg-emerald-900/20 dark:text-emerald-400 border border-emerald-100/50 dark:border-emerald-500/10">
                                                {{ $product->retail_price > 0 ? round((($product->retail_price - $product->purchase_price) / $product->retail_price) * 100, 0) : 0 }}%
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div
                                                class="flex items-center justify-end gap-1.5 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                                <button wire:click="$dispatch('edit-product', { id: {{ $product->id }} })"
                                                    class="flex size-8 items-center justify-center rounded-lg bg-white text-zinc-500 hover:text-emerald-600 border border-zinc-200 shadow-sm dark:bg-zinc-800 dark:border-zinc-700">
                                                    <flux:icon.pencil class="size-3.5" />
                                                </button>
                                                <flux:modal.trigger name="delete-product-{{ $product->id }}">
                                                    <button
                                                        class="flex size-8 items-center justify-center rounded-lg bg-white text-zinc-400 hover:text-rose-500 border border-zinc-200 shadow-sm dark:bg-zinc-800 dark:border-zinc-700">
                                                        <flux:icon.trash-2 class="size-3.5" />
                                                    </button>
                                                </flux:modal.trigger>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @break

            @case(App\Enums\ProductView::Compact)
                <!-- Compact View (High Density) -->
                <div
                    class="overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                    <table class="w-full text-left text-xs text-zinc-600 dark:text-zinc-400 border-collapse">
                        <thead
                            class="bg-zinc-50/50 text-[9px] font-black uppercase tracking-widest text-zinc-400 dark:bg-zinc-950/50">
                            <tr>
                                <th class="px-4 py-3 w-8 text-center text-[9px] font-black uppercase tracking-widest">Sel</th>
                                <th class="px-4 py-3 text-[9px] font-black uppercase tracking-widest">Asset ID</th>
                                <th class="px-4 py-3 text-[9px] font-black uppercase tracking-widest">Descriptor</th>
                                <th class="px-4 py-3 text-[9px] font-black uppercase tracking-widest">Class</th>
                                <th class="px-4 py-3 text-right text-[9px] font-black uppercase tracking-widest">Yield</th>
                                <th class="px-4 py-3 text-right text-[9px] font-black uppercase tracking-widest">Market Value
                                </th>
                                <th class="px-4 py-3 text-right text-[9px] font-black uppercase tracking-widest">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-50 dark:divide-zinc-800">
                            @foreach ($products as $product)
                                <tr wire:key="product-compact-{{ $product->id }}"
                                    class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                                    <td class="px-4 py-2 text-center text-[9px] font-black uppercase tracking-widest">
                                        <input type="checkbox" wire:model.live="selectedProducts"
                                            value="{{ $product->id }}"
                                            class="size-3.5 rounded border-zinc-300 text-emerald-500 focus:ring-emerald-500/40">
                                    </td>
                                    <td class="px-4 py-2 font-mono text-[10px] font-bold text-zinc-400">
                                        {{ $product->product_id }}</td>
                                    <td class="px-4 py-2 font-bold text-zinc-900 dark:text-white">{{ $product->name }}</td>
                                    <td class="px-4 py-2 opacity-60">
                                        @foreach ($product->categories as $cat)
                                            {{ $cat->name }}@if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="px-4 py-2 text-right">
                                        <span
                                            class="inline-flex items-center px-1.5 py-0.5 rounded-full text-[9px] font-black bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-400">
                                            {{ $product->retail_price > 0 ? round((($product->retail_price - $product->purchase_price) / $product->retail_price) * 100, 0) : 0 }}%
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 text-right font-black text-zinc-950 dark:text-white">Rs.
                                        {{ number_format($product->retail_price, 0) }}</td>
                                    <td class="px-4 py-2 text-right">
                                        <button wire:click="$dispatch('edit-product', { id: {{ $product->id }} })"
                                            class="text-[10px] font-black uppercase tracking-widest text-emerald-600 hover:text-emerald-700 transition-colors">Modify</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @break

            @case(App\Enums\ProductView::Kanban)
                <!-- Kanban board (Agile Inventory) -->
                <div class="flex overflow-x-auto gap-6 pb-6 no-scrollbar">
                    @php
                        $groupedProducts = $products->groupBy(function ($item) {
                            return $item->categories->first()->name ?? 'Uncategorized';
                        });
                        $allCategories = $categories->pluck('name')->push('Uncategorized')->unique();
                    @endphp

                    @foreach ($allCategories as $catName)
                        @if (isset($groupedProducts[$catName]) || ($products->isEmpty() && $catName === 'Uncategorized'))
                            <div class="w-80 shrink-0 flex flex-col gap-4">
                                <div
                                    class="flex items-center justify-between px-3 py-2 bg-zinc-100/50 dark:bg-zinc-800/30 rounded-xl border border-zinc-200/50 dark:border-zinc-700/50">
                                    <div class="flex items-center gap-2">
                                        <div class="size-1.5 rounded-full bg-emerald-500"></div>
                                        <h3 class="text-xs font-black uppercase tracking-widest text-zinc-900 dark:text-white">
                                            {{ $catName }}</h3>
                                    </div>
                                    <span
                                        class="text-[10px] font-black text-zinc-400 bg-white dark:bg-zinc-900 px-2 py-0.5 rounded-full shadow-sm ring-1 ring-zinc-200 dark:ring-zinc-800">
                                        {{ $groupedProducts[$catName]->count() ?? 0 }}
                                    </span>
                                </div>

                                <div class="flex flex-col gap-3">
                                    @foreach ($groupedProducts[$catName] ?? [] as $product)
                                        <div wire:key="kanban-{{ $product->id }}"
                                            class="group p-4 bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl shadow-sm hover:shadow-xl hover:border-emerald-500/20 transition-all">

                                            <div class="flex gap-4 mb-4">
                                                <div
                                                    class="size-14 shrink-0 overflow-hidden rounded-xl bg-zinc-50 dark:bg-zinc-950 border border-zinc-100 dark:border-zinc-800">
                                                    @if ($product->images->first()->image_path ?? false)
                                                        <img src="{{ Storage::url($product->images->first()->image_path) }}"
                                                            alt="{{ $product->name }}"
                                                            class="h-full w-full object-cover group-hover:scale-110 transition-transform">
                                                    @else
                                                        <div class="flex h-full w-full items-center justify-center">
                                                            <flux:icon.photo class="size-6 text-zinc-200 dark:text-zinc-700" />
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <h4
                                                        class="text-xs font-bold text-zinc-900 dark:text-white truncate group-hover:text-emerald-600 transition-colors">
                                                        {{ $product->name }}</h4>
                                                    <span
                                                        class="text-[9px] font-black font-mono text-zinc-400 uppercase tracking-tighter">{{ $product->product_id }}</span>
                                                    <div class="mt-2 flex items-center justify-between">
                                                        <span class="text-sm font-black text-zinc-950 dark:text-white">Rs.
                                                            {{ number_format($product->retail_price, 0) }}</span>
                                                        <span
                                                            class="text-[9px] font-black text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-900/20 px-1.5 py-0.5 rounded">
                                                            {{ $product->retail_price > 0 ? round((($product->retail_price - $product->purchase_price) / $product->retail_price) * 100, 0) : 0 }}%
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div
                                                class="flex items-center justify-between pt-3 border-t border-zinc-50 dark:border-zinc-800">
                                                <div class="flex items-center gap-1">
                                                    <div class="size-2 rounded-full bg-emerald-500"></div>
                                                    <span
                                                        class="text-[9px] font-bold text-zinc-400 uppercase tracking-widest">Active
                                                        Asset</span>
                                                </div>
                                                <button wire:click="$dispatch('edit-product', { id: {{ $product->id }} })"
                                                    class="opacity-0 group-hover:opacity-100 transition-opacity size-7 flex items-center justify-center rounded-lg bg-zinc-50 dark:bg-zinc-800 text-zinc-400 hover:text-emerald-600">
                                                    <flux:icon.pencil class="size-3" />
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @break

            @default
                <!-- Grid View (Default - Premium Cards) -->
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach ($products as $product)
                        <div wire:key="product-{{ $product->id }}"
                            class="group relative flex flex-col overflow-hidden rounded-3xl border border-zinc-200 bg-white transition-all duration-300 hover:-translate-y-1 hover:border-emerald-500/30 hover:shadow-2xl hover:shadow-emerald-500/10 dark:border-zinc-800 dark:bg-zinc-900 dark:hover:border-emerald-500/50">

                            <!-- Visual Assets Container -->
                            <div class="relative aspect-[4/3] overflow-hidden bg-zinc-50 dark:bg-zinc-950">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-zinc-900/60 via-transparent to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                                </div>

                                @if ($product->images->first()->image_path ?? false)
                                    <img src="{{ Storage::url($product->images->first()->image_path) }}"
                                        alt="{{ $product->name }}"
                                        class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110">
                                @else
                                    <div
                                        class="flex h-full w-full items-center justify-center bg-gradient-to-br from-zinc-100 to-zinc-50 dark:from-zinc-900 dark:to-zinc-800">
                                        <flux:icon.photo class="size-16 text-zinc-300 dark:text-zinc-700" />
                                    </div>
                                @endif

                                <!-- HUD Overlays -->
                                <div class="absolute inset-x-0 top-0 flex items-center justify-between p-4">
                                    <div class="flex items-center gap-2">
                                        <input type="checkbox" wire:model.live="selectedProducts"
                                            value="{{ $product->id }}"
                                            class="size-5 rounded-lg border-white/20 bg-black/20 text-emerald-500 backdrop-blur-md transition-all checked:bg-emerald-500 focus:ring-emerald-500/50">
                                    </div>
                                    <div class="flex flex-col items-end gap-1.5">
                                        @if ($product->stock_quantity === null)
                                            <span
                                                class="inline-flex items-center gap-1 rounded-full bg-emerald-500 px-2.5 py-1 text-[10px] font-black uppercase tracking-widest text-white shadow-lg shadow-emerald-500/40">
                                                <span class="text-xs">∞</span> Persistent
                                            </span>
                                        @elseif($product->stock_quantity > 0)
                                            <span
                                                class="inline-flex items-center gap-1 rounded-full bg-blue-500 px-2.5 py-1 text-[10px] font-black uppercase tracking-widest text-white shadow-lg shadow-blue-500/40">
                                                {{ $product->stock_quantity }} In Stock
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center gap-1 rounded-full bg-rose-500 px-2.5 py-1 text-[10px] font-black uppercase tracking-widest text-white shadow-lg shadow-rose-500/40">
                                                Depleted
                                            </span>
                                        @endif
                                        <span
                                            class="rounded-lg bg-black/40 px-2 py-1 text-[10px] font-bold text-white backdrop-blur-md">
                                            {{ $product->product_id }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Quick Action Bar -->
                                <div
                                    class="absolute inset-x-0 bottom-0 translate-y-full p-4 transition-transform duration-300 group-hover:translate-y-0">
                                    <div class="flex gap-2">
                                        <a href="{{ route('products.show', $product->id) }}" wire:navigate
                                            class="flex flex-1 items-center justify-center gap-2 rounded-xl bg-white py-2 text-xs font-bold text-zinc-900 shadow-xl transition-colors hover:bg-emerald-50">
                                            <flux:icon.presentation-chart-line class="size-4" />
                                            Intelligence
                                        </a>
                                        <button wire:click="deleteProduct({{ $product->id }})"
                                            wire:confirm="Decommission this asset permanently?"
                                            class="flex size-9 items-center justify-center rounded-xl bg-rose-500 text-white shadow-xl transition-colors hover:bg-rose-600">
                                            <flux:icon.trash class="size-4" />
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Intelligence Layer -->
                            <div class="flex flex-1 flex-col p-5">
                                <div class="mb-4">
                                    <h3
                                        class="line-clamp-1 text-sm font-bold text-zinc-900 dark:text-white group-hover:text-emerald-600 transition-colors">
                                        {{ $product->name }}
                                    </h3>
                                    <div class="mt-1 flex flex-wrap gap-1.5">
                                        @forelse($product->categories as $cat)
                                            <span
                                                class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider">{{ $cat->name }}{{ !$loop->last ? ' •' : '' }}</span>
                                        @empty
                                            <span
                                                class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider">Uncategorized</span>
                                        @endforelse
                                    </div>
                                </div>

                                <div class="mt-auto space-y-4">
                                    <!-- Price Engine -->
                                    <div
                                        class="flex items-end justify-between border-b border-zinc-100 pb-3 dark:border-zinc-800">
                                        <div class="flex flex-col">
                                            <span class="text-[10px] font-black uppercase tracking-widest text-zinc-400">Retail
                                                Value</span>
                                            <span class="text-xl font-black text-zinc-950 dark:text-white">
                                                Rs. {{ number_format($product->retail_price, 0) }}
                                            </span>
                                        </div>
                                        <div
                                            class="flex h-10 w-16 flex-col items-center justify-center rounded-xl bg-emerald-50 px-2 dark:bg-emerald-900/20">
                                            <span
                                                class="text-[8px] font-black uppercase tracking-widest text-emerald-600">Margin</span>
                                            <span class="text-xs font-black text-emerald-700 dark:text-emerald-400">
                                                {{ $product->retail_price > 0 ? round((($product->retail_price - $product->purchase_price) / $product->retail_price) * 100, 1) : 0 }}%
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Efficiency Metrics -->
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="flex flex-col">
                                            <span class="text-[9px] font-black uppercase tracking-widest text-zinc-400">Cost
                                                Basis</span>
                                            <span class="text-xs font-bold text-zinc-600 dark:text-zinc-400">Rs.
                                                {{ number_format($product->purchase_price, 0) }}</span>
                                        </div>
                                        <div class="flex flex-col text-right">
                                            <span class="text-[9px] font-black uppercase tracking-widest text-zinc-400">Dlv.
                                                Fee</span>
                                            <span class="text-xs font-bold text-zinc-600 dark:text-zinc-400">Rs.
                                                {{ number_format($product->delivery_charges, 0) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endswitch

            <!-- Pagination -->
            <div class="flex justify-center">
                {{ $products->links() }}
            </div>
        @else
            <!-- Empty State (No Products Found) -->
            <div
                class="flex flex-col items-center justify-center rounded-3xl border border-zinc-200 bg-white py-20 dark:border-zinc-800 dark:bg-zinc-900 shadow-sm">
                <div class="relative mb-8">
                    <div class="absolute inset-0 bg-emerald-500/20 blur-[60px] rounded-full"></div>
                    <div
                        class="relative flex size-24 items-center justify-center rounded-3xl bg-emerald-50 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-400 ring-8 ring-emerald-500/5">
                        <flux:icon.package-search class="size-12" />
                    </div>
                </div>
                <div class="text-center max-w-sm px-6">
                    <h3 class="text-lg font-black text-zinc-900 dark:text-white uppercase tracking-tight">Vault is Empty
                    </h3>
                    <p class="mt-2 text-sm font-medium text-zinc-500 leading-relaxed">
                        We couldn't locate any items matching your parameters. Refine your search or initialize a new asset.
                    </p>
                    <div class="mt-8 flex justify-center">
                        <flux:button href="{{ route('products.create') }}" wire:navigate variant="primary"
                            icon="plus" class="bg-emerald-600">Initialize Product</flux:button>
                    </div>
                </div>
            </div>
        @endif

        <!-- Floating Intelligence Bar -->
        @if (count($selectedProducts) > 0)
            <div class="fixed bottom-8 left-1/2 -translate-x-1/2 z-50 animate-in slide-in-from-bottom-8 duration-500">
                <div
                    class="flex items-center gap-6 rounded-2xl border border-white/20 bg-zinc-950/90 py-3 px-5 shadow-2xl backdrop-blur-xl ring-1 ring-white/10">
                    <div class="flex items-center gap-3 border-r border-white/10 pr-6">
                        <div
                            class="flex size-7 items-center justify-center rounded-full bg-emerald-500 text-[10px] font-black text-white shadow-lg shadow-emerald-500/40">
                            {{ count($selectedProducts) }}
                        </div>
                        <span class="text-xs font-black uppercase tracking-widest text-white">Selection Active</span>
                    </div>

                    <div class="flex items-center gap-3">
                        <flux:modal.trigger name="bulk-change-category">
                            <button
                                class="flex items-center gap-2 rounded-xl bg-white/10 px-4 py-2 text-xs font-black uppercase tracking-widest text-white hover:bg-white/20 transition-all border border-white/5">
                                <flux:icon.tag class="size-3.5 text-emerald-400" />
                                Update Category
                            </button>
                        </flux:modal.trigger>

                        <button wire:click="clearSelection"
                            class="size-8 flex items-center justify-center rounded-xl bg-rose-500/20 text-rose-400 hover:bg-rose-500 hover:text-white transition-all border border-rose-500/20"
                            x-tooltip="Abort Selection">
                            <flux:icon.x class="size-4" />
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <!-- Bulk Change Category Modal -->
        <flux:modal name="bulk-change-category" class="max-w-md">
            <div class="space-y-6">
                <div class="flex items-start text-left gap-4">
                    <div
                        class="rounded-2xl bg-emerald-50 p-3 dark:bg-emerald-900/30 shrink-0 border border-emerald-100 dark:border-emerald-500/20">
                        <flux:icon.tag class="size-6 text-emerald-600 dark:text-emerald-400" />
                    </div>
                    <div class="space-y-1">
                        <flux:heading size="lg" class="font-black uppercase tracking-tight">Recategorize Assets
                        </flux:heading>
                        <flux:text class="text-xs font-medium">
                            You are about to reassign <strong
                                class="text-emerald-600">{{ count($selectedProducts) }}</strong>
                            selected products to a new operational category.
                        </flux:text>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="space-y-2">
                        <flux:label class="text-[10px] font-black uppercase tracking-widest text-zinc-400">Target Category
                        </flux:label>
                        <flux:dropdown>
                            <flux:button
                                class="w-full justify-between bg-zinc-50 dark:bg-zinc-800 border-zinc-200 dark:border-zinc-700 hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-xl font-bold"
                                icon="tag" variant="subtle" right-icon="chevron-down">
                                <span class="truncate">
                                    {{ $categories->firstWhere('id', $targetCategory)->name ?? 'Select category...' }}
                                </span>
                            </flux:button>

                            <flux:menu class="max-h-60 overflow-y-auto min-w-[20rem]" anchor="bottom start">
                                @foreach ($categories as $category)
                                    <flux:menu.item wire:click="$set('targetCategory', {{ $category->id }})"
                                        class="font-bold text-xs uppercase tracking-widest">
                                        {{ $category->name }}
                                    </flux:menu.item>
                                @endforeach
                            </flux:menu>
                        </flux:dropdown>
                        <flux:error name="targetCategory" />
                    </div>
                </div>

                <div
                    class="flex flex-col-reverse sm:flex-row justify-end gap-3 pt-4 border-t border-zinc-100 dark:border-zinc-800">
                    <flux:modal.close>
                        <flux:button variant="ghost"
                            class="w-full sm:w-auto font-bold uppercase tracking-widest text-[10px]">
                            Cancel</flux:button>
                    </flux:modal.close>
                    <flux:button type="submit" variant="primary" wire:click="bulkChangeCategory"
                        class="w-full sm:w-auto bg-emerald-600 hover:bg-emerald-700 font-bold uppercase tracking-widest text-[10px]">
                        Confirm Reassignment
                    </flux:button>
                </div>
            </div>
        </flux:modal>
        <!-- Modals -->


    </div>
