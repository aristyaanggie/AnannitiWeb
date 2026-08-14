{{--
  Link Component
  
  Props:
  - href (string): Link URL [required]
  - external (boolean): Open in new tab [default: false]
  - class (string): Additional CSS classes [default: '']
  
  Slots:
  - default: Link text content
  
  Example:
  <x-ui.link href="/portfolio">
    View Portfolio
  </x-ui.link>
--}}

@props([
    'href' => '#',
    'external' => false,
])

<a
    href="{{ $href }}"
    @if($external)
        target="_blank"
        rel="noopener noreferrer"
    @endif
    class="
        inline-flex items-center
        text-primary font-medium
        transition-colors duration-normal ease-out
        hover:text-secondary
        focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary
        {{ $attributes->get('class', '') }}
    "
    {{ $attributes->except('class') }}
>
    {{ $slot }}
</a>
