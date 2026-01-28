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

    public $allCategories = [];

    public function mount()
    {
        $this->allCategories = \App\Models\Category::orderBy('name')->get();
    }

    public function addProduct()
    {
        $this->product->validate();

        $product = Product::create([
            'name' => $this->product->name,
            'description' => $this->product->description,
            'purchase_price' => $this->product->cost_price,
            'retail_price' => $this->product->retail_price,
            'delivery_charges' => $this->product->delivery_charges,
        ]);

        if (! empty($this->product->product_images)) {
            foreach ($this->product->product_images as $image) {
                $path = $image->store('product_images', 'public');
                $product->images()->create([
                    'image_path' => $path,
                ]);
            }
        }

        if (! empty($this->product->categories)) {
            $product->categories()->attach($this->product->categories);
        }

        $this->product->reset();
        $this->product->categories = []; // Explicitly reset categories

        Flux::modal('add-product')->close();

        $this->dispatch('product-added');
    }

    public function toggleCategory($categoryId)
    {
        if (in_array($categoryId, $this->product->categories)) {
            $this->product->categories = array_diff($this->product->categories, [$categoryId]);
        } else {
            $this->product->categories[] = $categoryId;
        }
    }

    public function render()
    {
        return view('livewire.modals.add-product');
    }
}
