<?php

namespace App\Livewire\Products\Forms;

use App\Models\Product;
use App\Services\ProductService;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EditProductForm extends Form
{
    public ?Product $product = null;

    #[Validate('nullable|string')]
    public $sku = '';

    #[Validate('nullable|integer|min:0')]
    public $stock_quantity = null;

    #[Validate('required|string|in:active,inactive,archived')]
    public $status = 'active';

    #[Validate('nullable|string')]
    public $internal_notes = '';

    #[Validate(['new_product_images.*' => 'image|max:10240'])]
    public $new_product_images = [];

    #[Validate('nullable|array')]
    public $categories = []; // Array of category IDs

    public function rules()
    {
        return [
            'name' => 'required|min:5',
            'description' => 'required|min:5',
            'cost_price' => 'required|numeric|min:0',
            'retail_price' => 'required|numeric|min:0',
            'delivery_charges' => 'required|numeric|min:0',
            'sku' => 'nullable|string|unique:products,sku,'.$this->product->id,
            'stock_quantity' => 'nullable|integer|min:0',
            'status' => 'required|string|in:active,inactive,archived',
            'internal_notes' => 'nullable|string',
        ];
    }

    public function setProduct(Product $product)
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->cost_price = $product->purchase_price;
        $this->retail_price = $product->retail_price;
        $this->delivery_charges = $product->delivery_charges;
        $this->sku = $product->sku;
        $this->stock_quantity = $product->stock_quantity;
        $this->status = $product->status;
        $this->internal_notes = $product->internal_notes;
        $this->categories = $product->categories()->pluck('categories.id')->toArray();
    }

    public function update()
    {
        $productService = app(ProductService::class);

        $productService->updateProduct(
            $this->product,
            [
                'name' => $this->name,
                'description' => $this->description,
                'cost_price' => $this->cost_price,
                'retail_price' => $this->retail_price,
                'delivery_charges' => $this->delivery_charges,
                'sku' => $this->sku,
                'stock_quantity' => $this->stock_quantity,
                'status' => $this->status,
                'internal_notes' => $this->internal_notes,
            ],
            $this->categories,
            $this->new_product_images,
        );
    }
}
