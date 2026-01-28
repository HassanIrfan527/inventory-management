<?php

namespace App\Livewire;

use App\Enums\ProductView;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Products Inventory')]
#[Layout('layouts.app')]
class Inventory extends Component
{
    public ProductView $viewType = ProductView::Grid; // Default view type

    public $totalProducts = 0;

    public $totalInventoryValue = 0;

    public $avg_margin = 0;

    #[On('set-view-type')]
    public function setView(string $type)
    {
        // tryFrom returns null if the string doesn't match an Enum case
        $this->viewType = ProductView::tryFrom($type) ?? ProductView::Grid;
    }

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
