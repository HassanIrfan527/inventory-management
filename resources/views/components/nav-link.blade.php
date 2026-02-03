@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-4 py-2 text-sm font-semibold leading-5 text-emerald-600 dark:text-emerald-500 bg-emerald-50/50 dark:bg-emerald-500/10 rounded-xl transition duration-150 ease-in-out'
            : 'inline-flex items-center px-4 py-2 text-sm font-semibold leading-5 text-zinc-600 dark:text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-500 hover:bg-zinc-100 dark:hover:bg-zinc-800 rounded-xl transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }} wire:navigate>
    {{ $slot }}
</a>
