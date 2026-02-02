<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.public')]
#[Title('Help Center - Kinetic Hub')]
class Help extends Component
{
    public string $search = '';

    public function render()
    {
        return view('livewire.help');
    }
}
