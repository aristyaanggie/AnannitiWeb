@extends('layouts.app')

@section('content')
<x-layout.navbar />

{{-- Breadcrumb --}}
<section class="bg-white border-b border-[#e5e5e5]">
  <div class="max-w-[1400px] mx-auto px-6 md:px-8 lg:px-12 py-4">
    <nav class="flex items-center gap-2 text-[13px]" aria-label="Breadcrumb">
      <a href="{{ route('home') }}" class="text-[#999999] hover:text-[#1a1a1a] transition-colors duration-200">Home</a>
      <span class="text-[#cccccc]">/</span>
      <a href="{{ route('shop') }}" class="text-[#999999] hover:text-[#1a1a1a] transition-colors duration-200">Shop</a>
      @if($product->category)
          <span class="text-[#cccccc]">/</span>
          <a href="{{ route('shop.category', $product->category->slug) }}" class="text-[#999999] hover:text-[#1a1a1a] transition-colors duration-200">{{ $product->category->name }}</a>
      @endif
      <span class="text-[#cccccc]">/</span>
      <span class="text-[#1a1a1a] font-medium">{{ $product->name }}</span>
    </nav>
  </div>
</section>

@php
    $images = [];
    $mainImage = $product->thumbnail ? asset('storage/' . $product->thumbnail) : asset('images/hero-placeholder2.jpeg');

    if ($product->galleries->count() > 0) {
        $images[] = $mainImage;
        foreach ($product->galleries->sortBy('display_order') as $gallery) {
            $images[] = asset('storage/' . $gallery->image);
        }
    } else {
        $images[] = $mainImage;
    }
@endphp

{{-- Store images JSON in a script tag to avoid HTML entity encoding issues in x-data --}}
<script id="product-images-data" type="application/json">{!! json_encode($images, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>

{{-- Product Detail --}}
<section class="bg-white" x-data="{ 
    activeImage: 0, 
    quantity: 1, 
    customerName: '', 
    customerCountry: '', 
    customerPhone: '', 
    images: JSON.parse(document.getElementById('product-images-data').textContent),
    selectedFormat: '{{ $product->sales_format === 'individual' ? 'individual' : 'standard' }}',
    getPrice() {
        return this.selectedFormat === 'individual' ? {{ $product->individual_price ?? $product->price ?? 0 }} : {{ $product->standard_price ?? $product->price ?? 0 }};
    },
    getFormatText() {
        if (this.selectedFormat === 'individual') return 'Individual Unit / 1 {{ addslashes($product->individual_unit ?? 'Piece') }}';
        return 'Standard Package / {{ $product->standard_quantity ?? 1 }} {{ addslashes($product->standard_unit ?? 'Unit') }}';
    },
    getFormattedPrice() {
        return new Intl.NumberFormat('id-ID').format(this.getPrice());
    }
}">
  <div class="max-w-[1400px] mx-auto px-6 md:px-8 lg:px-12 pt-10 md:pt-16 pb-16 md:py-24 lg:py-32">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-16 lg:gap-20 items-start">

      {{-- LEFT: Product Image + Thumbnails --}}
      <div>
        {{-- Main Image --}}
        <div class="aspect-[4/5] overflow-hidden rounded-2xl bg-[#f5f5f0] mb-4">
          <img :src="images[activeImage]"
               alt="{{ $product->name }}"
               class="w-full h-full object-cover transition-opacity duration-200"
               loading="eager" />
        </div>

        {{-- Thumbnails --}}
        @if(count($images) > 1)
        <div class="flex gap-3 overflow-x-auto pb-2 snap-x snap-mandatory scrollbar-hide">
          @foreach($images as $index => $image)
            <button @click="activeImage = {{ $index }}" :class="activeImage === {{ $index }} ? 'border-black' : 'border-[#e5e5e5] hover:border-[#ccc]'" class="flex-shrink-0 snap-start w-20 h-20 md:w-24 md:h-24 overflow-hidden rounded-xl border-2 transition-all duration-200 cursor-pointer focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-black focus-visible:ring-offset-2">
              <img src="{{ $image }}" alt="{{ $product->name }} view {{ $index + 1 }}" class="w-full h-full object-cover" loading="lazy" />
            </button>
          @endforeach
        </div>
        @endif
      </div>

      {{-- RIGHT: Product Info --}}
      <div class="flex flex-col justify-center md:py-8">
        @if($product->category)
          <p class="text-[11px] uppercase tracking-[0.3em] text-text-muted mb-5">{{ $product->category->name }}</p>
        @endif

        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-text-primary mb-5 leading-[1.1]" style="font-family: var(--font-heading);">{{ $product->name }}</h1>

        @if($product->badge)
          <span class="inline-block px-3 py-1 text-[10px] font-semibold uppercase tracking-[0.12em] bg-black text-white rounded mb-4">{{ $product->badge->name }}</span>
        @endif

        @if($product->short_description)
          <p class="text-base md:text-lg text-text-secondary leading-relaxed mb-8 max-w-md">{{ $product->short_description }}</p>
        @elseif($product->description)
          <p class="text-base md:text-lg text-text-secondary leading-relaxed mb-8 max-w-md">{{ Str::limit(strip_tags($product->description), 150) }}</p>
        @endif

        <div class="mb-8">
          <p class="text-2xl md:text-3xl font-bold text-text-primary mb-2">
            {{ config('ananniti.payment.currency_symbol', 'Rp') }} <span x-text="getFormattedPrice()"></span>
          </p>
          @if($product->stock_quantity > 0)
            <p class="text-[13px] text-success font-medium">In Stock ({{ $product->stock_quantity }} available)</p>
          @else
            <p class="text-[13px] text-[#999999] font-medium">Out of Stock</p>
          @endif
        </div>

        @if($product->sales_format === 'both')
        {{-- Format Selector --}}
        <div class="mb-8">
          <span class="block text-[14px] font-medium text-[#1a1a1a] mb-3">Select Format</span>
          <div class="flex flex-col sm:flex-row gap-3">
            <label class="flex-1 p-3 border rounded-xl cursor-pointer transition-colors duration-200"
                   :class="selectedFormat === 'standard' ? 'border-[#1a1a1a] bg-[#fafafa]' : 'border-[#e5e5e5]'">
              <div class="flex items-center gap-2">
                <input type="radio" name="format" value="standard" x-model="selectedFormat" class="hidden" />
                <span class="text-[14px] font-bold text-[#1a1a1a]">Standard Package</span>
              </div>
              <p class="text-[12px] text-[#666666] mt-1">{{ $product->standard_quantity ?? 1 }} {{ $product->standard_unit ?? 'Unit' }} / Package</p>
            </label>
            <label class="flex-1 p-3 border rounded-xl cursor-pointer transition-colors duration-200"
                   :class="selectedFormat === 'individual' ? 'border-[#1a1a1a] bg-[#fafafa]' : 'border-[#e5e5e5]'">
              <div class="flex items-center gap-2">
                <input type="radio" name="format" value="individual" x-model="selectedFormat" class="hidden" />
                <span class="text-[14px] font-bold text-[#1a1a1a]">Individual Unit</span>
              </div>
              <p class="text-[12px] text-[#666666] mt-1">1 {{ $product->individual_unit ?? 'Piece' }}</p>
            </label>
          </div>
        </div>
        @endif

        {{-- Quantity Selector --}}
        <div class="flex items-center gap-4 mb-6">
          <span class="text-[14px] font-medium text-[#1a1a1a]">Quantity</span>
          <div class="flex items-center border border-[#e5e5e5] rounded-lg">
            <button @click="quantity = Math.max(1, quantity - 1)" class="w-10 h-10 flex items-center justify-center text-[#1a1a1a] hover:bg-[#f5f5f0] transition-colors duration-150 rounded-l-lg" aria-label="Decrease quantity">−</button>
            <span class="w-12 h-10 flex items-center justify-center text-[14px] font-medium text-[#1a1a1a] border-x border-[#e5e5e5]" x-text="quantity"></span>
            <button @click="quantity++" class="w-10 h-10 flex items-center justify-center text-[#1a1a1a] hover:bg-[#f5f5f0] transition-colors duration-150 rounded-r-lg" aria-label="Increase quantity">+</button>
          </div>
        </div>

        {{-- Customer Info --}}
        <div class="space-y-3 mb-6">
          <input type="text" x-model="customerName" placeholder="Your name" class="w-full px-4 py-2.5 bg-[#fafafa] border border-[#e5e5e5] rounded-lg text-[14px] text-[#1a1a1a] placeholder:text-[#999999] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200" />
          <input type="text" x-model="customerCountry" placeholder="Your country" class="w-full px-4 py-2.5 bg-[#fafafa] border border-[#e5e5e5] rounded-lg text-[14px] text-[#1a1a1a] placeholder:text-[#999999] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200" />
        </div>

        {{-- WhatsApp CTA --}}
        <form action="{{ route('shop.order.store') }}" method="POST" class="w-full" target="_blank">
          @csrf
          <input type="hidden" name="product_id" value="{{ $product->id }}">
          <input type="hidden" name="product_name" value="{{ $product->name }}">
          <input type="hidden" name="format" :value="selectedFormat === 'individual' ? 'Individual Unit' : 'Standard Package'">
          <input type="hidden" name="quantity" :value="quantity">
          <input type="hidden" name="price" :value="getPrice()">
          <input type="hidden" name="customer_name" :value="customerName">
          <input type="hidden" name="customer_country" :value="customerCountry">
          
          <div class="flex flex-col sm:flex-row gap-3 mb-8">
            <button type="submit"
                   :disabled="customerName.trim() === '' || customerCountry.trim() === ''"
                   :class="(customerName.trim() === '' || customerCountry.trim() === '') ? 'opacity-50 cursor-not-allowed' : 'hover:bg-[#1a1a1a] focus:ring-2 focus:ring-black focus:ring-offset-2'"
                   class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-black text-white text-sm font-medium rounded-lg transition-colors duration-200 focus:outline-none">
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
              Ask via WhatsApp
            </button>
            <a href="{{ route('shop') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 border border-[#e5e5e5] text-[#1a1a1a] text-sm font-medium rounded-lg transition-colors duration-200 hover:border-[#1a1a1a] focus:outline-none focus:ring-2 focus:ring-[#1a1a1a] focus:ring-offset-2">
              Back to Shop
            </a>
          </div>
        </form>

        {{-- Product Description --}}
        @if($product->description)
        <div class="border-t border-[#e5e5e5] pt-6">
          <p class="text-[15px] text-text-secondary leading-relaxed">{{ $product->description }}</p>
        </div>
        @endif
      </div>

    </div>
  </div>
</section>

{{-- Related Products --}}
@if($relatedProducts->count() > 0)
<section class="bg-white border-t border-[#e5e5e5]">
  <div class="max-w-[1100px] mx-auto px-6 md:px-8 lg:px-12 py-16 md:py-24">

    <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-12 md:mb-16">
      <div>
        <p class="text-[11px] uppercase tracking-[0.25em] text-text-muted mb-4">You May Also Like</p>
        <h2 class="text-3xl md:text-4xl font-bold text-text-primary leading-tight">Related Products</h2>
      </div>
      <a href="{{ route('shop') }}" class="mt-4 md:mt-0 inline-flex items-center gap-2 text-sm font-semibold text-text-primary hover:text-text-secondary transition-colors duration-200">
        View All
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
      </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
      @foreach($relatedProducts as $related)
        <x.shop.product-card
            :image="$related->thumbnail ? 'storage/' . $related->thumbnail : 'images/hero-placeholder2.jpeg'"
            :title="$related->name"
            :category="$related->category->name ?? ''"
            :price="$related->price"
            :badge="$related->badge?->name"
            :href="route('shop.product', $related->slug)"
        />
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- CTA --}}
<section class="bg-[#0a0a0a]">
  <div class="max-w-[1400px] mx-auto px-6 md:px-8 lg:px-12 py-24 md:py-32 lg:py-40">
    <div class="max-w-2xl mx-auto text-center">
      <p class="text-[11px] uppercase tracking-[0.3em] text-white/70 mb-6">Need Help Choosing?</p>
      <h2 class="text-3xl md:text-4xl lg:text-[2.75rem] font-bold text-white leading-[1.1] mb-5" style="font-family: var(--font-heading);">Not Sure What<br> You Need?</h2>
      <p class="text-base text-white/70 leading-relaxed max-w-md mx-auto mb-10">Our team can help you find the perfect equipment for your studio setup and artistic style.</p>
      <a href="{{ route('booking.create') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white text-black text-sm font-semibold rounded-lg transition-all duration-200 hover:bg-white/90 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-white/50 focus:ring-offset-2 focus:ring-offset-black">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
        Consult via WhatsApp
      </a>
    </div>
  </div>
</section>

<x-layout.footer />

@endsection
