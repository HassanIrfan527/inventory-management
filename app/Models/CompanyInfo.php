<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
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
}
