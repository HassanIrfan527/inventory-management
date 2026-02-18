<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function listProducts(?string $search = null, ?int $categoryId = null, int $perPage = 15, string $sortBy = 'created_at', string $direction = 'desc'): LengthAwarePaginator
    {
        return Product::query()
            ->with(['categories', 'images']) // Load relationships
            ->search($search)                // Apply fuzzy search
            ->inCategory($categoryId)        // Filter by category
            ->sorted($sortBy, $direction)    // Apply sorting
            ->paginate($perPage);
    }

    /**
     * @param  array<int, UploadedFile>  $images
     */
    public function createProduct(array $data, array $categories = [], array $images = []): Product
    {
        return DB::transaction(function () use ($data, $categories, $images): Product {
            $payload = [
                'name' => $data['name'],
                'description' => $data['description'] ?? '',
                'purchase_price' => $data['purchase_price'] ?? ($data['cost_price'] ?? 0),
                'retail_price' => $data['retail_price'],
                'delivery_charges' => $data['delivery_charges'] ?? 0,
                'sku' => $data['sku'] ?? null,
                'stock_quantity' => $data['stock_quantity'] ?? null,
                'status' => $data['status'] ?? 'active',
                'internal_notes' => $data['internal_notes'] ?? null,
            ];

            $product = Product::create($payload);

            if (! empty($categories)) {
                $product->categories()->sync($categories);
            }

            $this->storeImages($product, $images);

            $this->clearStatsCache();

            return $product->load(['categories', 'images']);
        });
    }

    /**
     * @param  array<int, UploadedFile>  $newImages
     */
    public function updateProduct(Product $product, array $data, ?array $categories = null, array $newImages = []): Product
    {
        return DB::transaction(function () use ($product, $data, $categories, $newImages): Product {
            $payload = [
                'name' => $data['name'] ?? $product->name,
                'description' => $data['description'] ?? $product->description,
                'purchase_price' => $data['purchase_price'] ?? ($data['cost_price'] ?? $product->purchase_price),
                'retail_price' => $data['retail_price'] ?? $product->retail_price,
                'delivery_charges' => $data['delivery_charges'] ?? $product->delivery_charges,
                'sku' => $data['sku'] ?? $product->sku,
                'stock_quantity' => $data['stock_quantity'] ?? $product->stock_quantity,
                'status' => $data['status'] ?? $product->status,
                'internal_notes' => $data['internal_notes'] ?? $product->internal_notes,
            ];

            $product->update($payload);

            if ($categories !== null) {
                $product->categories()->sync($categories);
            }

            if (! empty($newImages)) {
                $this->storeImages($product, $newImages);
            }

            $this->clearStatsCache();

            return $product->load(['categories', 'images']);
        });
    }

    /**
     * @param  array<int, int>  $productIds
     */
    public function assignCategoryToProducts(array $productIds, int $categoryId): int
    {
        $category = Category::findOrFail($categoryId);

        $products = Product::whereIn('id', $productIds)->get();

        foreach ($products as $product) {
            $product->categories()->sync([$category->id]);
        }

        $this->clearCategoriesCache();

        return $products->count();
    }

    public function deleteProduct(Product $product): void
    {
        $product->delete();
        $this->clearStatsCache();
    }

    /**
     * @param  array<int, UploadedFile>  $images
     */
    protected function storeImages(Product $product, array $images): void
    {
        foreach ($images as $image) {
            if (! $image instanceof UploadedFile) {
                continue;
            }

            $path = $image->store('product_images', 'public');

            $product->images()->create([
                'image_path' => $path,
            ]);
        }
    }

    public function calculateStats(): array
    {
        $key = 'product:stats:'.Auth::id();

        return Cache::remember($key, now()->addMinutes(30), function () {
            $totalRetail = Product::sum('retail_price');
            $totalPurchase = Product::sum('purchase_price');
            $avg_margin = $totalRetail > 0 ? (($totalRetail - $totalPurchase) / $totalRetail) * 100 : 0;

            return [
                'totalProducts' => Product::count(),
                'totalInventoryValue' => Product::totalInventoryValue(),
                'avg_margin' => $avg_margin,
            ];
        });
    }

    public function getCategories()
    {
        $key = 'product:categories:'.Auth::id();

        return Cache::remember($key, now()->addMinutes(30), function () {
            return Category::all();
        });
    }

    public function clearStatsCache(): void
    {
        Cache::forget('product:stats:'.Auth::id());
    }

    public function clearCategoriesCache(): void
    {
        Cache::forget('product:categories:'.Auth::id());
    }
}
