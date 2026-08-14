@extends('layouts.app')

@section('content')
<x-layout.navbar />

{{-- Breadcrumb --}}
<section class="bg-white border-b border-[#e5e5e5]">
  <div class="max-w-[1400px] mx-auto px-6 md:px-8 lg:px-12 py-4">
    <nav class="flex items-center gap-2 text-[13px]" aria-label="Breadcrumb">
      <a href="{{ route('home') }}" class="text-[#999999] hover:text-[#1a1a1a] transition-colors duration-200">Home</a>
      <span class="text-[#cccccc]">/</span>
      <a href="{{ route('gallery.index') }}" class="text-[#999999] hover:text-[#1a1a1a] transition-colors duration-200">Gallery</a>
      @if($portfolio->category)
        <span class="text-[#cccccc]">/</span>
        <span class="text-[#1a1a1a] font-medium">{{ $portfolio->category->name }}</span>
      @endif
    </nav>
  </div>
</section>

{{-- Split Layout Section --}}
<section class="bg-white">
  <div class="max-w-[1400px] mx-auto px-6 md:px-8 lg:px-12 py-10 md:py-16 lg:py-20">
    <div class="flex flex-col lg:flex-row gap-10 lg:gap-16 items-start">
      
      {{-- Left Column: Image (Sticky on Desktop) --}}
      <div class="w-full lg:w-1/2 lg:sticky lg:top-28">
        <div class="bg-[#f5f5f0] rounded-2xl overflow-hidden relative shadow-sm border border-[#e5e5e5]">
          @if($portfolio->image)
            <img src="{{ asset('storage/' . $portfolio->image) }}" alt="{{ $portfolio->title }}" class="w-full h-auto max-h-[75vh] object-contain object-center mx-auto" loading="eager" onerror="this.style.display='none'" />
          @else
            <img src="{{ asset('images/hero-placeholder2.jpeg') }}" alt="{{ $portfolio->title }}" class="w-full h-auto max-h-[75vh] object-contain object-center mx-auto" loading="eager" onerror="this.style.display='none'" />
          @endif
        </div>
      </div>

      {{-- Right Column: Details --}}
      <div class="w-full lg:w-1/2 flex flex-col pt-2 lg:pt-4">
        
        {{-- Header Info --}}
        <div>
          @if($portfolio->category)
            <p class="text-[11px] uppercase tracking-[0.3em] text-[#999999] mb-3">{{ $portfolio->category->name }}</p>
          @endif
          <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-[#1a1a1a] leading-[1.1] mb-4" style="font-family: var(--font-heading);">{{ $portfolio->title }}</h1>
          @if($portfolio->is_featured)
            <span class="inline-block px-3 py-1 text-[10px] font-bold uppercase tracking-widest bg-[#1a1a1a] text-white rounded-full">Featured</span>
          @endif
        </div>

        {{-- Description --}}
        @if($portfolio->description)
          <div class="mt-8">
            <p class="text-[15px] text-[#666666] leading-[1.8]">{{ $portfolio->description }}</p>
          </div>
        @endif

        {{-- Details Grid --}}
        <div class="grid grid-cols-2 gap-y-8 gap-x-6 py-8 border-y border-[#e5e5e5] mt-10">
          @if($portfolio->tattoo_style)
            <div>
              <p class="text-[11px] uppercase tracking-[0.2em] text-[#999999] mb-1.5">Style</p>
              <p class="text-[14px] font-semibold text-[#1a1a1a]">{{ $portfolio->tattoo_style }}</p>
            </div>
          @endif
          @if($portfolio->placement)
            <div>
              <p class="text-[11px] uppercase tracking-[0.2em] text-[#999999] mb-1.5">Placement</p>
              <p class="text-[14px] font-semibold text-[#1a1a1a]">{{ $portfolio->placement }}</p>
            </div>
          @endif
          @if($portfolio->session_hours)
            <div>
              <p class="text-[11px] uppercase tracking-[0.2em] text-[#999999] mb-1.5">Session</p>
              <p class="text-[14px] font-semibold text-[#1a1a1a]">{{ $portfolio->session_hours }}h</p>
            </div>
          @endif
          @if($portfolio->category)
            <div>
              <p class="text-[11px] uppercase tracking-[0.2em] text-[#999999] mb-1.5">Category</p>
              <p class="text-[14px] font-semibold text-[#1a1a1a]">{{ $portfolio->category->name }}</p>
            </div>
          @endif
        </div>

        {{-- Artist Card & CTAs --}}
        @if($portfolio->artist)
        <div class="mt-10">
          <div class="bg-[#fafafa] rounded-2xl p-6 md:p-7 border border-[#e5e5e5]">
            <p class="text-[11px] uppercase tracking-[0.2em] text-[#999999] mb-5">Artist</p>
            <div class="flex items-center gap-4 mb-5">
              @if($portfolio->artist->photo)
                <img src="{{ asset('storage/' . $portfolio->artist->photo) }}" alt="{{ $portfolio->artist->name }}" class="w-14 h-14 rounded-full object-cover ring-2 ring-white" loading="lazy" />
              @else
                <div class="w-14 h-14 rounded-full bg-[#e5e5e5] flex items-center justify-center ring-2 ring-white">
                  <span class="text-[18px] font-bold text-[#999999]">{{ strtoupper(substr($portfolio->artist->name, 0, 1)) }}</span>
                </div>
              @endif
              <div>
                <h3 class="text-[15px] font-bold text-[#1a1a1a]">{{ $portfolio->artist->name }}</h3>
                @if($portfolio->artist->specialization)
                  <p class="text-[12px] text-[#999999] mt-0.5">{{ $portfolio->artist->specialization }}</p>
                @endif
              </div>
            </div>
            @if($portfolio->artist->experience_years)
              <p class="text-[13px] text-[#666666] mb-4">{{ $portfolio->artist->experience_years }} years experience</p>
            @endif
            <a href="{{ route('gallery.artist', $portfolio->artist->slug) }}" class="inline-flex items-center gap-1.5 text-[13px] font-semibold text-[#1a1a1a] hover:gap-2.5 transition-all duration-200">
              View Portfolio
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
          </div>

          {{-- CTAs --}}
          <div class="mt-5 space-y-3">
            <a href="{{ route('booking.create') }}" class="block w-full text-center px-6 py-3.5 bg-[#1a1a1a] text-white text-[13px] font-semibold rounded-xl transition-all duration-200 hover:bg-[#333333] hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-[#1a1a1a] focus:ring-offset-2">
              Book Consultation
            </a>
            <a href="https://wa.me/{{ $whatsappNumber }}?text={{ rawurlencode('Hi, I\'m interested in a tattoo similar to: ' . $portfolio->title) }}" target="_blank" rel="noopener noreferrer" class="block w-full text-center px-5 py-3 border border-[#e5e5e5] bg-white text-[#1a1a1a] text-[13px] font-medium rounded-xl hover:bg-[#fafafa] hover:border-[#1a1a1a] transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-black/20 focus:ring-offset-2">
              Ask via WhatsApp
            </a>
          </div>
        </div>
        @endif
        
      </div>
    </div>
  </div>
</section>

{{-- Related Works --}}
@if($relatedWorks->count() > 0)
<section class="bg-[#fafafa] border-t border-[#e5e5e5]">
  <div class="max-w-[1400px] mx-auto px-6 md:px-8 lg:px-12 py-16 md:py-20 lg:py-24">
    <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-10 md:mb-12">
      <div>
        <p class="text-[11px] uppercase tracking-[0.25em] text-[#999999] mb-3">More from {{ $portfolio->category?->name ?? 'Gallery' }}</p>
        <h2 class="text-2xl md:text-3xl font-bold text-[#1a1a1a] leading-tight" style="font-family: var(--font-heading);">Related Works</h2>
      </div>
      <a href="{{ route('gallery.index') }}" class="mt-4 md:mt-0 inline-flex items-center gap-2 text-[13px] font-semibold text-[#1a1a1a] hover:gap-2.5 transition-all duration-200">
        View All
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
      </a>
    </div>

      @php
        $ratios = ['1/1','3/4','1/1','3/4','3/4','1/1','3/4','1/1'];
        $ratioCount = count($ratios);
        $cols = [[], [], [], []];
        foreach ($relatedWorks as $i => $related) {
          $cols[$i % 4][] = ['item' => $related, 'ratio' => $ratios[$i % $ratioCount]];
        }
      @endphp
      <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-2 sm:gap-1 md:gap-2 lg:gap-3">
        @foreach($cols as $col)
          <div class="flex flex-col gap-2 sm:gap-1 md:gap-2 lg:gap-3">
            @foreach($col as $cell)
              <a href="{{ route('gallery.show', $cell['item']->slug) }}" class="group relative block overflow-hidden bg-[#e5e5e5]" style="aspect-ratio: {{ $cell['ratio'] }};">
                @if($cell['item']->image)
                  <img src="{{ asset('storage/' . $cell['item']->image) }}" alt="{{ $cell['item']->title }}" class="w-full h-full object-cover object-center transition-transform duration-700 group-hover:scale-110" loading="lazy" onerror="this.style.display='none'" />
                @else
                  <img src="{{ asset('images/hero-placeholder2.jpeg') }}" alt="{{ $cell['item']->title }}" class="w-full h-full object-cover object-center transition-transform duration-700 group-hover:scale-110" loading="lazy" onerror="this.style.display='none'" />
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-5 md:p-6">
                  <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                    <h3 class="text-white text-[15px] md:text-lg font-bold leading-snug" style="font-family: var(--font-heading);">{{ $cell['item']->title }}</h3>
                    <p class="text-white/70 text-[10px] md:text-xs uppercase tracking-widest mt-1.5">{{ $cell['item']->tattoo_style ?? 'Custom' }}</p>
                  </div>
                </div>
              </a>
            @endforeach
          </div>
        @endforeach
      </div>
  </div>
</section>
@endif

<x-layout.footer />

@endsection
