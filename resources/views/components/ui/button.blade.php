{{--
  Button Component
  
  Props:
  - variant (string): 'primary', 'secondary' [default: 'primary']
  - size (string): 'sm', 'md', 'lg' [default: 'md']
  - disabled (boolean): Disable button [default: false]
  - type (string): Button type 'submit', 'button', 'reset' [default: 'button']
  - class (string): Additional CSS classes [default: '']
  
  Slots:
  - default: Button text content
  
  Example:
  <x-ui.button variant="primary" size="lg">
    Click Me
  </x-ui.button>
--}}

@props([
    'variant' => 'primary',
    'size' => 'md',
    'disabled' => false,
    'type' => 'button',
])

@php
    $variantClasses = match($variant) {
        'primary' => 'bg-primary text-surface hover:bg-primary-light active:bg-text-primary',
        'secondary' => 'bg-secondary text-surface hover:bg-secondary-light active:bg-text-primary border border-secondary',
        default => 'bg-primary text-surface hover:bg-primary-light active:bg-text-primary',
    };
    
    $sizeMap = [
        'sm' => 'px-3 py-2 text-sm',
        'md' => 'px-4 py-2 text-base',
        'lg' => 'px-6 py-3 text-lg',
    ];
    $sizeClass = $sizeMap[$size] ?? $sizeMap['md'];
@endphp

<button
    type="{{ $type }}"
    @disabled($disabled)
    class="
        inline-flex items-center justify-center
        rounded-md font-semibold
        transition-all duration-normal ease-out
        focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary
        disabled:opacity-50 disabled:cursor-not-allowed
        {{ $sizeClass }}
        {{ $variantClasses }}
        {{ $attributes->get('class', '') }}
    "
    {{ $attributes->except('class') }}
>
    {{ $slot }}
</button>

