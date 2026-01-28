<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Orders Management')]
#[Layout('layouts.app')]
class Orders extends Component
{
    // Static Data for Mockup
    public ?int $totalOrders = null;

    public ?int $completedOrders = null;

    public ?int $pendingOrders = null;

    public ?int $totalRevenue = null;

    public $orders;

    public function mount()
    {
        $this->totalOrders = Order::count();
        $this->completedOrders = Order::where('status', 'completed')->count();
        $this->pendingOrders = Order::where('status', 'pending')->count();
        $this->totalRevenue = Order::sum('total_amount');

        $this->orders = Order::with(['contact', 'products'])->get();
    }

    #[On('order-created')]
    public function render()
    {
        return view('livewire.orders');
    }
}
