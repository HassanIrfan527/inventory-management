@props([
    'itemId' => null,
    'itemName' => null,
    'title' => 'Delete Item',
    'message' => 'Are you sure you want to delete this item? This action cannot be undone.',
])


<flux:modal name="delete-modal" class="max-w-md">
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-start gap-4">
            <div class="rounded-full bg-red-50 p-3 dark:bg-red-950 shrink-0">
                <flux:icon icon="trash-2" class="h-6 w-6 text-red-600 dark:text-red-400" />
            </div>
            <div class="space-y-2">
                <flux:heading size="lg">{{ $title }}</flux:heading>
                <flux:text class="leading-relaxed">{{ $message }}</flux:text>
                @if ($itemName)
                    <p class="font-bold text-zinc-900 dark:text-zinc-100">{{ $itemName }}</p>
                @endif
            </div>
        </div>

        <!-- Warning Callout -->
        <flux:callout icon="circle-alert" variant="warning" class="text-sm">
            This action cannot be undone and will permanently remove this record from calculations.
        </flux:callout>

        <!-- Actions -->
        <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 pt-2">
            <flux:modal.close>
                <flux:button variant="ghost" class="w-full sm:w-auto">Cancel</flux:button>
            </flux:modal.close>
            <flux:button variant="danger" @click="$wire.deleteContact({{ $itemId }})" wire:loading.attr="disabled" class="w-full sm:w-auto">
                <flux:icon icon="trash-2" variant="mini" />
                Delete Permanently
            </flux:button>
        </div>
    </div>
</flux:modal>
