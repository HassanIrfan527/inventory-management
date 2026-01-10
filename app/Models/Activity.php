<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use BelongsToUser;
    /** @use HasFactory<\Database\Factories\ActivityFactory> */
    use HasFactory;

    protected $fillable = [
        'contact_id',
        'description',
        'subject_id',
        'subject_type',
        'properties',
    ];

    public function subject()
    {
        // This must match the 'subject' prefix used in your migration (subject_id, subject_type)
        return $this->morphTo();
    }

    protected function casts(): array
    {
        return [
            'properties' => 'array',
        ];
    }
}
