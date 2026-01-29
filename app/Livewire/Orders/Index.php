<?php

namespace App\Livewire\Orders;

use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Orders Management')]
#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    public ?int $totalOrders = null;

    public ?int $completedOrders = null;

    public ?int $pendingOrders = null;

    public ?int $totalRevenue = null;

    public function mount(): void
    {
        $this->hydrateMetrics();
    }

    protected function hydrateMetrics(): void
    {
        $this->totalOrders = Order::count();
        $this->completedOrders = Order::where('status', 'completed')->count();
        $this->pendingOrders = Order::where('status', 'pending')->count();
        $this->totalRevenue = Order::sum('total_amount');
    }

    #[On('order-created')]
    public function refreshOrders(): void
    {
        $this->resetPage();
        $this->hydrateMetrics();
    }

    public function render()
    {
        $orders = Order::with(['contact', 'products'])
            ->latest()
            ->paginate(10);

        return view('livewire.orders.index', [
            'orders' => $orders,
        ]);
    }
}
