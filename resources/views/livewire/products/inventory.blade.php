<?php

use App\Enums\ProductView;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Products Inventory')] #[Layout('layouts.app')] class extends Component
{
    public ProductView $viewType = ProductView::Grid;

    public $totalProducts = 0;

    public $totalInventoryValue = 0;

    public $avg_margin = 0;

    #[On('set-view-type')]
    public function setView(string $type)
    {
        $this->viewType = ProductView::tryFrom($type) ?? ProductView::Grid;
    }

    public function mount()
    {
        $this->totalProducts = Product::count();
        $this->totalInventoryValue = Product::totalInventoryValue();

        $totalRetail = Product::sum('retail_price');
        $totalPurchase = Product::sum('purchase_price');
        $this->avg_margin = $totalRetail > 0 ? (($totalRetail - $totalPurchase) / $totalRetail) * 100 : 0;
    }
};
?>

<div class="flex h-full w-full flex-1 flex-col gap-6">
    <!-- Page Header -->

    <div class="flex flex-row items-center justify-between gap-4 p-5">
        <div class="flex flex-col gap-1">
            <flux:heading size="xl" level="1">Products inventory</flux:heading>
            <flux:text size="sm" class="text-neutral-600 dark:text-neutral-400">
                Manage your product inventory and pricing.
            </flux:text>
        </div>
        <div>
            <flux:modal.trigger name="product-view-settings">
                <flux:button
                    square
                    variant="subtle"
                    size="sm"
                    icon="columns-3-cog"
                    aria-label="Inventory view settings"
                />
            </flux:modal.trigger>
        </div>
    </div>
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Total Products -->
        <div class="rounded-2xl border border-neutral-200 bg-white p-6 shadow-sm dark:border-neutral-700 dark:bg-neutral-900">
            <div class="flex items-center justify-between">
                <div class="flex flex-col gap-1">
                    <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Total Products</p>
                    <p class="text-2xl font-bold text-neutral-900 dark:text-white">{{ $totalProducts }}</p>
                </div>
                <div class="rounded-xl bg-blue-50 p-3 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">
                    <flux:icon.box class="w-6 h-6" />
                </div>
            </div>
        </div>

        <!-- Avg. Profit Margin -->
        <div class="rounded-2xl border border-neutral-200 bg-white p-6 shadow-sm dark:border-neutral-700 dark:bg-neutral-900">
            <div class="flex items-center justify-between">
                <div class="flex flex-col gap-1">
                    <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Avg. Profit Margin</p>
                    <p class="text-2xl font-bold text-neutral-900 dark:text-white">
                        {{ round($avg_margin, 1) }}%
                    </p>
                </div>
                <div class="rounded-xl bg-orange-50 p-3 text-orange-600 dark:bg-orange-900/30 dark:text-orange-400">
                    <flux:icon.trending-up class="w-6 h-6" />
                </div>
            </div>
        </div>

        <!-- Total Inventory Value -->
        <div class="rounded-2xl border border-neutral-200 bg-white p-6 shadow-sm dark:border-neutral-700 dark:bg-neutral-900">
            <div class="flex items-center justify-between">
                <div class="flex flex-col gap-1">
                    <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Total Inventory Value</p>
                    <p class="text-2xl font-bold text-neutral-900 dark:text-white">Rs.
                        {{ $totalInventoryValue }}</p>
                </div>
                <div class="rounded-xl bg-purple-50 p-3 text-purple-600 dark:bg-purple-900/30 dark:text-purple-400">
                    <flux:icon.banknote class="w-6 h-6" />
                </div>
            </div>
        </div>
    </div>

    <!-- Settings Modal -->
    <livewire:products.modals.product-view-settings :viewType="$viewType" />

    <!-- Products Section -->
    <livewire:products.index :viewType="$viewType" />
    <livewire:products.modals.add-product />
    <livewire:products.modals.product-details />
</div>
