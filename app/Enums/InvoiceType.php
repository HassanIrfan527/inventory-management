<?php

namespace App\Enums;

enum InvoiceType: string
{
    case CUSTOMER = 'customer';
    case SUPPLIER = 'supplier';
}
