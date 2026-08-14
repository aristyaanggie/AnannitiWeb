@php
    // $key and $meta are passed via @include
    // $assets is inherited from parent view scope
@endphp

@php
    $hasAsset = !empty($assets[$key]);
    $fullPath = $hasAsset ? storage_path('app/public/' . $assets[$key]) : null;
    $fileSize = ($hasAsset && $fullPath && file_exists($fullPath)) ? filesize($fullPath) : null;
    $fileSizeKB = $fileSize !== null ? round($fileSize / 1024, 1) : null;
    $fileSizeMB = $fileSize !== null ? round($fileSize / (1024 * 1024), 2) : null;
    $fileSizeDisplay = $fileSizeKB !== null ? ($fileSizeKB >= 1024 ? $fileSizeMB . ' MB' : $fileSizeKB . ' KB') : null;

    $resolution = null;
    if ($hasAsset && $fullPath && file_exists($fullPath) && in_array(pathinfo($assets[$key], PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
        $imageInfo = @getimagesize($fullPath);
        if ($imageInfo) {
            $resolution = $imageInfo[0] . 'x' . $imageInfo[1];
        }
    }
@endphp

<div class="bg-white border border-[#e5e5e5] rounded-2xl overflow-hidden">
    <div class="p-5 md:p-6">

        {{-- Label --}}
        <label class="block text-[14px] font-semibold text-[#1a1a1a] mb-3">{{ $meta['label'] }}</label>

        {{-- Upload Preview --}}
        <div class="mb-4" x-data="{ preview: '{{ $hasAsset ? asset('storage/' . $assets[$key]) : '' }}' }">
            <div class="border-2 border-dashed rounded-xl transition-all duration-200 cursor-pointer relative overflow-hidden
                {{ $hasAsset ? 'border-[#1a1a1a]/15' : 'border-[#e5e5e5] hover:border-[#cccccc]' }}
                {{ in_array($key, ['hero_image', 'about_image', 'gallery_hero', 'shop_hero']) ? '' : 'text-center p-4' }}">

                <input type="file"
                    name="{{ $key }}"
                    accept="{{ $meta['accept'] }}"
                    class="absolute inset-0 opacity-0 w-full h-full cursor-pointer z-10"
                    x-on:change="if($event.target.files[0]) preview = URL.createObjectURL($event.target.files[0])" />

                <template x-if="preview">
                    <img :src="preview" class="{{ $meta['previewClass'] }}" alt="{{ $meta['label'] }} preview" />
                </template>

                <template x-if="!preview">
                    @if(in_array($key, ['hero_image', 'gallery_hero', 'shop_hero']))
                        <div class="flex flex-col items-center justify-center h-[200px]">
                            <svg class="w-10 h-10 text-[#cccccc] mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5a1.5 1.5 0 001.5-1.5V5.25a1.5 1.5 0 00-1.5-1.5H3.75a1.5 1.5 0 00-1.5 1.5v14.25a1.5 1.5 0 001.5 1.5z"></path></svg>
                            <p class="text-[13px] text-[#666666] font-medium">Drop image here</p>
                            <p class="text-[11px] text-[#cccccc] mt-1">{{ $meta['accept'] }} &bull; Max {{ $meta['maxSize'] }}</p>
                        </div>
                    @elseif($key === 'about_image')
                        <div class="flex flex-col items-center justify-center h-[180px]">
                            <svg class="w-10 h-10 text-[#cccccc] mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5a1.5 1.5 0 001.5-1.5V5.25a1.5 1.5 0 00-1.5-1.5H3.75a1.5 1.5 0 00-1.5 1.5v14.25a1.5 1.5 0 001.5 1.5z"></path></svg>
                            <p class="text-[13px] text-[#666666] font-medium">Drop image here</p>
                            <p class="text-[11px] text-[#cccccc] mt-1">{{ $meta['accept'] }} &bull; Max {{ $meta['maxSize'] }}</p>
                        </div>
                    @else
                        <div>
                            <p class="text-[13px] text-[#666666] font-medium">Drop {{ strtolower($meta['label']) }} here</p>
                            <p class="text-[11px] text-[#cccccc] mt-1">{{ $meta['accept'] }} &bull; Max {{ $meta['maxSize'] }}</p>
                        </div>
                    @endif
                </template>
            </div>
        </div>

        @error($key)
            <p class="text-[12px] text-[#ef4444] mb-3">{{ $message }}</p>
        @enderror

        {{-- Current Asset Info --}}
        @if($hasAsset)
            <div class="mb-4 flex justify-end">
                <button type="button"
                    class="text-[12px] font-semibold text-[#ef4444] hover:text-[#dc2626] transition-colors"
                    title="Delete {{ $meta['label'] }}"
                    x-data
                    @click="$dispatch('open-delete-modal', { action: '{{ route('admin.brand-assets.destroy', $key) }}', title: 'Delete {{ $meta['label'] }}?', message: 'The {{ strtolower($meta['label']) }} will be removed and the website will use the default fallback.' })">
                    Delete
                </button>
            </div>
        @endif

        {{-- Used In --}}
        <div class="mb-3">
            <p class="text-[11px] font-semibold text-[#999999] uppercase tracking-wider mb-1.5">Used In</p>
            <div class="flex flex-wrap gap-1.5">
                @foreach($meta['usage'] as $item)
                    <span class="inline-block px-2 py-0.5 text-[11px] font-medium text-[#666666] bg-[#f5f5f0] rounded-md border border-[#e5e5e5]">{{ $item }}</span>
                @endforeach
            </div>
        </div>

        {{-- Recommended --}}
        <div>
            <p class="text-[11px] font-semibold text-[#999999] uppercase tracking-wider mb-1.5">Recommended</p>
            <p class="text-[12px] text-[#666666]">{{ $meta['recommended'] }}</p>
        </div>

    </div>
</div>
