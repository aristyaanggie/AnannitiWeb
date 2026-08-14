@props([
    'active' => 'products',
    'productsHref' => null,
    'suppliesHref' => null,
])

<div class="flex border-b border-[#e5e5e5] mb-6">
    <a href="{{ $productsHref ?: route('admin.products.index') }}"
        class="inline-flex items-center gap-2 px-4 py-2.5 text-[13px] font-semibold border-b-2 -mb-px transition-colors duration-150 {{ $active === 'products' ? 'border-[#1a1a1a] text-[#1a1a1a]' : 'border-transparent text-[#999999] hover:text-[#1a1a1a]' }}">
        Shop Products
    </a>
    <a href="{{ $suppliesHref ?: route('admin.products.index', ['tab' => 'supplies']) }}"
        class="inline-flex items-center gap-2 px-4 py-2.5 text-[13px] font-semibold border-b-2 -mb-px transition-colors duration-150 {{ $active === 'supplies' ? 'border-[#1a1a1a] text-[#1a1a1a]' : 'border-transparent text-[#999999] hover:text-[#1a1a1a]' }}">
        Tattoo Supply
    </a>
</div>
