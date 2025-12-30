<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public static function boot()
    {
        parent::boot();

        static::creating(function ($invoice) {
            // only set if not already set
            if (empty($invoice->invoice_number)) {
                do {
                    // random 5 digit number
                    $randomNumber = random_int(10000, 99999);
                    $newId = 'INV-' . $randomNumber;
                } while (
                    self::where('invoice_number', $newId)->exists()
                );

                $invoice->invoice_number = $newId;
            }
        });
    }
}
