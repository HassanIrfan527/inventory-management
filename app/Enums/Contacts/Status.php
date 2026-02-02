<?php

namespace App\Enums\Contacts;

enum Status: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case BLOCKED = 'blocked';

}
