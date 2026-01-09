<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\EditProductForm;
use App\Models\Product;
use Flux\Flux;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditProduct extends Component
{
    use WithFileUploads;

    public EditProductForm $form;

    public ?Product $product = null;

    #[On('edit-product')]
    public function open($id)
    {
        $this->product = Product::find($id);
        if ($this->product) {
            $this->form->setProduct($this->product);
            Flux::modal('edit-product')->show();
        }
    }

    public $allCategories = [];

    public function mount()
    {
        $this->allCategories = \App\Models\Category::orderBy('name')->get();
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

        Flux::modal('edit-product')->close();

        $this->dispatch('product-added'); // Refresh table
    }

    public function render()
    {
        return view('livewire.modals.edit-product');
    }
}
