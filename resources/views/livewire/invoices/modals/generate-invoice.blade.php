<?php

use App\Models\Order;
use Flux\Flux;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component
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
        $this->dispatch('toast', variant: 'success', heading: 'Download Started', text: 'Your invoice is being generated and will download shortly.');
    }
};
?>

<flux:modal name="generate-invoice-modal" class="min-w-[20rem] md:min-w-[50rem] space-y-6">
    @if ($order)
        <div class="flex items-center justify-between">
            <div>
                <flux:heading size="lg">Generate Invoice</flux:heading>
                <flux:subheading>Preview and download invoice for {{ $order->order_number }}</flux:subheading>
            </div>
            <flux:button icon="arrow-down-tray" variant="primary" wire:click="download">
                Download PDF
            </flux:button>
        </div>

        <flux:separator />

        <!-- Invoice Preview Area -->
        <div class="rounded-xl border border-neutral-200 bg-neutral-50 p-8 dark:border-neutral-700 dark:bg-neutral-800/50 shadow-inner overflow-hidden">
            <div class="bg-white dark:bg-neutral-900 shadow-xl rounded-sm p-10 max-w-3xl mx-auto border border-neutral-100 dark:border-neutral-800">
                <!-- Invoice Header -->
                <div class="flex justify-between items-start mb-12">
                    <div>
                        <h2 class="text-3xl font-black text-primary-600 dark:text-primary-400 tracking-tighter uppercase mb-1">INVOICE</h2>
                        <div class="flex flex-col text-sm text-neutral-500 dark:text-neutral-400">
                            <span>Number: <strong class="text-neutral-900 dark:text-white">{{ str_replace('ORDER', 'INV', $order->order_number) }}</strong></span>
                            <span>Date: <strong class="text-neutral-900 dark:text-white">{{ now()->format('M d, Y') }}</strong></span>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="flex items-center gap-2 justify-end mb-2">
                            <div class="h-8 w-8 bg-black dark:bg-white flex items-center justify-center rounded">
                                <span class="text-white dark:text-black font-bold italic">A</span>
                            </div>
                            <span class="text-xl font-bold tracking-tight">ANTIGRAVITY</span>
                        </div>
                        <p class="text-xs text-neutral-500 max-w-[150px] leading-relaxed">
                            123 Business Avenue, Suite 100<br>
                            Tech City, TC 54321
                        </p>
                    </div>
                </div>

                <!-- Billing Details -->
                <div class="grid grid-cols-2 gap-12 mb-12">
                    <div>
                        <h4 class="text-[10px] font-bold text-neutral-400 uppercase tracking-widest mb-3">BILL TO</h4>
                        <div class="space-y-1">
                            <p class="font-bold text-neutral-900 dark:text-white text-lg leading-tight">{{ $order->contact->name ?? 'Guest Customer' }}</p>
                            <p class="text-sm text-neutral-600 dark:text-neutral-400 leading-relaxed">
                                {{ $order->address ?: ($order->contact->address ?? 'No address provided') }}
                            </p>
                            @if($order->contact->phone ?? false)
                                <p class="text-xs text-neutral-500 mt-2">{{ $order->contact->phone }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="text-right">
                        <h4 class="text-[10px] font-bold text-neutral-400 uppercase tracking-widest mb-3">ORDER STATUS</h4>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider {{ $order->status === 'Completed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ $order->status }}
                        </span>
                    </div>
                </div>

                <!-- Table -->
                <table class="w-full mb-12">
                    <thead>
                        <tr class="border-b-2 border-neutral-900 dark:border-white">
                            <th class="text-left py-4 text-[10px] font-black uppercase tracking-widest text-neutral-400">ITEM DESCRIPTION</th>
                            <th class="text-center py-4 text-[10px] font-black uppercase tracking-widest text-neutral-400 w-20">QTY</th>
                            <th class="text-right py-4 text-[10px] font-black uppercase tracking-widest text-neutral-400 w-32">PRICE</th>
                            <th class="text-right py-4 text-[10px] font-black uppercase tracking-widest text-neutral-400 w-32">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-100 dark:divide-neutral-800">
                        @foreach($order->products as $product)
                            <tr>
                                <td class="py-5">
                                    <p class="font-bold text-neutral-900 dark:text-white leading-tight uppercase">{{ $product->name }}</p>
                                    <p class="text-[10px] text-neutral-400 mt-1">Product ID: #{{ $product->id }}</p>
                                </td>
                                <td class="py-5 text-center text-sm font-medium text-neutral-600 dark:text-neutral-400">{{ $product->pivot->quantity }}</td>
                                <td class="py-5 text-right text-sm font-medium text-neutral-600 dark:text-neutral-400">Rs. {{ number_format($product->pivot->sale_price) }}</td>
                                <td class="py-5 text-right text-sm font-bold text-neutral-900 dark:text-white">Rs. {{ number_format($product->pivot->quantity * $product->pivot->sale_price) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Totals -->
                <div class="flex justify-end">
                    <div class="w-64 space-y-3">
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-neutral-500 font-medium">Subtotal</span>
                            <span class="text-neutral-900 dark:text-white font-bold">Rs. {{ number_format($order->total_amount - $order->delivery_charge) }}</span>
                        </div>
                        @if($order->delivery_charge > 0)
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-neutral-500 font-medium">Delivery Fee</span>
                                <span class="text-neutral-900 dark:text-white font-bold">Rs. {{ number_format($order->delivery_charge) }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between items-center pt-3 border-t border-neutral-100 dark:border-neutral-800">
                            <span class="text-lg font-black tracking-tight uppercase">Total</span>
                            <span class="text-2xl font-black text-primary-600 dark:text-primary-400 tracking-tighter">Rs. {{ number_format($order->total_amount) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Footer Note -->
                <div class="mt-20 pt-8 border-t border-dotted border-neutral-200 dark:border-neutral-800 text-center">
                    <p class="text-xs text-neutral-400 italic">Thank you for your business! If you have any questions, please contact billing@antigravity.io</p>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-2">
            <flux:modal.close>
                <flux:button variant="ghost">Close Preview</flux:button>
            </flux:modal.close>
        </div>
    @else
        <div class="flex flex-col items-center justify-center py-12">
            <flux:icon name="magnifying-glass" size="xl" class="text-neutral-200 mb-4" />
            <flux:heading>Loading Invoice...</flux:heading>
        </div>
    @endif
</flux:modal>
