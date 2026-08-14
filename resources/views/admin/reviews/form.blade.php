@extends('layouts.admin')

@section('content')
<div class="max-w-[900px] mx-auto" x-data="{
    photoPreview: '{{ optional($review)->photo ? asset('storage/' . $review->photo) : '' }}',
    rating: {{ old('rating', isset($review) && $review ? $review->rating : 3) }},
    handlePhoto(e) {
        const file = e.target.files[0];
        if (file) {
            this.photoPreview = URL.createObjectURL(file);
        }
    }
}">

    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ route('admin.reviews.index') }}" class="inline-flex items-center gap-1.5 text-[13px] text-[#999999] hover:text-[#1a1a1a] transition-colors duration-200 mb-4">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path></svg>
            Back to Reviews
        </a>
        <h2 class="text-xl font-bold text-[#1a1a1a]" style="font-family: var(--font-heading);">{{ $pageTitle }}</h2>
        <p class="text-[13px] text-[#999999] mt-1">Fill in the details below to {{ $review ? 'update' : 'create' }} a review.</p>
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

    <form method="POST" action="{{ $review ? route('admin.reviews.update', $review) : route('admin.reviews.store') }}" enctype="multipart/form-data">
        @csrf
        @if($review)
            @method('PUT')
        @endif

        <div class="space-y-8">

            {{-- Section 1: Basic Information --}}
            <div class="bg-white border border-[#e5e5e5] rounded-2xl p-6 md:p-8">
                <h3 class="text-[15px] font-bold text-[#1a1a1a] mb-6" style="font-family: var(--font-heading);">Basic Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="name" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Customer Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', optional($review)->name ?? '') }}" required autofocus
                            class="w-full px-4 py-3 bg-[#fafafa] border {{ $errors->has('name') ? 'border-[#ef4444]' : 'border-[#e5e5e5]' }} rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                            placeholder="e.g. John Smith" />
                        @error('name')
                            <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="country" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Country</label>
                        <input type="text" id="country" name="country" value="{{ old('country', optional($review)->country ?? '') }}"
                            class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                            placeholder="e.g. Australia" />
                    </div>
                    <div>
                        <label for="tattoo_style" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Tattoo Style</label>
                        <input type="text" id="tattoo_style" name="tattoo_style" value="{{ old('tattoo_style', optional($review)->tattoo_style ?? '') }}"
                            class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                            placeholder="e.g. Blackwork, Realism" />
                    </div>
                </div>
            </div>

            {{-- Section 2: Artist --}}
            <div class="bg-white border border-[#e5e5e5] rounded-2xl p-6 md:p-8">
                <h3 class="text-[15px] font-bold text-[#1a1a1a] mb-6" style="font-family: var(--font-heading);">Artist</h3>
                <div>
                    <input type="hidden" name="artist_id" value="{{ $artistId }}" />
                    <p class="text-[14px] text-[#666666]">{{ \App\Models\ArtistProfile::find($artistId)?->name ?? '—' }}</p>
                </div>
            </div>

            {{-- Section 3: Rating --}}
            <div class="bg-white border border-[#e5e5e5] rounded-2xl p-6 md:p-8">
                <h3 class="text-[15px] font-bold text-[#1a1a1a] mb-6" style="font-family: var(--font-heading);">Rating</h3>
                <div>
                    <label class="block text-[13px] font-medium text-[#1a1a1a] mb-3">Rating (1–5 Stars)</label>
                    <input type="hidden" name="rating" :value="rating" />
                    <div class="flex items-center gap-2">
                        @for($i = 1; $i <= 5; $i++)
                            <button type="button" @click="rating = {{ $i }}" aria-label="Set rating {{ $i }}" class="transition-transform duration-150 hover:scale-110">
                                <svg class="w-8 h-8 transition-colors duration-150" :class="rating >= {{ $i }} ? 'text-[#D4AF37]' : 'text-[#e5e5e5]'" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            </button>
                        @endfor
                        <span class="ml-2 text-[14px] text-[#666666]" x-text="rating + ' / 5'"></span>
                    </div>
                    @error('rating')
                        <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Section 4: Review --}}
            <div class="bg-white border border-[#e5e5e5] rounded-2xl p-6 md:p-8">
                <h3 class="text-[15px] font-bold text-[#1a1a1a] mb-6" style="font-family: var(--font-heading);">Review</h3>
                <div>
                    <label for="content" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Customer Review</label>
                    <textarea id="content" name="content" rows="6" required
                        class="w-full px-4 py-3 bg-[#fafafa] border {{ $errors->has('content') ? 'border-[#ef4444]' : 'border-[#e5e5e5]' }} rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200 resize-none"
                        placeholder="What did the customer say about their experience?">{{ old('content', optional($review)->content ?? '') }}</textarea>
                    @error('content')
                        <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Section 5: Photo --}}
            <div class="bg-white border border-[#e5e5e5] rounded-2xl p-6 md:p-8">
                <h3 class="text-[15px] font-bold text-[#1a1a1a] mb-6" style="font-family: var(--font-heading);">Photo</h3>
                <div class="relative">
                    <input type="file" name="photo" accept="image/jpeg,image/png,image/webp" class="absolute inset-0 opacity-0 w-full h-full cursor-pointer z-10" id="photo-input" x-on:change="handlePhoto($event)" />
                    <label for="photo-input" class="block border-2 border-dashed border-[#e5e5e5] rounded-xl p-8 text-center hover:border-[#cccccc] transition-colors duration-200 cursor-pointer" :class="photoPreview ? 'border-[#1a1a1a]/20' : ''">
                        <template x-if="photoPreview">
                            <div class="relative">
                                <img :src="photoPreview" class="w-full h-48 object-cover rounded-lg" alt="Photo preview" />
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
                    @error('photo')
                        <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Section 6: Publishing --}}
            <div class="bg-white border border-[#e5e5e5] rounded-2xl p-6 md:p-8">
                <h3 class="text-[15px] font-bold text-[#1a1a1a] mb-6" style="font-family: var(--font-heading);">Publishing</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Status</label>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <label class="flex items-center gap-3 px-5 py-3 border border-[#e5e5e5] rounded-xl cursor-pointer hover:border-[#1a1a1a] transition-colors duration-200 has-[:checked]:border-[#1a1a1a] has-[:checked]:bg-[#fafafa]">
                                <input type="radio" name="is_visible" value="1" {{ old('is_visible', optional($review)->is_visible ?? '1') == '1' ? 'checked' : '' }} class="w-4 h-4 text-[#1a1a1a] border-[#e5e5e5] focus:ring-[#1a1a1a]" />
                                <span class="text-[14px] text-[#1a1a1a] font-medium">Published</span>
                            </label>
                            <label class="flex items-center gap-3 px-5 py-3 border border-[#e5e5e5] rounded-xl cursor-pointer hover:border-[#1a1a1a] transition-colors duration-200 has-[:checked]:border-[#1a1a1a] has-[:checked]:bg-[#fafafa]">
                                <input type="radio" name="is_visible" value="0" {{ old('is_visible', optional($review)->is_visible ?? '1') == '0' ? 'checked' : '' }} class="w-4 h-4 text-[#1a1a1a] border-[#e5e5e5] focus:ring-[#1a1a1a]" />
                                <span class="text-[14px] text-[#1a1a1a] font-medium">Draft</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <label class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Featured</label>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <label class="flex items-center gap-3 px-5 py-3 border border-[#e5e5e5] rounded-xl cursor-pointer hover:border-[#1a1a1a] transition-colors duration-200 has-[:checked]:border-[#1a1a1a] has-[:checked]:bg-[#fafafa]">
                                <input type="radio" name="is_featured" value="1" {{ old('is_featured', optional($review)->is_featured ?? '0') == '1' ? 'checked' : '' }} class="w-4 h-4 text-[#1a1a1a] border-[#e5e5e5] focus:ring-[#1a1a1a]" />
                                <span class="text-[14px] text-[#1a1a1a] font-medium">Yes</span>
                            </label>
                            <label class="flex items-center gap-3 px-5 py-3 border border-[#e5e5e5] rounded-xl cursor-pointer hover:border-[#1a1a1a] transition-colors duration-200 has-[:checked]:border-[#1a1a1a] has-[:checked]:bg-[#fafafa]">
                                <input type="radio" name="is_featured" value="0" {{ old('is_featured', optional($review)->is_featured ?? '0') == '0' ? 'checked' : '' }} class="w-4 h-4 text-[#1a1a1a] border-[#e5e5e5] focus:ring-[#1a1a1a]" />
                                <span class="text-[14px] text-[#1a1a1a] font-medium">No</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bottom Actions --}}
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 pb-8">
                <a href="{{ route('admin.reviews.index') }}" class="text-[14px] text-[#666666] hover:text-[#1a1a1a] transition-colors duration-200">Cancel</a>
                <div class="flex items-center gap-3">
                    <button type="submit"
                        class="px-6 py-2.5 bg-[#1a1a1a] text-white text-[14px] font-semibold rounded-lg hover:bg-[#333333] transition-colors duration-200">
                        {{ $review ? 'Save Changes' : 'Create Review' }}
                    </button>
                </div>
            </div>

        </div>
    </form>

</div>
@endsection
