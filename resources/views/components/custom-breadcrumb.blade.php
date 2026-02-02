@props([
    'items' => [],
])

<flux:breadcrumbs>
    <flux:breadcrumbs.item :href="route('dashboard')" icon="home" wire:navigate />
    @foreach ($items as $item)
        <flux:breadcrumbs.item :href="$item['href']" wire:navigate>
            <div
                class="inline-flex items-center gap-2 rounded-full bg-emerald-100 px-3 py-1 text-xs font-medium text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 w-fit">
                <flux:icon name="{{ $item['icon'] }}" class="w-3.5 h-3.5" />
                <span>{{ $item['name'] }}</span>
            </div>
        </flux:breadcrumbs.item>
    @endforeach
</flux:breadcrumbs>
