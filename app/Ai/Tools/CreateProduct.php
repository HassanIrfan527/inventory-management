<?php

namespace App\Ai\Tools;

use App\Services\ProductService;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Tools\Request;
use Stringable;

class CreateProduct implements Tool
{
    /**
     * Get the description of the tool's purpose.
     */
    public function description(): Stringable|string
    {
        return 'Create a new product with name, retail price, and optional description, purchase price, and stock quantity.';
    }

    /**
     * Execute the tool.
     */
    public function handle(Request $request): Stringable|string
    {
        $service = app(ProductService::class);

        $product = $service->createProduct([
            'name' => $request['name'],
            'retail_price' => $request['retail_price'],
            'description' => $request['description'] ?? '',
            'purchase_price' => $request['purchase_price'] ?? ($request['retail_price'] * 0.8),
            'stock_quantity' => $request['stock_quantity'] ?? 0,
        ]);

        return "Product **{$product->name}** created successfully with ID `{$product->product_id}`.";
    }

    /**
     * Get the tool's schema definition.
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'name' => $schema->string()->description('The product name')->required(),
            'retail_price' => $schema->number()->description('The retail/selling price')->required(),
            'description' => $schema->string()->description('Product description'),
            'purchase_price' => $schema->number()->description('The purchase/cost price. Defaults to 80% of retail price if not provided.'),
            'stock_quantity' => $schema->integer()->description('Initial stock quantity. Defaults to 0.'),
        ];
    }
}
