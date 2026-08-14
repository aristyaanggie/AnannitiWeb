@extends('layouts.admin')

@section('content')
<div class="space-y-6" x-data="{ searchQuery: '', statusFilter: 'all' }">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-[#1a1a1a]" style="font-family: var(--font-heading);">Reviews</h2>
            <p class="text-[13px] text-[#999999] mt-1">Manage customer reviews and testimonials.</p>
        </div>
        <a href="{{ route('admin.reviews.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#1a1a1a] text-white text-[13px] font-semibold rounded-lg hover:bg-[#333333] transition-colors duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path></svg>
            Add Review
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
            <p class="text-[13px] text-[#999999] mt-1">Total Reviews</p>
        </div>
        <div class="stat-card">
            <p class="text-2xl font-bold text-[#1a1a1a]">{{ $stats['published'] }}</p>
            <p class="text-[13px] text-[#999999] mt-1">Published</p>
        </div>
        <div class="stat-card">
            <p class="text-2xl font-bold text-[#1a1a1a]">{{ $stats['draft'] }}</p>
            <p class="text-[13px] text-[#999999] mt-1">Draft</p>
        </div>
        <div class="stat-card">
            <p class="text-2xl font-bold text-[#1a1a1a]">{{ $stats['featured'] }}</p>
            <p class="text-[13px] text-[#999999] mt-1">Featured</p>
        </div>
    </div>

    {{-- Toolbar: Search + Filters --}}
    <div class="flex flex-col sm:flex-row gap-3">
        <div class="relative flex-1">
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-[#999999]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            <input type="text" x-model="searchQuery" placeholder="Search reviews..."
                class="w-full pl-10 pr-4 py-3 bg-white border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200" style="padding-left: 2.75rem;" />
        </div>
        <select x-model="statusFilter"
            class="px-4 py-3 bg-white border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200 appearance-none cursor-pointer">
            <option value="all">All Status</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
            <option value="featured">Featured</option>
        </select>
    </div>

    {{-- Reviews Table --}}
    @if($reviews->isEmpty())
        <div class="bg-white border border-[#e5e5e5] rounded-xl py-16 text-center">
            <svg class="w-12 h-12 mx-auto text-[#e5e5e5] mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"></path></svg>
            <p class="text-[15px] font-semibold text-[#1a1a1a] mb-1">No reviews yet.</p>
            <p class="text-[13px] text-[#999999] mb-6">Add your first customer review to get started.</p>
            <a href="{{ route('admin.reviews.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#1a1a1a] text-white text-[13px] font-semibold rounded-lg hover:bg-[#333333] transition-colors duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path></svg>
                Add First Review
            </a>
        </div>
    @else
        {{-- Desktop Table --}}
        <div class="hidden md:block bg-white border border-[#e5e5e5] rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-[#e5e5e5]">
                            <th class="text-left px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Photo</th>
                            <th class="text-left px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Customer</th>
                            <th class="text-left px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Artist</th>
                            <th class="text-left px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Rating</th>
                            <th class="text-left px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Review</th>
                            <th class="text-left px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Status</th>
                            <th class="text-left px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Featured</th>
                            <th class="text-left px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Created</th>
                            <th class="text-right px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reviews as $review)
                            <tr class="border-b border-[#e5e5e5] last:border-0 hover:bg-[#fafafa] transition-colors duration-150"
                                x-show="(statusFilter === 'all') ||
                                    (statusFilter === 'published' && {{ $review->is_visible ? 'true' : 'false' }}) ||
                                    (statusFilter === 'draft' && {{ !$review->is_visible ? 'true' : 'false' }}) ||
                                    (statusFilter === 'featured' && {{ $review->is_featured ? 'true' : 'false' }})"
                                x-transition>
                                <td class="px-6 py-4">
                                    <div class="w-10 h-10 rounded-full bg-[#f5f5f0] overflow-hidden flex-shrink-0">
                                        @if($review->photo)
                                            <img src="{{ asset('storage/' . $review->photo) }}" alt="{{ $review->name }}" class="w-full h-full object-cover" />
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <span class="text-[13px] font-bold text-[#999999]">{{ strtoupper(substr($review->name, 0, 1)) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-[14px] font-medium text-[#1a1a1a]">{{ $review->name }}</p>
                                    @if($review->country)
                                        <p class="text-[12px] text-[#999999]">{{ $review->country }}</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-[14px] text-[#666666]">{{ $review->artist?->name ?? '—' }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-0.5">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->rating)
                                                <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                            @else
                                                <svg class="w-3.5 h-3.5 text-[#e5e5e5]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                            @endif
                                        @endfor
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-[13px] text-[#666666] max-w-[200px] truncate" title="{{ $review->content }}">{{ Str::limit($review->content, 60) }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    @if($review->is_visible)
                                        <span class="inline-block px-2.5 py-1 text-[11px] font-semibold rounded-full bg-[#f0fdf4] text-[#166534]">Published</span>
                                    @else
                                        <span class="inline-block px-2.5 py-1 text-[11px] font-semibold rounded-full bg-[#fafafa] text-[#999999]">Draft</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($review->is_featured)
                                        <span class="inline-block px-2.5 py-1 text-[11px] font-semibold rounded-full bg-[#1a1a1a] text-white">Featured</span>
                                    @else
                                        <span class="text-[13px] text-[#999999]">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-[13px] text-[#999999]">{{ $review->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <form method="POST" action="{{ route('admin.reviews.toggle-status', $review) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="p-2 text-[#999999] hover:text-[#1a1a1a] rounded-lg hover:bg-[#f5f5f0] transition-colors duration-150" title="{{ $review->is_visible ? 'Unpublish' : 'Publish' }}">
                                                @if($review->is_visible)
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                @else
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"></path></svg>
                                                @endif
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.reviews.toggle-featured', $review) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="p-2 text-[#999999] hover:text-[#D4AF37] rounded-lg hover:bg-[#fafaf0] transition-colors duration-150" title="{{ $review->is_featured ? 'Remove Featured' : 'Set Featured' }}">
                                                <svg class="w-4 h-4" fill="{{ $review->is_featured ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"></path></svg>
                                            </button>
                                        </form>
                                        <a href="{{ route('admin.reviews.edit', $review) }}" class="p-2 text-[#999999] hover:text-[#1a1a1a] rounded-lg hover:bg-[#f5f5f0] transition-colors duration-150" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path></svg>
                                        </a>
                                        <button @click="$dispatch('open-delete-modal', { action: '{{ route('admin.reviews.destroy', $review) }}' })" class="p-2 text-[#999999] hover:text-[#ef4444] rounded-lg hover:bg-[#fef2f2] transition-colors duration-150" title="Delete">
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
            @foreach($reviews as $review)
                <div class="bg-white border border-[#e5e5e5] rounded-xl p-4"
                    x-show="(statusFilter === 'all') ||
                        (statusFilter === 'published' && {{ $review->is_visible ? 'true' : 'false' }}) ||
                        (statusFilter === 'draft' && {{ !$review->is_visible ? 'true' : 'false' }}) ||
                        (statusFilter === 'featured' && {{ $review->is_featured ? 'true' : 'false' }})"
                    x-transition>
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-full bg-[#f5f5f0] overflow-hidden flex-shrink-0">
                            @if($review->photo)
                                <img src="{{ asset('storage/' . $review->photo) }}" alt="{{ $review->name }}" class="w-full h-full object-cover" />
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <span class="text-[13px] font-bold text-[#999999]">{{ strtoupper(substr($review->name, 0, 1)) }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[14px] font-medium text-[#1a1a1a]">{{ $review->name }}</p>
                            <p class="text-[12px] text-[#999999] mt-0.5">{{ $review->artist?->name ?? '—' }} &bull; {{ $review->country ?? '—' }}</p>
                        </div>
                        <div class="flex items-center gap-1">
                            @if($review->is_featured)
                                <span class="flex-shrink-0 px-2 py-0.5 text-[10px] font-semibold rounded-full bg-[#1a1a1a] text-white">Featured</span>
                            @endif
                            @if(!$review->is_visible)
                                <span class="flex-shrink-0 px-2 py-0.5 text-[10px] font-semibold rounded-full bg-[#fafafa] text-[#999999]">Draft</span>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center gap-0.5 mt-2">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $review->rating)
                                <svg class="w-3 h-3 text-[#D4AF37]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            @else
                                <svg class="w-3 h-3 text-[#e5e5e5]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            @endif
                        @endfor
                    </div>
                    <p class="text-[13px] text-[#666666] mt-2 line-clamp-2">{{ $review->content }}</p>
                    <div class="flex items-center justify-between mt-3 pt-3 border-t border-[#e5e5e5]">
                        <span class="text-[12px] text-[#999999]">{{ $review->created_at->format('d M Y') }}</span>
                        <div class="flex items-center gap-1">
                            <form method="POST" action="{{ route('admin.reviews.toggle-status', $review) }}" class="inline">
                                @csrf
                                <button type="submit" aria-label="Toggle status" class="p-2 text-[#999999] hover:text-[#1a1a1a] rounded-lg hover:bg-[#f5f5f0] transition-colors duration-150">
                                    @if($review->is_visible)
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    @else
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"></path></svg>
                                    @endif
                                </button>
                            </form>
                            <a href="{{ route('admin.reviews.edit', $review) }}" class="p-2 text-[#999999] hover:text-[#1a1a1a] rounded-lg hover:bg-[#f5f5f0] transition-colors duration-150">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path></svg>
                            </a>
                            <button @click="$dispatch('open-delete-modal', { action: '{{ route('admin.reviews.destroy', $review) }}' })" aria-label="Delete" class="p-2 text-[#999999] hover:text-[#ef4444] rounded-lg hover:bg-[#fef2f2] transition-colors duration-150">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path></svg>
                                </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Delete Modal --}}
    <x-ui.delete-modal title="Delete Review?" message="This review will be permanently deleted. This action cannot be undone." />

</div>
@endsection
