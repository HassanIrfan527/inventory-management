<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use BelongsToUser;

    protected $fillable = [
        'order_id',
        'invoice_number',
        'po_number',
        'subtotal_amount',
        'tax_amount',
        'discount_amount',
        'delivery_charge',
        'total_amount',
        'currency',
        'billing_name',
        'billing_email',
        'billing_phone',
        'billing_address',
        'shipping_name',
        'shipping_address',
        'data',
        'status',
        'type',
        'due_date',
        'issued_at',
        'paid_at',
        'cancelled_at',
        'customer_notes',
        'internal_notes',
        'terms_and_conditions',
        'payment_method',
        'invoice_path',
    ];

    protected function casts(): array
    {
        return [
            'subtotal_amount' => 'decimal:2',
            'tax_amount' => 'decimal:2',
            'discount_amount' => 'decimal:2',
            'delivery_charge' => 'decimal:2',
            'total_amount' => 'decimal:2',
            'data' => 'array',
            'due_date' => 'datetime',
            'issued_at' => 'datetime',
            'paid_at' => 'datetime',
            'cancelled_at' => 'datetime',
        ];
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function contact()
    {
        return $this->hasOneThrough(Contact::class, Order::class, 'id', 'id', 'order_id', 'contact_id');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($invoice) {
            // only set if not already set
            if (empty($invoice->invoice_number)) {
                do {
                    // random 5 digit number
                    $randomNumber = random_int(10000, 99999);
                    $newId = 'INV-'.$randomNumber;
                } while (
                    self::where('invoice_number', $newId)->exists()
                );

                $invoice->invoice_number = $newId;
            }
        });
    }
}
