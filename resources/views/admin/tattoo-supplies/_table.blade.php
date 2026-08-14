{{-- Shared partial: Tattoo Supply list (dipakai di halaman Products tab "Tattoo Supply") --}}

{{-- Summary Cards --}}
<div class="grid grid-cols-2 lg:grid-cols-3 gap-4">
    <div class="stat-card">
        <p class="text-2xl font-bold text-[#1a1a1a]">{{ $stats['total'] }}</p>
        <p class="text-[13px] text-[#999999] mt-1">Total Items</p>
    </div>
    <div class="stat-card">
        <p class="text-2xl font-bold text-[#1a1a1a]">{{ $stats['visible'] }}</p>
        <p class="text-[13px] text-[#999999] mt-1">Visible</p>
    </div>
    <div class="stat-card">
        <p class="text-2xl font-bold text-[#1a1a1a]">{{ $stats['hidden'] }}</p>
        <p class="text-[13px] text-[#999999] mt-1">Hidden</p>
    </div>
</div>

{{-- Tattoo Supply Table --}}
@if($supplies->isEmpty())
    <div class="bg-white border border-[#e5e5e5] rounded-xl py-16 text-center">
        <svg class="w-12 h-12 mx-auto text-[#e5e5e5] mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"></path></svg>
        <p class="text-[15px] font-semibold text-[#1a1a1a] mb-1">No tattoo supply items yet.</p>
        <p class="text-[13px] text-[#999999] mb-6">Create your first tattoo supply card to get started.</p>
        <a href="{{ route('admin.tattoo-supplies.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#1a1a1a] text-white text-[13px] font-semibold rounded-lg hover:bg-[#333333] transition-colors duration-200">
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
                        <th class="text-left px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Image</th>
                        <th class="text-left px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Title</th>
                        <th class="text-left px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Subtitle</th>
                        <th class="text-left px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Order</th>
                        <th class="text-left px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Status</th>
                        <th class="text-right px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($supplies as $supply)
                        <tr class="border-b border-[#e5e5e5] last:border-0 hover:bg-[#fafafa] transition-colors duration-150">
                            <td class="px-6 py-4">
                                <div class="w-10 h-10 rounded-lg bg-[#f5f5f0] overflow-hidden flex-shrink-0">
                                    @if($supply->image)
                                        <img src="{{ asset('storage/' . $supply->image) }}" alt="{{ $supply->title }}" class="w-full h-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />
                                        <div class="w-full h-full hidden items-center justify-center">
                                            <svg class="w-5 h-5 text-[#cccccc]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5a1.5 1.5 0 001.5-1.5V5.25a1.5 1.5 0 00-1.5-1.5H3.75a1.5 1.5 0 00-1.5 1.5v14.25a1.5 1.5 0 001.5 1.5z"></path></svg>
                                        </div>
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-[#cccccc]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5a1.5 1.5 0 001.5-1.5V5.25a1.5 1.5 0 00-1.5-1.5H3.75a1.5 1.5 0 00-1.5 1.5v14.25a1.5 1.5 0 001.5 1.5z"></path></svg>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-[14px] font-medium text-[#1a1a1a]">{{ $supply->title }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-[13px] text-[#999999]">{{ $supply->subtitle ?? '—' }}</p>
                            </td>
                            <td class="px-6 py-4 text-[14px] text-[#666666]">{{ $supply->display_order }}</td>
                            <td class="px-6 py-4">
                                @if($supply->is_visible)
                                    <x-ui.status-badge status="published" />
                                @else
                                    <x-ui.status-badge status="draft" />
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('admin.tattoo-supplies.edit', $supply) }}" class="p-2 text-[#999999] hover:text-[#1a1a1a] rounded-lg hover:bg-[#f5f5f0] transition-colors duration-150" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path></svg>
                                    </a>
                                    <button @click="$dispatch('open-delete-modal', { action: '{{ route('admin.tattoo-supplies.destroy', $supply) }}' })" class="p-2 text-[#999999] hover:text-[#ef4444] rounded-lg hover:bg-[#fef2f2] transition-colors duration-150" title="Delete">
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
        @foreach($supplies as $supply)
            <div class="bg-white border border-[#e5e5e5] rounded-xl p-4">
                <div class="flex items-start gap-3">
                    <div class="w-12 h-12 rounded-lg bg-[#f5f5f0] overflow-hidden flex-shrink-0">
                        @if($supply->image)
                            <img src="{{ asset('storage/' . $supply->image) }}" alt="{{ $supply->title }}" class="w-full h-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />
                            <div class="w-full h-full hidden items-center justify-center">
                                <svg class="w-5 h-5 text-[#cccccc]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5a1.5 1.5 0 001.5-1.5V5.25a1.5 1.5 0 00-1.5-1.5H3.75a1.5 1.5 0 00-1.5 1.5v14.25a1.5 1.5 0 001.5 1.5z"></path></svg>
                            </div>
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#cccccc]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5a1.5 1.5 0 001.5-1.5V5.25a1.5 1.5 0 00-1.5-1.5H3.75a1.5 1.5 0 00-1.5 1.5v14.25a1.5 1.5 0 001.5 1.5z"></path></svg>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-[14px] font-medium text-[#1a1a1a]">{{ $supply->title }}</p>
                        <p class="text-[12px] text-[#999999] mt-0.5">{{ $supply->subtitle ?? '—' }}</p>
                    </div>
                    <div class="flex items-center gap-1">
                        @if(!$supply->is_visible)
                            <x-ui.status-badge status="draft" />
                        @endif
                    </div>
                </div>
                <div class="flex items-center justify-between mt-3 pt-3 border-t border-[#e5e5e5]">
                    <span class="text-[12px] text-[#999999]">Order: {{ $supply->display_order }}</span>
                    <div class="flex items-center gap-1">
                        <a href="{{ route('admin.tattoo-supplies.edit', $supply) }}" class="p-2 text-[#999999] hover:text-[#1a1a1a] rounded-lg hover:bg-[#f5f5f0] transition-colors duration-150">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path></svg>
                        </a>
                        <button @click="$dispatch('open-delete-modal', { action: '{{ route('admin.tattoo-supplies.destroy', $supply) }}' })" class="p-2 text-[#999999] hover:text-[#ef4444] rounded-lg hover:bg-[#fef2f2] transition-colors duration-150">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path></svg>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

{{-- Delete Modal --}}
<x-ui.delete-modal title="Delete Tattoo Supply?" message="This tattoo supply card will be permanently deleted. This action cannot be undone." />
