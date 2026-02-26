<?php

namespace App\Services;

use App\Enums\Order\Status;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class DashboardService
{
    public function getStats($userId)
    {
        $key = "dashboard:stats:{$userId}";

        // TTL for 30 minutes
        return Cache::remember($key, now()->addMinutes(30), function () use ($userId) {
            return [
                'total_products' => Product::where('user_id', $userId)->count(),
                'total_orders' => Order::where('user_id', $userId)->count(),
                'total_contacts' => Contact::where('user_id', $userId)->count(),
                'total_invoices' => Invoice::where('user_id', $userId)->count(),
                'total_revenue' => Order::where('user_id', $userId)
                    ->where('status', Status::COMPLETED->value)
                    ->sum('total_amount'),
                'pending_orders' => Order::where('user_id', $userId)->where('status', Status::PENDING->value)->count(),
            ];
        });
    }

    public function recentOrders($userId)
    {
        $key = "dashboard:recent_orders:{$userId}";

        return Cache::remember($key, now()->addMinutes(30), function () use ($userId) {
            return Order::where('user_id', $userId)->with('contact')->latest()->take(5)->get();
        });
    }

    public function productsByCategory($userId)
    {
        $key = "dashboard:products_by_category:{$userId}";

        return Cache::remember($key, now()->addMinutes(30), function () use ($userId) {
            return Category::where('user_id', $userId)->withCount('products')
                ->orderBy('products_count', 'desc')
                ->get();
        });
    }

    public function topSellingProducts($userId)
    {
        $key = "dashboard:top_selling_products:{$userId}";

        return Cache::remember($key, now()->addMinutes(30), function () use ($userId) {
            return Product::where('user_id', $userId)->withCount('orders')
                ->orderBy('orders_count', 'desc')
                ->take(5)
                ->get();
        });
    }

    public function leastSellingProducts($userId)
    {
        $key = "dashboard:least_selling_products:{$userId}";

        return Cache::remember($key, now()->addMinutes(30), function () use ($userId) {
            return Product::where('user_id', $userId)->withCount('orders')
                ->orderBy('orders_count', 'asc')
                ->take(5)
                ->get();
        });
    }

    public function clearCache($userId): void
    {
        Cache::forget("dashboard:stats:{$userId}");
        Cache::forget("dashboard:recent_orders:{$userId}");
        Cache::forget("dashboard:products_by_category:{$userId}");
        Cache::forget("dashboard:top_selling_products:{$userId}");
        Cache::forget("dashboard:least_selling_products:{$userId}");
    }
}
