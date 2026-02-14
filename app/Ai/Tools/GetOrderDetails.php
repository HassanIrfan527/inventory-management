<?php

namespace App\Ai\Tools;

use App\Models\Order;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Tools\Request;
use Stringable;

class GetOrderDetails implements Tool
{
    /**
     * Get the description of the tool's purpose.
     */
    public function description(): Stringable|string
    {
        return 'Get full details of a specific order by its order number.';
    }

    /**
     * Execute the tool.
     */
    public function handle(Request $request): Stringable|string
    {
        $order = Order::query()
            ->with(['contact', 'products', 'invoices'])
            ->where('order_number', $request['order_number'])
            ->first();

        if (! $order) {
            return "No order found with number `{$request['order_number']}`.";
        }

        $contactName = $order->contact?->name ?? 'N/A';
        $paymentStatus = $order->payment_status?->value ?? 'N/A';
        $paymentMethod = $order->payment_method?->value ?? 'N/A';

        $result = "Order `{$order->order_number}`:\n";
        $result .= "- Contact: **{$contactName}**\n";
        $result .= "- Status: {$order->status}\n";
        $result .= "- Payment: {$paymentStatus} ({$paymentMethod})\n";
        $result .= "- Subtotal: Rs. {$order->subtotal_amount}\n";
        $result .= "- Tax: Rs. {$order->tax_amount}\n";
        $result .= "- Discount: Rs. {$order->discount_amount}\n";
        $result .= "- Delivery: Rs. {$order->delivery_charge}\n";
        $result .= "- **Total: Rs. {$order->total_amount}**\n";

        if ($order->products->isNotEmpty()) {
            $result .= "\nItems:\n";
            foreach ($order->products as $product) {
                $qty = $product->pivot->quantity;
                $price = $product->pivot->sale_price;
                $subtotal = $product->pivot->subtotal;
                $result .= "- **{$product->name}** × {$qty} @ Rs. {$price} = Rs. {$subtotal}\n";
            }
        }

        if ($order->invoices->isNotEmpty()) {
            $result .= "\nInvoices:\n";
            foreach ($order->invoices as $invoice) {
                $result .= "- `{$invoice->invoice_number}` — {$invoice->type} — Status: {$invoice->status}\n";
            }
        }

        return $result;
    }

    /**
     * Get the tool's schema definition.
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'order_number' => $schema->string()->description('The order number (e.g., ORDER-12345)')->required(),
        ];
    }
}
