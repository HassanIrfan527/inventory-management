<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Http\Resources\V1\ItemResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ItemController extends Controller
{
    public function __construct(protected ProductService $productService)
    {
    }

    public function index(Request $request)
    {
        $search = $request->query('search');
        $categoryId = $request->query('category_id');
        $perPage = (int) $request->query('per_page', 15);

        $products = $this->productService->listProducts(
            search: $search,
            categoryId: $categoryId ? (int) $categoryId : null,
            perPage: $perPage,
        );

        return ItemResource::collection($products);
    }

    public function store(StoreItemRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $product = $this->productService->createProduct(
            data: $validated,
            categories: $validated['categories'] ?? [],
            images: $request->file('product_images', []),
        );

        return (new ItemResource($product))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Product $product): ItemResource
    {
        $product->load(['categories', 'images']);

        return new ItemResource($product);
    }

    public function update(UpdateItemRequest $request, Product $product): ItemResource
    {
        $validated = $request->validated();

        $updated = $this->productService->updateProduct(
            $product,
            $validated,
            $validated['categories'] ?? null,
            $request->file('product_images', []),
        );

        return new ItemResource($updated);
    }

    public function destroy(Product $product): JsonResponse
    {
        $this->productService->deleteProduct($product);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
