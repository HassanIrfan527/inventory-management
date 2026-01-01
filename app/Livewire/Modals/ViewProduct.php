<?php

namespace App\Livewire\Modals;

use App\Models\Product;
use Flux\Flux;
use Livewire\Attributes\On;
use Livewire\Component;

class ViewProduct extends Component
{
    public ?Product $product = null;

    #[On('view-product')]
    public function open($productId)
    {
        $this->product = Product::find($productId);
        Flux::modal('view-product')->show();
    }

    public function render()
    {
        return view('livewire.modals.view-product');
    }
}
