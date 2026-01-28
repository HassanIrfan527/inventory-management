<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'order_number' => $this->order_number,
            'status' => $this->status,
            'total_amount' => (int) $this->total_amount,
            'delivery_charge' => (int) $this->delivery_charge,
            'address' => $this->address,
            'contact' => new ContactResource($this->whenLoaded('contact')),
            'items' => $this->whenLoaded('products', function () {
                return $this->products->map(function ($product) {
                    return [
                        'product_id' => $product->id,
                        'product_code' => $product->product_id,
                        'name' => $product->name,
                        'quantity' => (int) $product->pivot->quantity,
                        'price' => (int) $product->pivot->sale_price,
                        'line_total' => (int) $product->pivot->quantity * (int) $product->pivot->sale_price,
                    ];
                });
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
