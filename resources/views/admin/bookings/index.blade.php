@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-[#1a1a1a]" style="font-family: var(--font-heading);">Bookings</h2>
            <p class="text-[13px] text-[#999999] mt-1">View incoming tattoo service bookings.</p>
        </div>
    </div>

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="px-4 py-3 bg-[#f0fdf4] border border-[#bbf7d0] rounded-xl text-[14px] text-[#166534]">
            {{ session('success') }}
        </div>
    @endif

    {{-- Summary Cards / Filters --}}
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-4">
        <a href="{{ route('admin.bookings.index') }}" class="stat-card hover:bg-[#fafafa] transition-colors {{ $filter === 'all' ? 'border-[#1a1a1a] shadow-sm' : '' }}">
            <p class="text-2xl font-bold text-[#1a1a1a]">{{ $stats['total'] }}</p>
            <p class="text-[13px] text-[#999999] mt-1">All Bookings</p>
        </a>
        <a href="{{ route('admin.bookings.index', ['filter' => 'week']) }}" class="stat-card hover:bg-[#fafafa] transition-colors {{ $filter === 'week' ? 'border-[#1a1a1a] shadow-sm' : '' }}">
            <p class="text-2xl font-bold text-[#1a1a1a]">{{ $stats['week'] }}</p>
            <p class="text-[13px] text-[#999999] mt-1">This Week</p>
        </a>
        <a href="{{ route('admin.bookings.index', ['filter' => 'month']) }}" class="stat-card hover:bg-[#fafafa] transition-colors {{ $filter === 'month' ? 'border-[#1a1a1a] shadow-sm' : '' }}">
            <p class="text-2xl font-bold text-[#1a1a1a]">{{ $stats['month'] }}</p>
            <p class="text-[13px] text-[#999999] mt-1">This Month</p>
        </a>
        <a href="{{ route('admin.bookings.index', ['filter' => 'year']) }}" class="stat-card hover:bg-[#fafafa] transition-colors {{ $filter === 'year' ? 'border-[#1a1a1a] shadow-sm' : '' }}">
            <p class="text-2xl font-bold text-[#1a1a1a]">{{ $stats['year'] }}</p>
            <p class="text-[13px] text-[#999999] mt-1">This Year</p>
        </a>
        <a href="{{ route('admin.bookings.index', ['filter' => 'trash']) }}" class="stat-card hover:bg-[#fafafa] transition-colors {{ $filter === 'trash' ? 'border-[#1a1a1a] shadow-sm bg-[#fef2f2]' : '' }}">
            <p class="text-2xl font-bold {{ $filter === 'trash' ? 'text-[#ef4444]' : 'text-[#1a1a1a]' }}">{{ $stats['trash'] }}</p>
            <p class="text-[13px] text-[#999999] mt-1">Trash</p>
        </a>
    </div>

    <div class="bg-white border border-[#e5e5e5] rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-[#e5e5e5]">
                        <th class="text-left px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Date Submitted</th>
                        <th class="text-left px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Customer</th>
                        <th class="text-left px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Service</th>
                        <th class="text-left px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Tattoo Style</th>
                        <th class="text-left px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Budget</th>
                        <th class="text-left px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Preferred Date/Time</th>
                        <th class="text-right px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        <tr class="border-b border-[#e5e5e5] last:border-0 hover:bg-[#fafafa] transition-colors duration-150">
                            <td class="px-6 py-4 text-[13px] text-[#666666]">{{ $booking->created_at->format('d M Y, H:i') }}</td>
                            <td class="px-6 py-4">
                                <p class="text-[14px] font-medium text-[#1a1a1a]">{{ $booking->name }}</p>
                                <p class="text-[12px] text-[#999999]">{{ $booking->country }}</p>
                                @if($booking->phone)<p class="text-[12px] text-[#999999]">{{ $booking->phone }}</p>@endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-[11px] font-medium rounded-md {{ $booking->service === 'studio' ? 'bg-[#f5f5f0] text-[#1a1a1a]' : 'bg-[#e5e5e5] text-[#1a1a1a]' }}">
                                    {{ $booking->service === 'studio' ? 'Studio' : 'Home Service' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-[14px] text-[#1a1a1a]">{{ $booking->tattoo_style }}</td>
                            <td class="px-6 py-4 text-[14px] text-[#1a1a1a]">{{ $booking->budget }}</td>
                            <td class="px-6 py-4">
                                <p class="text-[13px] text-[#1a1a1a]">{{ $booking->preferred_date ?? 'Flexible' }}</p>
                                <p class="text-[12px] text-[#999999]">{{ $booking->preferred_time ?? '—' }}</p>
                            </td>
                            <td class="px-6 py-4 text-right">
                                @if($filter === 'trash')
                                    <div class="flex items-center justify-end gap-1">
                                        <form method="POST" action="{{ route('admin.bookings.restore', $booking->id) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="p-2 text-[#999999] hover:text-[#16a34a] rounded-lg hover:bg-[#f0fdf4] transition-colors duration-150" title="Restore">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"></path></svg>
                                            </button>
                                        </form>
                                        <button x-data @click="$dispatch('open-delete-modal', { action: '{{ route('admin.bookings.force-delete', $booking->id) }}' })" class="p-2 text-[#999999] hover:text-[#ef4444] rounded-lg hover:bg-[#fef2f2] transition-colors duration-150" title="Delete Permanently">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path></svg>
                                        </button>
                                    </div>
                                @else
                                    <button x-data @click="$dispatch('open-delete-modal', { action: '{{ route('admin.bookings.destroy', $booking) }}' })" class="p-2 text-[#999999] hover:text-[#ef4444] rounded-lg hover:bg-[#fef2f2] transition-colors duration-150" title="Delete">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path></svg>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-[14px] text-[#999999]">No bookings found for this filter.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-[#e5e5e5]">
            {{ $bookings->appends(['filter' => $filter])->links() }}
        </div>
    </div>

    {{-- Delete Modal --}}
    <x-ui.delete-modal />
</div>
@endsection
