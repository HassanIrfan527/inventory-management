<?php

namespace App\Enums\Order;

enum OrderSource: string
{
    case MANUAL = 'manual';
    case API = 'api';
    case IMPORT = 'import';

}
