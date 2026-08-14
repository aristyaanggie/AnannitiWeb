@php
  $favIcon = setting('favicon');
  $ogImagePath = setting('hero_image');
  $ogImage = $ogImagePath
      ? url('storage/' . $ogImagePath)
      : asset('images/hero-placeholder2.jpeg');
  $pageTitle = ($title ?? 'Premium Tattoo Studio') . ' — ' . config('app.name', 'Ananniti Tattoo Bali');
  $pageDescription = $description ?? config('ananniti.studio.tagline', 'Premium custom tattoo design in Bali');
  $pageUrl = url()->current();
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $pageDescription }}">
    <link rel="canonical" href="{{ $pageUrl }}">
    @if($favIcon)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $favIcon) }}">
    @endif

    {{-- Open Graph --}}
    <meta property="og:site_name" content="{{ config('app.name', 'Ananniti Tattoo Bali') }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $pageUrl }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:locale" content="id_ID">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $pageDescription }}">
    <meta name="twitter:image" content="{{ $ogImage }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-background">
    <div class="min-h-screen flex flex-col">
        @yield('content')
    </div>
    @stack('scripts')
</body>
</html>
