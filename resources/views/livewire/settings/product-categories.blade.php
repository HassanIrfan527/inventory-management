<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Product Categories')" :subheading="__('Manage your product categories here.')">
        <div class="space-y-6">
            <!-- Add Category Section -->
            <div class="flex items-center gap-4">
                <flux:input wire:model="name" placeholder="New Category Name" class="flex-1" />
                <flux:button variant="primary" wire:click="addCategory" icon="plus">Add Category</flux:button>
            </div>

            <flux:separator />

            <!-- Categories Grid -->
            @if($categories->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($categories as $category)
                        <div wire:key="category-{{ $category->id }}"
                             class="group relative flex items-center justify-between p-4 rounded-xl border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-neutral-900 transition-all hover:shadow-md"
                             x-data="{ isEditing: false, name: '{{ addslashes($category->name) }}' }">

                            <!-- View Mode -->
                            <div x-show="!isEditing" class="flex-1 flex items-center justify-between">
                                <span class="font-medium text-neutral-900 dark:text-white truncate cursor-pointer"
                                      @click="isEditing = true; $nextTick(() => $refs.input.focus())"
                                      title="Click to edit">
                                    {{ $category->name }}
                                </span>
                                <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button @click="isEditing = true; $nextTick(() => $refs.input.focus())"
                                            class="text-neutral-500 hover:text-blue-600 dark:hover:text-blue-400 p-1 rounded-md hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors">
                                        <flux:icon icon="pencil" class="w-4 h-4" />
                                    </button>
                                    <button wire:confirm="Are you sure you want to delete this category?"
                                            wire:click="deleteCategory({{ $category->id }})"
                                            class="text-neutral-500 hover:text-red-600 dark:hover:text-red-400 p-1 rounded-md hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors">
                                        <flux:icon icon="trash-2" class="w-4 h-4" />
                                    </button>
                                </div>
                            </div>

                            <!-- Edit Mode -->
                            <div x-show="isEditing" class="flex-1 flex items-center gap-2" x-cloak>
                                <input x-ref="input"
                                       x-model="name"
                                       @keydown.enter="isEditing = false; $wire.updateCategory({{ $category->id }}, name)"
                                       @click.outside="isEditing = false; $wire.updateCategory({{ $category->id }}, name)"
                                       class="w-full bg-transparent border-0 border-b-2 border-blue-500 focus:ring-0 px-0 py-1 text-neutral-900 dark:text-white font-medium placeholder-neutral-400" />
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-neutral-100 dark:bg-neutral-800 mb-4">
                        <flux:icon icon="tag" class="w-6 h-6 text-neutral-400" />
                    </div>
                    <h3 class="text-lg font-medium text-neutral-900 dark:text-white">No categories yet</h3>
                    <p class="text-neutral-500 mt-1">Add your first category above to get started.</p>
                </div>
            @endif
        </div>
    </x-settings.layout>
</section>
