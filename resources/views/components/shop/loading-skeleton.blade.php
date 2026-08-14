@props([
    'count' => 6,
])

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
    @for($i = 0; $i < $count; $i++)
        <div class="animate-pulse">
            <div class="aspect-[4/5] rounded-2xl bg-[#e5e5e5] mb-4"></div>
            <div class="h-3 w-20 bg-[#e5e5e5] rounded mb-2"></div>
            <div class="h-4 w-32 bg-[#e5e5e5] rounded mb-2"></div>
            <div class="h-4 w-16 bg-[#e5e5e5] rounded"></div>
        </div>
    @endfor
</div>
