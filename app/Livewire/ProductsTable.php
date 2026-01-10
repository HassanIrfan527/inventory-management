<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsTable extends Component
{
    use WithPagination;

    #[On('product-added')]
    public function refresh()
    {
        $this->render();
    }

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
        if ($product) {
            $productName = $product->name;
            $product->delete();
            $this->dispatch('toast', type: 'success', message: "Product '{$productName}' has been removed from inventory.");
        }
        $this->resetPage();
    }

    public function bulkChangeCategory()
    {
        $this->validate([
            'targetCategory' => 'required|exists:categories,id',
            'selectedProducts' => 'required|array|min:1',
        ]);

        $category = Category::find($this->targetCategory);
        
        Product::whereIn('id', $this->selectedProducts)->get()->each(function ($product) use ($category) {
            $product->categories()->sync([$category->id]);
        });

        $count = count($this->selectedProducts);
        $this->dispatch('toast', type: 'success', message: "Updated category for {$count} products to '{$category->name}'.");
        
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

        return view('livewire.products-table', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
