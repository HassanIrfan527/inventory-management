<?php

namespace App\Enums\Contacts;

enum Source: string
{
    case WEB = 'Web';
    case REFERRAL = 'Referral';
    case SOCIAL_MEDIA = 'Social Media';
    case ADVERTISEMENT = 'Advertisement';
    case OTHER = 'Other';
}
