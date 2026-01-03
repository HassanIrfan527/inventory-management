<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderCreated
{
    public Order $order;
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct($order) {
        $this->order = $order;
    }

}
