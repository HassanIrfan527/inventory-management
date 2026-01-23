<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    use BelongsToUser;
    protected $fillable = [
        'name',
        'description',
        'purchase_price',
        'retail_price',
        'delivery_charges',
    ];

    public static function totalInventoryValue()
    {
        $total = number_format(static::sum('retail_price') ?? 0, 0);

        return $total;

    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
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
                    $newId = 'PROD-' . $randomNumber;
                } while (
                    self::where('product_id', $newId)->exists()
                );

                $product->product_id = $newId;
            }
        });
    }
}
