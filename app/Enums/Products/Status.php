<?php

namespace App\Enums\Products;

enum Status: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case DISCONTINUED = 'discontinued';
}
