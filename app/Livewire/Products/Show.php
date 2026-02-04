<?php

namespace App\Livewire\Products;

use App\Livewire\Products\Forms\EditProductForm;
use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.app')]
class Show extends Component
{
    use WithFileUploads;

    public Product $product;

    public EditProductForm $form;

    public bool $isEditing = false;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->form->setProduct($product);
    }

    public function title(): string
    {
        return $this->product->name;
    }

    public function enableEdit()
    {
        $this->isEditing = true;
    }

    public function cancelEdit()
    {
        $this->isEditing = false;
        $this->form->setProduct($this->product);
    }

    public function save()
    {
        $this->form->validate();
        $this->form->update();

        $this->product->refresh();
        $this->isEditing = false;

        $this->dispatch('toast', type: 'success', message: 'Product updated successfully.');
    }

    public function deleteProduct()
    {
        $productService = app(ProductService::class);
        $productService->deleteProduct($this->product);

        $this->dispatch('toast', type: 'success', message: 'Asset removed from active catalog.');

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
