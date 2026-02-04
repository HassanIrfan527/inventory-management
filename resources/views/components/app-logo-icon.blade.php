@props(['variant' => 'default'])

@if($variant === 'white')
{{-- Monochrome White Variant (for dark/colored backgrounds) --}}
<svg {{ $attributes->merge(['class' => 'fill-current']) }} viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
    <rect x="8" y="4" width="24" height="30" rx="3" class="fill-white/30"/>
    <rect x="5" y="7" width="24" height="30" rx="3" class="fill-white/50"/>
    <rect x="2" y="10" width="24" height="30" rx="3" class="fill-white"/>
    <rect x="6" y="16" width="12" height="2" rx="1" class="fill-emerald-600/80"/>
    <rect x="6" y="22" width="16" height="2" rx="1" class="fill-emerald-600/60"/>
    <rect x="6" y="28" width="10" height="2" rx="1" class="fill-emerald-600/40"/>
</svg>

@else
{{-- Logo Option 1: Layered Pages (Default) --}}
{{-- Represents "Folio" as a collection/portfolio of pages --}}
<svg {{ $attributes->merge(['class' => 'fill-current']) }} viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
    {{-- Back page (lighter) --}}
    <rect x="8" y="4" width="24" height="30" rx="3" class="fill-teal-600/40 dark:fill-teal-500/30"/>
    {{-- Middle page --}}
    <rect x="5" y="7" width="24" height="30" rx="3" class="fill-teal-500/60 dark:fill-teal-400/50"/>
    {{-- Front page (main) --}}
    <rect x="2" y="10" width="24" height="30" rx="3" class="fill-emerald-600 dark:fill-emerald-500"/>
    {{-- Lines on front page --}}
    <rect x="6" y="16" width="12" height="2" rx="1" class="fill-white/80"/>
    <rect x="6" y="22" width="16" height="2" rx="1" class="fill-white/60"/>
    <rect x="6" y="28" width="10" height="2" rx="1" class="fill-white/40"/>
</svg>
@endif

{{--
Logo Option 2: Stylized F with Page Fold (Alternative)
Uncomment this and modify the @else block to use this logo instead

<svg {{ $attributes->merge(['class' => 'fill-current']) }} viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
    <defs>
        <linearGradient id="folioGradient" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" style="stop-color:#059669"/>
            <stop offset="100%" style="stop-color:#0d9488"/>
        </linearGradient>
    </defs>
    <path d="M8 4C5.79 4 4 5.79 4 8v24c0 2.21 1.79 4 4 4h16c2.21 0 4-1.79 4-4V14l-10-10H8z" fill="url(#folioGradient)"/>
    <path d="M18 4v6c0 2.21 1.79 4 4 4h6L18 4z" class="fill-emerald-400 dark:fill-emerald-300"/>
    <rect x="9" y="18" width="10" height="3" rx="1" class="fill-white/80"/>
    <rect x="9" y="24" width="14" height="3" rx="1" class="fill-white/60"/>
    <rect x="9" y="30" width="8" height="3" rx="1" class="fill-white/40"/>
</svg>
--}}
