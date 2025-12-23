<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /** @use HasFactory<\Database\Factories\ContactFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'whatsapp_no',
        'address',
        'landmark',
    ];

    // The DB queries will work according to the 'contact_id' instead of 'id'
    public function getRouteKeyName()
    {
        return 'contact_id';
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($contact) {
            // only set if not already set
            if (empty($contact->contact_id)) {
                do {
                    // random 6 digit number
                    $randomNumber = random_int(100000, 999999);
                } while (
                    self::where('contact_id', $randomNumber)->exists()
                );

                $contact->contact_id = $randomNumber;
            }
        });
    }
}
