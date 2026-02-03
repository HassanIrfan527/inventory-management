<div {{ $attributes->merge(['class' => 'flex items-center gap-3 group']) }}>
    <div class="flex items-center justify-center group-hover:scale-110 transition-all duration-300">
        <x-app-logo-icon class="size-10 fill-emerald-600 dark:fill-emerald-500" />
    </div>
    <span class="text-3xl font-black tracking-tighter text-zinc-950 dark:text-white leading-none">
        {{ config('app.name') }}
    </span>
</div>
