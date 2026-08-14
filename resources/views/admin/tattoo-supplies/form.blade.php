@extends('layouts.admin')

@section('content')
<div class="max-w-[900px] mx-auto">

    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ route('admin.products.index', ['tab' => 'supplies']) }}" class="inline-flex items-center gap-1.5 text-[13px] text-[#999999] hover:text-[#1a1a1a] transition-colors duration-200 mb-4">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path></svg>
            Back to Products
        </a>
        <h2 class="text-xl font-bold text-[#1a1a1a]" style="font-family: var(--font-heading);">{{ $pageTitle }}</h2>
        <p class="text-[13px] text-[#999999] mt-1">Fill in the details below to {{ $supply ? 'update' : 'create' }} a tattoo supply card.</p>
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

    <form method="POST" action="{{ $supply ? route('admin.tattoo-supplies.update', $supply) : route('admin.tattoo-supplies.store') }}" enctype="multipart/form-data">
        @csrf
        @if($supply)
            @method('PUT')
        @endif

        <div class="space-y-8" x-data="{ displayOrder: {{ old('display_order', $supply->display_order ?? '0') }} }">

            {{-- Section 1: Basic Information --}}
            <div class="bg-white border border-[#e5e5e5] rounded-2xl p-6 md:p-8">
                <h3 class="text-[15px] font-bold text-[#1a1a1a] mb-6" style="font-family: var(--font-heading);">Basic Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="title" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Title <span class="text-[#ef4444]">*</span></label>
                        <input type="text" id="title" name="title" value="{{ old('title', $supply->title ?? '') }}" required autofocus
                            class="w-full px-4 py-3 bg-[#fafafa] border {{ $errors->has('title') ? 'border-[#ef4444]' : 'border-[#e5e5e5]' }} rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                            placeholder="e.g. Tattoo Machine" />
                        @error('title')
                            <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label for="subtitle" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Subtitle</label>
                        <input type="text" id="subtitle" name="subtitle" value="{{ old('subtitle', $supply->subtitle ?? '') }}"
                            class="w-full px-4 py-3 bg-[#fafafa] border {{ $errors->has('subtitle') ? 'border-[#ef4444]' : 'border-[#e5e5e5]' }} rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                            placeholder="e.g. Precision instruments for every style" />
                        @error('subtitle')
                            <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label for="link" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Link</label>
                        <input type="text" id="link" name="link" value="{{ old('link', $supply->link ?? '') }}"
                            class="w-full px-4 py-3 bg-[#fafafa] border {{ $errors->has('link') ? 'border-[#ef4444]' : 'border-[#e5e5e5]' }} rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                            placeholder="e.g. /shop/category/tattoo-machine" />
                        <p class="text-[11px] text-[#999999] mt-1.5">URL where this card links to. Leave blank for no link.</p>
                        @error('link')
                            <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Section 2: Image --}}
            <div class="bg-white border border-[#e5e5e5] rounded-2xl p-6 md:p-8">
                <h3 class="text-[15px] font-bold text-[#1a1a1a] mb-2" style="font-family: var(--font-heading);">Image</h3>
                <p class="text-[13px] text-[#999999] mb-6">{{ $supply && $supply->image ? 'Current image is shown below. Upload a new one to replace it.' : 'Upload an image for this tattoo supply card.' }}</p>

                {{-- Current Image --}}
                @if($supply && $supply->image)
                    <div class="mb-4 p-3 bg-[#f5f5f0] rounded-xl flex items-center gap-4">
                        <div class="w-20 h-14 rounded-lg overflow-hidden flex-shrink-0">
                            <img src="{{ asset('storage/' . $supply->image) }}" alt="Current image" class="w-full h-full object-cover" />
                        </div>
                        <div>
                            <p class="text-[12px] text-[#666666]">{{ basename($supply->image) }}</p>
                            <p class="text-[11px] text-[#999999]">Current image</p>
                        </div>
                    </div>
                @endif

                <div x-data="{
                    imagePreview: '{{ $supply && $supply->image ? asset('storage/' . $supply->image) : '' }}',
                    handleImage(e) {
                        const file = e.target.files[0];
                        if (file && file.type.startsWith('image/')) {
                            this.imagePreview = URL.createObjectURL(file);
                        }
                    }
                }">
                    <div class="mb-4 bg-[#f8f9fa] border border-[#e5e5e5] rounded-xl p-4">
                        <h4 class="text-[12px] font-bold text-[#1a1a1a] mb-2">Panduan Rasio Foto</h4>
                        <ul class="text-[12px] font-medium space-y-1">
                            <li :class="displayOrder == 0 ? 'text-[#1a1a1a]' : 'text-[#999999]'">
                                Order 0 : <strong>3:4 Portrait</strong>
                            </li>
                            <li :class="displayOrder == 1 || displayOrder == 2 ? 'text-[#1a1a1a]' : 'text-[#999999]'">
                                Order 1 & 2 : <strong>16:9 Landscape</strong>
                            </li>
                            <li :class="displayOrder >= 3 ? 'text-[#1a1a1a]' : 'text-[#999999]'">
                                Order 3+ : <strong>4:3 Landscape</strong>
                            </li>
                        </ul>
                    </div>

                    <div class="relative">
                        <input type="file" name="image" accept="image/jpeg,image/png,image/webp" class="absolute inset-0 opacity-0 w-full h-full cursor-pointer z-10" id="image-input" x-on:change="handleImage($event)" {{ !$supply ? 'required' : '' }} />
                        <label for="image-input" class="block border-2 border-dashed rounded-xl p-8 text-center transition-all duration-200 cursor-pointer overflow-hidden"
                            :class="imagePreview ? 'border-[#1a1a1a]/20' : 'border-[#e5e5e5] hover:border-[#cccccc] hover:bg-[#fafafa]'">
                            <template x-if="imagePreview">
                                <div class="relative max-w-sm mx-auto bg-gray-100 rounded-lg overflow-hidden" 
                                     :class="displayOrder == 0 ? 'aspect-[3/4]' : (displayOrder == 1 || displayOrder == 2 ? 'aspect-[16/9]' : 'aspect-[4/3]')">
                                    <img :src="imagePreview" class="w-full h-full object-cover" alt="Image preview" />
                                    <div class="absolute inset-0 shadow-[inset_0_0_0_1px_rgba(0,0,0,0.1)] rounded-lg pointer-events-none"></div>
                                    <button type="button" @click="imagePreview = ''; document.getElementById('image-input').value = ''" class="absolute top-2 right-2 w-7 h-7 bg-[#1a1a1a]/80 text-white rounded-full flex items-center justify-center text-[14px] hover:bg-[#ef4444] transition-colors pointer-events-auto z-20">&times;</button>
                                </div>
                            </template>
                            <template x-if="!imagePreview">
                                <div>
                                    <svg class="w-8 h-8 mx-auto text-[#cccccc] mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5a1.5 1.5 0 001.5-1.5V5.25a1.5 1.5 0 00-1.5-1.5H3.75a1.5 1.5 0 00-1.5 1.5v14.25a1.5 1.5 0 001.5 1.5z"></path></svg>
                                    <p class="text-[13px] text-[#666666] font-medium">Drop image here</p>
                                    <p class="text-[12px] text-[#999999] mt-1">or click to upload</p>
                                    <p class="text-[11px] text-[#cccccc] mt-2">Upload dengan rasio yang sesuai agar pas &bull; Max 5MB</p>
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
                        <input type="number" id="display_order" name="display_order" value="{{ old('display_order', $supply->display_order ?? '0') }}"
                            x-model="displayOrder"
                            class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                            placeholder="0" min="0" />
                        <p class="text-[11px] text-[#999999] mt-1.5">Lower numbers appear first.</p>
                    </div>
                    <div>
                        <label class="block text-[13px] font-medium text-[#1a1a1a] mb-3">Visibility</label>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <label class="flex items-center gap-3 px-5 py-3 border border-[#e5e5e5] rounded-xl cursor-pointer hover:border-[#1a1a1a] transition-colors duration-200 has-[:checked]:border-[#1a1a1a] has-[:checked]:bg-[#fafafa]">
                                <input type="radio" name="is_visible" value="1" {{ old('is_visible', $supply->is_visible ?? '1') == '1' ? 'checked' : '' }} class="w-4 h-4 text-[#1a1a1a] border-[#e5e5e5] focus:ring-[#1a1a1a]" />
                                <span class="text-[14px] text-[#1a1a1a] font-medium">Published</span>
                            </label>
                            <label class="flex items-center gap-3 px-5 py-3 border border-[#e5e5e5] rounded-xl cursor-pointer hover:border-[#1a1a1a] transition-colors duration-200 has-[:checked]:border-[#1a1a1a] has-[:checked]:bg-[#fafafa]">
                                <input type="radio" name="is_visible" value="0" {{ old('is_visible', $supply->is_visible ?? '1') == '0' ? 'checked' : '' }} class="w-4 h-4 text-[#1a1a1a] border-[#e5e5e5] focus:ring-[#1a1a1a]" />
                                <span class="text-[14px] text-[#1a1a1a] font-medium">Draft</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bottom Actions --}}
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 pb-8">
                <a href="{{ route('admin.products.index', ['tab' => 'supplies']) }}" class="text-[14px] text-[#666666] hover:text-[#1a1a1a] transition-colors duration-200">Cancel</a>
                <div class="flex items-center gap-3">
                    <button type="submit"
                        class="px-6 py-2.5 bg-[#1a1a1a] text-white text-[14px] font-semibold rounded-lg hover:bg-[#333333] transition-colors duration-200">
                        {{ $supply ? 'Save Changes' : 'Create Tattoo Supply' }}
                    </button>
                </div>
            </div>

        </div>
    </form>

</div>
@endsection
