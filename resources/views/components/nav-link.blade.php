@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-4 py-2 text-sm font-semibold leading-5 text-blue-600 dark:text-blue-500 bg-blue-50/50 dark:bg-blue-500/10 rounded-xl transition duration-150 ease-in-out'
            : 'inline-flex items-center px-4 py-2 text-sm font-semibold leading-5 text-zinc-600 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 hover:bg-zinc-100 dark:hover:bg-zinc-800 rounded-xl transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }} wire:navigate>
    {{ $slot }}
</a>
