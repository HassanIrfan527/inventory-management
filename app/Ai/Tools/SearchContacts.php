<?php

namespace App\Ai\Tools;

use App\Services\ContactService;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Tools\Request;
use Stringable;

class SearchContacts implements Tool
{
    /**
     * Get the description of the tool's purpose.
     */
    public function description(): Stringable|string
    {
        return 'Search for contacts by name or email.';
    }

    /**
     * Execute the tool.
     */
    public function handle(Request $request): Stringable|string
    {
        $service = app(ContactService::class);
        $contacts = $service->listContacts(search: $request['query'], perPage: 10);

        if ($contacts->isEmpty()) {
            return "No contacts found matching '{$request['query']}'.";
        }

        $result = "Found {$contacts->total()} contact(s):\n";

        foreach ($contacts as $contact) {
            $type = $contact->type?->value ?? 'N/A';
            $result .= "- **{$contact->name}** (ID: `{$contact->contact_id}`, Type: {$type}, Email: {$contact->email}, Phone: {$contact->phone})\n";
        }

        return $result;
    }

    /**
     * Get the tool's schema definition.
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'query' => $schema->string()->description('Search term for contact name or email')->required(),
        ];
    }
}
