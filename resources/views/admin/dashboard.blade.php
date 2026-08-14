@extends('layouts.admin')

@section('content')
<div class="space-y-8">

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
        @php
            $statItems = [
                ['label' => 'Products', 'count' => $stats['products'], 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />'],
                ['label' => 'Categories', 'count' => $stats['categories'], 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a1.807 1.807 0 000-2.764L13.11 3.757a1.807 1.807 0 00-2.607.33L8.958 5.623M3 9.75v4.5A2.25 2.25 0 005.25 16.5h4.5" />'],
                ['label' => 'Portfolio', 'count' => $stats['portfolio'], 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5a1.5 1.5 0 001.5-1.5V5.25a1.5 1.5 0 00-1.5-1.5H3.75a1.5 1.5 0 00-1.5 1.5v14.25a1.5 1.5 0 001.5 1.5z" />'],
                ['label' => 'Artists', 'count' => $stats['artists'], 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />'],
                ['label' => 'Reviews', 'count' => $stats['reviews'], 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />'],
            ];
        @endphp

        @foreach($statItems as $stat)
            <div class="stat-card">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-lg bg-[#f5f5f0] flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#1a1a1a]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">{!! $stat['icon'] !!}</svg>
                    </div>
                </div>
                <p class="text-2xl font-bold text-[#1a1a1a]">{{ $stat['count'] }}</p>
                <p class="text-[13px] text-[#999999] mt-1">{{ $stat['label'] }}</p>
            </div>
        @endforeach
    </div>

    {{-- Quick Actions --}}
    <div>
        <h2 class="text-[15px] font-bold text-[#1a1a1a] mb-4" style="font-family: var(--font-heading);">Quick Actions</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('admin.products.create') }}" class="group flex items-center gap-4 p-5 bg-white border border-[#e5e5e5] rounded-xl hover:border-[#1a1a1a] transition-all duration-200">
                <div class="w-10 h-10 rounded-lg bg-[#f5f5f0] flex items-center justify-center group-hover:bg-[#1a1a1a] transition-colors duration-200">
                    <svg class="w-5 h-5 text-[#1a1a1a] group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path></svg>
                </div>
                <div>
                    <p class="text-[14px] font-semibold text-[#1a1a1a]">Add Product</p>
                    <p class="text-[12px] text-[#999999]">Create new product</p>
                </div>
            </a>
            <a href="{{ route('admin.portfolio.create') }}" class="group flex items-center gap-4 p-5 bg-white border border-[#e5e5e5] rounded-xl hover:border-[#1a1a1a] transition-all duration-200">
                <div class="w-10 h-10 rounded-lg bg-[#f5f5f0] flex items-center justify-center group-hover:bg-[#1a1a1a] transition-colors duration-200">
                    <svg class="w-5 h-5 text-[#1a1a1a] group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5a1.5 1.5 0 001.5-1.5V5.25a1.5 1.5 0 00-1.5-1.5H3.75a1.5 1.5 0 00-1.5 1.5v14.25a1.5 1.5 0 001.5 1.5z"></path></svg>
                </div>
                <div>
                    <p class="text-[14px] font-semibold text-[#1a1a1a]">Add Portfolio</p>
                    <p class="text-[12px] text-[#999999]">Upload artwork</p>
                </div>
            </a>
            <a href="{{ route('admin.brand-assets.edit') }}" class="group flex items-center gap-4 p-5 bg-white border border-[#e5e5e5] rounded-xl hover:border-[#1a1a1a] transition-all duration-200">
                <div class="w-10 h-10 rounded-lg bg-[#f5f5f0] flex items-center justify-center group-hover:bg-[#1a1a1a] transition-colors duration-200">
                    <svg class="w-5 h-5 text-[#1a1a1a] group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"></path></svg>
                </div>
                <div>
                    <p class="text-[14px] font-semibold text-[#1a1a1a]">Edit Website Content</p>
                    <p class="text-[12px] text-[#999999]">Hero & section images</p>
                </div>
            </a>
            <a href="{{ route('admin.reviews.create') }}" class="group flex items-center gap-4 p-5 bg-white border border-[#e5e5e5] rounded-xl hover:border-[#1a1a1a] transition-all duration-200">
                <div class="w-10 h-10 rounded-lg bg-[#f5f5f0] flex items-center justify-center group-hover:bg-[#1a1a1a] transition-colors duration-200">
                    <svg class="w-5 h-5 text-[#1a1a1a] group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"></path></svg>
                </div>
                <div>
                    <p class="text-[14px] font-semibold text-[#1a1a1a]">Add Review</p>
                    <p class="text-[12px] text-[#999999]">Customer testimonial</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
