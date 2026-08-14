@extends('layouts.app')

@section('content')
<x-layout.navbar />

{{-- ═══════════════ EDITORIAL HERO ═══════════════ --}}
<section class="bg-white">
  <div class="max-w-[1400px] mx-auto px-6 md:px-8 lg:px-12 pt-24 md:pt-28 pb-10 md:pb-14">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-8 md:gap-10 items-center">

      {{-- LEFT: Content --}}
      <div class="md:col-span-5 order-2 md:order-1">
        <a href="{{ route('shop') }}" class="inline-flex items-center gap-1.5 text-[12px] text-text-muted hover:text-text-primary transition-colors duration-200 mb-6">
          <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path></svg>
          Shop
        </a>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-text-primary mb-5 leading-[1.05]" style="font-family: var(--font-heading);">{!! nl2br(e($category->name)) !!}</h1>
        @if($category->description)
          <p class="text-[15px] md:text-base text-text-secondary leading-relaxed mb-6 max-w-md">{{ $category->description }}</p>
        @endif
        <p class="text-[13px] text-text-muted">{{ $products->count() }} {{ Str::plural('Product', $products->count()) }}</p>
      </div>

      {{-- RIGHT: Image --}}
      <div class="md:col-span-7 order-1 md:order-2">
        <div class="aspect-[4/5] md:aspect-[3/4] overflow-hidden rounded-2xl">
          @if($category->image)
            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-full h-full object-cover" loading="eager" />
          @else
            <img src="{{ asset('images/hero-placeholder2.jpeg') }}" alt="{{ $category->name }}" class="w-full h-full object-cover" />
          @endif
        </div>
      </div>

    </div>
  </div>
</section>

{{-- ═══════════════ PRODUCTS ═══════════════ --}}
<section class="bg-white">
  <div class="max-w-[1400px] mx-auto px-6 md:px-8 lg:px-12 py-12 md:py-16 lg:py-20">

    @if($products->isEmpty())
      {{-- Empty State --}}
      <div class="text-center py-20">
        <svg class="w-16 h-16 mx-auto text-[#e5e5e5] mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"></path></svg>
        <p class="text-[18px] font-semibold text-text-primary mb-2">Products Coming Soon</p>
        <p class="text-[14px] text-text-muted mb-8">We're preparing our {{ $category->name }} collection. Check back soon!</p>
        <a href="{{ route('shop') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-[#1a1a1a] text-white text-sm font-semibold rounded-lg hover:bg-[#333333] transition-colors duration-200">
          Browse All Products
        </a>
      </div>
    @else
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-10">
        @foreach($products as $product)
          <x.shop.product-card
              :image="$product->thumbnail ? 'storage/' . $product->thumbnail : 'images/hero-placeholder2.jpeg'"
              :title="$product->name"
              :category="$product->category->name ?? $category->name"
              :price="$product->sales_format === 'individual' ? ($product->individual_price ?? $product->price) : ($product->standard_price ?? $product->price)"
              :badge="$product->badge?->name"
              :href="route('shop.product', $product->slug)"
          />
        @endforeach
      </div>
    @endif

  </div>
</section>

{{-- ═══════════════ CHAPTER TRANSITION: WHITE → DARK ═══════════════ --}}
<div class="relative h-20 md:h-28 bg-white overflow-hidden">
  <div class="absolute inset-0 bg-gradient-to-b from-white via-white/80 to-[#0a0a0a]/80"></div>
</div>

{{-- ═══════════════ CTA SECTION ═══════════════ --}}
<section class="bg-[#0a0a0a]">
  <div class="max-w-[1400px] mx-auto px-6 md:px-8 lg:px-12 py-24 md:py-32 lg:py-40">
    <div class="max-w-2xl mx-auto text-center">
      <p class="text-[11px] uppercase tracking-[0.3em] text-white/70 mb-6">Need Help Choosing?</p>
      <h2 class="text-3xl md:text-4xl lg:text-[2.75rem] font-bold text-white leading-[1.1] mb-5" style="font-family: var(--font-heading);">Not Sure What<br> You Need?</h2>
      <p class="text-base text-white/70 leading-relaxed max-w-md mx-auto mb-10">Our team can help you find the perfect equipment for your studio setup and artistic style.</p>
      <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white text-black text-sm font-semibold rounded-lg transition-all duration-200 hover:bg-white/90 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-white/50 focus:ring-offset-2 focus:ring-offset-black">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
        Consult via WhatsApp
      </a>
    </div>
  </div>
</section>

{{-- ═══════════════ FOOTER ═══════════════ --}}
<x-layout.footer />

@endsection
