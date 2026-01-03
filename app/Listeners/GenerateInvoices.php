<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Jobs\GenerateInvoiceJob;
use Illuminate\Contracts\Queue\ShouldQueue;
class GenerateInvoices implements ShouldQueue
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
        if ($event->createInvoice) {
            GenerateInvoiceJob::dispatch($event->order);
        }
        return;
    }
}
