<?php

namespace App\Livewire\Products\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class AddProductForm extends Form
{
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

    #[Validate('nullable|string|unique:products,sku')]
    public $sku = '';

    #[Validate('nullable|integer|min:0')]
    public $stock_quantity = null;

    #[Validate('required|string|in:active,inactive,archived')]
    public $status = 'active';

    #[Validate('nullable|string')]
    public $internal_notes = '';

    #[Validate(['product_images.*' => 'image|max:10240'])]
    public $product_images = [];

    #[Validate('nullable|array')]
    public $categories = [];
}
