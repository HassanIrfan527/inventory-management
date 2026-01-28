<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\V1\OrderResource;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    public function __construct(protected OrderService $orderService)
    {
    }

    public function index(Request $request)
    {
        $status = $request->query('status');
        $contactId = $request->query('contact_id');
        $perPage = (int) $request->query('per_page', 15);

        $orders = $this->orderService->listOrders(
            status: $status,
            contactId: $contactId ? (int) $contactId : null,
            perPage: $perPage,
        );

        return OrderResource::collection($orders);
    }

    public function store(StoreOrderRequest $request): OrderResource
    {
        $validated = $request->validated();

        $order = $this->orderService->createOrder(
            contactId: (int) $validated['contact_id'],
            status: $validated['status'],
            items: $validated['items'],
            deliveryCharge: (int) ($validated['delivery_charge'] ?? 0),
            address: $validated['address'] ?? null,
            generateInvoice: (bool) ($validated['generate_invoice'] ?? false),
        );

        return new OrderResource($order);
    }

    public function show(Order $order): OrderResource
    {
        $order->load(['contact', 'products']);

        return new OrderResource($order);
    }

    public function update(UpdateOrderRequest $request, Order $order): OrderResource
    {
        $updated = $this->orderService->updateOrder($order, $request->validated());

        return new OrderResource($updated);
    }

    public function destroy(Order $order): JsonResponse
    {
        $order->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
