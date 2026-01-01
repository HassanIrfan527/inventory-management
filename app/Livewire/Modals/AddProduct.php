<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\AddProductForm;
use App\Models\Product;
use Flux\Flux;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddProduct extends Component
{
    use WithFileUploads;

    public AddProductForm $product;

    public function addProduct()
    {
        $this->product->validate();

        $path = null;
        if ($this->product->temporaryUploadedFile) {
            $path = $this->product->temporaryUploadedFile->store('product_images', 'public');
        }

        Product::create([
            'name' => $this->product->name,
            'description' => $this->product->description,
            'purchase_price' => $this->product->cost_price,
            'retail_price' => $this->product->retail_price,
            'delivery_charges' => $this->product->delivery_charges,
            'product_image' => $path,
        ]);

        $this->product->reset();

        Flux::modal('add-product')->close();

        $this->dispatch('product-added');
    }

    public function render()
    {
        return view('livewire.modals.add-product');
    }
}
