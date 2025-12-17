@props([
    'title' => 'Delete Item',
    'message' => 'Are you sure you want to delete this item? This action cannot be undone.',
    'confirmText' => 'Delete',
    'cancelText' => 'Cancel',
    'isDangerous' => true,
])

<div
    x-show="showDeleteModal"
    x-cloak
    x-transition
    style="display: none;"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 dark:bg-black/70"
    @keydown.window.escape="showDeleteModal = false"
    role="alertdialog"
>
     <div
        x-show="showDeleteModal"
        x-cloak
        x-transition
        style="display: none;"
        @click.away="showDeleteModal = false"
        class="relative w-full max-w-sm mx-4 rounded-lg bg-white dark:bg-neutral-900 shadow-lg"
    >
        <!-- Close Button -->
        <button @click="showDeleteModal = false"
            class="absolute top-4 right-4 text-neutral-500 hover:text-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-200 transition-colors"
            aria-label="Close modal">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Modal Content -->
        <div class="p-6">
            <!-- Icon -->
            <div class="flex justify-center mb-4">
                <div class="rounded-full bg-red-100 dark:bg-red-900/30 p-3">
                    <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </div>
            </div>

            <!-- Title -->
            <h3 class="text-lg font-semibold text-neutral-900 dark:text-white text-center mb-2">
                {{ $title }}
            </h3>

            <!-- Message -->
            <p class="text-sm text-neutral-600 dark:text-neutral-400 text-center mb-6">
                {{ $message }}
            </p>

            <!-- Action Buttons -->
            <div class="flex gap-3">
                <button
                    class="flex-1 px-4 py-2.5 rounded-lg border border-neutral-300 text-neutral-700 font-medium hover:bg-neutral-50 transition-colors dark:border-neutral-600 dark:text-neutral-300 dark:hover:bg-neutral-800">
                    {{ $cancelText }}
                </button>
                <button @click="handleDelete()" :disabled="isDeleting"
                    class="flex-1 px-4 py-2.5 rounded-lg bg-red-600 text-white font-medium hover:bg-red-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed dark:bg-red-500 dark:hover:bg-red-600">
                    <span x-show="!isDeleting">{{ $confirmText }}</span>
                    <span x-show="isDeleting" class="flex items-center justify-center gap-2">
                        <svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
                        </svg>
                        Deleting...
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
