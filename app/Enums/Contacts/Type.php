<?php

namespace App\Enums\Contacts;

enum Type: string
{
    case CUSTOMER = 'customer';
    case SUPPLIER = 'supplier';
    case LEAD = 'lead';
}
