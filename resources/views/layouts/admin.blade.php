@php
  $favIcon = setting('favicon');
  $adminLogo = setting('logo');
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if($favIcon)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $favIcon) }}">
    @endif
    <title>{{ $pageTitle ?? 'Dashboard' }} — {{ config('app.name', 'Ananniti Tattoo') }}</title>
    <meta name="description" content="Admin Portal for Ananniti Tattoo Bali">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #a3a3a3;
            transition: all 0.2s;
            text-decoration: none;
        }
        .sidebar-link:hover { background: #1a1a1a; color: #ffffff; }
        .sidebar-link.active { background: #ffffff; color: #0a0a0a; }
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
    <div class="flex min-h-screen" x-data="{ open: false, settingsOpen: {{ request()->routeIs('admin.settings.*') || request()->routeIs('admin.categories.*') ? 'true' : 'false' }} }">

        {{-- Sidebar --}}
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-[#0a0a0a] border-r border-[#1a1a1a] transform transition-transform duration-200 md:translate-x-0" :class="open ? 'translate-x-0' : '-translate-x-full'" x-cloak>
            <div class="flex items-center gap-3 px-6 py-5 border-b border-[#1a1a1a]">
                @if($adminLogo)
                    <div class="w-10 h-10 flex-shrink-0 flex items-center justify-center">
                        <img src="{{ asset('storage/' . $adminLogo) }}" alt="Logo" class="w-full h-full object-contain" />
                    </div>
                @else
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0 bg-white">
                        <span class="text-[10px] font-bold tracking-wider text-[#0a0a0a]">AT</span>
                    </div>
                @endif
                <span class="font-bold text-[15px] text-white" style="font-family: var(--font-heading);">Ananniti Tattoo</span>
            </div>

            <nav class="px-4 py-4 space-y-1">
                {{-- Dashboard --}}
                <a href="{{ route('admin.dashboard') }}" @click="open = false" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"></path></svg>
                    Dashboard
                </a>

                {{-- Shop Orders --}}
                <a href="{{ route('admin.orders.index') }}" @click="open = false" class="sidebar-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"></path></svg>
                    Shop Orders
                </a>

                {{-- Bookings --}}
                <a href="{{ route('admin.bookings.index') }}" @click="open = false" class="sidebar-link {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"></path></svg>
                    Bookings
                </a>

                {{-- Website Content (Brand Assets) --}}
                <a href="{{ route('admin.brand-assets.edit') }}" @click="open = false" class="sidebar-link {{ request()->routeIs('admin.brand-assets.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5a1.5 1.5 0 0 0 1.5-1.5V5.25a1.5 1.5 0 0 0-1.5-1.5H3.75a1.5 1.5 0 0 0-1.5 1.5v14.25a1.5 1.5 0 0 0 1.5 1.5Zm6-10.5h.008v.008H9.75v-.008Zm0 3h.008v.008H9.75v-.008Zm0 3h.008v.008H9.75v-.008Zm3-6h.008v.008H12.75v-.008Zm0 3h.008v.008H12.75v-.008Zm0 3h.008v.008H12.75v-.008Zm3-6h.008v.008H15.75v-.008Zm0 3h.008v.008H15.75v-.008Zm0 3h.008v.008H15.75v-.008Z"></path></svg>
                    Website Content
                </a>

                {{-- Products --}}
                <a href="{{ route('admin.products.index') }}" @click="open = false" class="sidebar-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"></path></svg>
                    Products
                </a>

                {{-- Portfolio --}}
                <a href="{{ route('admin.portfolio.index') }}" @click="open = false" class="sidebar-link {{ request()->routeIs('admin.portfolio.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5a1.5 1.5 0 001.5-1.5V5.25a1.5 1.5 0 00-1.5-1.5H3.75a1.5 1.5 0 00-1.5 1.5v14.25a1.5 1.5 0 001.5 1.5z"></path></svg>
                    Portfolio
                </a>

                {{-- Artist Profile --}}
                <a href="{{ route('admin.artist-profile.edit') }}" @click="open = false" class="sidebar-link {{ request()->routeIs('admin.artist-profile.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"></path></svg>
                    Artist Profile
                </a>

                {{-- Reviews --}}
                <a href="{{ route('admin.reviews.index') }}" @click="open = false" class="sidebar-link {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"></path></svg>
                    Reviews
                </a>

                {{-- Studio Settings (submenu) --}}
                <div>
                    <button @click="settingsOpen = !settingsOpen" class="sidebar-link w-full {{ request()->routeIs('admin.settings.*') || request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.21-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.728c-.293.21-.438.59-.438.924v.08c0 .333.146.713.438.924l1.003.728c.473.34.572.987.26 1.431l-1.296 2.247a1.125 1.125 0 01-1.37.49l-1.21-.456c-.355-.133-.751-.072-1.075.124a7.028 7.028 0 01-.22.127c-.331.183-.581.495-.645.87l-.213 1.28c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.063-.374-.313-.686-.645-.87a7.042 7.042 0 01-.22-.127c-.324-.196-.72-.257-1.075-.124l-1.21.456a1.125 1.125 0 01-1.37-.49l-1.296-2.247a1.728 1.528 0 01.26-1.431l1.003-.728c.293-.21.438-.59.438-.924v-.08c0-.333.146-.713.438-.924l-1.003-.728c-.473-.34-.572-.987-.26-1.431l1.296-2.247a1.125 1.125 0 011.37-.49l1.21.456c.355.133.751.072 1.075-.124.074-.04.147-.083.22-.127.331-.183.581-.495.645-.87l.213-1.281z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Studio Settings
                        <svg class="w-4 h-4 ml-auto transition-transform duration-200" :class="settingsOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path></svg>
                    </button>
                    <div x-show="settingsOpen" x-collapse class="ml-6 mt-1 space-y-1" x-cloak>
                        <a href="{{ route('admin.settings.index') }}" @click="open = false" class="sidebar-link text-[13px] {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.21-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.728c-.293.21-.438.59-.438.924v.08c0 .333.146.713.438.924l1.003.728c.473.34.572.987.26 1.431l-1.296 2.247a1.125 1.125 0 01-1.37.49l-1.21-.456c-.355-.133-.751-.072-1.075.124a7.028 7.028 0 01-.22.127c-.331.183-.581.495-.645.87l-.213 1.28c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.063-.374-.313-.686-.645-.87a7.042 7.042 0 01-.22-.127c-.324-.196-.72-.257-1.075-.124l-1.21.456a1.125 1.125 0 01-1.37-.49l-1.296-2.247a1.728 1.528 0 01.26-1.431l1.003-.728c.293-.21.438-.59.438-.924v-.08c0-.333.146-.713.438-.924l-1.003-.728c-.473-.34-.572-.987-.26-1.431l1.296-2.247a1.125 1.125 0 011.37-.49l1.21.456c.355.133.751.072 1.075-.124.074-.04.147-.083.22-.127.331-.183.581-.495.645-.87l.213-1.281z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Studio Settings
                        </a>
                        <a href="{{ route('admin.categories.index') }}" @click="open = false" class="sidebar-link text-[13px] {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a1.807 1.807 0 000-2.764L13.11 3.757a1.807 1.807 0 00-2.607.33L8.958 5.623M3 9.75v4.5A2.25 2.25 0 005.25 16.5h4.5"></path></svg>
                            Categories
                        </a>
                    </div>
                </div>
            </nav>

            <div class="absolute bottom-0 left-0 right-0 px-4 py-4 border-t border-[#1a1a1a]">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="sidebar-link w-full text-left text-[#a3a3a3] hover:text-[#ef4444] hover:bg-[#1a1a1a]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"></path></svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- Mobile overlay --}}
        <div x-show="open" @click="open = false" class="fixed inset-0 bg-black/50 z-40 md:hidden" x-cloak></div>

        {{-- Main Content --}}
        <div class="flex-1 md:ml-64">
            {{-- Top Bar --}}
            <header class="sticky top-0 z-40 bg-[#0a0a0a] border-b border-[#1a1a1a] shadow-sm">
                <div class="flex items-center justify-between px-6 py-4">
                    <button @click="open = !open" class="md:hidden p-2 -ml-2 text-[#a3a3a3] hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path></svg>
                    </button>
                    <div>
                        <h1 class="text-lg font-bold text-white" style="font-family: var(--font-heading);">{{ $pageTitle ?? 'Dashboard' }}</h1>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('home') }}" target="_blank" class="text-[13px] text-[#a3a3a3] hover:text-white transition-colors duration-200">View Site</a>
                        @auth
                            <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center">
                                <span class="text-[11px] font-bold text-[#1a1a1a]">{{ substr(auth()->user()->name, 0, 1) }}</span>
                            </div>
                        @endauth
                    </div>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
