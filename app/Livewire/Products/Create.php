<?php

namespace App\Livewire\Products;

use App\Livewire\Products\Forms\AddProductForm;
use App\Models\Category;
use App\Services\ProductService;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;


#[Title('Create Product')]
#[Layout('layouts.app')]
class Create extends Component
{
    use WithFileUploads;

    public AddProductForm $form;

    public function save()
    {
        $this->form->validate();

        $productService = app(ProductService::class);
        $product = $productService->createProduct(
            $this->form->all(),
            $this->form->categories,
            $this->form->product_images
        );

        $this->dispatch('toast', type: 'success', message: 'Product created successfully.');

        return redirect()->route('inventory');
    }

    public function cancel()
    {
        return redirect()->route('inventory');
    }

    public function with(): array
    {
        return [
            'categories' => Category::orderBy('name')->get(),
            'statusOptions' => [
                'active' => 'Operational',
                'inactive' => 'Inactive',
                'archived' => 'Archived',
            ],
        ];
    }
}
;
