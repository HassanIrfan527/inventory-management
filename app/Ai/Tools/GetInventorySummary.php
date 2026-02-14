<?php

namespace App\Ai\Tools;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Tools\Request;
use Stringable;

class GetInventorySummary implements Tool
{
    /**
     * Get the description of the tool's purpose.
     */
    public function description(): Stringable|string
    {
        return 'Get a summary of the inventory including product counts, total value, categories, and low stock alerts.';
    }

    /**
     * Execute the tool.
     */
    public function handle(Request $request): Stringable|string
    {
        $productCount = Product::count();
        $totalValue = Product::totalInventoryValue();
        $categoryCount = Category::count();
        $lowStockCount = Product::where('stock_quantity', '<', 10)
            ->where('stock_quantity', '>', 0)
            ->count();
        $outOfStockCount = Product::where('stock_quantity', 0)->count();
        $recentOrderCount = Order::where('created_at', '>=', now()->subDays(30))->count();

        return <<<TEXT
        Inventory Summary:
        - Total Products: **{$productCount}**
        - Total Inventory Value: **Rs. {$totalValue}**
        - Total Categories: **{$categoryCount}**
        - Low Stock (< 10 units): **{$lowStockCount}**
        - Out of Stock: **{$outOfStockCount}**
        - Orders (Last 30 days): **{$recentOrderCount}**
        TEXT;
    }

    /**
     * Get the tool's schema definition.
     */
    public function schema(JsonSchema $schema): array
    {
        return [];
    }
}
