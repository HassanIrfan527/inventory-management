@php
    $totalOrders = 10;
    $completedOrders = 5;
    $processingOrders = 5;
@endphp
<x-layouts.app :title="__('Orders')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <h2 class="p-4 text-lg font-semibold">Total Orders: {{ $totalOrders }}</h2>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <h2 class="p-4 text-lg font-semibold">Orders Completed: {{ $completedOrders }}</h2>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <h2 class="p-4 text-lg font-semibold">Orders In Processing: {{ $processingOrders }}</h2>
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <table class="min-w-full divide-y divide-neutral-200">
                <thead class="bg-neutral-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-neutral-200">
                    {{-- @foreach($orders as $order)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $order->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $order->customer_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $order->status }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $order->total }}</td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
