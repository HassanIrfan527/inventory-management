<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use BelongsToUser;

    protected $fillable = ['name'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
