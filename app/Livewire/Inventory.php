<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Products Inventory')]
class Inventory extends Component
{
    public $totalProducts = 0;

    public $totalInventoryValue = 0;

    public $avg_margin = 0;

    public function mount()
    {
        $this->totalProducts = Product::count();
        $this->totalInventoryValue = Product::totalInventoryValue();

        $totalRetail = Product::sum('retail_price');
        $totalPurchase = Product::sum('purchase_price');
        $this->avg_margin = $totalRetail > 0 ? (($totalRetail - $totalPurchase) / $totalRetail) * 100 : 0;
    }

    public function render()
    {
        return view('livewire.inventory');
    }
}
