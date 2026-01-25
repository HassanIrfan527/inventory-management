<?php

namespace App\AiAgents;

use App\Models\Category;
use App\Models\Product;
use LarAgent\Agent;
use LarAgent\Attributes\Tool;

class Scout extends Agent
{
    protected $model = 'qwen2.5:7b';

    protected $history = 'session';

    protected $provider = 'ollama';

    protected $tools = [];

    public function instructions()
    {
        return <<<'MARKDOWN'
# IDENTITY
You are **Scout**, the intelligent assistant for our Inventory Management System.
You are built using the **TALL Stack** (Tailwind, Alpine.js, Laravel, Livewire) and you run locally via Ollama.

# YOUR GOAL
Your purpose is to help the store owner manage products, categories, and stock levels efficiently.
You are proactive, concise, and technically aware of the system's structure.

# APP CONTEXT & TECH STACK
- **Framework:** Laravel 12
- **Database:** SQLite (using Eloquent ORM)
- **UI:** Livewire 3, FluxUI, Tailwind CSS v4
- **Current Task:** You are assisting the user in the "Inventory Admin" panel.

# INVENTORY MANAGEMENT KNOWLEDGE
1. This is a basic inventory management system where products can be created, updated, categorized, and tracked.
2. We track products, categories, orders, and invoices.
3. Products have: `name`, `description`, `purchase_price`, `retail_price`, `delivery_charges`.
4. Categories organize products; each product belongs to one or more categories.

# OPERATIONAL RULES
1. **Tool First:** Before answering a question about data, check if you have a tool (like `searchProducts`) to get the real numbers.
2. **Be Concise:** The user is busy. Keep responses short and helpful.
3. **Safety:** Do not mention internal PHP errors. If a tool fails, say "I had trouble accessing the database, please try again."
4. **Formatting:** Use **bolding** for product names and `inline code` for prices or IDs.

# PERSONALITY
You are a "Smart Sidekick." You are friendly, professional, and efficient.
You don't say "As an AI..." — you simply act as Scout.
MARKDOWN;
    }

    public function prompt($message)
    {
        return "User query: {$message}";
    }

    #[Tool('Search for products by name or description')]
    public function searchProducts(string $query)
    {
        $products = Product::where('name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->limit(5)
            ->get(['name', 'retail_price', 'product_id']);

        if ($products->isEmpty()) {
            return "No products found matching '{$query}'.";
        }

        $result = "Found products:\n";
        foreach ($products as $product) {
            $result .= "- **{$product->name}** (ID: `{$product->product_id}`, Price: Rs. {$product->retail_price})\n";
        }

        return $result;
    }

    #[Tool('Get a summary of the inventory')]
    public function getInventorySummary()
    {
        $count = Product::count();
        $totalValue = Product::totalInventoryValue();
        $categoriesCount = Category::count();

        return "Inventory Summary: Total Products: **{$count}**, Total Value: **Rs. {$totalValue}**, Total Categories: **{$categoriesCount}**.";
    }

    #[Tool('Create a new product')]
    public function createProduct(string $name, float $retail_price, ?string $description = null, ?float $purchase_price = null)
    {
        $product = Product::create([
            'name' => $name,
            'retail_price' => $retail_price,
            'description' => $description,
            'purchase_price' => $purchase_price ?? ($retail_price * 0.8), // Mock logic if missing
        ]);

        return "Product '**{$name}**' has been created successfully with ID `{$product->product_id}`.";
    }

    #[Tool('Create a new product category')]
    public function createNewCategory(string $name)
    {
        $category = Category::create(['name' => $name]);

        return "Category '**{$name}**' has been created successfully.";
    }
}
