<?php

namespace App\Services;

use App\Models\Invoice;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class InvoiceService
{
    public function listInvoices(?string $status = null, ?string $type = null, int $perPage = 15): LengthAwarePaginator
    {
        return Invoice::query()
            ->with(['order.contact'])
            ->when($status, fn ($query, $status) => $query->where('status', $status))
            ->when($type, fn ($query, $type) => $query->where('type', $type))
            ->latest()
            ->paginate($perPage);
    }

    public function updateInvoice(Invoice $invoice, array $data): Invoice
    {
        $invoice->update([
            'status' => $data['status'] ?? $invoice->status,
            'due_date' => $data['due_date'] ?? $invoice->due_date,
        ]);

        return $invoice->refresh()->load(['order.contact']);
    }
}
