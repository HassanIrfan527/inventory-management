<?php

namespace App\Livewire\Modals;

use Livewire\Component;
use Livewire\Attributes\Reactive;
class ProductViewSettings extends Component
{
    #[Reactive]
    public $viewType;

    public function changeView(string $type)
    {
        $this->dispatch('set-view-type', type: $type);
    }

    public function render()
    {
        return view('livewire.modals.product-view-settings');
    }
}
