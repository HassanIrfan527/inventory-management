<?php

use App\Livewire\Modals\CreateOrder;
use App\Models\User;
use Livewire\Livewire;

it('renders the create order modal', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test(CreateOrder::class)
        ->assertStatus(200);
});
