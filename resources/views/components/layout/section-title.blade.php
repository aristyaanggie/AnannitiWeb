{{--
  Section Title Component
  
  Props:
  - title (string): Section title [required]
  - subtitle (string): Optional subtitle [default: '']
  - align (string): Text alignment 'left', 'center' [default: 'center']
  - size (string): Title size 'sm', 'md', 'lg' [default: 'md']
  
  Slots:
  - default: Additional content after subtitle (optional)
  
  Example:
  <x-layout.section-title 
    title="Our Portfolio" 
    subtitle="Explore our latest tattoo designs"
  />
--}}

@props([
    'title' => '',
    'subtitle' => '',
    'align' => 'center',
    'size' => 'md',
])

@php
    $alignClass = match($align) {
        'left' => 'text-left',
        'center' => 'text-center',
        default => 'text-center',
    };
    
    $sizeMap = [
        'sm' => 'h3',
        'md' => 'h2',
        'lg' => 'h1',
    ];
    $titleTag = $sizeMap[$size] ?? 'h2';
@endphp

<div class="{{ $alignClass }} mb-12 md:mb-16">
    <{{ $titleTag }} class="text-text-primary font-bold">
        {{ $title }}
    </{{ $titleTag }}>
    
    @if($subtitle)
        <p class="mt-3 md:mt-4 text-lg text-text-secondary">
            {{ $subtitle }}
        </p>
    @endif
    
    @if($slot->isNotEmpty())
        <div class="mt-6">
            {{ $slot }}
        </div>
    @endif
</div>
