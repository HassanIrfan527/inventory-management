<?php

namespace App\Ai\Tools;

use App\Services\InvoiceService;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Tools\Request;
use Stringable;

class ListRecentInvoices implements Tool
{
    /**
     * Get the description of the tool's purpose.
     */
    public function description(): Stringable|string
    {
        return 'List recent invoices, optionally filtered by status or type (customer, supplier).';
    }

    /**
     * Execute the tool.
     */
    public function handle(Request $request): Stringable|string
    {
        $service = app(InvoiceService::class);
        $invoices = $service->listInvoices(
            status: $request['status'] ?? null,
            type: $request['type'] ?? null,
            perPage: $request['limit'] ?? 10,
        );

        if ($invoices->isEmpty()) {
            return 'No invoices found.';
        }

        $result = "Found {$invoices->total()} invoice(s):\n";

        foreach ($invoices as $invoice) {
            $contactName = $invoice->order?->contact?->name ?? 'N/A';
            $dueDate = $invoice->due_date?->format('Y-m-d') ?? 'N/A';
            $result .= "- `{$invoice->invoice_number}` — {$contactName} — Rs. {$invoice->total_amount} — Type: {$invoice->type} — Status: {$invoice->status} — Due: {$dueDate}\n";
        }

        return $result;
    }

    /**
     * Get the tool's schema definition.
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'status' => $schema->string()->description('Filter by invoice status'),
            'type' => $schema->string()->description('Filter by invoice type: customer or supplier'),
            'limit' => $schema->integer()->description('Number of invoices to return. Defaults to 10.'),
        ];
    }
}
