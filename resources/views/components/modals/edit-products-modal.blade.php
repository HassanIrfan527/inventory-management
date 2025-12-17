<div
    x-show="showEditModal"
    x-transition
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 dark:bg-black/70 p-4"
    @keydown.escape="showEditModal = false"
>
    <div
        x-show="showEditModal"
        x-transition
        @click.away="showEditModal = false"
        class="relative w-full max-w-2xl max-h-[90vh] overflow-y-auto rounded-lg bg-white dark:bg-neutral-900 shadow-lg"
    >
        <!-- Close Button -->
        <button
            @click="showEditModal = false"
            class="sticky top-4 right-4 float-right text-neutral-500 hover:text-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-200 transition-colors z-10"
            aria-label="Close modal"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Modal Content -->
        <template x-if="selectedProduct">
            <div class="p-6 sm:p-8">
            <!-- Header -->
            <h3 class="text-2xl font-bold text-neutral-900 dark:text-white mb-6">Edit Product</h3>

            <!-- Form -->
            <form @submit.prevent="submitEdit" class="space-y-6">
                <!-- Product ID (Read-only) -->
                <div>
                    <label class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300 mb-2">Product ID</label>
                    <input
                        type="text"
                        x-model="selectedProduct.product_id"
                        disabled
                        class="w-full px-4 py-2 rounded-lg border border-neutral-300 bg-neutral-50 text-neutral-900 dark:border-neutral-600 dark:bg-neutral-800 dark:text-white disabled:opacity-50"
                    >
                </div>

                <!-- Product Name -->
                <div>
                    <label class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300 mb-2">Product Name *</label>
                    <input
                        type="text"
                        x-model="selectedProduct.name"
                        required
                        class="w-full px-4 py-2 rounded-lg border border-neutral-300 bg-white text-neutral-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition-colors dark:border-neutral-600 dark:bg-neutral-800 dark:text-white dark:focus:border-blue-400"
                    >
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300 mb-2">Description</label>
                    <textarea
                        x-model="selectedProduct.description"
                        rows="3"
                        class="w-full px-4 py-2 rounded-lg border border-neutral-300 bg-white text-neutral-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition-colors resize-none dark:border-neutral-600 dark:bg-neutral-800 dark:text-white dark:focus:border-blue-400"
                    ></textarea>
                </div>

                <!-- Pricing Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Cost Price -->
                    <div>
                        <label class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300 mb-2">Cost Price *</label>
                        <input
                            type="number"
                            step="0.01"
                            x-model.number="selectedProduct.purchase_price"
                            required
                            class="w-full px-4 py-2 rounded-lg border border-neutral-300 bg-white text-neutral-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition-colors dark:border-neutral-600 dark:bg-neutral-800 dark:text-white dark:focus:border-blue-400"
                        >
                    </div>

                    <!-- Delivery Charges -->
                    <div>
                        <label class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300 mb-2">Delivery Charges</label>
                        <input
                            type="number"
                            step="0.01"
                            x-model.number="selectedProduct.delivery_charges"
                            class="w-full px-4 py-2 rounded-lg border border-neutral-300 bg-white text-neutral-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition-colors dark:border-neutral-600 dark:bg-neutral-800 dark:text-white dark:focus:border-blue-400"
                        >
                    </div>

                    <!-- Retail Price -->
                    <div>
                        <label class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300 mb-2">Retail Price *</label>
                        <input
                            type="number"
                            step="0.01"
                            x-model.number="selectedProduct.retail_price"
                            required
                            class="w-full px-4 py-2 rounded-lg border border-neutral-300 bg-white text-neutral-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition-colors dark:border-neutral-600 dark:bg-neutral-800 dark:text-white dark:focus:border-blue-400"
                        >
                    </div>
                </div>

                <!-- Margin Display -->
                <div class="rounded-lg bg-blue-50 dark:bg-blue-900/20 p-4 border border-blue-200 dark:border-blue-800">
                    <p class="text-sm text-blue-600 dark:text-blue-400 font-medium">Calculated Margin:
                        <span class="font-bold" x-text="selectedProduct?.margin?.toFixed(1)"></span>%
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 pt-4">
                    <button
                        type="button"
                        @click="showEditModal = false"
                        class="flex-1 px-4 py-2.5 rounded-lg border border-neutral-300 text-neutral-700 font-medium hover:bg-neutral-50 transition-colors dark:border-neutral-600 dark:text-neutral-300 dark:hover:bg-neutral-800"
                    >
                        Cancel
                    </button>
                    <button
                        type="submit"
                        :disabled="isUpdating"
                        class="flex-1 px-4 py-2.5 rounded-lg bg-blue-600 text-white font-medium hover:bg-blue-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed dark:bg-blue-500 dark:hover:bg-blue-600"
                    >
                        <span x-show="!isUpdating">Save Changes</span>
                        <span x-show="isUpdating" class="flex items-center justify-center gap-2">
                            <svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
                            </svg>
                            Saving...
                        </span>
                    </button>
                </div>
            </form>
            </div>
        </template>
    </div>
</div>
