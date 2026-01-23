<flux:modal name="view-product" :closable="false" class="min-w-[20rem] md:min-w-[40rem] space-y-6">
    <div x-data="{
        copy(text, label) {
            navigator.clipboard.writeText(text);
            window.dispatchEvent(new CustomEvent('toast', { detail: { message: label + ' copied to clipboard', type: 'success' } }));
        }
    }">
        @if ($selectedProduct)
            <div class="flex items-start justify-between gap-4">
                <div>
                    <flux:heading size="lg">{{ $selectedProduct->name }}</flux:heading>
                    <div class="flex items-center gap-2 mt-1">
                        <flux:subheading>Product ID:</flux:subheading>
                        <button @click="copy('{{ $selectedProduct->product_id }}', 'Product ID')"
                            class="font-mono text-sm font-medium text-blue-600 dark:text-blue-400 hover:underline cursor-pointer flex items-center gap-1"
                            title="Click to copy">
                            {{ $selectedProduct->product_id }}
                            <flux:icon.copy class="size-3 cursor-pointer" />
                        </button>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    @php
                        $margin =
                            $selectedProduct->retail_price > 0
                                ? round(
                                    (($selectedProduct->retail_price - $selectedProduct->purchase_price) /
                                        $selectedProduct->retail_price) *
                                        100,
                                    1,
                                )
                                : 0;
                    @endphp
                    <flux:badge color="{{ $margin > 0 ? 'green' : 'red' }}" size="sm">{{ $margin }}% Margin
                    </flux:badge>
                </div>
            </div>

            <flux:separator variant="subtle" class="my-6" />

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Product Image -->
                <div class="md:col-span-1">
                    @if ($selectedProduct->images->first()->image_path ?? false)
                        <img src="{{ Storage::url($selectedProduct->images->first()->image_path ?? false) }}"
                            alt="{{ $selectedProduct->name }}"
                            class="aspect-square rounded-xl object-cover border border-neutral-200 dark:border-neutral-700" />
                    @else
                        <div
                            class="aspect-square rounded-xl bg-neutral-100 dark:bg-neutral-800 flex items-center justify-center border border-neutral-200 dark:border-neutral-700">
                            <flux:icon.photo class="size-16 text-neutral-300 dark:text-neutral-600" />
                        </div>
                    @endif
                </div>

                <!-- Product Details -->
                <div class="md:col-span-2 space-y-6">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <flux:label>Description</flux:label>
                            <button @click="copy('{{ $selectedProduct->description ?? '' }}', 'Description')"
                                class="text-neutral-400 hover:text-neutral-600 dark:hover:text-neutral-200 transition-colors">
                                <flux:icon.copy class="size-4 cursor-pointer" />
                            </button>
                        </div>
                        <flux:textarea readonly rows="3">
                            {{ $selectedProduct->description ?? 'No description provided.' }}</flux:textarea>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <flux:label>Cost Price</flux:label>
                                <button @click="copy('{{ $selectedProduct->purchase_price }}', 'Cost Price')"
                                    class="text-neutral-400 hover:text-neutral-600 dark:hover:text-neutral-200 transition-colors">
                                    <flux:icon.copy class="size-4 cursor-pointer" />
                                </button>
                            </div>
                            <flux:input readonly value="Rs. {{ number_format($selectedProduct->purchase_price, 0) }}"
                                icon="banknotes" />
                        </div>

                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <flux:label>Retail Price</flux:label>
                                <button @click="copy('{{ $selectedProduct->retail_price }}', 'Retail Price')"
                                    class="text-neutral-400 hover:text-neutral-600 dark:hover:text-neutral-200 transition-colors">
                                    <flux:icon.copy class="size-4 cursor-pointer" />
                                </button>
                            </div>
                            <!-- Prominent Retail Price -->
                            <div class="relative">
                                <flux:input readonly value="Rs. {{ number_format($selectedProduct->retail_price, 0) }}"
                                    icon="tag" class="font-bold text-lg text-blue-600 dark:text-blue-400" />
                            </div>
                        </div>

                        @if ($selectedProduct->delivery_charges > 0)
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <flux:label>Delivery Charges</flux:label>
                                    <button
                                        @click="copy('{{ $selectedProduct->delivery_charges }}', 'Delivery Charges')"
                                        class="text-neutral-400 hover:text-neutral-600 dark:hover:text-neutral-200 transition-colors">
                                        <flux:icon.copy class="size-4 cursor-pointer" />
                                    </button>
                                </div>
                                <flux:input readonly
                                    value="Rs. {{ number_format($selectedProduct->delivery_charges, 0) }}"
                                    icon="truck" />
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-2 pt-4">
                <flux:modal.trigger name="edit-product">
                    <flux:button variant="primary" icon="pencil">Edit Product</flux:button>
                </flux:modal.trigger>
                <flux:modal.close>
                    <flux:button variant="ghost">Close</flux:button>
                </flux:modal.close>
            </div>
        @else
            <div class="py-12 flex flex-col items-center justify-center text-center space-y-4">
                <div class="animate-spin text-neutral-400">
                    <flux:icon.arrow-path class="size-8" />
                </div>
                <flux:heading>Loading Product Details...</flux:heading>
            </div>
        @endif
    </div>
</flux:modal>
