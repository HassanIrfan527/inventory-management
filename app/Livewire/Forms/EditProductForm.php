<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class EditProductForm extends Form
{
    public ?Product $product = null;

    #[Validate('required|min:5')]
    public $name = '';

    #[Validate('required|min:5')]
    public $description = '';

    #[Validate('required|numeric|min:0')]
    public $cost_price = '';

    #[Validate('required|numeric|min:0')]
    public $retail_price = '';

    #[Validate('required|numeric|min:0')]
    public $delivery_charges = '';

    #[Validate(['new_product_images.*' => 'image|max:10240'])]
    public $new_product_images = [];

    #[Validate('nullable|array')]
    public $categories = []; // Array of category IDs

    public function setProduct(Product $product)
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->cost_price = $product->purchase_price;
        $this->retail_price = $product->retail_price;
        $this->delivery_charges = $product->delivery_charges;
        $this->categories = $product->categories()->pluck('categories.id')->toArray();
    }

    public function update()
    {
        if (!empty($this->new_product_images)) {
            foreach ($this->new_product_images as $image) {
                $path = $image->store('product_images', 'public');
                $this->product->images()->create([
                    'image_path' => $path
                ]);
            }
        }

        $this->product->update([
            'name' => $this->name,
            'description' => $this->description,
            'purchase_price' => $this->cost_price,
            'retail_price' => $this->retail_price,
            'delivery_charges' => $this->delivery_charges,
        ]);

        if (isset($this->categories)) {
            // Sync categories (handles adding/removing)
            $this->product->categories()->sync($this->categories);
        }
    }
}
