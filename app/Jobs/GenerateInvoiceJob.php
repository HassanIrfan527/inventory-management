<?php

namespace App\Jobs;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;

class GenerateInvoiceJob implements ShouldQueue
{
    use Queueable;

    public $order;

    /**
     * Create a new job instance.
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $invoice = Invoice::create([
            'order_id' => $this->order->id,
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
        $fileName = 'invoices/'.$invoice->invoice_number.'.pdf';

        // 3. Save the actual file to Storage
        Storage::disk('public')->put($fileName, $pdf->output());

        // 4. Update the Database with the path
        $invoice->update([
            'invoice_path' => $fileName,
        ]);
    }
}
