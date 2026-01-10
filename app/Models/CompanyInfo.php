<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    use BelongsToUser;
    /** @use HasFactory<\Database\Factories\CompanyInfoFactory> */
    use HasFactory;

    protected $table = 'company_info';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'website',
        'logo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function phone(): Attribute
    {
        return Attribute::make(
            // SAVING TO DB: Remove the dash
            set: fn ($value) => str_replace('-', '', $value),

            // RETRIEVING FROM DB: Put the dash back for the UI
            get: fn ($value) => substr($value, 0, 4).'-'.substr($value, 4),
        );
    }
}
