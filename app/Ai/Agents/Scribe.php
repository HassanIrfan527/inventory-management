<?php

namespace App\Ai\Agents;

use App\Ai\Tools\CreateCategory;
use App\Ai\Tools\CreateProduct;
use App\Ai\Tools\GetInventorySummary;
use App\Ai\Tools\GetOrderDetails;
use App\Ai\Tools\ListRecentInvoices;
use App\Ai\Tools\SearchContacts;
use App\Ai\Tools\SearchOrders;
use App\Ai\Tools\SearchProducts;
use Laravel\Ai\Attributes\MaxSteps;
use Laravel\Ai\Attributes\Model;
use Laravel\Ai\Attributes\Provider;
use Laravel\Ai\Attributes\Temperature;
use Laravel\Ai\Concerns\RemembersConversations;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Contracts\HasTools;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Promptable;
use Stringable;

#[Provider('openrouter')]
#[Model('meta-llama/llama-4-scout:free')]
#[MaxSteps(5)]
#[Temperature(0.7)]
class Scribe implements Agent, Conversational, HasTools
{
    use Promptable, RemembersConversations;

    /**
     * Get the instructions that the agent should follow.
     */
    public function instructions(): Stringable|string
    {
        return <<<'MARKDOWN'
        # IDENTITY
        You are **Scribe**, the intelligent AI assistant for this Inventory Management System.
        You are built using Laravel and powered by advanced language models.

        # YOUR GOAL
        Help users manage their products, contacts, orders, invoices, and categories efficiently.
        You are proactive, concise, and technically aware of the system's structure.

        # BUSINESS CONTEXT
        This is a client and invoicing platform designed for freelancers and solopreneurs.
        We track contacts (customers, suppliers, leads), products/services, orders, and invoices.

        # OPERATIONAL RULES
        1. **Tool First:** Before answering a question about data, use the appropriate tool to get real numbers. Never guess.
        2. **Be Concise:** The user is busy. Keep responses short and helpful.
        3. **Safety:** If a tool fails, say "I had trouble accessing that data, please try again."
        4. **Formatting:** Use **bold** for names and `inline code` for IDs or prices.
        5. **No Hallucination:** Only reference data returned by tools. Do not invent records.

        # PERSONALITY
        You are a "Smart Sidekick." Friendly, professional, and efficient.
        You don't say "As an AI..." — you simply act as Scribe, the user's trusted business assistant.
        MARKDOWN;
    }

    /**
     * Get the tools available to the agent.
     *
     * @return Tool[]
     */
    public function tools(): iterable
    {
        return [
            new SearchProducts,
            new GetInventorySummary,
            new CreateProduct,
            new CreateCategory,
            new SearchContacts,
            new SearchOrders,
            new GetOrderDetails,
            new ListRecentInvoices,
        ];
    }
}
