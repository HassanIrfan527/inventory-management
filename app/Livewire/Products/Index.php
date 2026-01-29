<?php

namespace App\Livewire\Products;

use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[On('product-added')]
    public function refresh()
    {
        $this->render();
    }

    #[Reactive]
    public $viewType;

    public $search = '';

    public $sortBy = 'created_at';

    public $perPage = 12;

    public $selectedCategory = null;

    public $selectedProducts = [];

    public $targetCategory = '';

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
        $product = Product::find($productId);

        if (! $product) {
            return;
        }

        $productName = $product->name;

        $productService = app(ProductService::class);
        $productService->deleteProduct($product);

        $this->dispatch('toast', type: 'success', message: "Product '{$productName}' has been removed from inventory.");

        $this->resetPage();
    }

    public function bulkChangeCategory()
    {
        $this->validate([
            'targetCategory' => 'required|exists:categories,id',
            'selectedProducts' => 'required|array|min:1',
        ]);

        $productService = app(ProductService::class);

        $count = $productService->assignCategoryToProducts($this->selectedProducts, (int) $this->targetCategory);

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

    public function toggleAll()
    {
        $productsOnPage = Product::query()
            ->when($this->search, function ($query) {
                return $query->where('name', 'like', "%{$this->search}%")
                    ->orWhere('product_id', 'like', "%{$this->search}%");
            })
            ->when($this->selectedCategory, function ($query) {
                return $query->whereHas('categories', function ($q) {
                    $q->where('categories.id', $this->selectedCategory);
                });
            })
            ->paginate($this->perPage)
            ->pluck('id')
            ->map(fn ($id) => (string) $id)
            ->toArray();

        $allSelected = count(array_intersect($productsOnPage, $this->selectedProducts)) === count($productsOnPage);

        if ($allSelected) {
            $this->selectedProducts = array_diff($this->selectedProducts, $productsOnPage);
        } else {
            $this->selectedProducts = array_unique(array_merge($this->selectedProducts, $productsOnPage));
        }
    }

    public function render()
    {
        $products = Product::query()
            ->when($this->search, function ($query) {
                return $query->where('name', 'like', "%{$this->search}%")
                    ->orWhere('product_id', 'like', "%{$this->search}%");
            })
            ->when($this->selectedCategory, function ($query) {
                return $query->whereHas('categories', function ($q) {
                    $q->where('categories.id', $this->selectedCategory);
                });
            })
            ->orderBy($this->sortBy, 'desc')
            ->paginate($this->perPage);

        $categories = Category::orderBy('name')->get();

        return view('livewire.products.index', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
