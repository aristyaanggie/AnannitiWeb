@extends('layouts.admin')

@section('content')
<div class="max-w-[900px] mx-auto">

    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ route('admin.settings.index') }}" class="inline-flex items-center gap-1.5 text-[13px] text-[#999999] hover:text-[#1a1a1a] transition-colors duration-200 mb-4">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path></svg>
            Back to Settings
        </a>
        <h2 class="text-xl font-bold text-[#1a1a1a]" style="font-family: var(--font-heading);">{{ $pageTitle }}</h2>
        <p class="text-[13px] text-[#999999] mt-1">Update your {{ strtolower($group) }} settings.</p>
    </div>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="mb-6 px-4 py-3 bg-[#f0fdf4] border border-[#bbf7d0] rounded-xl text-[14px] text-[#166534]">
            {{ session('success') }}
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

    <form method="POST" action="{{ route('admin.settings.update', $group) }}">
        @csrf
        @method('PUT')

        <div class="space-y-8">

            @if($group === 'business')
                {{-- Business Settings --}}
                <div class="bg-white border border-[#e5e5e5] rounded-2xl p-6 md:p-8">
                    <h3 class="text-[15px] font-bold text-[#1a1a1a] mb-1" style="font-family: var(--font-heading);">Studio Information</h3>
                    <p class="text-[13px] text-[#999999] mb-6">Identitas dasar studio.</p>
                    <div class="space-y-5">
                        <div>
                            <label for="studio_name" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Studio Name</label>
                            <input type="text" id="studio_name" name="studio_name" value="{{ old('studio_name', $settings['studio_name'] ?? '') }}"
                                class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                                placeholder="e.g. Ananniti Tattoo Bali" />
                            @error('studio_name')
                                <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="tagline" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Tagline</label>
                            <input type="text" id="tagline" name="tagline" value="{{ old('tagline', $settings['tagline'] ?? '') }}"
                                class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                                placeholder="e.g. Premium Custom Tattoo Design in Bali" />
                            @error('tagline')
                                <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="description" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Description</label>
                            <textarea id="description" name="description" rows="3"
                                class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200 resize-none"
                                placeholder="Short description of your studio">{{ old('description', $settings['description'] ?? '') }}</textarea>
                            @error('description')
                                <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-[#e5e5e5] rounded-2xl p-6 md:p-8">
                    <h3 class="text-[15px] font-bold text-[#1a1a1a] mb-1" style="font-family: var(--font-heading);">Contact</h3>
                    <p class="text-[13px] text-[#999999] mb-6">Nomor dan email yang bisa dihubungi.</p>
                    <div class="space-y-5">
                        <div>
                            <label for="phone" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Phone</label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone', $settings['phone'] ?? '') }}"
                                class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                                placeholder="e.g. +62 812 3456 7890" />
                            @error('phone')
                                <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="whatsapp" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">WhatsApp Number</label>
                            <input type="text" id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $settings['whatsapp'] ?? '') }}"
                                class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                                placeholder="e.g. 6281234567890" />
                            @error('whatsapp')
                                <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="email" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $settings['email'] ?? '') }}"
                                class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                                placeholder="e.g. hello@anannititattoo.com" />
                            @error('email')
                                <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-[#e5e5e5] rounded-2xl p-6 md:p-8">
                    <h3 class="text-[15px] font-bold text-[#1a1a1a] mb-1" style="font-family: var(--font-heading);">Address & Map</h3>
                    <p class="text-[13px] text-[#999999] mb-6">Lokasi studio dan link peta.</p>
                    <div class="space-y-5">
                        <div>
                            <label for="address" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Address</label>
                            <input type="text" id="address" name="address" value="{{ old('address', $settings['address'] ?? '') }}"
                                class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                                placeholder="e.g. Jl. Raya Seminyak No. 12, Bali" />
                            @error('address')
                                <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="google_maps_url" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Google Maps URL</label>
                            <input type="url" id="google_maps_url" name="google_maps_url" value="{{ old('google_maps_url', $settings['google_maps_url'] ?? '') }}"
                                class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                                placeholder="https://maps.google.com/?q=..." />
                            @error('google_maps_url')
                                <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-[#e5e5e5] rounded-2xl p-6 md:p-8">
                    <h3 class="text-[15px] font-bold text-[#1a1a1a] mb-1" style="font-family: var(--font-heading);">Business Hours</h3>
                    <p class="text-[13px] text-[#999999] mb-6">Jam operasional yang tampil di footer.</p>
                    <div>
                        <label for="business_hours" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Hours</label>
                        <input type="text" id="business_hours" name="business_hours" value="{{ old('business_hours', $settings['business_hours'] ?? '') }}"
                            class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                            placeholder="e.g. Open Daily · 10:00 — 22:00 WITA" />
                        @error('business_hours')
                            <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            @endif

            @if($group === 'social')
                {{-- Social Settings --}}
                <div class="bg-white border border-[#e5e5e5] rounded-2xl p-6 md:p-8">
                    <h3 class="text-[15px] font-bold text-[#1a1a1a] mb-6" style="font-family: var(--font-heading);">Social Media</h3>
                    <div class="space-y-5">
                        <div>
                            <label for="instagram" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Instagram URL</label>
                            <input type="url" id="instagram" name="instagram" value="{{ old('instagram', $settings['instagram'] ?? '') }}"
                                class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                                placeholder="https://instagram.com/..." />
                            @error('instagram')
                                <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="tiktok" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">TikTok URL</label>
                            <input type="url" id="tiktok" name="tiktok" value="{{ old('tiktok', $settings['tiktok'] ?? '') }}"
                                class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                                placeholder="https://tiktok.com/..." />
                            @error('tiktok')
                                <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="facebook" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Facebook URL</label>
                            <input type="url" id="facebook" name="facebook" value="{{ old('facebook', $settings['facebook'] ?? '') }}"
                                class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                                placeholder="https://facebook.com/..." />
                            @error('facebook')
                                <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            @endif

            @if($group === 'seo')
                {{-- SEO Settings --}}
                <div class="bg-white border border-[#e5e5e5] rounded-2xl p-6 md:p-8">
                    <h3 class="text-[15px] font-bold text-[#1a1a1a] mb-6" style="font-family: var(--font-heading);">SEO</h3>
                    <div class="space-y-5">
                        <div>
                            <label for="meta_title" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Meta Title</label>
                            <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $settings['meta_title'] ?? '') }}"
                                class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                                placeholder="e.g. Ananniti Tattoo Bali - Premium Tattoo Studio" />
                            @error('meta_title')
                                <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="meta_description" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Meta Description</label>
                            <textarea id="meta_description" name="meta_description" rows="3"
                                class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200 resize-none"
                                placeholder="Brief description for search engines">{{ old('meta_description', $settings['meta_description'] ?? '') }}</textarea>
                            @error('meta_description')
                                <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            @endif

            {{-- Bottom Actions --}}
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 pb-8">
                <a href="{{ route('admin.settings.index') }}" class="text-[14px] text-[#666666] hover:text-[#1a1a1a] transition-colors duration-200">Cancel</a>
                <div class="flex items-center gap-3">
                    <button type="submit"
                        class="px-6 py-2.5 bg-[#1a1a1a] text-white text-[14px] font-semibold rounded-lg hover:bg-[#333333] transition-colors duration-200">
                        Save Changes
                    </button>
                </div>
            </div>

        </div>
    </form>

</div>
@endsection
