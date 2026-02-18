<?php

namespace App\Livewire\Products;

use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Inventory')]
#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    #[On('product-updated')]
    public function refresh()
    {
        $this->productService->clearStatsCache();
        $this->stats = $this->productService->calculateStats();
    }

    #[Reactive]
    public $viewType;

    public $search = '';

    public $sortBy = 'created_at';

    public $perPage = 12;

    public $selectedCategory = null;

    public $selectedProducts = [];

    public $targetCategory = '';

    public $stats = [];

    #[Computed]
    public function productService(): ProductService
    {
        return app(ProductService::class);
    }

    public function mount()
    {
        $this->stats = $this->productService->calculateStats();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedSelectedCategory()
    {
        $this->resetPage();
    }

    public function toggleCategory($categoryId)
    {
        if ($this->selectedCategory === $categoryId) {
            $this->selectedCategory = null;
        } else {
            $this->selectedCategory = $categoryId;
        }
    }

    public function deleteProduct($productId)
    {
        $product = Product::findOrFail($productId);

        if (! $product) {
            return;
        }

        $productName = $product->name;

        $this->productService->deleteProduct($product);

        $this->dispatch('toast', type: 'success', message: "Product '{$productName}' has been removed from inventory.");

        $this->resetPage();
    }

    public function bulkChangeCategory()
    {
        $this->validate([
            'targetCategory' => 'required|exists:categories,id',
            'selectedProducts' => 'required|array|min:1',
        ]);

        $count = $this->productService->assignCategoryToProducts($this->selectedProducts, (int) $this->targetCategory);

        $category = Category::find($this->targetCategory);

        if ($category) {
            $this->dispatch('toast', type: 'success', message: "Updated category for {$count} products to '{$category->name}'.");
        }

        $this->selectedProducts = [];
        $this->targetCategory = '';
        $this->dispatch('close-modal', name: 'bulk-change-category');
    }

    public function clearSelection()
    {
        $this->selectedProducts = [];
    }

    public function render()
    {
        $products = $this->productService->listProducts(
            search: $this->search,
            categoryId: $this->selectedCategory,
            sortBy: $this->sortBy,
            perPage: $this->perPage
        );
        $categories = $this->productService->getCategories();

        return view('livewire.products.index', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
