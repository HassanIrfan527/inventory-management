<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
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

    #[Validate(['product_images.*' => 'image|max:10240'])]
    public $product_images = [];

    #[Validate('nullable|array')]
    public $categories = []; // Changed to array for possible multiple selection, or single.
    // Plan said "option al field", but pivot table exists. I'll make it multiple select in UI to be safe/powerful
    // User asked "show the category as an option al field", I will use a Flux Select which supports multiple
}
