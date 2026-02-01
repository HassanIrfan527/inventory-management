<?php

namespace App\Services;

use App\Events\OrderCreated;
use App\Models\Order;
use App\Models\Product;
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
