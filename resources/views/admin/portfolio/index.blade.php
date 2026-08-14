@extends('layouts.admin')

@section('content')
<div class="space-y-6" x-data="{ searchQuery: '' }">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-[#1a1a1a]" style="font-family: var(--font-heading);">Portfolio</h2>
            <p class="text-[13px] text-[#999999] mt-1">Manage your tattoo artwork gallery.</p>
        </div>
        <a href="{{ route('admin.portfolio.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#1a1a1a] text-white text-[13px] font-semibold rounded-lg hover:bg-[#333333] transition-colors duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path></svg>
            Add Portfolio
        </a>
    </div>

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="px-4 py-3 bg-[#f0fdf4] border border-[#bbf7d0] rounded-xl text-[14px] text-[#166534]">
            {{ session('success') }}
        </div>
    @endif

    {{-- Summary Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="stat-card">
            <p class="text-2xl font-bold text-[#1a1a1a]">{{ $stats['total'] }}</p>
            <p class="text-[13px] text-[#999999] mt-1">Total Portfolio</p>
        </div>
        <div class="stat-card">
            <p class="text-2xl font-bold text-[#1a1a1a]">{{ $stats['featured'] }}</p>
            <p class="text-[13px] text-[#999999] mt-1">Featured</p>
        </div>
        <div class="stat-card">
            <p class="text-2xl font-bold text-[#1a1a1a]">{{ $stats['hidden'] }}</p>
            <p class="text-[13px] text-[#999999] mt-1">Hidden</p>
        </div>
        <div class="stat-card">
            <p class="text-2xl font-bold text-[#1a1a1a] text-[18px]">{{ $stats['newest'] }}</p>
            <p class="text-[13px] text-[#999999] mt-1">Newest</p>
        </div>
    </div>

    {{-- Search --}}
    <div class="relative">
        <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-[#999999]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
        <input type="text" x-model="searchQuery" placeholder="Search portfolio..."
            class="w-full pl-10 pr-4 py-3 bg-white border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200" style="padding-left: 2.75rem;" />
    </div>

    {{-- Portfolio Table --}}
    @if($portfolios->isEmpty())
        <div class="bg-white border border-[#e5e5e5] rounded-xl py-16 text-center">
            <svg class="w-12 h-12 mx-auto text-[#e5e5e5] mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5a1.5 1.5 0 001.5-1.5V5.25a1.5 1.5 0 00-1.5-1.5H3.75a1.5 1.5 0 00-1.5 1.5v14.25a1.5 1.5 0 001.5 1.5z"></path></svg>
            <p class="text-[15px] font-semibold text-[#1a1a1a] mb-1">No portfolio items yet.</p>
            <p class="text-[13px] text-[#999999] mb-6">Create your first portfolio item to get started.</p>
            <a href="{{ route('admin.portfolio.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#1a1a1a] text-white text-[13px] font-semibold rounded-lg hover:bg-[#333333] transition-colors duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path></svg>
                Create First Item
            </a>
        </div>
    @else
        {{-- Desktop Table --}}
        <div class="hidden md:block bg-white border border-[#e5e5e5] rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-[#e5e5e5]">
                            <th class="text-left px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Preview</th>
                            <th class="text-left px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Title</th>
                            <th class="text-left px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Artist</th>
                            <th class="text-left px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Category</th>
                            <th class="text-left px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Style</th>
                            <th class="text-left px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Featured</th>
                            <th class="text-left px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Created</th>
                            <th class="text-right px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($portfolios as $item)
                            <tr class="border-b border-[#e5e5e5] last:border-0 hover:bg-[#fafafa] transition-colors duration-150">
                                <td class="px-6 py-4">
                                    <div class="w-12 h-12 rounded-lg bg-[#f5f5f0] overflow-hidden flex-shrink-0">
                                        @if($item->image)
                                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover" />
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <svg class="w-5 h-5 text-[#cccccc]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5a1.5 1.5 0 001.5-1.5V5.25a1.5 1.5 0 00-1.5-1.5H3.75a1.5 1.5 0 00-1.5 1.5v14.25a1.5 1.5 0 001.5 1.5z"></path></svg>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-[14px] font-medium text-[#1a1a1a]">{{ $item->title }}</td>
                                <td class="px-6 py-4 text-[14px] text-[#666666]">{{ $item->artist?->name ?? '—' }}</td>
                                <td class="px-6 py-4 text-[14px] text-[#666666]">{{ $item->category?->name ?? '—' }}</td>
                                <td class="px-6 py-4 text-[14px] text-[#666666]">{{ $item->tattoo_style ?? '—' }}</td>
                                <td class="px-6 py-4">
                                    @if($item->is_featured)
                                        <span class="inline-block px-2.5 py-1 text-[11px] font-semibold rounded-full bg-[#1a1a1a] text-white">Featured</span>
                                    @else
                                        <span class="text-[13px] text-[#999999]">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-[13px] text-[#999999]">{{ $item->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('admin.portfolio.edit', $item) }}" class="p-2 text-[#1a1a1a] hover:text-[#000000] rounded-lg hover:bg-[#f5f5f0] transition-colors duration-150" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path></svg>
                                        </a>
                                        <button @click="$dispatch('open-delete-modal', { action: '{{ route('admin.portfolio.destroy', $item) }}' })" class="p-2 text-[#999999] hover:text-[#ef4444] rounded-lg hover:bg-[#fef2f2] transition-colors duration-150" title="Delete">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Mobile Cards --}}
        <div class="md:hidden space-y-3">
            @foreach($portfolios as $item)
                <div class="bg-white border border-[#e5e5e5] rounded-xl p-4">
                    <div class="flex items-start gap-3">
                        <div class="w-12 h-12 rounded-lg bg-[#f5f5f0] overflow-hidden flex-shrink-0">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover" />
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-[#cccccc]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5a1.5 1.5 0 001.5-1.5V5.25a1.5 1.5 0 00-1.5-1.5H3.75a1.5 1.5 0 00-1.5 1.5v14.25a1.5 1.5 0 001.5 1.5z"></path></svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[14px] font-medium text-[#1a1a1a] truncate">{{ $item->title }}</p>
                            <p class="text-[12px] text-[#999999] mt-0.5">{{ $item->artist?->name ?? '—' }} &bull; {{ $item->category?->name ?? '—' }}</p>
                        </div>
                        @if($item->is_featured)
                            <span class="flex-shrink-0 px-2 py-0.5 text-[10px] font-semibold rounded-full bg-[#1a1a1a] text-white">Featured</span>
                        @endif
                    </div>
                    <div class="flex items-center justify-between mt-3 pt-3 border-t border-[#e5e5e5]">
                        <span class="text-[12px] text-[#999999]">{{ $item->tattoo_style ?? '—' }}</span>
                        <div class="flex items-center gap-1">
                            <a href="{{ route('admin.portfolio.edit', $item) }}" class="p-2 text-[#999999] hover:text-[#1a1a1a] rounded-lg hover:bg-[#f5f5f0] transition-colors duration-150">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path></svg>
                            </a>
                            <button @click="$dispatch('open-delete-modal', { action: '{{ route('admin.portfolio.destroy', $item) }}' })" class="p-2 text-[#999999] hover:text-[#ef4444] rounded-lg hover:bg-[#fef2f2] transition-colors duration-150" title="Delete">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path></svg>
                                </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Delete Modal --}}
    <x-ui.delete-modal title="Delete Portfolio?" message="This portfolio item will be permanently deleted. This action cannot be undone." />

</div>
@endsection
