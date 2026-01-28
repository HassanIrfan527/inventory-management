<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function listProducts(?string $search = null, ?int $categoryId = null, int $perPage = 15, string $sortBy = 'created_at', string $direction = 'desc'): LengthAwarePaginator
    {
        $query = Product::query()
            ->with(['categories', 'images'])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%'.$search.'%')
                        ->orWhere('product_id', 'like', '%'.$search.'%');
                });
            })
            ->when($categoryId, function ($query, $categoryId) {
                $query->whereHas('categories', function ($q) use ($categoryId) {
                    $q->where('categories.id', $categoryId);
                });
            })
            ->orderBy($sortBy, $direction);

        return $query->paginate($perPage);
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
                'purchase_price' => $data['purchase_price'] ?? $data['cost_price'],
                'retail_price' => $data['retail_price'],
                'delivery_charges' => $data['delivery_charges'] ?? 0,
            ];

            $product = Product::create($payload);

            if (! empty($categories)) {
                $product->categories()->sync($categories);
            }

            $this->storeImages($product, $images);

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
            ];

            $product->update($payload);

            if ($categories !== null) {
                $product->categories()->sync($categories);
            }

            if (! empty($newImages)) {
                $this->storeImages($product, $newImages);
            }

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

        return $products->count();
    }

    public function deleteProduct(Product $product): void
    {
        $product->delete();
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
}
