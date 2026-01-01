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
    public function open($productId)
    {
        $this->product = Product::find($productId);
        if ($this->product) {
            $this->form->setProduct($this->product);
            Flux::modal('edit-product')->show();
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
