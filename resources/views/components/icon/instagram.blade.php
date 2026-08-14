{{--
  Instagram Icon Component
  
  Props:
  - size (string): Icon size 'sm', 'md', 'lg' [default: 'md']
  - class (string): Additional CSS classes [default: '']
  
  Example:
  <x-icon.instagram size="md" />
--}}

@props([
    'size' => 'md',
])

@php
    $sizeMap = [
        'sm' => 'w-4 h-4',
        'md' => 'w-5 h-5',
        'lg' => 'w-6 h-6',
    ];
    $sizeClass = $sizeMap[$size] ?? $sizeMap['md'];
@endphp

<svg 
    class="{{ $sizeClass }} {{ $attributes->get('class', '') }}"
    viewBox="0 0 24 24"
    fill="none"
    stroke="currentColor"
    stroke-width="2"
    stroke-linecap="round"
    stroke-linejoin="round"
    xmlns="http://www.w3.org/2000/svg"
    {{ $attributes->except('class') }}
>
    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
</svg>