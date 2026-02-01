<div class="flex h-full w-full flex-1 flex-col gap-8">
    <!-- Page Header -->
    @php
        $breadcrumbItem = [
            [
                'name' => 'Invoices',
                'href' => route('invoices'),
                'icon' => 'notepad-text',
            ],
        ];
    @endphp
    <!-- Breadcrumbs -->
    <x-custom-breadcrumb :items="$breadcrumbItem"></x-custom-breadcrumb>

    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex flex-col gap-1">
            <flux:heading size="xl" level="1" class="text-emerald-950 dark:text-emerald-50">Invoices</flux:heading>
            <flux:text size="sm" class="text-zinc-600 dark:text-zinc-400">
                Manage and track your customer and supplier invoices.
            </flux:text>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Total Invoices -->
        <div class="group relative overflow-hidden rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm transition-all hover:shadow-md dark:border-zinc-800 dark:bg-zinc-900">
            <div class="absolute -right-2 -top-2 h-16 w-16 rounded-full bg-gradient-to-br from-emerald-500/10 to-teal-500/10 blur-2xl"></div>
            <div class="relative flex items-center justify-between">
                <div class="flex flex-col gap-1">
                    <p class="text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Total Invoices</p>
                    <p class="text-3xl font-bold text-zinc-900 dark:text-white mt-1">{{ number_format($stats['total']) }}</p>
                </div>
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-zinc-100 text-zinc-600 dark:bg-zinc-800 dark:text-zinc-400 transition-transform group-hover:scale-110">
                    <flux:icon.notepad-text class="h-6 w-6" />
                </div>
            </div>
            <div class="mt-4 flex items-center gap-2 text-sm pt-4 border-t border-zinc-50 dark:border-zinc-800/50">
                <span class="flex items-center gap-1 font-medium text-emerald-600 dark:text-emerald-400 shrink-0 whitespace-nowrap">
                    <flux:icon.activity class="h-4 w-4" />
                    <span>Global</span>
                </span>
                <span class="text-zinc-400 truncate text-xs font-medium uppercase tracking-tighter">Billed Documents</span>
            </div>
        </div>

        <!-- Paid Revenue -->
        <div class="group relative overflow-hidden rounded-2xl border border-emerald-100 bg-emerald-50/10 p-6 shadow-sm transition-all hover:shadow-md dark:border-emerald-900/30 dark:bg-zinc-900">
            <div class="absolute -right-2 -top-2 h-20 w-20 rounded-full bg-gradient-to-br from-emerald-400/20 to-teal-400/20 blur-3xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <div class="relative flex items-center justify-between">
                <div class="flex flex-col gap-1">
                    <p class="text-xs font-semibold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">Paid Revenue</p>
                    <p class="text-2xl font-black text-zinc-900 dark:text-white mt-1">Rs. {{ number_format($stats['revenue']) }}</p>
                </div>
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-400 ring-4 ring-emerald-50/50 dark:ring-emerald-900/10 transition-transform group-hover:rotate-6 group-hover:scale-110">
                    <flux:icon.banknote class="h-6 w-6" />
                </div>
            </div>
            <div class="mt-4 flex items-center gap-2 text-sm pt-4 border-t border-emerald-50 dark:border-emerald-900/10">
                <span class="flex items-center gap-1 font-medium text-emerald-600 dark:text-emerald-400 shrink-0 whitespace-nowrap text-[10px] font-black uppercase tracking-widest">
                    <flux:icon.check-circle class="h-3.5 w-3.5" />
                    Verified
                </span>
                <span class="text-zinc-400 truncate">Total earnings</span>
            </div>
        </div>

        <!-- Pending Invoices -->
        <div class="group relative overflow-hidden rounded-2xl border border-amber-100 bg-white p-6 shadow-sm transition-all hover:shadow-md dark:border-amber-900/30 dark:bg-zinc-900">
            <div class="flex items-center justify-between">
                <div class="flex flex-col gap-1">
                    <p class="text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Pending</p>
                    <p class="text-3xl font-bold text-zinc-900 dark:text-white mt-1">{{ number_format($stats['pending']) }}</p>
                </div>
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-amber-100 text-amber-600 dark:bg-amber-900/30 dark:text-amber-400 ring-4 ring-amber-50/50 dark:ring-amber-900/10 transition-transform group-hover:scale-110">
                    <flux:icon.clock class="h-6 w-6" />
                </div>
            </div>
            <div class="mt-4 flex items-center gap-2 text-sm pt-4 border-t border-amber-50 dark:border-amber-900/10">
                <span class="flex items-center gap-1 font-medium text-amber-600 dark:text-amber-400 shrink-0 whitespace-nowrap text-[10px] font-black uppercase tracking-widest">
                    <flux:icon.layers class="h-3.5 w-3.5" />
                    In Queue
                </span>
                <span class="text-zinc-400 truncate">Awaiting payment</span>
            </div>
        </div>

        <!-- Overdue Invoices -->
        <div class="group relative overflow-hidden rounded-2xl border border-rose-100 bg-white p-6 shadow-sm transition-all hover:shadow-md dark:border-rose-900/30 dark:bg-zinc-900">
            <div class="flex items-center justify-between">
                <div class="flex flex-col gap-1">
                    <p class="text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Overdue</p>
                    <p class="text-3xl font-bold text-rose-600 dark:text-rose-400 mt-1">{{ number_format($stats['overdue']) }}</p>
                </div>
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-rose-100 text-rose-600 dark:bg-rose-900/30 dark:text-rose-400 ring-4 ring-rose-50/50 dark:ring-rose-900/10 transition-transform group-hover:scale-110">
                    <flux:icon.circle-alert class="h-6 w-6" />
                </div>
            </div>
            <div class="mt-4 flex items-center gap-2 text-sm pt-4 border-t border-rose-50 dark:border-rose-900/10">
                <span class="flex items-center gap-1 font-medium text-rose-600 dark:text-rose-400 shrink-0 whitespace-nowrap text-[10px] font-black uppercase tracking-widest">
                    <flux:icon.flag class="h-3.5 w-3.5" />
                    Critical
                </span>
                <span class="text-zinc-400 truncate">Immediate follow-up</span>
            </div>
        </div>
    </div>

    <!-- Invoices Filter & Table Section -->
    <div class="flex flex-col overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-700 dark:bg-zinc-900 transition-all">
        <!-- Toolbar -->
        <div class="flex flex-col items-center justify-between gap-4 border-b border-zinc-100 p-6 md:flex-row dark:border-zinc-800">
            <div class="flex items-center gap-4">
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-400">
                    <flux:icon.notepad-text class="size-5" />
                </div>
                <div class="flex flex-col">
                    <h2 class="text-lg font-bold text-zinc-900 dark:text-white leading-none">Invoice Ledger</h2>
                    <flux:text size="xs" class="mt-1">Historical billing and payment records</flux:text>
                </div>
                <flux:badge color="emerald" size="sm" class="ml-2" inset="top bottom">{{ $invoices->total() }} Total</flux:badge>
            </div>

            <div class="flex w-full flex-col gap-3 sm:flex-row sm:w-auto">
                {{-- Search Bar --}}
                <div class="relative w-full sm:w-80">
                    <flux:input wire:model.live.debounce.300ms="search" icon="magnifying-glass" size="sm"
                        placeholder="Search invoice #, customer..." />
                </div>

                {{-- Status Filter --}}
                <div class="w-full sm:w-44">
                    <flux:select wire:model.live="filterStatus" size="sm" placeholder="All Statuses">
                        <flux:select.option value="">All Statuses</flux:select.option>
                        <flux:select.option value="paid">Paid</flux:select.option>
                        <flux:select.option value="pending">Pending</flux:select.option>
                        <flux:select.option value="overdue">Overdue</flux:select.option>
                        <flux:select.option value="cancelled">Cancelled</flux:select.option>
                    </flux:select>
                </div>
            </div>
        </div>

        <!-- Professional Table -->
        <div class="relative overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-zinc-50 border-b border-zinc-100 dark:bg-zinc-800/50 dark:border-zinc-800">
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Invoice ID</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Recipient</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 text-center">Reference</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 text-center">Status</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 text-right">Amount</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                    @forelse ($invoices as $invoice)
                        <tr class="group transition-all hover:bg-emerald-50/30 dark:hover:bg-emerald-900/10 cursor-pointer"
                            @click="window.location.href = '{{ route('invoices.show', $invoice->id) }}'">
                            {{-- Invoice ID --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-black text-emerald-600 dark:text-emerald-400 tracking-tight">{{ $invoice->invoice_number }}</span>
                                <div class="mt-1 flex items-center gap-1 text-[10px] text-zinc-400 uppercase tracking-tighter">
                                    <flux:icon.calendar class="h-3 w-3" />
                                    {{ $invoice->created_at->format('M d, Y') }}
                                </div>
                            </td>

                            {{-- Resipient --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-emerald-100 text-emerald-700 font-bold text-xs ring-2 ring-white dark:bg-emerald-900/50 dark:text-emerald-300 dark:ring-zinc-800 transition-transform group-hover:scale-105">
                                        {{ substr($invoice->billing_name ?? ($invoice->order->contact->name ?? 'G'), 0, 1) }}
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-bold text-zinc-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                                            {{ $invoice->billing_name ?? ($invoice->order->contact->name ?? 'Guest Customer') }}
                                        </span>
                                        <span class="text-xs text-zinc-500">{{ $invoice->billing_email ?? ($invoice->order->contact->email ?? 'no-email@example.com') }}</span>
                                    </div>
                                </div>
                            </td>

                            {{-- Reference --}}
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <flux:badge size="sm" color="zinc" class="font-mono">
                                    #{{ $invoice->order?->order_number ?? 'N/A' }}
                                </flux:badge>
                            </td>

                            {{-- Status --}}
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @php
                                    $statusColor = match ($invoice->status) {
                                        'paid' => 'emerald',
                                        'pending' => 'amber',
                                        'overdue' => 'rose',
                                        'cancelled' => 'red',
                                        default => 'zinc',
                                    };
                                @endphp
                                <flux:badge :color="$statusColor" variant="solid" size="sm" class="capitalize">
                                    <span class="inline-block h-1.5 w-1.5 rounded-full bg-white mr-1.5 opacity-80"></span>
                                    {{ str_replace('_', ' ', $invoice->status) }}
                                </flux:badge>
                            </td>

                            {{-- Amount --}}
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="font-black text-zinc-900 dark:text-white text-base tracking-tight">
                                    Rs. {{ number_format($invoice->total_amount, 2) }}
                                </div>
                                <div class="mt-0.5 text-[10px] text-zinc-400 uppercase tracking-widest font-bold">
                                    {{ $invoice->currency }}
                                </div>
                            </td>

                            {{-- Actions --}}
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="flex items-center justify-end gap-1" @click.stop>
                                    <flux:button :href="route('invoices.show', $invoice->id)" variant="ghost" size="sm" icon="eye" x-tooltip="View Details" wire:navigate 
                                        class="text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400" />
                                    <flux:button wire:click="download({{ $invoice->id }})" variant="ghost" size="sm" icon="arrow-down-tray" x-tooltip="Download PDF" 
                                        class="text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400" />
                                    
                                    <flux:dropdown>
                                        <flux:button variant="ghost" icon="ellipsis-horizontal" size="sm" class="text-zinc-400" />
                                        <flux:menu>
                                            <flux:menu.item icon="printer">Print Invoice</flux:menu.item>
                                            <flux:menu.item icon="envelope" wire:click.stop>Email to Customer</flux:menu.item>
                                            <flux:menu.separator />
                                            <flux:menu.item icon="trash" variant="danger">Cancel Invoice</flux:menu.item>
                                        </flux:menu>
                                    </flux:dropdown>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-24 text-center">
                                <div class="flex flex-col items-center justify-center gap-4">
                                    <div class="relative">
                                        <div class="absolute -inset-4 rounded-full bg-emerald-50 blur-xl dark:bg-emerald-900/20"></div>
                                        <flux:icon.notepad-text class="relative h-16 w-16 text-emerald-200 dark:text-emerald-800" />
                                    </div>
                                    <div class="max-w-xs mx-auto">
                                        <h3 class="text-xl font-bold text-zinc-900 dark:text-white">No invoices found</h3>
                                        <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">
                                            Adjust your search or filters to find what you're looking for.
                                        </p>
                                    </div>
                                    <flux:button wire:click="$set('search', '')" variant="subtle" size="sm" class="mt-2">
                                        Clear Search Filters
                                    </flux:button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Professional Pagination -->
        @if ($invoices->hasPages())
            <div class="border-t border-zinc-100 bg-zinc-50/30 px-6 py-4 dark:border-zinc-800 dark:bg-zinc-800/10">
                {{ $invoices->links() }}
            </div>
        @endif
    </div>
</div>
