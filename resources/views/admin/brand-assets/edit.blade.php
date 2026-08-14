@extends('layouts.admin')

@php
    $assetMeta = [
        'logo' => [
            'label' => 'Logo',
            'accept' => 'image/jpeg,image/png,image/webp,image/svg+xml',
            'maxSize' => '5MB',
            'usage' => ['Navbar', 'Footer', 'Login', 'Branding Website'],
            'recommended' => 'SVG / PNG, Transparent, Minimal 300x300',
            'previewClass' => 'w-[160px] h-[80px] object-contain mx-auto',
        ],
        'favicon' => [
            'label' => 'Favicon',
            'accept' => 'image/jpeg,image/png,image/webp,image/svg+xml,.ico',
            'maxSize' => '2MB',
            'usage' => ['Browser Tab', 'Bookmark', 'Shortcut'],
            'recommended' => '512x512 PNG',
            'previewClass' => 'w-12 h-12 object-contain mx-auto',
        ],
        'hero_image' => [
            'label' => 'Hero Image',
            'accept' => 'image/jpeg,image/png,image/webp',
            'maxSize' => '5MB',
            'usage' => ['Homepage Hero Background'],
            'recommended' => '1920x1080, 16:9',
            'previewClass' => 'w-full h-[240px] object-cover',
        ],
        'about_image' => [
            'label' => 'About Image',
            'accept' => 'image/jpeg,image/png,image/webp',
            'maxSize' => '5MB',
            'usage' => ['Homepage About'],
            'recommended' => '1920x1080, 16:9',
            'previewClass' => 'w-full h-[220px] object-cover',
        ],
        'gallery_hero' => [
            'label' => 'Gallery Header Image',
            'accept' => 'image/jpeg,image/png,image/webp',
            'maxSize' => '5MB',
            'usage' => ['Gallery Page Header'],
            'recommended' => '1920x1080, 16:9',
            'previewClass' => 'w-full h-[240px] object-cover',
        ],
        'shop_hero' => [
            'label' => 'Shop Header Image',
            'accept' => 'image/jpeg,image/png,image/webp',
            'maxSize' => '5MB',
            'usage' => ['Shop Page Header'],
            'recommended' => '1920x1080, 16:9',
            'previewClass' => 'w-full h-[240px] object-cover',
        ],
    ];

    // Layout seksi Website Content
    $sections = [
        'hero' => ['title' => 'Hero', 'image' => 'hero_image', 'fields' => ['hero_eyebrow', 'hero_badge', 'hero_title', 'hero_subtitle', 'hero_primary_button', 'hero_secondary_button']],
        'about' => ['title' => 'About', 'image' => 'about_image', 'fields' => ['about_badge', 'about_title', 'about_description']],
        'services' => ['title' => 'Services', 'image' => null, 'fields' => ['services_badge', 'services_title']],
        'supply' => ['title' => 'Tattoo Supply', 'image' => null, 'fields' => ['supply_badge', 'supply_title']],
        'portfolio' => ['title' => 'Portfolio', 'image' => null, 'fields' => ['portfolio_badge', 'portfolio_title']],
        'artist' => ['title' => 'Artist', 'image' => null, 'fields' => ['artist_badge', 'artist_title']],
        'consultation' => ['title' => 'Consultation', 'image' => null, 'fields' => ['consultation_title', 'consultation_description', 'consultation_button']],
        'footer' => ['title' => 'Footer', 'image' => null, 'fields' => ['footer_brand', 'footer_copyright']],
    ];

    $fieldValue = fn (string $key) => $texts[$key] ?? '';
@endphp

@section('content')
<div class="max-w-[900px] mx-auto">

    {{-- Header --}}
    <div class="mb-6">
        <h2 class="text-xl font-bold text-[#1a1a1a]" style="font-family: var(--font-heading);">{{ $pageTitle }}</h2>
        <p class="text-[13px] text-[#999999] mt-1">Edit foto dan teks setiap bagian website. Kosongkan field untuk kembali ke teks default.</p>
    </div>

    {{-- Quick Anchor Navigation --}}
    <div class="sticky top-[68px] z-20 -mx-1 px-1 py-3 bg-[#fafafa]/95 backdrop-blur-sm">
        <div class="flex flex-wrap gap-1.5">
            @php
                $anchors = ['branding' => 'Logo & Favicon'] + collect($sections)->mapWithKeys(fn ($s, $k) => [$k => $s['title']])->all() + ['headers' => 'Gallery & Shop'];
            @endphp
            @foreach($anchors as $anchorId => $anchorLabel)
                <a href="#wc-{{ $anchorId }}"
                    class="px-3 py-1.5 text-[12px] font-medium rounded-full border border-[#e5e5e5] text-[#666666] bg-white hover:border-[#1a1a1a] hover:text-[#1a1a1a] transition-colors duration-150">
                    {{ $anchorLabel }}
                </a>
            @endforeach
        </div>
    </div>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="mb-6 px-4 py-3 bg-[#f0fdf4] border border-[#bbf7d0] rounded-xl text-[14px] text-[#166534]">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-6 px-4 py-3 bg-[#fef2f2] border border-[#fecaca] rounded-xl text-[14px] text-[#991b1b]">
            {{ session('error') }}
        </div>
    @endif

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="mb-6 px-4 py-3 bg-[#fef2f2] border border-[#fecaca] rounded-xl text-[14px] text-[#991b1b]">
            <p class="font-medium mb-1">Please fix the following errors:</p>
            <ul class="list-disc list-inside text-[13px]">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.brand-assets.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="space-y-12">

            {{-- ═══════════════ LOGO & FAVICON ═══════════════ --}}
            <div id="wc-branding" class="scroll-mt-[150px]">
                <h3 class="text-[15px] font-bold text-[#1a1a1a] mb-1" style="font-family: var(--font-heading);">Logo & Favicon</h3>
                <p class="text-[13px] text-[#999999] mb-6">Brand identity yang dipakai di seluruh website.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach(['logo', 'favicon'] as $key)
                        @php $meta = $assetMeta[$key]; @endphp
                        @include('admin.brand-assets._asset-card', ['key' => $key, 'meta' => $meta])
                    @endforeach
                </div>
            </div>

            {{-- ═══════════════ SEKSI WEBSITE CONTENT ═══════════════ --}}
            @foreach($sections as $slug => $section)
                <div id="wc-{{ $slug }}" class="scroll-mt-[150px]">
                    <h3 class="text-[15px] font-bold text-[#1a1a1a] mb-1" style="font-family: var(--font-heading);">{{ $section['title'] }}</h3>
                    <p class="text-[13px] text-[#999999] mb-6">Teks yang tampil di bagian {{ strtolower($section['title']) }} website.</p>

                    <div class="space-y-6">
                        @if($section['image'])
                            @php $meta = $assetMeta[$section['image']]; @endphp
                            @include('admin.brand-assets._asset-card', ['key' => $section['image'], 'meta' => $meta])
                        @endif

                        <div class="bg-white border border-[#e5e5e5] rounded-2xl p-6 md:p-8">
                            <div class="grid grid-cols-1 gap-5">
                                @foreach($section['fields'] as $key)
                                    @php $meta = $textFields[$key]; @endphp
                                    @if($meta['type'] === 'textarea')
                                        <x-ui.textarea name="{{ $key }}" label="{{ $meta['label'] }}" :value="$fieldValue($key)" rows="4" />
                                    @else
                                        <x-ui.input name="{{ $key }}" label="{{ $meta['label'] }}" :value="$fieldValue($key)" />
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- ═══════════════ HEADER GALLERY & SHOP ═══════════════ --}}
            <div id="wc-headers" class="scroll-mt-[150px]">
                <h3 class="text-[15px] font-bold text-[#1a1a1a] mb-1" style="font-family: var(--font-heading);">Halaman Gallery & Shop</h3>
                <p class="text-[13px] text-[#999999] mb-6">Gambar header untuk halaman Gallery dan Shop.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach(['gallery_hero', 'shop_hero'] as $key)
                        @php $meta = $assetMeta[$key]; @endphp
                        @include('admin.brand-assets._asset-card', ['key' => $key, 'meta' => $meta])
                    @endforeach
                </div>
            </div>

            {{-- Bottom Actions --}}
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 pb-8 border-t border-[#e5e5e5]">
                <a href="{{ route('admin.settings.index') }}" class="text-[14px] text-[#666666] hover:text-[#1a1a1a] transition-colors duration-200">Go to Studio Settings</a>
                <button type="submit"
                    class="px-6 py-2.5 bg-[#1a1a1a] text-white text-[14px] font-semibold rounded-lg hover:bg-[#333333] transition-colors duration-200">
                    Save Changes
                </button>
            </div>

        </div>
    </form>

</div>

{{-- Delete Confirmation Modal --}}
<x-ui.delete-modal id="delete-brand-asset-modal" title="Delete Asset?" message="This asset will be permanently removed." actionLabel="Delete" />

@endsection
