@extends('layouts.admin')

@section('content')
<div class="max-w-[900px] mx-auto">

    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center gap-1.5 text-[13px] text-[#999999] hover:text-[#1a1a1a] transition-colors duration-200 mb-4">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path></svg>
            Back to Categories
        </a>
        <h2 class="text-xl font-bold text-[#1a1a1a]" style="font-family: var(--font-heading);">{{ $pageTitle }}</h2>
        <p class="text-[13px] text-[#999999] mt-1">Fill in the details below to {{ $category ? 'update' : 'create' }} a category.</p>
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

    <form method="POST" action="{{ $category ? route('admin.categories.update', $category) : route('admin.categories.store') }}" enctype="multipart/form-data">
        @csrf
        @if($category)
            @method('PUT')
        @endif

        <div class="space-y-8">

            {{-- Section 1: Basic Information --}}
            <div class="bg-white border border-[#e5e5e5] rounded-2xl p-6 md:p-8">
                <h3 class="text-[15px] font-bold text-[#1a1a1a] mb-6" style="font-family: var(--font-heading);">Basic Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="name" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Category Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $category->name ?? '') }}" required autofocus
                            class="w-full px-4 py-3 bg-[#fafafa] border {{ $errors->has('name') ? 'border-[#ef4444]' : 'border-[#e5e5e5]' }} rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                            placeholder="e.g. Tattoo Machine" />
                        @error('name')
                            <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="slug" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Slug</label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug', $category->slug ?? '') }}"
                            class="w-full px-4 py-3 bg-[#fafafa] border {{ $errors->has('slug') ? 'border-[#ef4444]' : 'border-[#e5e5e5]' }} rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                            placeholder="auto-generated" />
                        <p class="text-[11px] text-[#999999] mt-1.5">Leave blank to auto-generate from name.</p>
                        @error('slug')
                            <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="type" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Type</label>
                        <select id="type" name="type" required
                            class="w-full px-4 py-3 bg-[#fafafa] border {{ $errors->has('type') ? 'border-[#ef4444]' : 'border-[#e5e5e5]' }} rounded-xl text-[14px] text-[#1a1a1a] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200 appearance-none cursor-pointer">
                            <option value="">Select type</option>
                            <option value="product" {{ old('type', $category->type ?? '') == 'product' ? 'selected' : '' }}>Product</option>
                            <option value="gallery" {{ old('type', $category->type ?? '') == 'gallery' ? 'selected' : '' }}>Gallery</option>
                        </select>
                        @error('type')
                            <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label for="description" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Description</label>
                        <textarea id="description" name="description" rows="3"
                            class="w-full px-4 py-3 bg-[#fafafa] border {{ $errors->has('description') ? 'border-[#ef4444]' : 'border-[#e5e5e5]' }} rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200 resize-none"
                            placeholder="Optional description for this category">{{ old('description', $category->description ?? '') }}</textarea>
                        @error('description')
                            <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Section 2: Image --}}
            <div class="bg-white border border-[#e5e5e5] rounded-2xl p-6 md:p-8">
                <h3 class="text-[15px] font-bold text-[#1a1a1a] mb-6" style="font-family: var(--font-heading);">Image</h3>
                <div x-data="{
                    imagePreview: '{{ $category && $category->image ? asset('storage/' . $category->image) : '' }}',
                    handleImage(e) {
                        const file = e.target.files[0];
                        if (file && file.type.startsWith('image/')) {
                            this.imagePreview = URL.createObjectURL(file);
                        }
                    }
                }">
                    <div class="relative">
                        <input type="file" name="image" accept="image/jpeg,image/png,image/webp" class="absolute inset-0 opacity-0 w-full h-full cursor-pointer z-10" id="image-input" x-on:change="handleImage($event)" />
                        <label for="image-input" class="block border-2 border-dashed rounded-xl p-8 text-center transition-all duration-200 cursor-pointer"
                            :class="imagePreview ? 'border-[#1a1a1a]/20' : 'border-[#e5e5e5] hover:border-[#cccccc] hover:bg-[#fafafa]'">
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
                    </div>
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
                        <label for="display_order" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Display Order</label>
                        <input type="number" id="display_order" name="display_order" value="{{ old('display_order', $category->display_order ?? '0') }}"
                            class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                            placeholder="0" min="0" />
                        <p class="text-[11px] text-[#999999] mt-1.5">Lower numbers appear first.</p>
                    </div>
                    <div>
                        <label class="block text-[13px] font-medium text-[#1a1a1a] mb-3">Visibility</label>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <label class="flex items-center gap-3 px-5 py-3 border border-[#e5e5e5] rounded-xl cursor-pointer hover:border-[#1a1a1a] transition-colors duration-200 has-[:checked]:border-[#1a1a1a] has-[:checked]:bg-[#fafafa]">
                                <input type="radio" name="is_visible" value="1" {{ old('is_visible', $category->is_visible ?? '1') == '1' ? 'checked' : '' }} class="w-4 h-4 text-[#1a1a1a] border-[#e5e5e5] focus:ring-[#1a1a1a]" />
                                <span class="text-[14px] text-[#1a1a1a] font-medium">Published</span>
                            </label>
                            <label class="flex items-center gap-3 px-5 py-3 border border-[#e5e5e5] rounded-xl cursor-pointer hover:border-[#1a1a1a] transition-colors duration-200 has-[:checked]:border-[#1a1a1a] has-[:checked]:bg-[#fafafa]">
                                <input type="radio" name="is_visible" value="0" {{ old('is_visible', $category->is_visible ?? '1') == '0' ? 'checked' : '' }} class="w-4 h-4 text-[#1a1a1a] border-[#e5e5e5] focus:ring-[#1a1a1a]" />
                                <span class="text-[14px] text-[#1a1a1a] font-medium">Draft</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bottom Actions --}}
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 pb-8">
                <a href="{{ route('admin.categories.index') }}" class="text-[14px] text-[#666666] hover:text-[#1a1a1a] transition-colors duration-200">Cancel</a>
                <div class="flex items-center gap-3">
                    <button type="submit"
                        class="px-6 py-2.5 bg-[#1a1a1a] text-white text-[14px] font-semibold rounded-lg hover:bg-[#333333] transition-colors duration-200">
                        {{ $category ? 'Save Changes' : 'Create Category' }}
                    </button>
                </div>
            </div>

        </div>
    </form>

</div>
@endsection
