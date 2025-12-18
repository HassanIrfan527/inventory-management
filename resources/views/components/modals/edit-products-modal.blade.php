<flux:modal name="edit-product" class="min-w-[20rem] md:min-w-[40rem] space-y-6" :closable="false">
    <div x-data="{
        copy(text, label) {
            navigator.clipboard.writeText(text);
            window.dispatchEvent(new CustomEvent('toast', { detail: { message: label + ' copied to clipboard', type: 'success' } }));
        }
    }">
        @if ($selectedProduct)
            <div class="flex items-start justify-between gap-4">
                <div>
                    <flux:heading size="lg">Edit Product</flux:heading>
                    <flux:subheading>Update product information below.</flux:subheading>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-sm text-neutral-500 dark:text-neutral-400">ID:</span>
                    <button @click="copy('{{ $selectedProduct->product_id }}', 'Product ID')"
                        class="font-mono text-sm font-medium hover:text-blue-600 dark:hover:text-blue-400 cursor-pointer flex items-center gap-1 transition-colors">
                        {{ $selectedProduct->product_id }}
                        <flux:icon.copy class="size-3 cursor-pointer" />
                    </button>
                </div>
            </div>

            <flux:separator variant="subtle" class="my-6" />

            <form wire:submit.prevent="save" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Product Image -->
                <div class="md:col-span-1 space-y-4">
                    <div
                        class="aspect-square rounded-xl bg-neutral-100 dark:bg-neutral-800 flex items-center justify-center border border-neutral-200 dark:border-neutral-700 relative group overflow-hidden">
                        <flux:icon.photo class="size-16 text-neutral-300 dark:text-neutral-600" />
                        <!-- Placeholder for image upload if needed later -->
                        <div
                            class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                            <span class="text-white text-xs font-medium">Change Image</span>
                        </div>
                    </div>
                </div>

                <!-- Edit Form -->
                <div class="md:col-span-2 space-y-6">
                    <flux:field>
                        <div class="flex justify-between items-center mb-1.5">
                            <flux:label>Product Name</flux:label>

                        </div>
                        <flux:input value="{{ $selectedProduct->name }}" required />
                        <flux:error name="selectedProduct.name" />
                    </flux:field>

                    <flux:field>
                        <div class="flex justify-between items-center mb-1.5">
                            <flux:label>Description</flux:label>
                        </div>
                        <flux:textarea rows="3" resize="none">{{ $selectedProduct->description }}</flux:textarea>
                        <flux:error name="selectedProduct.description" />
                    </flux:field>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <flux:field>
                            <div class="flex justify-between items-center mb-1.5">
                                <flux:label>Cost Price</flux:label>

                            </div>
                            <flux:input type="number" value="{{ number_format($selectedProduct->purchase_price, 0) }}"
                                icon="banknotes" />
                            <flux:error name="selectedProduct.purchase_price" />
                        </flux:field>

                        <flux:field>
                            <div class="flex justify-between items-center mb-1.5">
                                <flux:label>Retail Price</flux:label>

                            </div>
                            <div class="relative">
                                <flux:input type="number"
                                    value="{{ number_format($selectedProduct->retail_price, 0) }}" icon="tag"
                                    class="font-bold text-lg text-blue-600 dark:text-blue-400" />
                            </div>
                            <flux:error name="selectedProduct.retail_price" />
                        </flux:field>

                        <flux:field>

                            <div class="flex justify-between items-center mb-1.5">
                                <flux:label>Delivery Charges</flux:label>

                            </div>



                            <flux:input type="number"
                                value="{{ number_format($selectedProduct->delivery_charges, 0) }}" />
                            <flux:error name="selectedProduct.delivery_charges" />


                        </flux:field>
                    </div>
                </div>
            </form>

            <div class="flex justify-end gap-2 pt-4">
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button variant="primary" wire:click="save">Save Changes</flux:button>
            </div>
        @else
            <div class="py-12 flex flex-col items-center justify-center text-center space-y-4">
                <div class="animate-spin text-neutral-400">
                    <flux:icon.arrow-path class="size-8" />
                </div>
                <flux:heading>Loading...</flux:heading>
            </div>
        @endif
    </div>
</flux:modal>
