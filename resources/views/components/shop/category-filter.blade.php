@props([
    'categories' => [],
    'active' => null,
])

<section class="bg-white border-t border-[#e5e5e5]" x-data="{ activeCategory: '{{ $active }}' }">
  <div class="max-w-[1400px] mx-auto px-6 md:px-8 lg:px-12 py-8">
    <div class="flex items-center gap-3 overflow-x-auto pb-2 snap-x snap-mandatory scrollbar-hide" role="tablist" aria-label="Product categories">
      @foreach($categories as $category)
        <button
          @click="activeCategory = '{{ $category['slug'] }}'"
          :class="activeCategory === '{{ $category['slug'] }}'
            ? 'bg-black text-white border-black'
            : 'bg-white text-black border-black hover:bg-black hover:text-white'"
          class="flex-shrink-0 snap-start px-5 py-2.5 border text-[13px] font-semibold rounded-full transition-all duration-200 cursor-pointer focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-black focus-visible:ring-offset-2"
          role="tab"
          :aria-pressed="activeCategory === '{{ $category['slug'] }}'"
        >
          {{ $category['name'] }}
        </button>
      @endforeach
    </div>
  </div>
</section>
