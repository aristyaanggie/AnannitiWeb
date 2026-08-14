@extends('layouts.admin')

@section('content')
<div class="space-y-6" x-data="{ selectedProducts: [], showBulkActions: false }">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-[#1a1a1a]" style="font-family: var(--font-heading);">Products</h2>
            <p class="text-[13px] text-[#999999] mt-1">Manage your shop products and tattoo supply cards.</p>
        </div>
        @if($activeTab === 'products')
            <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#1a1a1a] text-white text-[13px] font-semibold rounded-lg hover:bg-[#333333] transition-colors duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path></svg>
                Add Product
            </a>
        @else
            <a href="{{ route('admin.tattoo-supplies.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#1a1a1a] text-white text-[13px] font-semibold rounded-lg hover:bg-[#333333] transition-colors duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path></svg>
                Add Tattoo Supply
            </a>
        @endif
    </div>

    {{-- Tab Navigation --}}
    <x-admin.tabs :active="$activeTab" />

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="px-4 py-3 bg-[#f0fdf4] border border-[#bbf7d0] rounded-xl text-[14px] text-[#166534]">
            {{ session('success') }}
        </div>
    @endif

    @if($activeTab === 'products')
        {{-- Summary Cards --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="stat-card">
                <p class="text-2xl font-bold text-[#1a1a1a]">{{ $stats['total'] }}</p>
                <p class="text-[13px] text-[#999999] mt-1">Active Products</p>
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
                <p class="text-2xl font-bold text-[#1a1a1a]">{{ $stats['low_stock'] }}</p>
                <p class="text-[13px] text-[#999999] mt-1">Low Stock</p>
            </div>
        </div>

        {{-- Bulk Actions --}}
        <div x-show="selectedProducts.length > 0" x-transition class="flex items-center gap-3 px-4 py-3 bg-[#f5f5f0] border border-[#e5e5e5] rounded-xl">
            <span class="text-[13px] text-[#666666]"><span x-text="selectedProducts.length"></span> selected</span>
            <button class="px-3 py-1.5 text-[12px] font-medium bg-[#1a1a1a] text-white rounded-lg hover:bg-[#333333] transition-colors duration-150">Publish</button>
            <button class="px-3 py-1.5 text-[12px] font-medium border border-[#e5e5e5] text-[#666666] rounded-lg hover:bg-white transition-colors duration-150">Draft</button>
            <button class="px-3 py-1.5 text-[12px] font-medium text-[#ef4444] hover:bg-[#fef2f2] rounded-lg transition-colors duration-150">Delete</button>
        </div>

        {{-- Products Table --}}
        @if($products->isEmpty())
            {{-- Empty State --}}
            <div class="bg-white border border-[#e5e5e5] rounded-xl py-16 text-center">
                <svg class="w-12 h-12 mx-auto text-[#e5e5e5] mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m16.5 0v1.125c0 .53-.21 1.004-.59 1.355a2.25 2.25 0 01-2.25.645h-9a2.25 2.25 0 01-2.25-.645c-.38-.351-.59-.825-.59-1.355V7.5M6.75 21h10.5"></path></svg>
                <p class="text-[15px] font-semibold text-[#1a1a1a] mb-1">No products yet.</p>
                <p class="text-[13px] text-[#999999] mb-6">Create your first product to get started.</p>
                <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#1a1a1a] text-white text-[13px] font-semibold rounded-lg hover:bg-[#333333] transition-colors duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path></svg>
                    Create First Product
                </a>
            </div>
        @else
            {{-- Desktop Table --}}
            <div class="hidden md:block bg-white border border-[#e5e5e5] rounded-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-[#e5e5e5]">
                                <th class="text-left px-6 py-3 w-10">
                                    <input type="checkbox" class="w-4 h-4 rounded border-[#e5e5e5] text-[#1a1a1a] focus:ring-[#1a1a1a]"
                                        @change="selectedProducts = $event.target.checked ? {{ $products->pluck('id')->toJson() }} : []" />
                                </th>
                                <th class="text-left px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Product</th>
                                <th class="text-left px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Category</th>
                                <th class="text-left px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Price</th>
                                <th class="text-left px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Stock</th>
                                <th class="text-left px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Status</th>
                                <th class="text-left px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Updated</th>
                                <th class="text-right px-6 py-3 text-[12px] font-medium text-[#999999] uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr class="border-b border-[#e5e5e5] last:border-0 hover:bg-[#fafafa] transition-colors duration-150">
                                    <td class="px-6 py-4">
                                        <input type="checkbox" value="{{ $product->id }}" class="w-4 h-4 rounded border-[#e5e5e5] text-[#1a1a1a] focus:ring-[#1a1a1a]"
                                            x-model="selectedProducts" />
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-lg bg-[#f5f5f0] overflow-hidden flex-shrink-0">
                                                @if($product->thumbnail)
                                    <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}" class="w-full h-full object-cover" />
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center">
                                                        <svg class="w-5 h-5 text-[#cccccc]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5a1.5 1.5 0 001.5-1.5V5.25a1.5 1.5 0 00-1.5-1.5H3.75a1.5 1.5 0 00-1.5 1.5v14.25a1.5 1.5 0 001.5 1.5z"></path></svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="text-[14px] font-medium text-[#1a1a1a]">{{ $product->name }}</p>
                                                @if($product->badge)
                                                    <span class="inline-block mt-1 px-2 py-0.5 text-[10px] font-semibold uppercase tracking-wider bg-[#1a1a1a] text-white rounded">{{ $product->badge->name }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-[14px] text-[#666666]">{{ $product->category->name ?? '—' }}</td>
                                    <td class="px-6 py-4 text-[14px] font-medium text-[#1a1a1a]">
                                        {{ config('ananniti.payment.currency_symbol', 'Rp') }}
                                        @if($product->sales_format === 'individual')
                                            {{ number_format($product->individual_price ?? $product->price, 0, ',', '.') }}
                                        @else
                                            {{ number_format($product->standard_price ?? $product->price, 0, ',', '.') }}
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <span class="text-[14px] text-[#1a1a1a]">{{ $product->stock_quantity }}</span>
                                            @if($product->stock_quantity < $product->minimum_stock)
                                                <x-ui.status-badge status="low_stock" />
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($product->is_visible)
                                            <x-ui.status-badge status="published" />
                                        @else
                                            <x-ui.status-badge status="draft" />
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-[13px] text-[#999999]">{{ $product->updated_at->format('d M Y') }}</td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-1">
                                            <form method="POST" action="{{ route('admin.products.toggle-status', $product) }}" class="inline">
                                                @csrf
                                                <button type="submit" class="p-2 text-[#999999] hover:text-[#1a1a1a] rounded-lg hover:bg-[#f5f5f0] transition-colors duration-150" title="Toggle Status">
                                                    @if($product->is_visible)
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                                    @else
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                    @endif
                                                </button>
                                            </form>
                                            <a href="{{ route('admin.products.edit', $product) }}" class="p-2 text-[#999999] hover:text-[#1a1a1a] rounded-lg hover:bg-[#f5f5f0] transition-colors duration-150" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path></svg>
                                            </a>
                                            <button @click="$dispatch('open-delete-modal', { action: '{{ route('admin.products.destroy', $product) }}' })" class="p-2 text-[#999999] hover:text-[#ef4444] rounded-lg hover:bg-[#fef2f2] transition-colors duration-150" title="Delete">
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
                @foreach($products as $product)
                    <div class="bg-white border border-[#e5e5e5] rounded-xl p-4">
                        <div class="flex items-start gap-3">
                            <div class="w-12 h-12 rounded-lg bg-[#f5f5f0] overflow-hidden flex-shrink-0">
                                @if($product->thumbnail)
                                    <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}" class="w-full h-full object-cover" />
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-[#cccccc]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5a1.5 1.5 0 001.5-1.5V5.25a1.5 1.5 0 00-1.5-1.5H3.75a1.5 1.5 0 00-1.5 1.5v14.25a1.5 1.5 0 001.5 1.5z"></path></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2">
                                    <p class="text-[14px] font-medium text-[#1a1a1a] truncate">{{ $product->name }}</p>
                                    @if($product->badge)
                                        <span class="flex-shrink-0 px-2 py-0.5 text-[10px] font-semibold uppercase tracking-wider bg-[#1a1a1a] text-white rounded">{{ $product->badge->name }}</span>
                                    @endif
                                </div>
                                <p class="text-[13px] text-[#999999] mt-0.5">{{ $product->category->name ?? '—' }}</p>
                            </div>
                            <div class="text-right flex-shrink-0">
                                <p class="text-[14px] font-medium text-[#1a1a1a]">
                                    {{ config('ananniti.payment.currency_symbol', 'Rp') }}
                                    @if($product->sales_format === 'individual')
                                        {{ number_format($product->individual_price ?? $product->price, 0, ',', '.') }}
                                    @else
                                        {{ number_format($product->standard_price ?? $product->price, 0, ',', '.') }}
                                    @endif
                                </p>
                                @if($product->is_visible)
                                    <x-ui.status-badge status="published" />
                                @else
                                    <x-ui.status-badge status="draft" />
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-3 pt-3 border-t border-[#e5e5e5]">
                            <div class="flex items-center gap-2">
                                <span class="text-[12px] text-[#999999]">Stock: {{ $product->stock_quantity }}</span>
                                @if($product->stock_quantity < $product->minimum_stock)
                                    <x-ui.status-badge status="low_stock" />
                                @endif
                            </div>
                            <div class="flex items-center gap-1">
                                <form method="POST" action="{{ route('admin.products.toggle-status', $product) }}" class="inline">
                                    @csrf
                                    <button type="submit" aria-label="Toggle status" class="p-2 text-[#999999] hover:text-[#1a1a1a] rounded-lg hover:bg-[#f5f5f0] transition-colors duration-150">
                                        @if($product->is_visible)
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                        @else
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        @endif
                                    </button>
                                </form>
                                <a href="{{ route('admin.products.edit', $product) }}" class="p-2 text-[#999999] hover:text-[#1a1a1a] rounded-lg hover:bg-[#f5f5f0] transition-colors duration-150">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path></svg>
                                </a>
                                <button @click="$dispatch('open-delete-modal', { action: '{{ route('admin.products.destroy', $product) }}' })" aria-label="Delete" class="p-2 text-[#999999] hover:text-[#ef4444] rounded-lg hover:bg-[#fef2f2] transition-colors duration-150">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Delete Modal --}}
        <x-ui.delete-modal />
    @else
        {{-- Tattoo Supply tab --}}
        @include('admin.tattoo-supplies._table', ['supplies' => $supplies, 'stats' => $supplyStats])
    @endif

</div>
@endsection
