<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderProduct extends Pivot
{
    // Laravel assumes the table is 'order_product' based on alphabetical order
    protected $table = 'order_product';

    // If your migration has an 'id' column, keep this true
    public $incrementing = true;

    // Define relationships inside the pivot if you need to access them directly
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    protected function casts(): array
    {
        return [
            'unit_cost' => 'decimal:2',
            'sale_price' => 'decimal:2',
            'tax_amount' => 'decimal:2',
            'discount_amount' => 'decimal:2',
            'subtotal' => 'decimal:2',
        ];
    }
}
