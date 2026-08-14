{{--
  Container Component
  
  Props:
  - class (string): Additional CSS classes [default: '']
  
  Slots:
  - default: Container content
  
  Example:
  <x-layout.container>
    Content with max-width and responsive padding
  </x-layout.container>
--}}

<div class="max-w-6xl mx-auto px-4 sm:px-6 md:px-8 lg:px-12 {{ $attributes->get('class', '') }}" {{ $attributes->except('class') }}>
    {{ $slot }}
</div>
