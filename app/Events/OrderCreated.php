<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderCreated
{
    public Order $order;

    public bool $createInvoice;

    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct($order, $createInvoice = true)
    {
        $this->order = $order;
        $this->createInvoice = $createInvoice;
    }
}
