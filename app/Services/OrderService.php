<?php

namespace App\Services;

use App\Events\OrderCreated;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function __construct(
        protected DashboardService $dashboardService
    ) {}

    public function getStats($userId): array
    {
        $key = "orders:stats:{$userId}";

        return Cache::remember($key, now()->addMinutes(30), function () use ($userId) {
            $stats = Order::where('user_id', $userId)
                ->selectRaw('
                    COUNT(*) as total_orders,
                    SUM(CASE WHEN status = "Completed" THEN total_amount ELSE 0 END) as total_revenue,
                    COUNT(CASE WHEN status = "Pending" THEN 1 END) as pending_orders,
                    COUNT(CASE WHEN status = "Completed" THEN 1 END) as completed_orders
                ')
                ->first();

            return [
                'total_orders' => (int) ($stats->total_orders ?? 0),
                'total_revenue' => (float) ($stats->total_revenue ?? 0),
                'pending_orders' => (int) ($stats->pending_orders ?? 0),
                'completed_orders' => (int) ($stats->completed_orders ?? 0),
            ];
        });
    }

    public function listOrders(?string $status = null, ?int $contactId = null, int $perPage = 15, ?string $search = null): LengthAwarePaginator
    {
        return Order::query()
            ->with(['contact', 'products'])
            ->when($status, fn ($query, $status) => $query->where('status', $status))
            ->when($contactId, fn ($query, $contactId) => $query->where('contact_id', $contactId))
            ->when($search, function ($query) use ($search) {
                $query->where('order_number', 'like', '%'.$search.'%')
                    ->orWhereHas('contact', function ($q) use ($search) {
                        $q->where('first_name', 'like', '%'.$search.'%')
                            ->orWhere('last_name', 'like', '%'.$search.'%');
                    });
            })
            ->latest()
            ->paginate($perPage);
    }

    /**
     * @param  array<int, array{product_id:int, quantity:int, price:int}>  $items
     */
    public function createOrder(int $contactId, string $status, array $items, int $deliveryCharge = 0, ?string $address = null, bool $generateInvoice = false): Order
    {
        return DB::transaction(function () use ($contactId, $status, $items, $deliveryCharge, $address, $generateInvoice): Order {
            $subtotal = 0;
            $totalTax = 0;
            $totalDiscount = 0;

            foreach ($items as $item) {
                $subtotal += (float) $item['quantity'] * (float) $item['price'];
            }

            $order = Order::create([
                'contact_id' => $contactId,
                'status' => $status,
                'subtotal_amount' => $subtotal,
                'tax_amount' => $totalTax,
                'discount_amount' => $totalDiscount,
                'total_amount' => $subtotal + $totalTax - $totalDiscount + $deliveryCharge,
                'delivery_charge' => $deliveryCharge,
                'address' => $address,
            ]);

            foreach ($items as $item) {
                $product = Product::find($item['product_id']);
                $lineSubtotal = (float) $item['quantity'] * (float) $item['price'];

                $order->products()->attach($item['product_id'], [
                    'quantity' => $item['quantity'],
                    'unit_cost' => $product?->purchase_price ?? 0,
                    'sale_price' => $item['price'],
                    'tax_amount' => 0, // Default for now
                    'discount_amount' => 0, // Default for now
                    'subtotal' => $lineSubtotal,
                ]);
            }

            OrderCreated::dispatch($order, $generateInvoice);

            $order->load(['contact', 'products']);

            $this->clearStatsCache($order->user_id);

            return $order;
        });
    }

    public function updateOrder(Order $order, array $data): Order
    {
        $order->update([
            'status' => $data['status'] ?? $order->status,
            'delivery_charge' => $data['delivery_charge'] ?? $order->delivery_charge,
            'address' => $data['address'] ?? $order->address,
        ]);

        $order->refresh()->load(['contact', 'products']);

        $this->clearStatsCache($order->user_id);

        return $order;
    }

    public function clearStatsCache(int $userId): void
    {
        Cache::forget("orders:stats:{$userId}");
        $this->dashboardService->clearCache($userId);
    }
}
