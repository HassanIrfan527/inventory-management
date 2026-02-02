<?php

use Livewire\Attributes\Reactive;
use Livewire\Component;

new class extends Component
{
    #[Reactive]
    public $viewType;

    public function changeView(string $type)
    {
        $this->dispatch('set-view-type', type: $type);
    }
};
?>

<flux:modal name="product-view-settings" :maxWidth="'md'">
    <div class="flex flex-row items-center justify-between gap-4 p-5">
        <div class="flex flex-col gap-2">
            <h1 class="text-3xl font-bold text-neutral-900 dark:text-white">View Settings</h1>
            <p class="text-sm text-neutral-600 dark:text-neutral-400">Change the view for your products page</p>
        </div>
        <div>
            <flux:icon.columns-3-cog />
        </div>
    </div>
    <flux:separator />

    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
        @foreach (App\Enums\ProductView::cases() as $view)
            <button wire:click="changeView('{{ $view->value }}')"
                class="flex flex-col items-center gap-3 p-4 rounded-xl border transition-all cursor-pointer group
                {{ $viewType === $view ? 'border-blue-600 bg-blue-50 dark:bg-blue-900/20 dark:border-blue-500' : 'border-neutral-200 hover:border-blue-300 hover:bg-neutral-50 dark:border-neutral-700 dark:hover:border-neutral-600 dark:hover:bg-neutral-800' }}">

                <div class="p-3 rounded-full {{ $viewType === $view ? 'bg-blue-100 text-blue-600 dark:bg-blue-900/40 dark:text-blue-400' : 'bg-neutral-100 text-neutral-500 group-hover:bg-white group-hover:text-blue-500 dark:bg-neutral-800 dark:text-neutral-400 dark:group-hover:text-blue-400' }}">
                    <flux:icon :icon="$view->icon()" class="w-6 h-6" />
                </div>

                <div class="text-center">
                    <span class="block font-medium {{ $viewType === $view ? 'text-blue-700 dark:text-blue-300' : 'text-neutral-900 dark:text-white' }}">
                        {{ ucfirst($view->value) }} View
                    </span>
                    <span class="text-xs text-neutral-500 dark:text-neutral-400 mt-1 block">
                        @switch($view)
                            @case(App\Enums\ProductView::Grid)
                                Default card layout with images
                                @break
                            @case(App\Enums\ProductView::List)
                                Detailed list with small thumbnails
                                @break
                            @case(App\Enums\ProductView::Compact)
                                Dense rows without images
                                @break
                            @case(App\Enums\ProductView::Kanban)
                                Grouped by category columns
                                @break
                            @case(App\Enums\ProductView::Gallery)
                                Focus on product images
                                @break
                        @endswitch
                    </span>
                </div>
            </button>
        @endforeach
    </div>
</flux:modal>
