<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Product;
use App\Services\DashboardService;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Dashboard')]
#[Layout('layouts.app')]
class Dashboard extends Component
{
    public string $viewMode = 'static';

    #[Computed]
    public function stats()
    {
        return app(DashboardService::class)->getStats(auth()->id());
    }

    #[Computed]
    public function recentOrders()
    {
        return app(DashboardService::class)->recentOrders(auth()->id());
    }

    #[Computed]
    public function productsByCategory()
    {
        return app(DashboardService::class)->productsByCategory(auth()->id());
    }

    #[Computed]
    public function topSellingProducts()
    {
        return app(DashboardService::class)->topSellingProducts(auth()->id());
    }

    #[Computed]
    public function leastSellingProducts()
    {
        return app(DashboardService::class)->leastSellingProducts(auth()->id());
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
