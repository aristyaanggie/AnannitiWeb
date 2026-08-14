@props([
    'image' => null,
    'title' => 'Product Name',
    'category' => 'Category',
    'price' => '0.00',
    'badge' => null,
    'href' => '#',
])

@php
    $badgeColors = [
        'NEW' => 'bg-black text-white',
        'BEST SELLER' => 'bg-[#1a1a1a] text-white',
        'LIMITED' => 'bg-black text-white',
        'OUT OF STOCK' => 'bg-[#666666] text-white',
        'FEATURED' => 'bg-[#1a1a1a] text-white',
    ];
    $badgeClass = $badge ? ($badgeColors[strtoupper($badge)] ?? 'bg-black text-white') : 'bg-black text-white';
@endphp

<a href="{{ $href }}" class="group cursor-pointer block">
    {{-- Image --}}
    <div class="relative aspect-[4/5] overflow-hidden rounded-2xl mb-4 bg-[#f5f5f0]">
        @if($image)
            <img src="{{ asset($image) }}" alt="{{ $title }}" class="w-full h-full object-cover transition-transform duration-200 group-hover:scale-[1.02]" onerror="this.src='{{ asset('images/hero-placeholder2.jpeg') }}'" loading="lazy" />
        @else
            <img src="{{ asset('images/hero-placeholder2.jpeg') }}" alt="{{ $title }}" class="w-full h-full object-cover transition-transform duration-200 group-hover:scale-[1.02]" loading="lazy" />
        @endif

        {{-- Badge --}}
        @if($badge)
            <div class="absolute top-4 left-4">
                <span class="inline-block px-3 py-1 text-[10px] font-semibold uppercase tracking-[0.15em] {{ $badgeClass }}">{{ $badge }}</span>
            </div>
        @endif
    </div>

    {{-- Content --}}
    <div>
        <p class="text-[12px] uppercase tracking-[0.15em] text-text-muted mb-1.5">{{ $category }}</p>
        <h3 class="text-[15px] font-bold text-text-primary mb-1.5 leading-snug line-clamp-2 transition-all duration-200 group-hover:translate-x-0.5" style="font-family: var(--font-heading);">{{ $title }}</h3>
        <p class="text-[14px] font-semibold text-text-primary mb-2">{{ config('ananniti.payment.currency_symbol', 'Rp') }} {{ number_format((float) $price, 0, ',', '.') }}</p>
        <span class="inline-flex items-center gap-1.5 text-[13px] font-semibold text-text-primary transition-all duration-200 group-hover:gap-2">
            View Product
            <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
        </span>
    </div>
</a>
