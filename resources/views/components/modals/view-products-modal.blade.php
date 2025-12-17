@props(['selectedProduct' => null])

<flux:modal name="view-product" flyout variant="floating" class="md:w-3/4 lg:w-2/3">
    <div x-data="{ copying: false }" x-cloak class="p-4 sm:p-6">
        <div class="flex items-start justify-between gap-4 mb-3">
            <div>
                <h2 class="text-xl sm:text-2xl font-semibold text-neutral-900 dark:text-white">
                    {{ $selectedProduct ? $selectedProduct->name : 'Product details' }}
                </h2>
                <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-1">Quick overview of product information</p>
            </div>

            <div class="flex items-center gap-2">
                <flux:button variant="ghost" color="neutral" class="text-sm" @click="window.Flux && window.Flux.modal('view-product')?.hide()">
                    Close
                </flux:button>
            </div>
        </div>

        <div class="max-h-[78vh] overflow-y-auto pr-2">
            @if ($selectedProduct)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <!-- Image / Placeholder -->
                    <div class="md:col-span-1 rounded-lg overflow-hidden bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-neutral-800 dark:to-neutral-700 flex items-center justify-center aspect-square p-4">
                        <div class="text-center w-full">
                            <svg class="w-24 h-24 text-neutral-300 dark:text-neutral-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="text-xs text-neutral-500 dark:text-neutral-400 mt-3">No image available</p>
                        </div>
                    </div>

                    <!-- Details -->
                    <div class="md:col-span-2 space-y-4">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-medium text-neutral-900 dark:text-white truncate">{{ $selectedProduct->name }}</h3>
                                <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-2">{{ $selectedProduct->description ?? 'No description provided.' }}</p>
                            </div>

                            <div class="text-right">
                                <p class="text-xs text-neutral-500 dark:text-neutral-400">Created</p>
                                <p class="text-sm font-medium text-neutral-700 dark:text-neutral-300">{{ $selectedProduct->created_at ? $selectedProduct->created_at->format('d M Y, H:i') : '—' }}</p>
                                <p class="text-xs text-neutral-500 dark:text-neutral-400 mt-2">Updated</p>
                                <p class="text-sm text-neutral-700 dark:text-neutral-300">{{ $selectedProduct->updated_at ? $selectedProduct->updated_at->format('d M Y, H:i') : '—' }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div class="rounded-lg border border-neutral-200 bg-white p-3 dark:border-neutral-700 dark:bg-neutral-900">
                                <p class="text-xs text-neutral-500 dark:text-neutral-400">Product ID</p>
                                <div class="mt-1 flex items-center gap-2">
                                    <span class="text-sm font-mono text-neutral-800 dark:text-neutral-200 truncate">{{ $selectedProduct->product_id }}</span>
                                    <button x-on:click="copying = true; navigator.clipboard.writeText('{{ $selectedProduct->product_id }}').then(()=> copying = false)" class="ml-2 inline-flex items-center justify-center rounded px-2 py-1 text-xs bg-neutral-100 hover:bg-neutral-200 dark:bg-neutral-800 dark:hover:bg-neutral-700 text-neutral-700 dark:text-neutral-200 transition-colors cursor-pointer" title="Copy Product ID">
                                        <template x-if="!copying">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                            </svg>
                                        </template>
                                        <template x-if="copying">
                                            <svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
                                            </svg>
                                        </template>
                                    </button>
                                </div>
                            </div>

                            <div class="rounded-lg border border-neutral-200 bg-white p-3 dark:border-neutral-700 dark:bg-neutral-900">
                                <p class="text-xs text-neutral-500 dark:text-neutral-400">Retail Price</p>
                                <p class="mt-1 font-semibold text-neutral-900 dark:text-white">Rs. {{ number_format($selectedProduct->retail_price, 2) }}</p>
                            </div>

                            <div class="rounded-lg border border-neutral-200 bg-white p-3 dark:border-neutral-700 dark:bg-neutral-900">
                                <p class="text-xs text-neutral-500 dark:text-neutral-400">Cost Price</p>
                                <p class="mt-1 text-neutral-700 dark:text-neutral-300">Rs. {{ number_format($selectedProduct->purchase_price, 2) }}</p>
                            </div>
                        </div>

                        @if(!is_null($selectedProduct->delivery_charges) && $selectedProduct->delivery_charges > 0)
                            <div class="rounded-lg border border-neutral-200 bg-white p-3 dark:border-neutral-700 dark:bg-neutral-900">
                                <p class="text-xs text-neutral-500 dark:text-neutral-400">Delivery Charges</p>
                                <p class="mt-1 text-neutral-700 dark:text-neutral-300">Rs. {{ number_format($selectedProduct->delivery_charges, 2) }}</p>
                            </div>
                        @endif

                        <div class="flex items-center justify-between gap-4 pt-2">
                            <div>
                                <p class="text-xs text-neutral-500 dark:text-neutral-400">Margin</p>
                                <p class="mt-1 text-lg font-semibold" :class="{'text-green-600 dark:text-green-400': true}">
                                    {{ $selectedProduct->retail_price > 0 ? round((($selectedProduct->retail_price - $selectedProduct->purchase_price) / $selectedProduct->retail_price) * 100, 1) . '%' : '—' }}
                                </p>
                            </div>

                            <div class="flex items-center gap-2">
                                <flux:modal.trigger name="edit-product">
                                    <flux:button color="gray" variant="primary" class="text-sm" wire:click.prevent="showEditProduct({{ $selectedProduct->id }})">
                                        Edit
                                    </flux:button>
                                </flux:modal.trigger>

                                <flux:button variant="ghost" class="text-sm" @click="window.Flux && window.Flux.modal('view-product')?.hide()">
                                    Close
                                </flux:button>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="mt-6">
                    <div class="animate-pulse space-y-2">
                        <div class="h-6 bg-neutral-100 dark:bg-neutral-800 rounded w-1/3"></div>
                        <div class="h-4 bg-neutral-100 dark:bg-neutral-800 rounded w-2/3"></div>
                        <div class="grid grid-cols-3 gap-3 mt-4">
                            <div class="h-12 bg-neutral-100 dark:bg-neutral-800 rounded"></div>
                            <div class="h-12 bg-neutral-100 dark:bg-neutral-800 rounded"></div>
                            <div class="h-12 bg-neutral-100 dark:bg-neutral-800 rounded"></div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</flux:modal>
