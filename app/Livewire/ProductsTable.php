<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Livewire\Forms\AddProductForm;
use Flux\Flux;

class ProductsTable extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';

    public $sortBy = 'created_at';

    public $perPage = 12;

    public $selectedProduct = null;

    public AddProductForm $product;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getProductDetails($productId)
    {
        $this->selectedProduct = Product::find($productId);
    }

    public function deleteProduct($productId)
    {
        $product = Product::find($productId);
        if ($product) {
            $product->delete();
        }
        $this->resetPage();
    }
    public function addProduct()
    {
        $this->product->validate();

        Product::create([
            'name' => $this->product->name,
            'description' => $this->product->description,
            'purchase_price' => $this->product->cost_price,
            'retail_price' => $this->product->retail_price,
            'delivery_charges' => $this->product->delivery_charges,
        ]);
        $this->resetPage();
        $this->product->reset();

        Flux::modal('add-product')->close();
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
