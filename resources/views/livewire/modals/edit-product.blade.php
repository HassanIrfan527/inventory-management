<flux:modal name="edit-product" class="min-w-[20rem] md:min-w-[40rem] space-y-6" :closable="false">
    <div x-data="{
        copy(text, label) {
            navigator.clipboard.writeText(text);
            window.dispatchEvent(new CustomEvent('toast', { detail: { message: label + ' copied to clipboard', type: 'success' } }));
        }
    }">
        @if ($product)
            <div class="flex items-start justify-between gap-4">
                <div>
                    <flux:heading size="lg">Edit Product</flux:heading>
                    <flux:subheading>Update product information below.</flux:subheading>
                </div>
                <div class="flex items-center gap-2">
                    <button @click="copy('{{ $product->product_id }}', 'Product ID')"
                        class="font-mono text-sm font-medium dark:text-neutral-500 hover:text-blue-600 dark:hover:text-blue-400 cursor-pointer flex items-center gap-1 transition-colors">
                        {{ $product->product_id }}
                        <flux:icon.copy class="size-3 cursor-pointer" />
                    </button>
                </div>
            </div>

            <flux:separator variant="subtle" class="my-6" />

            <form wire:submit.prevent="save" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Product Image -->
                <div class="md:col-span-1 space-y-4">
                    <div class="space-y-4">
                        <div class="aspect-square rounded-xl bg-neutral-100 dark:bg-neutral-800 flex items-center justify-center border border-neutral-200 dark:border-neutral-700 relative group overflow-hidden">
                            @if ($form->temporaryUploadedFile)
                                <img src="{{ $form->temporaryUploadedFile->temporaryUrl() }}" class="w-full h-full object-cover" />
                            @elseif ($product->product_image)
                                <img src="{{ Storage::url($product->product_image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover" />
                            @else
                                <flux:icon.photo class="size-16 text-neutral-300 dark:text-neutral-600" />
                            @endif
                            <div class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                                <label for="edit-photo-upload" class="cursor-pointer text-white text-xs font-medium w-full h-full flex items-center justify-center">
                                    Change Image
                                    <input type="file" id="edit-photo-upload" wire:model="form.temporaryUploadedFile" class="hidden">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Form -->
                <div class="md:col-span-2 space-y-6">
                    <flux:field>
                        <div class="flex justify-between items-center mb-1.5">
                            <flux:label>Product Name</flux:label>
                        </div>
                        <flux:input wire:model="form.name" />
                        <flux:error name="form.name" />
                    </flux:field>

                    <flux:field>
                        <div class="flex justify-between items-center mb-1.5">
                            <flux:label>Description</flux:label>
                        </div>
                        <flux:textarea rows="3" wire:model="form.description" />
                        <flux:error name="form.description" />
                    </flux:field>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <flux:field>
                            <div class="flex justify-between items-center mb-1.5">
                                <flux:label>Cost Price</flux:label>
                            </div>
                            <flux:input type="number" step="0.01" icon="banknotes" wire:model="form.cost_price" />
                            <flux:error name="form.cost_price" />
                        </flux:field>

                        <flux:field>
                            <div class="flex justify-between items-center mb-1.5">
                                <flux:label>Retail Price</flux:label>
                            </div>
                            <div class="relative">
                                <flux:input type="number" step="0.01" icon="tag" wire:model="form.retail_price" class="font-bold text-lg text-blue-600 dark:text-blue-400" />
                            </div>
                            <flux:error name="form.retail_price" />
                        </flux:field>

                        <flux:field>
                            <div class="flex justify-between items-center mb-1.5">
                                <flux:label>Delivery Charges</flux:label>
                            </div>
                            <flux:input type="number" step="0.01" icon="truck" wire:model="form.delivery_charges" />
                            <flux:error name="form.delivery_charges" />
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
