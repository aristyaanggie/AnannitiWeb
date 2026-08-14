{{--
  Section Component
  
  Props:
  - spacing (string): Spacing size 'sm', 'md', 'lg' [default: 'md']
  - class (string): Additional CSS classes [default: '']
  
  Slots:
  - default: Section content
  
  Example:
  <x-layout.section>
    Section content with vertical padding
  </x-layout.section>
--}}

@props([
    'spacing' => 'md',
])

@php
    $spacingMap = [
        'sm' => 'py-8 md:py-12',
        'md' => 'py-12 md:py-16',
        'lg' => 'py-16 md:py-24',
    ];
    $spacingClass = $spacingMap[$spacing] ?? $spacingMap['md'];
@endphp

<section class="{{ $spacingClass }} {{ $attributes->get('class', '') }}" {{ $attributes->except('class') }}>
    {{ $slot }}
</section>

