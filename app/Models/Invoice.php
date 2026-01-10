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
        'total_amount',
        'data',
        'status',
        'type',
        'due_date',
        'invoice_path',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
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
