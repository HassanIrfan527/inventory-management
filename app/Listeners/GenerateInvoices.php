<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Models\Invoice;
use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Queue\InteractsWithQueue;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
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
        $order = $event->order;


        $invoice = Invoice::create([
            'order_id' => $order->id,
            'due_date' => now()->addDays(30)->toDateString(),
        ]);

        $this->finalizeInvoice($invoice->id);
    }
    private function finalizeInvoice($invoiceId)
    {
        $invoice = Invoice::with('order.products', 'order.contact')->findOrFail($invoiceId);

        // 1. Point to your Blade file and pass data
        $pdf = Pdf::loadView('invoice.simple', ['invoice' => $invoice]);

        // 2. Define the filename and path
        $fileName = 'invoices/' . $invoice->invoice_number . '.pdf';

        // 3. Save the actual file to Storage
        Storage::disk('public')->put($fileName, $pdf->output());

        // 4. Update the Database with the path
        $invoice->update([
            'invoice_path' => $fileName
        ]);
    }
}
