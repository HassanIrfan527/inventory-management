<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\EditProductForm;
use App\Models\Product;
use Flux\Flux;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductDetails extends Component
{
    use WithFileUploads;

    public EditProductForm $form;

    public ?Product $product = null;

    public $isEditMode = false;

    public $allCategories = [];

    public function mount()
    {
        $this->allCategories = \App\Models\Category::orderBy('name')->get();
    }

    #[On('view-product')]
    public function openView($id)
    {
        $this->loadProduct($id);
        $this->isEditMode = false;
        Flux::modal('product-details')->show();
    }

    #[On('edit-product')]
    public function openEdit($id)
    {
        $this->loadProduct($id);
        $this->isEditMode = true;
        Flux::modal('product-details')->show();
    }

    protected function loadProduct($id)
    {
        $this->product = Product::findOrFail($id);
        $this->form->setProduct($this->product);
    }

    public function toggleEditMode()
    {
        $this->isEditMode = ! $this->isEditMode;
        if (! $this->isEditMode) {
            // Reset form when cancelling edit
            $this->form->setProduct($this->product);
        }
    }

    public function toggleCategory($categoryId)
    {
        if (in_array($categoryId, $this->form->categories)) {
            $this->form->categories = array_diff($this->form->categories, [$categoryId]);
        } else {
            $this->form->categories[] = $categoryId;
        }
    }

    public function save()
    {
        $this->form->validate();
        $this->form->update();

        $this->isEditMode = false;
        $this->product->refresh(); // Refresh to show updated data

        $this->dispatch('product-added'); // Refresh table

        // Optional: Show success toast
        $this->dispatch('toast', message: 'Product updated successfully', type: 'success');
    }

    public function render()
    {
        return view('livewire.modals.product-details');
    }
}
