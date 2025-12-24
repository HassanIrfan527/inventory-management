<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    /** @use HasFactory<\Database\Factories\ContactFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'whatsapp_no',
        'address',
        'landmark',
    ];


    // protected $casts = [
    //     'phone' => ,
    //     'whatsapp_no' => ,
    // ];

    protected function phone(): Attribute
    {
        return Attribute::make(
            // SAVING TO DB: Remove the dash
            set: fn ($value) => str_replace('-', '', $value),

            // RETRIEVING FROM DB: Put the dash back for the UI
            get: fn ($value) => substr($value, 0, 4) . '-' . substr($value, 4),
        );
    }

    protected function whatsappNo(): Attribute
    {
        return Attribute::make(
            // SAVING TO DB: Remove the dash
            set: fn ($value) => str_replace('-', '', $value),

            // RETRIEVING FROM DB: Put the dash back for the UI
            get: fn ($value) => substr($value, 0, 4) . '-' . substr($value, 4),
        );
    }

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
