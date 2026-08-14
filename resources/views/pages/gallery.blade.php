@php
  $galleryHero = setting('gallery_hero');
@endphp

@extends('layouts.app')

@section('content')
<x-layout.navbar />

<section class="bg-[#0a0a0a]" x-data="{ activeFilter: 'all', searchQuery: '' }">

  {{-- ═══════════════ HERO ═══════════════ --}}
  <div class="relative overflow-hidden bg-[#0a0a0a] min-h-[60svh] md:min-h-[70svh]">
    <div class="absolute inset-0 w-full h-full bg-no-repeat bg-[center_right_25%] md:bg-center bg-cover"
         style="background-image: url('{{ $galleryHero ? asset('storage/' . $galleryHero) : asset('storage/portfolio/studio-hero.jpg') }}');"
         loading="eager"></div>
    
    {{-- Overlays & Gradients --}}
    <div class="absolute inset-0 bg-black/60 md:bg-black/40"></div>
    <div class="absolute top-0 left-0 right-0 h-32 sm:h-40 bg-gradient-to-b from-[#0a0a0a]/90 to-transparent"></div>
    <div class="absolute bottom-0 left-0 right-0 h-32 sm:h-64 bg-gradient-to-t from-[#0a0a0a] to-transparent pointer-events-none"></div>

    {{-- Content --}}
    <div class="relative z-10 pt-24 sm:pt-32 pb-16 sm:pb-20 min-h-[60svh] md:min-h-[70svh] flex flex-col justify-center">
      <div class="max-w-[1400px] mx-auto w-full px-6 md:px-8 lg:px-12">
        <div class="max-w-2xl">
          <p class="text-[11px] uppercase tracking-[0.3em] text-white/70 mb-4 sm:mb-5 animate-fadeInUp">Portfolio</p>
          <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-white mb-5 sm:mb-6 leading-[1.05] animate-fadeInUp delay-100" style="font-family: var(--font-heading);">Our Artwork<br>Gallery</h1>
          <p class="text-base sm:text-lg leading-relaxed text-white/80 max-w-lg animate-fadeInUp delay-200">Every tattoo tells a story. Browse our collection of custom designs crafted with precision and passion.</p>
        </div>
      </div>
    </div>
  </div>

  {{-- ═══════════════ FILTER + SEARCH ═══════════════ --}}
  <div class="sticky top-16 md:top-20 z-20 bg-[#fafafa] border-b border-[#e5e5e5]">
    <div class="max-w-[1400px] mx-auto px-6 md:px-8 lg:px-12 py-4">
      <div class="flex flex-col md:flex-row md:items-center gap-4">
        <div class="flex gap-2 overflow-x-auto pb-1 scrollbar-hide flex-shrink-0">
          <button @click="activeFilter = 'all'" :class="activeFilter === 'all' ? 'bg-[#1a1a1a] text-white shadow-md' : 'bg-white text-[#666666] hover:bg-[#f0f0f0] border border-[#e5e5e5]'" class="px-4 py-2 text-[12px] font-medium rounded-full whitespace-nowrap transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#1a1a1a] focus:ring-offset-2">All</button>
          @foreach($styles as $style)
            <button @click="activeFilter = '{{ Str::lower($style) }}'" :class="activeFilter === '{{ Str::lower($style) }}' ? 'bg-[#1a1a1a] text-white shadow-md' : 'bg-white text-[#666666] hover:bg-[#f0f0f0] border border-[#e5e5e5]'" class="px-4 py-2 text-[12px] font-medium rounded-full whitespace-nowrap transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#1a1a1a] focus:ring-offset-2">{{ $style }}</button>
          @endforeach
        </div>
        <div class="relative flex-1 md:max-w-xs">
          <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-[#999999]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
          <input type="text" x-model="searchQuery" placeholder="Search artwork..."
            class="w-full pl-10 pr-4 py-2 bg-white border border-[#e5e5e5] rounded-full text-[13px] text-[#1a1a1a] placeholder:text-[#999999] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200" style="padding-left: 2.5rem;" />
        </div>
      </div>
    </div>
  </div>

  {{-- ═══════════════ GALLERY GRID ═══════════════ --}}
  <div class="max-w-[1400px] mx-auto px-6 md:px-8 lg:px-12 py-12 md:py-16 lg:py-20">

    @if($portfolioItems->isEmpty())
      <div class="text-center py-24">
        <svg class="w-16 h-16 mx-auto text-white/10 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5a1.5 1.5 0 001.5-1.5V5.25a1.5 1.5 0 00-1.5-1.5H3.75a1.5 1.5 0 00-1.5 1.5v14.25a1.5 1.5 0 001.5 1.5z"></path></svg>
        <p class="text-[18px] font-semibold text-white mb-2">No Artwork Yet</p>
        <p class="text-[14px] text-white/70">Our portfolio is being curated. Check back soon.</p>
      </div>
    @else
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-6">
        @foreach($portfolioItems as $item)
          @php
            $style = strtolower($item->tattoo_style ?? '');
            $artistName = strtolower($item->artist?->name ?? '');
            $title = strtolower($item->title);
          @endphp
          <div x-show="(activeFilter === 'all' || '{{ $style }}'.includes(activeFilter)) && (searchQuery === '' || '{{ $title }}'.includes(searchQuery.toLowerCase()) || '{{ $style }}'.includes(searchQuery.toLowerCase()) || '{{ $artistName }}'.includes(searchQuery.toLowerCase()))"
               x-transition:enter="transition ease-out duration-200"
               x-transition:enter-start="opacity-0 scale-95"
               x-transition:enter-end="opacity-100 scale-100"
               x-transition:leave="transition ease-in duration-150"
               x-transition:leave-start="opacity-100 scale-100"
               x-transition:leave-end="opacity-0 scale-95">
            <a href="{{ route('gallery.show', $item->slug) }}" class="group block">
              <div class="relative aspect-[4/5] overflow-hidden rounded-2xl bg-[#1a1a1a] shadow-lg shadow-black/20">
                @if($item->image)
                  <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" loading="lazy" onerror="this.style.display='none'" />
                @else
                  <img src="{{ asset('images/hero-placeholder2.jpeg') }}" alt="{{ $item->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" loading="lazy" onerror="this.style.display='none'" />
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="absolute inset-0 flex flex-col justify-end p-5 md:p-6 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                  <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                    @if($item->is_featured)
                      <span class="inline-block px-2.5 py-0.5 text-[9px] font-bold uppercase tracking-widest bg-white text-black rounded-full mb-2">Featured</span>
                    @endif
                    <p class="text-[10px] uppercase tracking-[0.2em] text-white/70 mb-1.5">{{ $item->tattoo_style ?? 'Custom' }}</p>
                    <h3 class="text-[15px] md:text-lg font-bold text-white leading-snug" style="font-family: var(--font-heading);">{{ $item->title }}</h3>
                    @if($item->artist)
                      <p class="text-[12px] text-white/70 mt-1.5">by {{ $item->artist->name }}</p>
                    @endif
                  </div>
                </div>
              </div>
            </a>
          </div>
        @endforeach
      </div>
    @endif

  </div>

  {{-- CTA --}}
  <div class="bg-[#0a0a0a]">
    <div class="max-w-[1400px] mx-auto px-6 md:px-8 lg:px-12 py-20 md:py-28 lg:py-36">
      <div class="max-w-2xl mx-auto text-center">
        <p class="text-[11px] uppercase tracking-[0.3em] text-white/70 mb-6">Inspired?</p>
        <h2 class="text-3xl md:text-4xl lg:text-[2.75rem] font-bold text-white leading-[1.1] mb-5" style="font-family: var(--font-heading);">Ready to Start<br>Your Tattoo Journey?</h2>
        <p class="text-base text-white/70 leading-relaxed max-w-md mx-auto mb-10">Let us help you design something meaningful. Every tattoo begins with a conversation.</p>
        <a href="{{ route('booking.create') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white text-black text-sm font-semibold rounded-lg transition-all duration-200 hover:bg-white/90 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-white/50 focus:ring-offset-2 focus:ring-offset-black">
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
          Book Consultation
        </a>
      </div>
    </div>
  </div>

</section>

<x-layout.footer />

@endsection
