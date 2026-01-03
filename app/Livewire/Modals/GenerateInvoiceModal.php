<?php

namespace App\Livewire\Modals;

use App\Models\Order;
use Flux\Flux;
use Livewire\Attributes\On;
use Livewire\Component;

class GenerateInvoiceModal extends Component
{
    public ?Order $order = null;

    #[On('open-generate-invoice-modal')]
    public function open(int $orderId)
    {
        $this->order = Order::with(['contact', 'products'])->find($orderId);

        Flux::modal('generate-invoice-modal')->show();
    }

    public function download()
    {
        // This is a mockup for now as requested, but we can set up the download logic here
        $this->dispatch('toast', variant: 'success', heading: 'Download Started', text: 'Your invoice is being generated and will download shortly.');
    }

    public function render()
    {
        return view('livewire.modals.generate-invoice-modal');
    }
}
