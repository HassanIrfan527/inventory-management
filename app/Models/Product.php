<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use BelongsToUser;

    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'purchase_price',
        'retail_price',
        'delivery_charges',
        'sku',
        'stock_quantity',
        'status',
        'internal_notes',
    ];

    protected function casts(): array
    {
        return [
            'stock_quantity' => 'integer',
        ];
    }

    public static function totalInventoryValue()
    {
        $total = static::sum('retail_price') ?? 0;

        return (float) $total;

    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)
            ->using(OrderProduct::class)
            ->withPivot([
                'quantity',
                'unit_cost',
                'sale_price',
                'tax_amount',
                'discount_amount',
                'subtotal',
            ])
            ->withTimestamps();
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            // only set if not already set
            if (empty($product->product_id)) {
                do {
                    // random 5 digit number
                    $randomNumber = random_int(10000, 99999);
                    $newId = 'PROD-'.$randomNumber;
                } while (
                    self::where('product_id', $newId)->exists()
                );

                $product->product_id = $newId;
            }
        });
    }
}
