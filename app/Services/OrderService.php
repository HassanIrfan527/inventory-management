<?php

namespace App\Services;

use App\Events\OrderCreated;
use App\Models\Order;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function listOrders(?string $status = null, ?int $contactId = null, int $perPage = 15): LengthAwarePaginator
    {
        return Order::query()
            ->with(['contact', 'products'])
            ->when($status, fn ($query, $status) => $query->where('status', $status))
            ->when($contactId, fn ($query, $contactId) => $query->where('contact_id', $contactId))
            ->latest()
            ->paginate($perPage);
    }

    /**
     * @param  array<int, array{product_id:int, quantity:int, price:int}>  $items
     */
    public function createOrder(int $contactId, string $status, array $items, int $deliveryCharge = 0, ?string $address = null, bool $generateInvoice = false): Order
    {
        return DB::transaction(function () use ($contactId, $status, $items, $deliveryCharge, $address, $generateInvoice): Order {
            $total = 0;

            foreach ($items as $item) {
                $total += (int) $item['quantity'] * (int) $item['price'];
            }

            $order = Order::create([
                'contact_id' => $contactId,
                'status' => $status,
                'total_amount' => $total + $deliveryCharge,
                'delivery_charge' => $deliveryCharge,
                'address' => $address,
            ]);

            foreach ($items as $item) {
                $order->products()->attach($item['product_id'], [
                    'quantity' => $item['quantity'],
                    'sale_price' => $item['price'],
                ]);
            }

            OrderCreated::dispatch($order, $generateInvoice);

            return $order->load(['contact', 'products']);
        });
    }

    public function updateOrder(Order $order, array $data): Order
    {
        $order->update([
            'status' => $data['status'] ?? $order->status,
            'delivery_charge' => $data['delivery_charge'] ?? $order->delivery_charge,
            'address' => $data['address'] ?? $order->address,
        ]);

        return $order->refresh()->load(['contact', 'products']);
    }
}
