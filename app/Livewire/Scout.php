<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Scout - Your Personal Inventory Assistant')]
class Scout extends Component
{
    public function render()
    {
        return view('livewire.scout');
    }
}
