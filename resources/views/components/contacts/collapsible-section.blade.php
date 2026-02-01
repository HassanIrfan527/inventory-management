@props([
    'wireModel' => null,
    'isOpen' => false,
    'title' => null,
    'subtitle' => null,
    'icon' => null,
    'badge' => null,
    'tag' => 'div',
])

<div {{ $attributes->merge(['class' => 'group']) }}>
    <div class="overflow-hidden rounded-xl border border-zinc-200 bg-white shadow-sm transition-all hover:shadow-md dark:border-zinc-800 dark:bg-zinc-900">
        {{-- Section Header --}}
        <button
            type="button"
            wire:click="$toggle('{{ $wireModel }}')"
            class="flex w-full items-center justify-between px-6 py-4 text-left transition-colors hover:bg-zinc-50 dark:hover:bg-zinc-800/50"
            aria-expanded="{{ $isOpen ? 'true' : 'false' }}"
        >
            <div class="flex items-center gap-3">
                @if ($icon)
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-gradient-to-br from-emerald-500 to-teal-600 text-white">
                        <flux:icon :name="$icon" class="h-5 w-5" />
                    </div>
                @endif
                <div>
                    <h3 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">
                        {{ $title }}
                    </h3>
                    @if ($subtitle)
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ $subtitle }}</p>
                    @endif
                </div>
            </div>

            <div class="flex items-center gap-2">
                @if ($badge)
                    <span class="rounded-full bg-emerald-100 px-2.5 py-0.5 text-xs font-medium text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400">
                        {{ $badge }}
                    </span>
                @endif
                <flux:icon
                    name="chevron-down"
                    class="h-5 w-5 text-zinc-400 transition-transform duration-200 {{ $isOpen ? 'rotate-180' : '' }}"
                />
            </div>
        </button>

        {{-- Section Content --}}
        <div
            x-data="{ open: @entangle($wireModel) }"
            x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="border-t border-zinc-200 dark:border-zinc-800"
        >
            <div class="p-6">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
