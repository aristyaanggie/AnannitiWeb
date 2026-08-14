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
      <span class="text-[#cccccc]">/</span>
      <span class="text-[#1a1a1a] font-medium">{{ $artist->name }}</span>
    </nav>
  </div>
</section>

{{-- Artist Hero --}}
<section class="bg-[#0a0a0a]">
  <div class="max-w-[1400px] mx-auto px-6 md:px-8 lg:px-12 py-16 md:py-24 lg:py-32">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-16 items-center">

      {{-- Photo --}}
      <div>
        @if($artist->photo)
          <div class="aspect-[3/4] overflow-hidden rounded-2xl shadow-2xl shadow-black/30">
            <img src="{{ asset('storage/' . $artist->photo) }}" alt="{{ $artist->name }}" class="w-full h-full object-cover" loading="eager" />
          </div>
        @else
          <div class="aspect-[3/4] overflow-hidden rounded-2xl bg-[#1a1a1a] flex items-center justify-center">
            <span class="text-[80px] font-bold text-white/20" style="font-family: var(--font-heading);">{{ strtoupper(substr($artist->name, 0, 1)) }}</span>
          </div>
        @endif
      </div>

      {{-- Info --}}
      <div class="flex flex-col justify-center">
        <div class="mb-6">
          <p class="text-[11px] uppercase tracking-[0.3em] text-white/70 mb-4">
            Resident Artist
          </p>
          <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-[1.05] mb-4" style="font-family: var(--font-heading);">{{ $artist->name }}</h1>
          
          @if($artist->specialization)
            <p class="text-[14px] md:text-[15px] font-medium tracking-[0.1em] text-[#D4AF37] mb-6">
              Specializes in: <span class="text-white">{{ $artist->specialization }}</span>
            </p>
          @endif
        </div>

        <div class="flex flex-wrap items-center gap-3 mb-8">
          @if($artist->experience_years)
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 text-white/90 text-[13px] font-medium backdrop-blur-sm">
              <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
              {{ $artist->experience_years }} Years Experience
            </div>
          @endif
          @if($artist->location)
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 text-white/90 text-[13px] font-medium backdrop-blur-sm">
              <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
              {{ $artist->location }}
            </div>
          @endif
        </div>

        @if($artist->biography)
          <div class="prose prose-invert prose-sm md:prose-base text-white/80 leading-relaxed mb-10 max-w-xl">
            <p class="text-[15px] md:text-[16px] leading-[1.8] font-light">{{ $artist->biography }}</p>
          </div>
        @endif

        {{-- Social Buttons --}}
        <div class="flex flex-wrap items-center gap-3 mb-10">
          @if($artist->whatsapp)
            @php
              $artistWa = preg_replace('/[^0-9]/', '', $artist->whatsapp);
              if (str_starts_with($artistWa, '08')) { $artistWa = '62' . substr($artistWa, 1); }
              if (!str_starts_with($artistWa, '62')) { $artistWa = '62' . $artistWa; }
            @endphp
            <a href="https://wa.me/{{ $artistWa }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 px-4 py-2 border border-white/25 text-white text-[13px] font-medium rounded-xl transition-colors duration-200 hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white/50 focus:ring-offset-2 focus:ring-offset-black">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 21l1.65-3.8a9 9 0 1 1 3.4 2.9L3 21z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M9 10a.5.5 0 0 0 1 0V9a.5.5 0 0 0-1 0v1a5 5 0 0 0 5 5h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 0 0 1"></path></svg>
              WhatsApp
            </a>
          @endif
          @if($artist->instagram)
            <a href="https://instagram.com/{{ ltrim($artist->instagram, '@') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 px-4 py-2 border border-white/25 text-white text-[13px] font-medium rounded-xl transition-colors duration-200 hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white/50 focus:ring-offset-2 focus:ring-offset-black">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
              Instagram
            </a>
          @endif
          @if($artist->tiktok)
            <a href="{{ str_starts_with($artist->tiktok, 'http') ? $artist->tiktok : 'https://tiktok.com/@' . ltrim($artist->tiktok, '@') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 px-4 py-2 border border-white/25 text-white text-[13px] font-medium rounded-xl transition-colors duration-200 hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white/50 focus:ring-offset-2 focus:ring-offset-black">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"></path></svg>
              TikTok
            </a>
          @endif
          @if($artist->facebook)
            <a href="{{ str_starts_with($artist->facebook, 'http') ? $artist->facebook : 'https://facebook.com/' . ltrim($artist->facebook, '@') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 px-4 py-2 border border-white/25 text-white text-[13px] font-medium rounded-xl transition-colors duration-200 hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white/50 focus:ring-offset-2 focus:ring-offset-black">
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0h-21.35C.597 0 0 .597 0 1.325v21.351C0 23.403.597 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.323-.597 1.323-1.324V1.325C24 .597 23.403 0 22.675 0z"/></svg>
              Facebook
            </a>
          @endif
        </div>

        {{-- CTA --}}
        <div class="flex flex-col sm:flex-row gap-3">
          <a href="{{ route('booking.create') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white text-black text-[13px] font-semibold rounded-xl transition-all duration-200 hover:bg-white/90 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-white/50 focus:ring-offset-2 focus:ring-offset-black">
            Book Tattoo with {{ $artist->name }}
          </a>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- Portfolio --}}
<section class="bg-white">
  <div class="max-w-[1400px] mx-auto px-6 md:px-8 lg:px-12 py-16 md:py-20 lg:py-24">
    <div class="mb-10 md:mb-12">
      <p class="text-[11px] uppercase tracking-[0.25em] text-[#999999] mb-3">Portfolio</p>
      <h2 class="text-2xl md:text-3xl font-bold text-[#1a1a1a] leading-tight" style="font-family: var(--font-heading);">Works by {{ $artist->name }}</h2>
    </div>

    @if($portfolioItems->isEmpty())
      <div class="text-center py-20">
        <svg class="w-16 h-16 mx-auto text-[#e5e5e5] mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5a1.5 1.5 0 001.5-1.5V5.25a1.5 1.5 0 00-1.5-1.5H3.75a1.5 1.5 0 00-1.5 1.5v14.25a1.5 1.5 0 001.5 1.5z"></path></svg>
        <p class="text-[18px] font-semibold text-[#1a1a1a] mb-2">No Portfolio Yet</p>
        <p class="text-[14px] text-[#999999]">This artist's portfolio is being curated.</p>
      </div>
    @else
      @php
        $ratios = ['1/1','3/4','1/1','3/4','3/4','1/1','3/4','1/1'];
        $ratioCount = count($ratios);
        $cols = [[], [], [], []];
        foreach ($portfolioItems as $i => $item) {
          $cols[$i % 4][] = ['item' => $item, 'ratio' => $ratios[$i % $ratioCount]];
        }
      @endphp
      <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-2 sm:gap-1 md:gap-2 lg:gap-3">
        @foreach($cols as $col)
          <div class="flex flex-col gap-2 sm:gap-1 md:gap-2 lg:gap-3">
            @foreach($col as $cell)
              <a href="{{ route('gallery.show', $cell['item']->slug) }}" class="group relative block overflow-hidden bg-[#f5f5f0]" style="aspect-ratio: {{ $cell['ratio'] }};">
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
    @endif

  </div>
</section>

<x-layout.footer />

@endsection
