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

    public function showViewProduct($productId)
    {
        $this->selectedProduct = Product::find($productId);
        Flux::modal('view-product')->show();
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
