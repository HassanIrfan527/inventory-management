<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Http\Resources\V1\InvoiceResource;
use App\Models\Invoice;
use App\Services\InvoiceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InvoiceController extends Controller
{
    public function __construct(protected InvoiceService $invoiceService) {}

    public function index(Request $request)
    {
        $status = $request->query('status');
        $type = $request->query('type');
        $perPage = (int) $request->query('per_page', 15);

        $invoices = $this->invoiceService->listInvoices($status, $type, $perPage);

        return InvoiceResource::collection($invoices);
    }

    public function show(Invoice $invoice): InvoiceResource
    {
        $invoice->load(['order.contact']);

        return new InvoiceResource($invoice);
    }

    public function update(UpdateInvoiceRequest $request, Invoice $invoice): InvoiceResource
    {
        $updated = $this->invoiceService->updateInvoice($invoice, $request->validated());

        return new InvoiceResource($updated);
    }

    public function destroy(Invoice $invoice): JsonResponse
    {
        $invoice->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
