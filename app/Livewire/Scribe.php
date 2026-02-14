<?php

namespace App\Livewire;

use App\Ai\Agents\Scribe as ScribeAgent;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Scribe - Your AI Business Assistant')]
class Scribe extends Component
{
    public string $userInput = '';

    public ?string $conversationId = null;

    public function mount(): void
    {
        $latest = DB::table('agent_conversations')
            ->where('user_id', auth()->id())
            ->latest('updated_at')
            ->first();

        $this->conversationId = $latest?->id;
    }

    public function sendMessage(): void
    {
        if (empty(trim($this->userInput))) {
            return;
        }

        $input = $this->userInput;
        $this->userInput = '';

        $agent = new ScribeAgent;

        if ($this->conversationId) {
            $response = $agent
                ->continue($this->conversationId, as: auth()->user())
                ->prompt($input);
        } else {
            $response = $agent
                ->forUser(auth()->user())
                ->prompt($input);

            $this->conversationId = $response->conversationId;
        }
    }

    public function newConversation(): void
    {
        $this->conversationId = null;
    }

    public function render()
    {
        $history = [];

        if ($this->conversationId) {
            $history = DB::table('agent_conversation_messages')
                ->where('conversation_id', $this->conversationId)
                ->orderBy('created_at')
                ->get()
                ->filter(fn ($msg) => in_array($msg->role, ['user', 'assistant']))
                ->map(fn ($msg) => [
                    'role' => $msg->role,
                    'content' => $msg->content ?? '',
                ])
                ->values()
                ->toArray();
        }

        return view('livewire.scribe', [
            'history' => $history,
        ]);
    }
}
