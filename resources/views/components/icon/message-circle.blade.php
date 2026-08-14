{{--
  Message Circle Icon Component
  
  Props:
  - size (string): Icon size 'sm', 'md', 'lg' [default: 'md']
  - class (string): Additional CSS classes [default: '']
  
  Example:
  <x-icon.message-circle size="md" />
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
    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
</svg>
