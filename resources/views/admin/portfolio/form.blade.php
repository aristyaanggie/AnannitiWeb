@extends('layouts.admin')

@section('content')
<div class="max-w-[900px] mx-auto" x-data="{
    imagePreview: '{{ $portfolio && $portfolio->image ? asset('storage/' . $portfolio->image) : '' }}',
    handleImage(e) {
        const file = e.target.files[0];
        if (file) {
            this.imagePreview = URL.createObjectURL(file);
        }
    }
}">

    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ route('admin.portfolio.index') }}" class="inline-flex items-center gap-1.5 text-[13px] text-[#999999] hover:text-[#1a1a1a] transition-colors duration-200 mb-4">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path></svg>
            Back to Portfolio
        </a>
        <h2 class="text-xl font-bold text-[#1a1a1a]" style="font-family: var(--font-heading);">{{ $pageTitle }}</h2>
        <p class="text-[13px] text-[#999999] mt-1">Fill in the details below to {{ $portfolio ? 'update' : 'create' }} a portfolio item.</p>
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

    <form method="POST" action="{{ $portfolio ? route('admin.portfolio.update', $portfolio) : route('admin.portfolio.store') }}" enctype="multipart/form-data">
        @csrf
        @if($portfolio)
            @method('PUT')
        @endif

        <div class="space-y-8">

            {{-- Section 1: Basic Information --}}
            <div class="bg-white border border-[#e5e5e5] rounded-2xl p-6 md:p-8">
                <h3 class="text-[15px] font-bold text-[#1a1a1a] mb-6" style="font-family: var(--font-heading);">Basic Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="title" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Title</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $portfolio->title ?? '') }}" required autofocus
                            class="w-full px-4 py-3 bg-[#fafafa] border {{ $errors->has('title') ? 'border-[#ef4444]' : 'border-[#e5e5e5]' }} rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                            placeholder="e.g. Japanese Dragon Sleeve" />
                        @error('title')
                            <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="slug" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Slug</label>
                        <input type="hidden" id="slug" name="slug" value="{{ old('slug', $portfolio->slug ?? '') }}" />
                        <p class="text-[14px] text-[#999999] italic">Auto-generated from title.</p>
                    </div>
                    <div>
                        <label class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Artist</label>
                        <input type="hidden" name="artist_id" value="{{ $artistId }}" />
                        <p class="text-[14px] text-[#666666]">{{ \App\Models\ArtistProfile::find($artistId)?->name ?? '—' }}</p>
                    </div>
                    <div>
                        <label for="category_id" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Category</label>
                        <select id="category_id" name="category_id" required
                            class="w-full px-4 py-3 bg-[#fafafa] border {{ $errors->has('category_id') ? 'border-[#ef4444]' : 'border-[#e5e5e5]' }} rounded-xl text-[14px] text-[#1a1a1a] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200 appearance-none cursor-pointer">
                            <option value="">Select category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $portfolio->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="tattoo_style" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Tattoo Style</label>
                        <input type="text" id="tattoo_style" name="tattoo_style" value="{{ old('tattoo_style', $portfolio->tattoo_style ?? '') }}"
                            class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                            placeholder="e.g. Blackwork, Realism" />
                    </div>
                    <div>
                        <label for="placement" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Placement</label>
                        <input type="text" id="placement" name="placement" value="{{ old('placement', $portfolio->placement ?? '') }}"
                            class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                            placeholder="e.g. Arm, Back, Chest" />
                    </div>
                    <div>
                        <label for="session_hours" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Session Hours</label>
                        <input type="number" id="session_hours" name="session_hours" value="{{ old('session_hours', $portfolio->session_hours ?? '') }}"
                            class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                            placeholder="e.g. 6" min="1" />
                    </div>
                    <div class="md:col-span-2">
                        <label for="description" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Description</label>
                        <textarea id="description" name="description" rows="4"
                            class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200 resize-none"
                            placeholder="Describe the artwork, inspiration, and process...">{{ old('description', $portfolio->description ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Section 2: Image --}}
            <div class="bg-white border border-[#e5e5e5] rounded-2xl p-6 md:p-8">
                <h3 class="text-[15px] font-bold text-[#1a1a1a] mb-6" style="font-family: var(--font-heading);">Image</h3>
                <div class="relative">
                    <input type="file" name="image" accept="image/jpeg,image/png,image/webp" class="absolute inset-0 opacity-0 w-full h-full cursor-pointer z-10" id="image-input" x-on:change="handleImage($event)" {{ $portfolio ? '' : 'required' }} />
                    <label for="image-input" class="block border-2 border-dashed border-[#e5e5e5] rounded-xl p-8 text-center hover:border-[#cccccc] transition-colors duration-200 cursor-pointer" :class="imagePreview ? 'border-[#1a1a1a]/20' : ''">
                        <template x-if="imagePreview">
                            <div class="relative">
                                <img :src="imagePreview" class="w-full h-48 object-cover rounded-lg" alt="Image preview" />
                                <button type="button" @click="imagePreview = ''; document.getElementById('image-input').value = ''" aria-label="Clear image" class="absolute top-2 right-2 w-6 h-6 bg-[#1a1a1a] text-white rounded-full flex items-center justify-center text-[12px] hover:bg-[#333333]">&times;</button>
                            </div>
                        </template>
                        <template x-if="!imagePreview">
                            <div>
                                <svg class="w-8 h-8 mx-auto text-[#cccccc] mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5a1.5 1.5 0 001.5-1.5V5.25a1.5 1.5 0 00-1.5-1.5H3.75a1.5 1.5 0 00-1.5 1.5v14.25a1.5 1.5 0 001.5 1.5z"></path></svg>
                                <p class="text-[13px] text-[#666666] font-medium">Drop image here</p>
                                <p class="text-[12px] text-[#999999] mt-1">or click to upload</p>
                                <p class="text-[11px] text-[#cccccc] mt-2">JPG, PNG, WebP &bull; Max 5MB</p>
                            </div>
                        </template>
                    </label>
                    @error('image')
                        <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Section 3: Display --}}
            <div class="bg-white border border-[#e5e5e5] rounded-2xl p-6 md:p-8">
                <h3 class="text-[15px] font-bold text-[#1a1a1a] mb-6" style="font-family: var(--font-heading);">Display</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Featured</label>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <label class="flex items-center gap-3 px-5 py-3 border border-[#e5e5e5] rounded-xl cursor-pointer hover:border-[#1a1a1a] transition-colors duration-200 has-[:checked]:border-[#1a1a1a] has-[:checked]:bg-[#fafafa]">
                                <input type="radio" name="is_featured" value="1" {{ old('is_featured', $portfolio->is_featured ?? '0') == '1' ? 'checked' : '' }} class="w-4 h-4 text-[#1a1a1a] border-[#e5e5e5] focus:ring-[#1a1a1a]" />
                                <span class="text-[14px] text-[#1a1a1a] font-medium">Yes</span>
                            </label>
                            <label class="flex items-center gap-3 px-5 py-3 border border-[#e5e5e5] rounded-xl cursor-pointer hover:border-[#1a1a1a] transition-colors duration-200 has-[:checked]:border-[#1a1a1a] has-[:checked]:bg-[#fafafa]">
                                <input type="radio" name="is_featured" value="0" {{ old('is_featured', $portfolio->is_featured ?? '0') == '0' ? 'checked' : '' }} class="w-4 h-4 text-[#1a1a1a] border-[#e5e5e5] focus:ring-[#1a1a1a]" />
                                <span class="text-[14px] text-[#1a1a1a] font-medium">No</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <label class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Published</label>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <label class="flex items-center gap-3 px-5 py-3 border border-[#e5e5e5] rounded-xl cursor-pointer hover:border-[#1a1a1a] transition-colors duration-200 has-[:checked]:border-[#1a1a1a] has-[:checked]:bg-[#fafafa]">
                                <input type="radio" name="is_visible" value="1" {{ old('is_visible', $portfolio->is_visible ?? '1') == '1' ? 'checked' : '' }} class="w-4 h-4 text-[#1a1a1a] border-[#e5e5e5] focus:ring-[#1a1a1a]" />
                                <span class="text-[14px] text-[#1a1a1a] font-medium">Published</span>
                            </label>
                            <label class="flex items-center gap-3 px-5 py-3 border border-[#e5e5e5] rounded-xl cursor-pointer hover:border-[#1a1a1a] transition-colors duration-200 has-[:checked]:border-[#1a1a1a] has-[:checked]:bg-[#fafafa]">
                                <input type="radio" name="is_visible" value="0" {{ old('is_visible', $portfolio->is_visible ?? '1') == '0' ? 'checked' : '' }} class="w-4 h-4 text-[#1a1a1a] border-[#e5e5e5] focus:ring-[#1a1a1a]" />
                                <span class="text-[14px] text-[#1a1a1a] font-medium">Draft</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <label for="display_order" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Display Order</label>
                        <input type="number" id="display_order" name="display_order" value="{{ old('display_order', $portfolio->display_order ?? '0') }}"
                            class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                            placeholder="0" min="0" />
                        <p class="text-[11px] text-[#999999] mt-1.5">Lower numbers appear first.</p>
                    </div>
                </div>
            </div>

            {{-- Bottom Actions --}}
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 pb-8">
                <a href="{{ route('admin.portfolio.index') }}" class="text-[14px] text-[#666666] hover:text-[#1a1a1a] transition-colors duration-200">Cancel</a>
                <div class="flex items-center gap-3">
                    <button type="submit"
                        class="px-6 py-2.5 bg-[#1a1a1a] text-white text-[14px] font-semibold rounded-lg hover:bg-[#333333] transition-colors duration-200">
                        {{ $portfolio ? 'Save Changes' : 'Create Portfolio Item' }}
                    </button>
                </div>
            </div>

        </div>
    </form>

</div>
@endsection
