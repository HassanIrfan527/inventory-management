<flux:modal name="add-product" flyout variant="floating" class="space-y-6">
    <div>
        <flux:heading size="lg">Add Product</flux:heading>
        <flux:subheading>Add a new product to your inventory.</flux:subheading>
    </div>

    <flux:separator variant="subtle" />

    <form class="space-y-6" wire:submit.prevent="addProduct">
        <!-- Product Image -->
        <flux:field>
            <flux:label badge="Optional">Product Image</flux:label>
            <flux:input type="file" wire:model="product.temporaryUploadedFile" />
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
