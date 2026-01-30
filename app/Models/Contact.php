<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use BelongsToUser;

    /** @use HasFactory<\Database\Factories\ContactFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'contact_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'landmark',
        'type',
        'status',
        'source',
        'company_name',
        'job_title',
        'city',
        'state',
        'country',
        'zip_code',
        'notes',
        'date_of_birth',
        'preferred_contact_method',
        'engagement_score',
        'custom_fields',
        'last_contacted_at',
        'last_activity_at',
    ];

    protected function casts(): array
    {
        return [
            'type' => \App\Enums\Contacts\Type::class,
            'status' => \App\Enums\Contacts\Status::class,
            'source' => \App\Enums\Contacts\Source::class,
            'preferred_contact_method' => \App\Enums\Contacts\PreferredContactMethod::class,
            'custom_fields' => 'array',
            'date_of_birth' => 'date',
            'last_contacted_at' => 'datetime',
            'last_activity_at' => 'datetime',
            'engagement_score' => 'integer',
        ];
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn () => trim($this->first_name.' '.$this->last_name),
        );
    }

    protected function phone(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => $value ? preg_replace('/[^0-9+]/', '', $value) : null,
            get: fn ($value) => $value,
        );
    }

    protected function whatsappNo(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => $value ? preg_replace('/[^0-9+]/', '', $value) : null,
            get: fn ($value) => $value,
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

    public function logActivity($description, $subject = null, $properties = [])
    {
        return $this->activities()->create([
            'description' => $description,
            'subject_id' => $subject?->id,
            'subject_type' => $subject ? get_class($subject) : null,
            'properties' => $properties,
        ]);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class)->latest();
    }
}
