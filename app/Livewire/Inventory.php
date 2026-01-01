<?php

namespace App\Livewire;

use Livewire\Component;

use Livewire\Attributes\Title;

#[Title('Products Inventory')]
class Inventory extends Component
{

    public function render()
    {
        return view('livewire.inventory');
    }

}
