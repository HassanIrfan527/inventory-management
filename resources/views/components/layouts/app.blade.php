<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main container class="py-8">
        {{ $slot }}
    </flux:main>
</x-layouts.app.sidebar>
