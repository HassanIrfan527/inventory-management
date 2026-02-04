<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.public')]
#[Title('User Documentation')]
class Docs extends Component
{
    public function render()
    {
        return view('livewire.docs');
    }
}
