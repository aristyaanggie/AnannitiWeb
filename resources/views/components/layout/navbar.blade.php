@props(['overlay' => false])
@php
  $navWhatsappNumber = setting('whatsapp', '6281234567890');
  $navWhatsappNumber = preg_replace('/[^0-9]/', '', $navWhatsappNumber);
  if (str_starts_with($navWhatsappNumber, '08')) {
      $navWhatsappNumber = '62' . substr($navWhatsappNumber, 1);
  }
  if (!str_starts_with($navWhatsappNumber, '62')) {
      $navWhatsappNumber = '62' . $navWhatsappNumber;
  }
  $navLogo = setting('logo');
@endphp

<nav 
  x-data="{ menuOpen: false, scrolled: false }"
  @scroll.window="scrolled = window.scrollY > 40"
  :style="`background-color: ${({{ $overlay ? 'true' : 'false' }} && !scrolled && window.innerWidth < 1024) ? 'transparent' : '#000000'}; border-bottom: 1px solid ${({{ $overlay ? 'true' : 'false' }} && !scrolled && window.innerWidth < 1024) ? 'transparent' : 'rgba(245, 245, 240, 0.08)'};`"
  class="fixed top-0 left-0 right-0 z-50 transition-all duration-200"
>
  <div class="max-w-[1400px] mx-auto px-6 md:px-8 lg:px-12 h-16 md:h-20 flex items-center">

    {{-- Logo & Brand (Left) --}}
    <a href="{{ route('home') }}" class="flex items-center gap-3 flex-shrink-0">
      @if($navLogo)
        <div class="w-[40px] h-[40px] md:w-[44px] md:h-[44px] flex-shrink-0 flex items-center justify-center">
          <img src="{{ asset('storage/' . $navLogo) }}" alt="Logo" class="w-full h-full object-contain" />
        </div>
      @else
        <div class="w-9 h-9 md:w-10 md:h-10 rounded flex items-center justify-center flex-shrink-0" style="background-color: rgba(245, 245, 240, 0.1);">
          <span class="text-[11px] md:text-xs font-bold tracking-wider" style="color: var(--color-navbar-text);">AT</span>
        </div>
      @endif
      <span class="block font-bold text-base md:text-lg tracking-tight" style="color: var(--color-navbar-text); font-family: var(--font-heading);">
        Ananniti Tattoo
      </span>
    </a>

    {{-- Desktop Navigation (Center) --}}
    <div class="hidden lg:flex items-center justify-center flex-1 mx-8">
      <div class="flex items-center gap-8">
        <a href="{{ route('home') }}" class="nav-link text-[13px]">Home</a>
        <a href="{{ route('home') }}#services" class="nav-link text-[13px]">Services</a>
        <a href="{{ route('shop') }}" class="nav-link text-[13px]">Shop</a>
        <a href="{{ route('gallery.index') }}" class="nav-link text-[13px]">Gallery</a>
        <a href="{{ route('home') }}#artists" class="nav-link text-[13px]">Artist</a>
      </div>
    </div>

    {{-- Desktop CTA (Right) --}}
    <div class="hidden lg:flex items-center flex-shrink-0">
      <a 
        href="https://wa.me/{{ $navWhatsappNumber }}" 
        target="_blank" 
        rel="noopener noreferrer"
        class="inline-flex items-center gap-2 px-5 py-2.5 text-[13px] font-semibold rounded transition-all duration-200 hover:scale-[1.02] active:scale-[0.98]"
        style="background-color: var(--color-navbar-text); color: var(--color-navbar-bg);"
      >
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
        </svg>
        Consult via WhatsApp
      </a>
    </div>

    {{-- Mobile Menu Button --}}
    <button 
      @click="menuOpen = !menuOpen"
      class="lg:hidden ml-auto w-11 h-11 flex items-center justify-center transition-colors duration-200"
      :style="`color: var(--color-navbar-text)`"
      aria-label="Toggle menu"
      :aria-expanded="menuOpen"
      aria-controls="mobile-drawer"
    >
      <template x-if="!menuOpen">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </template>
      <template x-if="menuOpen">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </template>
    </button>
  </div>

  {{-- Mobile Overlay --}}
  <div x-show="menuOpen" @click="menuOpen = false" x-transition.opacity.duration.200ms x-cloak class="lg:hidden fixed inset-0 z-50 bg-black/60"></div>

  {{-- Mobile Drawer (slide from right) --}}
  <div id="mobile-drawer"
    x-show="menuOpen"
    x-cloak
    x-transition:enter="transition ease-out duration-250"
    x-transition:enter-start="opacity-0 translate-x-full"
    x-transition:enter-end="opacity-100 translate-x-0"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 translate-x-0"
    x-transition:leave-end="opacity-0 translate-x-full"
    class="lg:hidden fixed top-0 right-0 bottom-0 z-50 w-[85%] max-w-sm flex flex-col"
    style="background-color: var(--color-navbar-bg); border-left: 1px solid rgba(245, 245, 240, 0.08);"
    role="dialog"
    aria-modal="true"
    aria-label="Mobile navigation"
  >
    {{-- Drawer Header --}}
    <div class="flex items-center justify-between px-6 h-16 flex-shrink-0 border-b border-white/10">
      <span class="text-xl font-bold" style="font-family: var(--font-heading); color: var(--color-navbar-text);">Menu</span>
      <button @click="menuOpen = false" class="w-11 h-11 flex items-center justify-center transition-colors duration-200" :style="`color: var(--color-navbar-text)`" aria-label="Close menu">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>

    {{-- Drawer Navigation --}}
    <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-1">
      <a href="{{ route('home') }}" class="flex items-center gap-4 px-3 min-h-[52px] text-[15px] font-medium text-white hover:bg-white/5 rounded-lg transition-colors duration-200" @click="menuOpen = false">
        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2.25 12l8.954-8.955a1.126 1.126 0 011.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21"/></svg>
        Home
      </a>
      <a href="{{ route('home') }}#services" class="flex items-center gap-4 px-3 min-h-[52px] text-[15px] font-medium text-white hover:bg-white/5 rounded-lg transition-colors duration-200" @click="menuOpen = false">
        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.015A3.001 3.001 0 0021 9.349M6.75 21h10.5"/></svg>
        Services
      </a>
      <a href="{{ route('shop') }}" class="flex items-center gap-4 px-3 min-h-[52px] text-[15px] font-medium text-white hover:bg-white/5 rounded-lg transition-colors duration-200" @click="menuOpen = false">
        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/></svg>
        Shop
      </a>
      <a href="{{ route('gallery.index') }}" class="flex items-center gap-4 px-3 min-h-[52px] text-[15px] font-medium text-white hover:bg-white/5 rounded-lg transition-colors duration-200" @click="menuOpen = false">
        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5a1.5 1.5 0 001.5-1.5V5.25a1.5 1.5 0 00-1.5-1.5H3.75a1.5 1.5 0 00-1.5 1.5v14.25a1.5 1.5 0 001.5 1.5z"/></svg>
        Gallery
      </a>
      <a href="{{ route('home') }}#artists" class="flex items-center gap-4 px-3 min-h-[52px] text-[15px] font-medium text-white hover:bg-white/5 rounded-lg transition-colors duration-200" @click="menuOpen = false">
        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
        Artist
      </a>
    </nav>

    {{-- Drawer CTA --}}
    <div class="px-6 py-6 flex-shrink-0 border-t border-white/10">
      <a 
        href="https://wa.me/{{ $navWhatsappNumber }}" 
        target="_blank" 
        rel="noopener noreferrer"
        class="flex items-center justify-center gap-2 w-full px-5 py-3.5 min-h-[48px] text-sm font-semibold rounded-lg transition-all duration-200"
        style="background-color: var(--color-navbar-text); color: var(--color-navbar-bg);"
        @click="menuOpen = false"
      >
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
        </svg>
        Consult via WhatsApp
      </a>
    </div>
  </div>
</nav>

<style scoped>
.nav-link {
  @apply font-medium transition-all duration-200 ease-out relative;
  color: var(--color-navbar-text);
  
  &::after {
    content: '';
    @apply absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-px transition-all duration-200 ease-out;
    background-color: rgba(245, 245, 240, 0.4);
  }
  
  &:hover {
    color: var(--color-navbar-text);
    &::after { @apply w-full; }
  }
}

.nav-link-mobile {
  @apply block py-3 text-sm font-medium transition-colors duration-200 ease-out;
  color: var(--color-navbar-text);
  
  &:hover { color: var(--color-navbar-text); }
}
</style>
