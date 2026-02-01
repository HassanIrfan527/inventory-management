<div class="flex h-full w-full flex-1 flex-col gap-6">
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

    <!-- Page Header -->
    <div class="flex flex-col gap-6">
        <div class="flex items-center justify-between">
            <div class="flex flex-col gap-1">
                <flux:heading size="xl" level="1">Invoices</flux:heading>
                <flux:text size="sm" class="text-zinc-600 dark:text-zinc-400">
                    Manage and track your customer and supplier invoices.
                </flux:text>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Total Invoices -->
            <div
                class="group relative overflow-hidden rounded-2xl border border-zinc-200 bg-white p-5 transition-all hover:shadow-md dark:border-zinc-800 dark:bg-zinc-900">
                <div class="flex items-center gap-4">
                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-zinc-100 text-zinc-600 dark:bg-zinc-800 dark:text-zinc-400">
                        <flux:icon.notepad-text variant="outline" class="size-6" />
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-zinc-500">Total Invoices</p>
                        <p class="text-2xl font-black text-zinc-900 dark:text-white">{{ $stats['total'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Revenue -->
            <div
                class="group relative overflow-hidden rounded-2xl border border-zinc-200 bg-white p-5 transition-all hover:shadow-md dark:border-zinc-800 dark:bg-zinc-900">
                <div class="flex items-center gap-4">
                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-400">
                        <flux:icon.banknote variant="outline" class="size-6" />
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-zinc-500">Paid Revenue</p>
                        <p class="text-2xl font-black text-zinc-900 dark:text-white">Rs.
                            {{ number_format($stats['revenue']) }}</p>
                    </div>
                </div>
            </div>

            <!-- Pending -->
            <div
                class="group relative overflow-hidden rounded-2xl border border-zinc-200 bg-white p-5 transition-all hover:shadow-md dark:border-zinc-800 dark:bg-zinc-900">
                <div class="flex items-center gap-4">
                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-amber-100 text-amber-600 dark:bg-amber-900/30 dark:text-amber-400">
                        <flux:icon.clock variant="outline" class="size-6" />
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-zinc-500">Pending</p>
                        <p class="text-2xl font-black text-zinc-900 dark:text-white">{{ $stats['pending'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Overdue -->
            <div
                class="group relative overflow-hidden rounded-2xl border border-zinc-200 bg-white p-5 transition-all hover:shadow-md dark:border-zinc-800 dark:bg-zinc-900">
                <div class="flex items-center gap-4">
                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-rose-100 text-rose-600 dark:bg-rose-900/30 dark:text-rose-400">
                        <flux:icon.circle-alert variant="outline" class="size-6" />
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-zinc-500">Overdue</p>
                        <p class="text-2xl font-black text-zinc-900 dark:text-white">{{ $stats['overdue'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Section -->
    <div class="flex flex-col gap-4">
        <!-- Toolbar -->
        <div class="flex flex-col items-center justify-between gap-4 md:flex-row">
            <h2 class="text-lg font-bold text-zinc-900 dark:text-white">All Invoices</h2>

            <div class="flex w-full flex-wrap gap-3 md:w-auto">
                <flux:input wire:model.live.debounce.300ms="search" icon="magnifying-glass" size="sm"
                    placeholder="Search by number or contact..." class="w-full sm:w-64" />

                <flux:select wire:model.live="filterStatus" size="sm" placeholder="All statuses"
                    class="w-full sm:w-40">
                    <flux:select.option value="">All statuses</flux:select.option>
                    <flux:select.option value="pending">Pending</flux:select.option>
                    <flux:select.option value="paid">Paid</flux:select.option>
                    <flux:select.option value="overdue">Overdue</flux:select.option>
                </flux:select>
            </div>
        </div>

        <!-- Table Card -->
        <div
            class="overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead
                        class="border-b border-zinc-100 bg-zinc-50/50 text-[10px] font-bold uppercase tracking-widest text-zinc-400 dark:border-zinc-800 dark:bg-zinc-800/20">
                        <tr>
                            <th class="px-6 py-4">Invoice Number</th>
                            <th class="px-6 py-4">Customer</th>
                            <th class="px-6 py-4">Order Ref</th>
                            <th class="px-6 py-4 text-right">Amount</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Date</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                        @forelse ($invoices as $invoice)
                            <tr class="group hover:bg-zinc-50/50 dark:hover:bg-zinc-800/30 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="font-black tracking-tight text-emerald-600 dark:text-emerald-400">
                                        {{ $invoice->invoice_number }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="flex h-8 w-8 items-center justify-center rounded-lg bg-zinc-100 text-xs font-bold text-zinc-600 dark:bg-zinc-800 dark:text-zinc-400 underline decoration-zinc-300 dark:decoration-zinc-700">
                                            {{ substr($invoice->order?->contact?->name ?? 'N', 0, 1) }}
                                        </div>
                                        <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                            {{ $invoice->order?->contact?->name ?? 'N/A' }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <flux:badge size="sm" color="zinc" class="font-mono">
                                        #{{ $invoice->order?->order_number ?? 'N/A' }}</flux:badge>
                                </td>
                                <td class="px-6 py-4 text-right text-sm font-black text-zinc-900 dark:text-white">
                                    Rs. {{ number_format($invoice->total_amount, 2) }}
                                </td>
                                <td class="px-6 py-4">
                                    <span @class([
                                        'inline-flex items-center gap-1.5 rounded-full px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-tight',
                                        'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' =>
                                            $invoice->status === 'paid',
                                        'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400' =>
                                            $invoice->status === 'pending',
                                        'bg-rose-100 text-rose-700 dark:bg-rose-900/30 dark:text-rose-400' =>
                                            $invoice->status === 'overdue',
                                    ])>
                                        <span @class([
                                            'h-1 w-1 rounded-full',
                                            'bg-emerald-500' => $invoice->status === 'paid',
                                            'bg-amber-500' => $invoice->status === 'pending',
                                            'bg-rose-500' => $invoice->status === 'overdue',
                                        ])></span>
                                        {{ $invoice->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-xs text-zinc-500">
                                    {{ $invoice->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <flux:button :href="route('invoices.show', $invoice->id)" variant="subtle"
                                            size="sm" icon="eye" x-tooltip="View Details" wire:navigate />
                                        <flux:button wire:click="download({{ $invoice->id }})" variant="subtle"
                                            size="sm" icon="download" x-tooltip="Download PDF" />
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-24 text-center">
                                    <div class="flex flex-col items-center justify-center gap-4">
                                        <div
                                            class="flex h-20 w-20 items-center justify-center rounded-2xl bg-zinc-50 dark:bg-zinc-800">
                                            <flux:icon.notepad-text variant="outline"
                                                class="size-10 text-zinc-300 dark:text-zinc-600" />
                                        </div>
                                        <div class="max-w-[280px]">
                                            <h3 class="text-lg font-bold text-zinc-900 dark:text-white">No invoices
                                                found</h3>
                                            <p class="text-sm text-zinc-500 dark:text-zinc-400">We couldn't find any
                                                invoices matching your filters.</p>
                                        </div>
                                        <flux:button wire:click="$set('search', '')" variant="outline"
                                            size="sm">Clear filters</flux:button>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($invoices->hasPages())
                <div class="border-t border-zinc-100 bg-zinc-50/30 p-4 dark:border-zinc-800">
                    {{ $invoices->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
