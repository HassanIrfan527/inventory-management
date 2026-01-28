<div>
    <flux:modal name="product-details" class="min-w-[20rem] md:min-w-[40rem] space-y-6" :closable="false">
        <div x-data="{
            copy(text, label) {
                navigator.clipboard.writeText(text);
                window.dispatchEvent(new CustomEvent('toast', { detail: { message: label + ' copied to clipboard', type: 'success' } }));
            },
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
            @if ($product)
                @if(!$isEditMode)
                    {{-- VIEW MODE --}}
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <flux:heading size="lg">{{ $product->name }}</flux:heading>
                            <div class="flex items-center gap-2 mt-1">
                                <flux:subheading>Product ID:</flux:subheading>
                                <button @click="copy('{{ $product->product_id }}', 'Product ID')"
                                    class="font-mono text-sm font-medium text-blue-600 dark:text-blue-400 hover:underline cursor-pointer flex items-center gap-1"
                                    title="Click to copy">
                                    {{ $product->product_id }}
                                    <flux:icon.copy class="size-3 cursor-pointer" />
                                </button>
                            </div>
                            @if ($product->categories->isNotEmpty())
                                <div class="mt-4 flex flex-wrap gap-2">
                                    @foreach ($product->categories as $category)
                                        <div
                                            class="px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300 border border-blue-200 dark:border-blue-800">
                                            {{ $category->name }}
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="flex items-center gap-2">
                            @php
                                $margin =
                                    $product->retail_price > 0
                                        ? round(
                                            (($product->retail_price - $product->purchase_price) / $product->retail_price) *
                                                100,
                                            1,
                                        )
                                        : 0;
                            @endphp
                            <flux:badge color="{{ $margin > 0 ? 'green' : 'red' }}" size="sm">{{ $margin }}%
                                Margin</flux:badge>
                        </div>
                    </div>

                    <flux:separator variant="subtle" class="my-6" />

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Product Images -->
                        <div class="md:col-span-1">
                            @if ($product->images->count() > 0)
                                <div x-data="{ mainImage: '{{ Storage::url($product->images->first()->image_path) }}' }" class="space-y-4">

                                    <div
                                        class="aspect-square rounded-xl overflow-hidden border border-neutral-200 dark:border-neutral-700">
                                        <img :src="mainImage"
                                            class="w-full h-full object-cover transition-all duration-300">
                                    </div>

                                    @if ($product->images->count() > 1)
                                        <div class="grid grid-cols-4 gap-2">
                                            @foreach ($product->images as $image)
                                                @php $url = Storage::url($image->image_path); @endphp
                                                <div @click="mainImage = '{{ $url }}'"
                                                    class="aspect-square rounded-lg overflow-hidden border border-neutral-200 dark:border-neutral-700 cursor-pointer hover:opacity-80 transition-opacity"
                                                    :class="{ 'ring-2 ring-blue-500 border-transparent': mainImage === '{{ $url }}' }">
                                                    <img src="{{ $url }}" class="w-full h-full object-cover">
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
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
                                    <button @click="copy('{{ $product->description ?? '' }}', 'Description')"
                                        class="text-neutral-400 hover:text-neutral-600 dark:hover:text-neutral-200 transition-colors">
                                        <flux:icon.copy class="size-4 cursor-pointer" />
                                    </button>
                                </div>
                                <flux:textarea readonly rows="3">
                                    {{ $product->description ?? 'No description provided.' }}</flux:textarea>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <flux:label>Cost Price</flux:label>
                                        <button @click="copy('{{ $product->purchase_price }}', 'Cost Price')"
                                            class="text-neutral-400 hover:text-neutral-600 dark:hover:text-neutral-200 transition-colors">
                                            <flux:icon.copy class="size-4 cursor-pointer" />
                                        </button>
                                    </div>
                                    <flux:input readonly value="Rs. {{ number_format($product->purchase_price, 0) }}"
                                        icon="banknotes" />
                                </div>

                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <flux:label>Retail Price</flux:label>
                                        <button @click="copy('{{ $product->retail_price }}', 'Retail Price')"
                                            class="text-neutral-400 hover:text-neutral-600 dark:hover:text-neutral-200 transition-colors">
                                            <flux:icon.copy class="size-4 cursor-pointer" />
                                        </button>
                                    </div>
                                    <!-- Prominent Retail Price -->
                                    <div class="relative">
                                        <flux:input readonly value="Rs. {{ number_format($product->retail_price, 0) }}"
                                            icon="tag" class="font-bold text-lg text-blue-600 dark:text-blue-400" />

                                    </div>
                                </div>

                                @if ($product->delivery_charges > 0)
                                    <div>
                                        <div class="flex items-center justify-between mb-2">
                                            <flux:label>Delivery Charges</flux:label>
                                            <button @click="copy('{{ $product->delivery_charges }}', 'Delivery Charges')"
                                                class="text-neutral-400 hover:text-neutral-600 dark:hover:text-neutral-200 transition-colors">
                                                <flux:icon.copy class="size-4 cursor-pointer" />
                                            </button>
                                        </div>
                                        <flux:input readonly value="Rs. {{ number_format($product->delivery_charges, 0) }}"
                                            icon="truck" />
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 pt-4">
                        <button wire:click="toggleEditMode"
                            class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-lg text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 bg-neutral-900 text-white hover:bg-neutral-900/90 dark:bg-neutral-50 dark:text-neutral-900 dark:hover:bg-neutral-50/90 h-10 px-4 py-2">
                            <flux:icon.pencil class="size-4" />
                            Edit Product
                        </button>
                        <flux:modal.close>
                            <flux:button variant="ghost">Close</flux:button>
                        </flux:modal.close>
                    </div>
                @else
                    {{-- EDIT MODE --}}
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <flux:heading size="lg">Edit Product</flux:heading>
                            <flux:subheading>Update product information below.</flux:subheading>
                        </div>
                        <div class="flex items-center gap-2">
                             <div class="font-mono text-sm font-medium dark:text-neutral-500 text-neutral-500">
                                {{ $product->product_id }}
                            </div>
                        </div>
                    </div>
        
                    <flux:separator variant="subtle" class="my-6" />
        
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Product Images -->
                        <div class="md:col-span-1 space-y-4">
                            <flux:label>Product Images</flux:label>
                            <div class="border border-neutral-200 dark:border-neutral-700 rounded-xl p-4 space-y-4">
                                <!-- Existing Images -->
                                @if($product->images->count() > 0)
                                    <div class="grid grid-cols-2 gap-2">
                                        @foreach($product->images as $image)
                                            <div class="relative group aspect-square rounded-lg overflow-hidden border border-neutral-200 dark:border-neutral-700">
                                                <img src="{{ Storage::url($image->image_path) }}" class="w-full h-full object-cover">
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-xs text-neutral-500 text-center py-4">No images uploaded.</div>
                                @endif
        
                                <flux:separator variant="subtle" />
        
                                <!-- Upload New -->
                                <div>
                                    <div class="grid grid-cols-2 gap-2 mb-2" x-show="previews.length > 0">
                                        <template x-for="(preview, index) in previews" :key="index">
                                            <div class="relative group aspect-square rounded-lg overflow-hidden border border-neutral-200 dark:border-neutral-700">
                                                <img :src="preview" class="w-full h-full object-cover">
                                            </div>
                                        </template>
                                    </div>
        
                                    <label for="edit-dropzone-file" class="flex flex-col items-center justify-center w-full h-24 border-2 border-neutral-300 border-dashed rounded-xl cursor-pointer bg-neutral-50 dark:hover:bg-neutral-800 dark:bg-neutral-900 hover:bg-neutral-100 dark:border-neutral-700 dark:hover:border-neutral-500 transition-all">
                                        <div class="flex flex-col items-center justify-center pt-2 pb-3">
                                            <flux:icon.plus class="w-6 h-6 mb-1 text-neutral-500 dark:text-neutral-400" />
                                            <p class="text-xs text-neutral-500 dark:text-neutral-400">Add Images</p>
                                        </div>
                                        <input id="edit-dropzone-file" type="file" multiple class="hidden" wire:model="form.new_product_images" @change="handleFileSelect" />
                                    </label>
                                    <flux:error name="form.new_product_images" />
                                    <flux:error name="form.new_product_images.*" />
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
        
                            <flux:field>
                                <flux:label badge="Optional">Categories</flux:label>
                                <flux:dropdown class="w-full">
                                    <flux:button class="w-full justify-between" icon="tag" variant="outline" right-icon="chevron-down">
                                        <span class="truncate">Select categories...</span>
                                    </flux:button>
        
                                    <flux:menu class="max-h-60 overflow-y-auto" anchor="start">
                                        @foreach ($allCategories as $category)
                                            <flux:menu.item wire:click="toggleCategory({{ $category->id }})" icon="{{ in_array($category->id, $form->categories) ? 'check' : '' }}">
                                                {{ $category->name }}
                                            </flux:menu.item>
                                        @endforeach
                                    </flux:menu>
                                </flux:dropdown>
        
                                @if (count($form->categories) > 0)
                                    <div class="flex flex-wrap gap-2 mt-2">
                                        @foreach ($allCategories->whereIn('id', $form->categories) as $category)
                                            <flux:badge color="blue" removable wire:click="toggleCategory({{ $category->id }})">
                                                {{ $category->name }}
                                            </flux:badge>
                                        @endforeach
                                    </div>
                                @endif
                                <flux:error name="form.categories" />
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
                    </div>
        
                    <div class="flex justify-end gap-2 pt-4">
                        <flux:button variant="ghost" wire:click="toggleEditMode">Cancel</flux:button>
                        <flux:button variant="primary" wire:click="save">Save Changes</flux:button>
                    </div>
                @endif
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
</div>
