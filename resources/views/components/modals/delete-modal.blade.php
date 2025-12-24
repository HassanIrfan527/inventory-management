@props([
    'itemId' => null,
    'itemName' => null,
    'title' => 'Delete Item',
    'message' => 'Are you sure you want to delete this item? This action cannot be undone.',
])


<flux:modal name="delete-modal" :title="$title" class="max-w-sm">
    <div class="space-y-6">
        <!-- Icon and Message -->
        <div class="flex flex-col items-center gap-4 text-center">
            <div class="rounded-full bg-red-50 p-3 dark:bg-red-950">
                <flux:icon icon="trash-2" class="h-6 w-6 text-red-600 dark:text-red-400" />
            </div>
            <div class="space-y-2">
                <p class="text-sm text-zinc-600 dark:text-zinc-400">{{ $message }}</p>
                @if ($itemName)
                    <p class="font-semibold text-zinc-900 dark:text-zinc-100">{{ $itemName }}</p>
                @endif
            </div>
        </div>

        <!-- Warning Callout -->
        <flux:callout icon="circle-alert" variant="warning" class="text-sm">
            This action cannot be undone.
        </flux:callout>
    </div>

    <!-- Actions -->
    <div class="mt-8 flex justify-end gap-2">
        <flux:modal.close>
            <flux:button variant="subtle">Cancel</flux:button>
        </flux:modal.close>
        <flux:button variant="danger" @click="$wire.deleteContact({{ $itemId }})" wire:loading.attr="disabled">
            <flux:icon icon="trash-2" variant="micro" />
            Delete
        </flux:button>
    </div>
</flux:modal>
