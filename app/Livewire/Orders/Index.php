<?php

namespace App\Livewire\Orders;

use App\Services\OrderService;
use Livewire\Attributes\Computed;
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

    public string $search = '';

    public string $statusFilter = '';

    protected function service(): OrderService
    {
        return app(OrderService::class);
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedStatusFilter(): void
    {
        $this->resetPage();
    }

    #[On('order-created')]
    public function refreshOrders(): void
    {
        $this->resetPage();
        $this->service()->clearStatsCache(auth()->id());
    }

    #[Computed]
    public function stats()
    {
        return $this->service()->getStats(auth()->id());
    }

    #[Computed]
    public function orders()
    {
        return $this->service()->listOrders(
            status: $this->statusFilter ?: null,
            perPage: 10,
            search: $this->search
        );
    }

    public function render()
    {
        return view('livewire.orders.index');
    }
}
