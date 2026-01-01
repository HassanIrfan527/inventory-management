<?php

namespace App\Livewire;

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

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function deleteProduct($productId)
    {
        $product = Product::find($productId);
        if ($product) {
            $product->delete();
        }
        $this->resetPage();
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
