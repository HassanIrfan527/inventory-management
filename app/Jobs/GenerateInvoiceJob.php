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
        $order = $this->order->load(['contact', 'products']);

        $invoice = Invoice::create([
            'order_id' => $order->id,
            'subtotal_amount' => $order->subtotal_amount,
            'tax_amount' => $order->tax_amount,
            'discount_amount' => $order->discount_amount,
            'delivery_charge' => $order->delivery_charge,
            'total_amount' => $order->total_amount,
            'currency' => 'PKR',
            'billing_name' => $order->contact?->name,
            'billing_email' => $order->contact?->email,
            'billing_phone' => $order->contact?->phone,
            'billing_address' => $order->address ?: $order->contact?->address,
            'shipping_name' => $order->contact?->name,
            'shipping_address' => $order->address ?: $order->contact?->address,
            'status' => \App\Enums\InvoiceStatus::PENDING->value,
            'type' => \App\Enums\InvoiceType::CUSTOMER->value,
            'due_date' => now()->addDays(30),
            'issued_at' => now(),
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
