<?php

namespace App\Models;

use App\Enums\InvoiceType;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use BelongsToUser;

    protected $guarded = [];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    // Helper to get the specific types
    public function customerInvoice()
    {
        return $this->hasOne(Invoice::class)->where('type', InvoiceType::CUSTOMER->value);
    }

    public function supplierInvoice()
    {
        return $this->hasOne(Invoice::class)->where('type', InvoiceType::SUPPLIER->value);
    }

    public function activities()
    {
        // 'subject' is the name of the relationship defined in Activity.php
        return $this->morphMany(Activity::class, 'subject');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->using(OrderProduct::class) // Using pivot model
            ->withPivot('quantity', 'sale_price') // List extra columns
            ->withTimestamps();
    }

    public function logActivity($description, $subject = null, $properties = [])
    {
        return $this->activities()->create([
            'description' => $description,
            'subject_id' => $subject?->id,
            'subject_type' => $subject ? get_class($subject) : null,
            'properties' => $properties,
        ]);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            // only set if not already set
            if (empty($order->order_number)) {
                do {
                    // random 5 digit number
                    $randomNumber = random_int(10000, 99999);
                    $newId = 'ORDER-'.$randomNumber;
                } while (
                    self::where('order_number', $newId)->exists()
                );

                $order->order_number = $newId;
            }
        });
    }
}
