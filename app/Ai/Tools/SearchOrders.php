<?php

namespace App\Ai\Tools;

use App\Services\OrderService;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Tools\Request;
use Stringable;

class SearchOrders implements Tool
{
    /**
     * Get the description of the tool's purpose.
     */
    public function description(): Stringable|string
    {
        return 'List recent orders, optionally filtered by status.';
    }

    /**
     * Execute the tool.
     */
    public function handle(Request $request): Stringable|string
    {
        $service = app(OrderService::class);
        $orders = $service->listOrders(
            status: $request['status'] ?? null,
            perPage: $request['limit'] ?? 10,
        );

        if ($orders->isEmpty()) {
            return 'No orders found.';
        }

        $result = "Found {$orders->total()} order(s):\n";

        foreach ($orders as $order) {
            $contactName = $order->contact?->name ?? 'N/A';
            $paymentStatus = $order->payment_status?->value ?? 'N/A';
            $result .= "- `{$order->order_number}` — {$contactName} — Rs. {$order->total_amount} — Status: {$order->status} — Payment: {$paymentStatus}\n";
        }

        return $result;
    }

    /**
     * Get the tool's schema definition.
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'status' => $schema->string()->description('Filter by order status (e.g., pending, completed)'),
            'limit' => $schema->integer()->description('Number of orders to return. Defaults to 10.'),
        ];
    }
}
