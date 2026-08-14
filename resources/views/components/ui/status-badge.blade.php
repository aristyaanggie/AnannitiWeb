@props([
    'status' => 'draft',
])

@php
    $statusConfig = [
        'published' => ['label' => 'Published', 'class' => 'bg-[#1a1a1a] text-white'],
        'draft' => ['label' => 'Draft', 'class' => 'border border-[#e5e5e5] text-[#666666] bg-white'],
        'out_of_stock' => ['label' => 'Out of Stock', 'class' => 'bg-[#ef4444] text-white'],
        'low_stock' => ['label' => 'Low Stock', 'class' => 'bg-[#f59e0b] text-white'],
    ];

    $config = $statusConfig[$status] ?? $statusConfig['draft'];
@endphp

<span class="inline-block px-2.5 py-1 text-[11px] font-semibold rounded-full {{ $config['class'] }}">
    {{ $config['label'] }}
</span>
