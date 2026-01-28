<?php

namespace App\Livewire;

use App\AiAgents\Vector as VectorAIAgent;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Vector - Your Personal Inventory Assistant')]
class Vector extends Component
{
    public $input = '';

    public $userInput = '';

    public $chatId;

    public function mount()
    {
        // Use a unique but persistent ID for this user's session
        $this->chatId = 'vector_chat_'.auth()->id();
    }

    public function sendMessage()
    {
        if (empty(trim($this->userInput))) {
            return;
        }

        // Use the standardized LarAgent 'for' method to maintain session
        VectorAIAgent::for($this->chatId)->respond($this->userInput);

        // Clear input
        $this->userInput = '';
    }

    public function render()
    {
        // Fetch history using the agent's history driver (session by default)
        $rawHistory = VectorAIAgent::for($this->chatId)->chatHistory()->toArray();

        // Normalize history to ensure 'content' is always a string for the blade view
        $history = array_map(function ($chat) {
            if (is_array($chat['content'])) {
                // If it's a single part with a 'text' key
                if (isset($chat['content']['text'])) {
                    $chat['content'] = $chat['content']['text'];
                } else {
                    // If it's an array of parts, join all 'text' parts
                    $parts = array_filter($chat['content'], fn ($part) => isset($part['text']));
                    $chat['content'] = implode("\n", array_column($parts, 'text'));
                }
            }

            // Ensure content is always a string (convert null/empty to empty string)
            $chat['content'] = (string) ($chat['content'] ?? '');

            return $chat;
        }, $rawHistory);

        return view('livewire.vector', [
            'history' => $history ?: [],
        ]);
    }
}
