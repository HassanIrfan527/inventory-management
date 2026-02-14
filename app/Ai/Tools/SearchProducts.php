<?php

namespace App\Ai\Tools;

use App\Services\ProductService;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Tools\Request;
use Stringable;

class SearchProducts implements Tool
{
    /**
     * Get the description of the tool's purpose.
     */
    public function description(): Stringable|string
    {
        return 'Search for products by name, SKU, or product ID.';
    }

    /**
     * Execute the tool.
     */
    public function handle(Request $request): Stringable|string
    {
        $service = app(ProductService::class);
        $products = $service->listProducts(search: $request['query'], perPage: 10);

        if ($products->isEmpty()) {
            return "No products found matching '{$request['query']}'.";
        }

        $result = "Found {$products->total()} product(s):\n";

        foreach ($products as $product) {
            $categories = $product->categories->pluck('name')->join(', ') ?: 'None';
            $result .= "- **{$product->name}** (ID: `{$product->product_id}`, SKU: `{$product->sku}`, Price: Rs. {$product->retail_price}, Stock: {$product->stock_quantity}, Categories: {$categories})\n";
        }

        return $result;
    }

    /**
     * Get the tool's schema definition.
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'query' => $schema->string()->description('Search term for product name, SKU, or product ID')->required(),
        ];
    }
}
