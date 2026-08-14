@extends('layouts.admin')

@section('content')
<div class="max-w-[900px] mx-auto" x-data="{
    photoPreview: '{{ $artist->photo ? asset('storage/' . $artist->photo) : '' }}',
    handlePhoto(e) {
        const file = e.target.files[0];
        if (file && file.type.startsWith('image/')) {
            this.photoPreview = URL.createObjectURL(file);
        }
    }
}">

    {{-- Header --}}
    <div class="mb-8">
        <h2 class="text-xl font-bold text-[#1a1a1a]" style="font-family: var(--font-heading);">{{ $pageTitle }}</h2>
        <p class="text-[13px] text-[#999999] mt-1">Edit the artist profile displayed on the public website.</p>
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

    <form method="POST" action="{{ route('admin.artist-profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="space-y-8">

            {{-- Section 1: Photo --}}
            <div class="bg-white border border-[#e5e5e5] rounded-2xl p-6 md:p-8">
                <h3 class="text-[15px] font-bold text-[#1a1a1a] mb-6" style="font-family: var(--font-heading);">Photo</h3>
                <div class="relative">
                    <input type="file" name="photo" accept="image/jpeg,image/png,image/webp" class="absolute inset-0 opacity-0 w-full h-full cursor-pointer z-10" id="photo-input" x-on:change="handlePhoto($event)" />
                    <label for="photo-input" class="block border-2 border-dashed rounded-xl p-8 text-center transition-all duration-200 cursor-pointer"
                        :class="photoPreview ? 'border-[#1a1a1a]/20' : 'border-[#e5e5e5] hover:border-[#cccccc] hover:bg-[#fafafa]'">
                        <template x-if="photoPreview">
                            <div class="relative">
                                <img :src="photoPreview" class="w-full h-64 object-cover rounded-lg" alt="Photo preview" />
                                <button type="button" @click="photoPreview = ''; document.getElementById('photo-input').value = ''" aria-label="Clear image" class="absolute top-2 right-2 w-6 h-6 bg-[#1a1a1a] text-white rounded-full flex items-center justify-center text-[12px] hover:bg-[#333333]">&times;</button>
                            </div>
                        </template>
                        <template x-if="!photoPreview">
                            <div>
                                <svg class="w-8 h-8 mx-auto text-[#cccccc] mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5a1.5 1.5 0 001.5-1.5V5.25a1.5 1.5 0 00-1.5-1.5H3.75a1.5 1.5 0 00-1.5 1.5v14.25a1.5 1.5 0 001.5 1.5z"></path></svg>
                                <p class="text-[13px] text-[#666666] font-medium">Drop photo here</p>
                                <p class="text-[12px] text-[#999999] mt-1">or click to upload</p>
                                <p class="text-[11px] text-[#cccccc] mt-2">JPG, PNG, WebP &bull; Max 5MB</p>
                            </div>
                        </template>
                    </label>
                </div>
                @error('photo')
                    <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            {{-- Section 2: Basic Information --}}
            <div class="bg-white border border-[#e5e5e5] rounded-2xl p-6 md:p-8">
                <h3 class="text-[15px] font-bold text-[#1a1a1a] mb-6" style="font-family: var(--font-heading);">Basic Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="name" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $artist->name) }}" required
                            class="w-full px-4 py-3 bg-[#fafafa] border {{ $errors->has('name') ? 'border-[#ef4444]' : 'border-[#e5e5e5]' }} rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                            placeholder="e.g. Gus Tut" />
                        @error('name')
                            <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="slug" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Slug</label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug', $artist->slug) }}" required
                            class="w-full px-4 py-3 bg-[#fafafa] border {{ $errors->has('slug') ? 'border-[#ef4444]' : 'border-[#e5e5e5]' }} rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                            placeholder="gus-tut" />
                        @error('slug')
                            <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="location" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Location</label>
                        <input type="text" id="location" name="location" value="{{ old('location', $artist->location ?? '') }}"
                            class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                            placeholder="e.g. Bali, Indonesia" />
                        @error('location')
                            <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="specialization" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Specialization</label>
                        <input type="text" id="specialization" name="specialization" value="{{ old('specialization', $artist->specialization ?? '') }}"
                            class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                            placeholder="e.g. Blackwork, Realism" />
                        @error('specialization')
                            <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="experience_years" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Experience (years)</label>
                        <input type="number" id="experience_years" name="experience_years" value="{{ old('experience_years', $artist->experience_years ?? '') }}"
                            class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                            placeholder="e.g. 10" min="0" max="100" />
                        @error('experience_years')
                            <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label for="biography" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Biography</label>
                        <textarea id="biography" name="biography" rows="4"
                            class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200 resize-none"
                            placeholder="Tell us about this artist...">{{ old('biography', $artist->biography ?? '') }}</textarea>
                        @error('biography')
                            <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Section 3: Social Media --}}
            <div class="bg-white border border-[#e5e5e5] rounded-2xl p-6 md:p-8">
                <h3 class="text-[15px] font-bold text-[#1a1a1a] mb-6" style="font-family: var(--font-heading);">Social Media & Contact</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="whatsapp" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">WhatsApp Number</label>
                        <input type="text" id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $artist->whatsapp ?? '') }}"
                            class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                            placeholder="e.g. 6281234567890" />
                        @error('whatsapp')
                            <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="instagram" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Instagram</label>
                        <input type="text" id="instagram" name="instagram" value="{{ old('instagram', $artist->instagram ?? '') }}"
                            class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                            placeholder="e.g. @gus_tut" />
                        @error('instagram')
                            <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="tiktok" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">TikTok</label>
                        <input type="text" id="tiktok" name="tiktok" value="{{ old('tiktok', $artist->tiktok ?? '') }}"
                            class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                            placeholder="e.g. @gus_tut" />
                        @error('tiktok')
                            <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="facebook" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Facebook</label>
                        <input type="text" id="facebook" name="facebook" value="{{ old('facebook', $artist->facebook ?? '') }}"
                            class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                            placeholder="e.g. https://facebook.com/gus.tut" />
                        @error('facebook')
                            <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Section 4: Visibility --}}
            <div class="bg-white border border-[#e5e5e5] rounded-2xl p-6 md:p-8">
                <h3 class="text-[15px] font-bold text-[#1a1a1a] mb-6" style="font-family: var(--font-heading);">Visibility</h3>
                <div>
                    <label class="block text-[13px] font-medium text-[#1a1a1a] mb-3">Show on Website</label>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <label class="flex items-center gap-3 px-5 py-3 border border-[#e5e5e5] rounded-xl cursor-pointer hover:border-[#1a1a1a] transition-colors duration-200 has-[:checked]:border-[#1a1a1a] has-[:checked]:bg-[#fafafa]">
                            <input type="radio" name="is_visible" value="1" {{ old('is_visible', $artist->is_visible ?? '1') == '1' ? 'checked' : '' }} class="w-4 h-4 text-[#1a1a1a] border-[#e5e5e5] focus:ring-[#1a1a1a]" />
                            <span class="text-[14px] text-[#1a1a1a] font-medium">Visible</span>
                        </label>
                        <label class="flex items-center gap-3 px-5 py-3 border border-[#e5e5e5] rounded-xl cursor-pointer hover:border-[#1a1a1a] transition-colors duration-200 has-[:checked]:border-[#1a1a1a] has-[:checked]:bg-[#fafafa]">
                            <input type="radio" name="is_visible" value="0" {{ old('is_visible', $artist->is_visible ?? '1') == '0' ? 'checked' : '' }} class="w-4 h-4 text-[#1a1a1a] border-[#e5e5e5] focus:ring-[#1a1a1a]" />
                            <span class="text-[14px] text-[#1a1a1a] font-medium">Hidden</span>
                        </label>
                    </div>
                </div>
            </div>

            {{-- Bottom Actions --}}
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 pb-8">
                <a href="{{ route('admin.dashboard') }}" class="text-[14px] text-[#666666] hover:text-[#1a1a1a] transition-colors duration-200">Cancel</a>
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
