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


    protected function messages()
    {
        return [
            'temporaryUploadedFile.image' => 'The file must be an image.',
            'temporaryUploadedFile.max' => 'The logo must be smaller than 2MB.',
            'temporaryUploadedFile.mimes' => 'Only JPG, JPEG, PNG, and WebP formats are allowed.',
            // This catches generic upload failures
            'temporaryUploadedFile.uploaded' => 'The logo failed to upload. Please try again.',
        ];
    }
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

        if ($this->product->temporaryUploadedFile) {
            $path = $this->product->temporaryUploadedFile->store('product_images', 'public');
        } else {
            $path = null;
        }

        // dd($path);

        Product::create([
            'name' => $this->product->name,
            'description' => $this->product->description,
            'purchase_price' => $this->product->cost_price,
            'retail_price' => $this->product->retail_price,
            'delivery_charges' => $this->product->delivery_charges,
            'product_image' => $path,
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
