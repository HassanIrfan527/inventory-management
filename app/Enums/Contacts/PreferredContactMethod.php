<?php

namespace App\Enums\Contacts;

enum PreferredContactMethod: string
{
    case EMAIL = 'Email';
    case PHONE = 'Phone';
    case MAIL = 'Mail';
    case SMS = 'SMS';
    case OTHER = 'Other';
}
