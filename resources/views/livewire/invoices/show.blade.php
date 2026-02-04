<?php

use App\Models\Invoice;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;

new #[Layout('layouts.app')] class extends Component {
    public Invoice $invoice;

    public function mount(Invoice $invoice)
    {
        $this->invoice = $invoice->load(['order.contact', 'order.products']);
    }

    public function title(): string
    {
        return "Invoice {$this->invoice->invoice_number}";
    }

    public function download()
    {
        $pdf = Pdf::loadView('invoice.modern', ['invoice' => $this->invoice]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $this->invoice->invoice_number . '.pdf');
    }
};
?>

<div class="flex h-full w-full flex-1 flex-col gap-8 pb-12">
    <!-- Breadcrumbs & Actions -->
    <div class="flex items-center justify-between">
         @php
        $breadcrumbItem = [
            [
                'name' => 'Invoices',
                'href' => route('invoices'),
                'icon' => 'document-text',
            ],
            [
                'name' => $invoice->invoice_number,
                'href' => route('invoices.show', $invoice->id),
                'icon' => 'eye',
            ],
        ];
    @endphp
    <!-- Breadcrumbs -->
    <x-custom-breadcrumb :items="$breadcrumbItem"></x-custom-breadcrumb>

        <div class="flex items-center gap-2">
            <flux:button wire:click="download" icon="download" variant="outline" size="sm">Download PDF</flux:button>
            <flux:button icon="printer" variant="outline" size="sm" onclick="window.print()">Print</flux:button>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
        <!-- Main Invoice Paper -->
        <div class="lg:col-span-2 flex flex-col gap-6">
            <div class="overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <!-- Header Section -->
                <div class="relative bg-emerald-600 px-8 py-10 dark:bg-emerald-900/50">
                    <!-- Decorative Background Element -->
                    <div class="absolute right-0 top-0 h-full w-32 translate-x-12 -skew-x-12 bg-white/10"></div>

                    <div class="relative flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-white/20 backdrop-blur-sm">
                                <x-app-logo-icon class="size-8" variant="white" />
                            </div>
                            <div class="text-white">
                                <h1 class="text-2xl font-black italic tracking-tight">{{ config('app.name') }}</h1>
                                <p class="text-xs font-medium text-emerald-100/80">INVENTORY MANAGEMENT SYSTEM</p>
                            </div>
                        </div>
                        <div class="text-right text-white">
                            <h2 class="text-3xl font-black uppercase tracking-tighter">Invoice</h2>
                            <p class="text-sm font-bold opacity-80">No. {{ $invoice->invoice_number }}</p>
                        </div>
                    </div>
                </div>

                <!-- Info Grid -->
                <div class="grid grid-cols-1 border-b border-zinc-100 bg-zinc-50/50 px-8 py-6 sm:grid-cols-3 dark:border-zinc-800 dark:bg-zinc-800/20">
                    <div class="space-y-1">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-zinc-400">Invoice To</p>
                        <p class="font-bold text-zinc-900 dark:text-white">{{ $invoice->billing_name ?? 'N/A' }}</p>
                        <p class="text-xs text-zinc-500 leading-tight">
                            {{ $invoice->billing_address ?? 'No address provided' }}
                        </p>
                        @if($invoice->billing_phone)
                        <p class="text-[10px] text-zinc-400">{{ $invoice->billing_phone }}</p>
                        @endif
                        @if($invoice->billing_email)
                        <p class="text-[10px] text-zinc-400">{{ $invoice->billing_email }}</p>
                        @endif
                    </div>
                    <div class="mt-4 sm:mt-0 space-y-1">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-zinc-400">Date Issued</p>
                        <p class="font-bold text-zinc-900 dark:text-white">{{ ($invoice->issued_at ?? $invoice->created_at)->format('M d, Y') }}</p>
                        <p class="text-[10px] font-bold uppercase tracking-widest text-zinc-400 mt-2">Due Date</p>
                        <p class="font-bold text-zinc-900 dark:text-white">{{ $invoice->due_date ? $invoice->due_date->format('M d, Y') : 'Immediate' }}</p>
                    </div>
                    <div class="mt-4 sm:mt-0 text-sm sm:text-right space-y-2">
                         <p class="text-[10px] font-bold uppercase tracking-widest text-zinc-400">Status</p>
                         <div>
                             <span @class([
                                 'inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-bold uppercase',
                                 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' => $invoice->status === 'paid',
                                 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400' => $invoice->status === 'pending',
                                 'bg-rose-100 text-rose-700 dark:bg-rose-900/30 dark:text-rose-400' => $invoice->status === 'overdue',
                                 'bg-zinc-100 text-zinc-700 dark:bg-zinc-900/30 dark:text-zinc-400' => !in_array($invoice->status, ['paid', 'pending', 'overdue']),
                             ])>
                                 <span @class([
                                     'h-1.5 w-1.5 rounded-full',
                                     'bg-emerald-500' => $invoice->status === 'paid',
                                     'bg-amber-500' => $invoice->status === 'pending',
                                     'bg-rose-500' => $invoice->status === 'overdue',
                                     'bg-zinc-500' => !in_array($invoice->status, ['paid', 'pending', 'overdue']),
                                 ])></span>
                                 {{ str_replace('_', ' ', $invoice->status) }}
                             </span>
                         </div>
                    </div>
                </div>

                <!-- Products Table -->
                <div class="p-0">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-zinc-50 text-[10px] font-black uppercase tracking-widest text-zinc-400 dark:bg-zinc-800/40">
                                <th class="px-8 py-3">Description</th>
                                <th class="px-4 py-3 text-center">Qty</th>
                                <th class="px-4 py-3 text-right">Price</th>
                                <th class="px-8 py-3 text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                            @foreach($invoice->order->products as $product)
                            <tr class="group">
                                <td class="px-8 py-5">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-zinc-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                                            {{ $product->name }}
                                        </span>
                                        <span class="text-xs text-zinc-500">{{ $product->sku }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-5 text-center">
                                    <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-zinc-100 text-xs font-bold text-zinc-600 dark:bg-zinc-800 dark:text-zinc-400">
                                        {{ $product->pivot->quantity }}
                                    </span>
                                </td>
                                <td class="px-4 py-5 text-right font-medium text-zinc-600 dark:text-zinc-400">
                                    {{ number_format($product->pivot->sale_price, 2) }}
                                </td>
                                <td class="px-8 py-5 text-right font-bold text-zinc-900 dark:text-white">
                                    {{ number_format($product->pivot->quantity * $product->pivot->sale_price, 2) }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Totals Section -->
                <div class="flex justify-end p-8 bg-zinc-50/50 dark:bg-zinc-800/20">
                    <div class="w-full max-w-[280px] space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-zinc-500">Subtotal</span>
                            <span class="font-bold text-zinc-900 dark:text-white">Rs. {{ number_format($invoice->subtotal_amount, 2) }}</span>
                        </div>
                        @if($invoice->tax_amount > 0)
                        <div class="flex justify-between text-sm">
                            <span class="text-zinc-500">Tax</span>
                            <span class="font-bold text-zinc-900 dark:text-white">+ Rs. {{ number_format($invoice->tax_amount, 2) }}</span>
                        </div>
                        @endif
                        @if($invoice->discount_amount > 0)
                        <div class="flex justify-between text-sm text-rose-600 dark:text-rose-400 font-medium">
                            <span>Discount</span>
                            <span>- Rs. {{ number_format($invoice->discount_amount, 2) }}</span>
                        </div>
                        @endif
                        @if($invoice->delivery_charge > 0)
                        <div class="flex justify-between text-sm text-emerald-600 dark:text-emerald-400 font-medium">
                            <span>Delivery</span>
                            <span>+ Rs. {{ number_format($invoice->delivery_charge, 2) }}</span>
                        </div>
                        @endif
                        <div class="flex items-center justify-between border-t border-zinc-200 pt-4 dark:border-zinc-700">
                            <div>
                                <span class="text-xs font-black uppercase tracking-widest text-zinc-400">Total Amount</span>
                                <p class="text-[10px] text-zinc-500 font-bold uppercase tracking-widest">{{ $invoice->currency }}</p>
                            </div>
                            <span class="text-3xl font-black text-emerald-600 dark:text-emerald-400">{{ number_format($invoice->total_amount, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Footer / Notes -->
                <div class="px-8 py-6 bg-zinc-50 dark:bg-zinc-800/40">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="flex flex-col gap-2">
                            <p class="text-[10px] font-bold uppercase tracking-widest text-zinc-400">Customer Notes</p>
                            <p class="text-xs text-zinc-500 leading-relaxed italic">
                                {{ $invoice->customer_notes ?: 'No customer notes.' }}
                            </p>
                        </div>
                        @if($invoice->terms_and_conditions)
                        <div class="flex flex-col gap-2">
                            <p class="text-[10px] font-bold uppercase tracking-widest text-zinc-400">Terms & Conditions</p>
                            <p class="text-xs text-zinc-500 leading-relaxed italic">
                                {{ $invoice->terms_and_conditions }}
                            </p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar / Meta -->
        <div class="flex flex-col gap-6">
            <!-- Customer Card -->
            <div class="rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <flux:heading size="lg" class="mb-4">Customer Details</flux:heading>
                <div class="flex items-center gap-4 border-b border-zinc-100 pb-4 dark:border-zinc-800">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-xl font-bold text-emerald-600 dark:bg-emerald-900/30">
                        {{ substr($invoice->billing_name ?? 'N', 0, 1) }}
                    </div>
                    <div>
                        <p class="font-bold text-zinc-900 dark:text-white">{{ $invoice->billing_name ?? 'N/A' }}</p>
                        <p class="text-xs text-zinc-500">{{ $invoice->billing_email ?? 'no-email@example.com' }}</p>
                    </div>
                </div>
                <div class="mt-4 space-y-4">
                    <flux:navlist variant="outline">
                        @if($invoice->billing_phone)
                        <flux:navlist.item icon="phone" class="!px-0">{{ $invoice->billing_phone }}</flux:navlist.item>
                        @endif
                        <flux:navlist.item icon="map-pin" class="!px-0">{{ $invoice->billing_address ?? 'N/A' }}</flux:navlist.item>
                    </flux:navlist>
                    @if($invoice->order->contact_id)
                    <flux:button :href="route('contact.show', $invoice->order->contact_id)" icon="external-link" variant="subtle" size="sm" class="w-full">View Customer Profile</flux:button>
                    @endif
                </div>
            </div>

            <!-- Linked Order -->
            <div class="rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <flux:heading size="lg" class="mb-4">Linked Order</flux:heading>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-zinc-500">Order #:</span>
                        <span class="text-sm font-bold text-zinc-900 dark:text-white">#{{ $invoice->order->order_number }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-zinc-500">Method:</span>
                        <flux:badge size="sm" color="zinc">{{ $invoice->order->payment_method?->value ?: 'N/A' }}</flux:badge>
                    </div>
                    <flux:button :href="route('orders')" icon="handbag" variant="subtle" size="sm" class="w-full">View Order Details</flux:button>
                </div>
            </div>

            <!-- Help / Support -->
            <div class="rounded-2xl border border-emerald-100 bg-emerald-50/50 p-6 dark:border-emerald-900/20 dark:bg-emerald-900/10">
                <div class="flex items-center gap-3 mb-2">
                    <div class="rounded-lg bg-emerald-500 p-2 text-white">
                        <flux:icon.lifebuoy class="size-4" />
                    </div>
                    <flux:heading size="sm" class="!text-emerald-700 dark:!text-emerald-400">Need Help?</flux:heading>
                </div>
                <p class="text-xs text-emerald-800/70 dark:text-emerald-400/70 leading-relaxed mb-4">
                    If you have any questions regarding this invoice, please reach out to our support team.
                </p>
                <flux:button variant="subtle" color="emerald" size="sm" class="w-full">Contact Support</flux:button>
            </div>
        </div>
    </div>
</div>
