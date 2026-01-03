<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Models\Contact;

class LogActivity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        Contact::find($event->order->contact_id, 'id')->logActivity('Order Created & Invoice Generated', $event->order, json_encode([
            'status' => $event->order->status,
            'total_amount' => $event->order->total_amount,
        ]));
    }
}
