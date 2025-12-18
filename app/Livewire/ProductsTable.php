<?php

namespace App\Livewire;

use App\Models\Product;
use Flux\Flux;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsTable extends Component
{
    use WithPagination;

    public $search = '';

    public $sortBy = 'created_at';

    public $perPage = 12;

    public $selectedProduct = null;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getProductDetails($productId)
    {
        $this->selectedProduct = Product::find($productId);
    }

    public function render()
    {
        $products = Product::query()
            ->when($this->search, function ($query) {
                return $query->where('name', 'like', "%{$this->search}%")
                    ->orWhere('product_id', 'like', "%{$this->search}%");
            })
            ->orderBy($this->sortBy, 'desc')
            ->paginate($this->perPage);

        return view('livewire.products-table', [
            'products' => $products,
        ]);
    }
}
