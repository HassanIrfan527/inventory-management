<flux:modal name="add-product" flyout variant="floating" class="space-y-6">
    <div>
        <flux:heading size="lg">Add Product</flux:heading>
        <flux:subheading>Add a new product to your inventory.</flux:subheading>
    </div>

    <flux:separator variant="subtle" />

    <form class="space-y-6" wire:submit.prevent="addProduct">
        <!-- Product Image -->
        <!-- Product Images -->
        <flux:field>
            <flux:label badge="Optional">Product Images</flux:label>
            
            <div x-data="{
                previews: [],
                handleFileSelect(event) {
                    this.previews = [];
                    const files = event.target.files;
                    for (let i = 0; i < files.length; i++) {
                        const file = files[i];
                        if (file.type.startsWith('image/')) {
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                this.previews.push(e.target.result);
                            };
                            reader.readAsDataURL(file);
                        }
                    }
                }
            }">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4" x-show="previews.length > 0">
                    <template x-for="(preview, index) in previews" :key="index">
                        <div class="relative group aspect-square rounded-xl overflow-hidden border border-neutral-200 dark:border-neutral-700">
                             <img :src="preview" class="w-full h-full object-cover">
                        </div>
                    </template>
                </div>

                <div class="flex items-center justify-center w-full">
                    <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-32 border-2 border-neutral-300 border-dashed rounded-xl cursor-pointer bg-neutral-50 dark:hover:bg-neutral-800 dark:bg-neutral-900 hover:bg-neutral-100 dark:border-neutral-700 dark:hover:border-neutral-500 transition-all">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <flux:icon.cloud-arrow-up class="w-8 h-8 mb-3 text-neutral-500 dark:text-neutral-400" />
                            <p class="mb-2 text-sm text-neutral-500 dark:text-neutral-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                            <p class="text-xs text-neutral-500 dark:text-neutral-400">SVG, PNG, JPG or GIF (MAX. 10MB)</p>
                        </div>
                        <input id="dropzone-file" type="file" multiple class="hidden" wire:model="product.product_images" @change="handleFileSelect" />
                    </label>
                </div> 
                <flux:error name="product.product_images" />
                 <flux:error name="product.product_images.*" />
            </div>
        </flux:field>

        <!-- Product Details -->
        <flux:field>
            <flux:label badge="Required">Product Name</flux:label>
            <flux:input placeholder="e.g. Wireless Headphones" wire:model="product.name" />
        </flux:field>

        <flux:field>
            <flux:label badge="Required">Description</flux:label>
            <flux:textarea rows="3" resize="none" placeholder="Enter product description..."
                wire:model="product.description" />
        </flux:field>

            <flux:field>
                <flux:label badge="Optional">Categories</flux:label>
                <flux:dropdown class="w-full">
                    <flux:button class="w-full justify-between" icon="tag" variant="outline" right-icon="chevron-down">
                        <span class="truncate">Select categories...</span>
                    </flux:button>

                    <flux:menu class="max-h-60 overflow-y-auto" anchor="start">
                        @foreach ($allCategories as $category)
                            <flux:menu.item wire:click="toggleCategory({{ $category->id }})" icon="{{ in_array($category->id, $product->categories) ? 'check' : '' }}">
                                {{ $category->name }}
                            </flux:menu.item>
                        @endforeach
                    </flux:menu>
                </flux:dropdown>

                @if (count($product->categories) > 0)
                    <div class="flex flex-wrap gap-2 mt-2">
                        @foreach ($allCategories->whereIn('id', $product->categories) as $category)
                            <flux:badge color="blue" removable wire:click="toggleCategory({{ $category->id }})">
                                {{ $category->name }}
                            </flux:badge>
                        @endforeach
                    </div>
                @endif
            </flux:field>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <flux:field>
                <flux:label badge="Required">Cost Price</flux:label>
                <flux:input type="number" step="0.01" icon="banknotes" placeholder="0.00"
                    wire:model="product.cost_price" />
            </flux:field>

            <flux:field>
                <flux:label badge="Required">Retail Price</flux:label>
                <flux:input type="number" step="0.01" icon="tag" placeholder="0.00"
                    wire:model="product.retail_price" />
            </flux:field>
            <flux:field>
                <flux:label badge="Optional">Delivery Charges</flux:label>
                <flux:input type="number" step="0.01" icon="truck" placeholder="0.00"
                    wire:model="product.delivery_charges" />
            </flux:field>

        </div>

        <flux:button type="submit" variant="primary" color="blue" class="w-full">
            Add Product
        </flux:button>
    </form>
</flux:modal>
