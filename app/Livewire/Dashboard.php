<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Dashboard')]
#[Layout('layouts.app')]
class Dashboard extends Component
{
    #[Computed]
    public function stats()
    {
        return [
            'total_products' => Product::count(),
            'total_orders' => Order::count(),
            'total_contacts' => Contact::count(),
            'total_invoices' => Invoice::count(),
            'total_revenue' => Order::where('status', 'completed')->sum('total_amount'),
            'pending_orders' => Order::where('status', 'pending')->count(),
        ];
    }

    #[Computed]
    public function recentOrders()
    {
        return Order::with('contact')->latest()->take(5)->get();
    }

    #[Computed]
    public function productsByCategory()
    {
        return Category::withCount('products')
            ->orderBy('products_count', 'desc')
            ->get();
    }

    #[Computed]
    public function topSellingProducts()
    {
        return Product::withCount('orders')
            ->orderBy('orders_count', 'desc')
            ->take(5)
            ->get();
    }

    #[Computed]
    public function leastSellingProducts()
    {
        return Product::withCount('orders')
            ->orderBy('orders_count', 'asc')
            ->take(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
