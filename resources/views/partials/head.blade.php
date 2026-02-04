<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

{{-- Page Title --}}
<title>{{ isset($title) ? $title . ' - ' . config('app.name') : config('app.name') }}</title>

{{-- Meta Description --}}
@if(isset($description))
<meta name="description" content="{{ $description }}">
@else
<meta name="description" content="{{ config('app.name') }} - Smart inventory management with AI-powered insights for small businesses.">
@endif

{{-- Open Graph / Social Sharing --}}
<meta property="og:type" content="website">
<meta property="og:title" content="{{ $title ?? config('app.name') }}">
<meta property="og:description" content="{{ $description ?? config('app.name') . ' - Smart inventory management with AI-powered insights for small businesses.' }}">
<meta property="og:site_name" content="{{ config('app.name') }}">
@if(isset($ogImage))
<meta property="og:image" content="{{ $ogImage }}">
@endif

{{-- Twitter Card --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title ?? config('app.name') }}">
<meta name="twitter:description" content="{{ $description ?? config('app.name') . ' - Smart inventory management with AI-powered insights for small businesses.' }}">

{{-- Favicon --}}
<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">

{{-- Fonts & Assets --}}
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance
