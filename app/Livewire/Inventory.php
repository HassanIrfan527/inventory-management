<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Products Inventory')]
class Inventory extends Component
{
    public function render()
    {
        return view('livewire.inventory');
    }
}
