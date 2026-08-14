@php
  $favIcon = setting('favicon');
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if($favIcon)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $favIcon) }}">
    @endif
    <title>{{ $pageTitle ?? 'Login' }} — {{ config('app.name', 'Ananniti Tattoo') }}</title>
    <meta name="description" content="Admin Portal for Ananniti Tattoo Bali">
    @vite(['resources/css/app.css'])
    <style>
        .stat-card {
            background: #ffffff;
            border: 1px solid #e5e5e5;
            border-radius: 12px;
            padding: 24px;
            transition: border-color 0.2s;
        }
        .stat-card:hover { border-color: #cccccc; }
    </style>
</head>
<body class="antialiased bg-[#fafafa]">
    <main>
        @yield('content')
    </main>
</body>
</html>
