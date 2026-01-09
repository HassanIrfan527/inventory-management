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
    public function open($id)
    {
        \Illuminate\Support\Facades\Log::info('ViewProduct event received for ID: '.$id);
        $this->product = Product::find($id);

        if ($this->product) {
            Flux::modal('view-product')->show();
        } else {
            \Illuminate\Support\Facades\Log::error('Product not found for ID: '.$id);
        }
    }

    public function render()
    {
        return view('livewire.modals.view-product');
    }
}
