@extends('layouts.admin')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div>
        <h2 class="text-xl font-bold text-[#1a1a1a]" style="font-family: var(--font-heading);">Settings</h2>
        <p class="text-[13px] text-[#999999] mt-1">Manage your studio settings and information.</p>
    </div>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="px-4 py-3 bg-[#f0fdf4] border border-[#bbf7d0] rounded-xl text-[14px] text-[#166534]">
            {{ session('success') }}
        </div>
    @endif

    {{-- Settings Groups --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- Business --}}
        <a href="{{ route('admin.settings.edit', 'business') }}" class="group bg-white border border-[#e5e5e5] rounded-2xl p-6 hover:border-[#1a1a1a] transition-all duration-200">
            <div class="w-10 h-10 rounded-lg bg-[#f5f5f0] flex items-center justify-center mb-4 group-hover:bg-[#1a1a1a] transition-colors duration-200">
                <svg class="w-5 h-5 text-[#1a1a1a] group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.015A3.001 3.001 0 0021 9.349M6.75 21h10.5"></path></svg>
            </div>
            <h3 class="text-[15px] font-bold text-[#1a1a1a] mb-2">Business</h3>
            <p class="text-[13px] text-[#999999]">Studio name, tagline, contact info, hours.</p>
        </a>

        {{-- Social --}}
        <a href="{{ route('admin.settings.edit', 'social') }}" class="group bg-white border border-[#e5e5e5] rounded-2xl p-6 hover:border-[#1a1a1a] transition-all duration-200">
            <div class="w-10 h-10 rounded-lg bg-[#f5f5f0] flex items-center justify-center mb-4 group-hover:bg-[#1a1a1a] transition-colors duration-200">
                <svg class="w-5 h-5 text-[#1a1a1a] group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"></path></svg>
            </div>
            <h3 class="text-[15px] font-bold text-[#1a1a1a] mb-2">Social</h3>
            <p class="text-[13px] text-[#999999]">Instagram, TikTok, Facebook links.</p>
        </a>

        {{-- SEO --}}
        <a href="{{ route('admin.settings.edit', 'seo') }}" class="group bg-white border border-[#e5e5e5] rounded-2xl p-6 hover:border-[#1a1a1a] transition-all duration-200">
            <div class="w-10 h-10 rounded-lg bg-[#f5f5f0] flex items-center justify-center mb-4 group-hover:bg-[#1a1a1a] transition-colors duration-200">
                <svg class="w-5 h-5 text-[#1a1a1a] group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 0z"></path></svg>
            </div>
            <h3 class="text-[15px] font-bold text-[#1a1a1a] mb-2">SEO</h3>
            <p class="text-[13px] text-[#999999]">Meta title, meta description.</p>
        </a>

    </div>

</div>
@endsection
