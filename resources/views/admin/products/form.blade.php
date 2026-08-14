@extends('layouts.admin')

@section('content')
<div class="max-w-[900px] mx-auto" x-data="{
    thumbnailPreview: '{{ $product && $product->thumbnail ? asset('storage/' . $product->thumbnail) : '' }}',
    galleryPreviews: {{ Js::from($product && $product->galleries ? $product->galleries->map(fn($g) => ['id' => $g->id, 'url' => asset('storage/' . $g->image)])->toArray() : []) }},
    galleryCounter: 0,
    init() {
        this.$watch('galleryPreviews', () => this.syncGalleryFiles());
        this.syncGalleryFiles();
    },
    salesFormat: '{{ old('sales_format', $product->sales_format ?? 'standard') }}',
    formatPrice(e) {
        let raw = e.target.value.replace(/[^0-9]/g, '');
        let formatted = raw ? parseInt(raw).toLocaleString('id-ID') : '';
        e.target.value = formatted;
    },
    stripPriceFormat() {
        ['price', 'standard_price', 'individual_price'].forEach(id => {
            const input = document.getElementById(id);
            if (input && input.value) {
                input.value = input.value.replace(/[^0-9]/g, '');
            }
        });
    },
    syncGalleryFiles() {
        const input = document.getElementById('gallery-input');
        if (!input) return;
        const dt = new DataTransfer();
        this.galleryPreviews.forEach(p => { if (p.file) dt.items.add(p.file); });
        input.files = dt.files;
    },
    handleThumbnail(e) {
        const file = e.target.files[0];
        if (file && file.type.startsWith('image/')) {
            this.thumbnailPreview = URL.createObjectURL(file);
        }
    },
    handleThumbnailDrop(e) {
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            this.thumbnailPreview = URL.createObjectURL(file);
            const input = document.getElementById('thumbnail-input');
            const dt = new DataTransfer();
            dt.items.add(file);
            input.files = dt.files;
        }
    },
    handleGallery(e) {
        const files = e.target.files;
        for (let i = 0; i < files.length; i++) {
            this.galleryCounter++;
            this.galleryPreviews.push({
                id: 'new_' + this.galleryCounter,
                url: URL.createObjectURL(files[i]),
                file: files[i]
            });
        }
        e.target.value = '';
    },
    handleGalleryDrop(e) {
        const files = e.dataTransfer.files;
        for (let i = 0; i < files.length; i++) {
            if (files[i].type.startsWith('image/')) {
                this.galleryCounter++;
                this.galleryPreviews.push({
                    id: 'new_' + this.galleryCounter,
                    url: URL.createObjectURL(files[i]),
                    file: files[i]
                });
            }
        }
    },
    removeGalleryImage(index) {
        this.galleryPreviews.splice(index, 1);
    },
    async clearAllGallery() {
        if (!confirm('Are you sure you want to remove all images? Saved images will be permanently deleted.')) return;
        
        const serverImages = this.galleryPreviews.filter(p => typeof p.id === 'number');
        const token = document.querySelector('meta[name=&quot;csrf-token&quot;]')?.content || '{{ csrf_token() }}';
        
        for (const img of serverImages) {
            try {
                await fetch('{{ url('/admin/products/gallery') }}/' + img.id, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': token, 'Accept': 'application/json' },
                });
            } catch (e) {
                console.error('Failed to delete gallery image:', e);
            }
        }
        
        this.galleryPreviews = [];
        const input = document.getElementById('gallery-input');
        if (input) input.value = '';
        this.syncGalleryFiles();
    },
    async deleteGalleryImage(id, index) {
        const token = document.querySelector('meta[name=&quot;csrf-token&quot;]')?.content || '{{ csrf_token() }}';
        try {
            const response = await fetch('{{ url('/admin/products/gallery') }}/' + id, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                },
            });
            if (response.ok) {
                this.galleryPreviews.splice(index, 1);
            }
        } catch (e) {
            console.error('Failed to delete gallery image:', e);
        }
    }
}">

    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ route('admin.products.index') }}" class="inline-flex items-center gap-1.5 text-[13px] text-[#999999] hover:text-[#1a1a1a] transition-colors duration-200 mb-4">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path></svg>
            Back to Products
        </a>
        <h2 class="text-xl font-bold text-[#1a1a1a]" style="font-family: var(--font-heading);">{{ $pageTitle }}</h2>
        <p class="text-[13px] text-[#999999] mt-1">Fill in the details below to {{ $product ? 'update' : 'create' }} a product.</p>
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

    <form method="POST" action="{{ $product ? route('admin.products.update', $product) : route('admin.products.store') }}" enctype="multipart/form-data" x-on:submit="stripPriceFormat()">
        @csrf
        @if($product)
            @method('PUT')
        @endif

        <div class="space-y-8">

            {{-- Section 1: Basic Information --}}
            <div class="bg-white border border-[#e5e5e5] rounded-2xl p-6 md:p-8">
                <h3 class="text-[15px] font-bold text-[#1a1a1a] mb-6" style="font-family: var(--font-heading);">Basic Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="name" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Product Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $product->name ?? '') }}" required autofocus
                            class="w-full px-4 py-3 bg-[#fafafa] border {{ $errors->has('name') ? 'border-[#ef4444]' : 'border-[#e5e5e5]' }} rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                            placeholder="e.g. Wireless Tattoo Machine" />
                        @error('name')
                            <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="slug" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Slug</label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug', $product->slug ?? '') }}"
                            class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                            placeholder="auto-generated" />
                        <p class="text-[11px] text-[#999999] mt-1.5">Leave blank to auto-generate from name.</p>
                    </div>
                    <div>
                        <label for="category_id" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Category</label>
                        <select id="category_id" name="category_id" required
                            class="w-full px-4 py-3 bg-[#fafafa] border {{ $errors->has('category_id') ? 'border-[#ef4444]' : 'border-[#e5e5e5]' }} rounded-xl text-[14px] text-[#1a1a1a] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200 appearance-none cursor-pointer">
                            <option value="">Select category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="badge_id" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Badge</label>
                        <select id="badge_id" name="badge_id"
                            class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200 appearance-none cursor-pointer">
                            <option value="">No badge</option>
                            @foreach($badges as $badge)
                                <option value="{{ $badge->id }}" {{ old('badge_id', $product->badge_id ?? '') == $badge->id ? 'selected' : '' }}>
                                    {{ $badge->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- Section 2: Sales & Inventory --}}
            <div class="bg-white border border-[#e5e5e5] rounded-2xl p-6 md:p-8">
                <h3 class="text-[15px] font-bold text-[#1a1a1a] mb-6" style="font-family: var(--font-heading);">Sales & Inventory</h3>
                
                {{-- Sales Format Selector --}}
                <div class="mb-8">
                    <label class="block text-[13px] font-medium text-[#1a1a1a] mb-3">Sales Format</label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <label class="flex flex-col items-start gap-2 p-4 border rounded-xl cursor-pointer transition-colors duration-200 hover:border-[#1a1a1a]"
                               :class="salesFormat === 'standard' ? 'border-[#1a1a1a] bg-[#fafafa]' : 'border-[#e5e5e5]'">
                            <div class="flex items-center gap-2">
                                <input type="radio" name="sales_format" value="standard" x-model="salesFormat" class="w-4 h-4 text-[#1a1a1a] border-[#e5e5e5] focus:ring-[#1a1a1a]" />
                                <span class="text-[14px] text-[#1a1a1a] font-bold">Standard Package</span>
                            </div>
                            <span class="text-[12px] text-[#666666] ml-6">Sold as a package (e.g. 1 Box = 20 pcs)</span>
                        </label>

                        <label class="flex flex-col items-start gap-2 p-4 border rounded-xl cursor-pointer transition-colors duration-200 hover:border-[#1a1a1a]"
                               :class="salesFormat === 'individual' ? 'border-[#1a1a1a] bg-[#fafafa]' : 'border-[#e5e5e5]'">
                            <div class="flex items-center gap-2">
                                <input type="radio" name="sales_format" value="individual" x-model="salesFormat" class="w-4 h-4 text-[#1a1a1a] border-[#e5e5e5] focus:ring-[#1a1a1a]" />
                                <span class="text-[14px] text-[#1a1a1a] font-bold">Individual Unit</span>
                            </div>
                            <span class="text-[12px] text-[#666666] ml-6">Sold per unit (e.g. 1 Piece)</span>
                        </label>

                        <label class="flex flex-col items-start gap-2 p-4 border rounded-xl cursor-pointer transition-colors duration-200 hover:border-[#1a1a1a]"
                               :class="salesFormat === 'both' ? 'border-[#1a1a1a] bg-[#fafafa]' : 'border-[#e5e5e5]'">
                            <div class="flex items-center gap-2">
                                <input type="radio" name="sales_format" value="both" x-model="salesFormat" class="w-4 h-4 text-[#1a1a1a] border-[#e5e5e5] focus:ring-[#1a1a1a]" />
                                <span class="text-[14px] text-[#1a1a1a] font-bold">Both Options</span>
                            </div>
                            <span class="text-[12px] text-[#666666] ml-6">Customer can choose Package or Individual</span>
                        </label>
                    </div>
                </div>

                {{-- Configuration Fields --}}
                <div class="flex flex-col md:flex-row gap-8 mb-8">
                    {{-- Standard Package Config --}}
                    <div x-show="salesFormat === 'standard' || salesFormat === 'both'" class="flex-1 space-y-5 p-5 border border-[#e5e5e5] rounded-xl bg-[#fafafa]">
                        <h4 class="text-[13px] font-bold text-[#1a1a1a] uppercase tracking-wider">Standard Package</h4>
                        <div>
                            <label for="standard_unit" class="block text-[12px] font-medium text-[#666666] mb-2">Selling Unit (e.g. Box, Kit, Bottle)</label>
                            <input type="text" id="standard_unit" name="standard_unit" value="{{ old('standard_unit', $product->standard_unit ?? 'Unit') }}"
                                class="w-full px-4 py-2.5 bg-white border border-[#e5e5e5] rounded-lg text-[14px] text-[#1a1a1a] focus:outline-none focus:border-[#1a1a1a] transition-colors" />
                        </div>
                        <div>
                            <label for="standard_quantity" class="block text-[12px] font-medium text-[#666666] mb-2">Quantity per Package (e.g. 20)</label>
                            <input type="number" id="standard_quantity" name="standard_quantity" value="{{ old('standard_quantity', $product->standard_quantity ?? '1') }}"
                                class="w-full px-4 py-2.5 bg-white border border-[#e5e5e5] rounded-lg text-[14px] text-[#1a1a1a] focus:outline-none focus:border-[#1a1a1a] transition-colors" />
                        </div>
                        <div>
                            <label for="standard_price" class="block text-[12px] font-medium text-[#666666] mb-2">Package Price</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[14px] text-[#999999]">{{ config('ananniti.payment.currency_symbol', 'Rp') }}</span>
                                <input type="text" id="standard_price" name="standard_price" value="{{ number_format(old('standard_price', $product->standard_price ?? $product->price ?? '0'), 0, ',', '.') }}"
                                    x-on:input="formatPrice($event)" style="padding-left: 45px;"
                                    class="w-full pr-4 py-2.5 bg-white border border-[#e5e5e5] rounded-lg text-[14px] text-[#1a1a1a] focus:outline-none focus:border-[#1a1a1a] transition-colors" inputmode="numeric" />
                            </div>
                        </div>
                    </div>

                    {{-- Individual Unit Config --}}
                    <div x-show="salesFormat === 'individual' || salesFormat === 'both'" class="flex-1 space-y-5 p-5 border border-[#e5e5e5] rounded-xl bg-[#fafafa]" style="display: none;">
                        <h4 class="text-[13px] font-bold text-[#1a1a1a] uppercase tracking-wider">Individual Unit</h4>
                        <div>
                            <label for="individual_unit" class="block text-[12px] font-medium text-[#666666] mb-2">Selling Unit (e.g. Piece)</label>
                            <input type="text" id="individual_unit" name="individual_unit" value="{{ old('individual_unit', $product->individual_unit ?? 'Piece') }}"
                                class="w-full px-4 py-2.5 bg-white border border-[#e5e5e5] rounded-lg text-[14px] text-[#1a1a1a] focus:outline-none focus:border-[#1a1a1a] transition-colors" />
                        </div>
                        <div>
                            <label for="individual_price" class="block text-[12px] font-medium text-[#666666] mb-2">Individual Price</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[14px] text-[#999999]">{{ config('ananniti.payment.currency_symbol', 'Rp') }}</span>
                                <input type="text" id="individual_price" name="individual_price" value="{{ number_format(old('individual_price', $product->individual_price ?? '0'), 0, ',', '.') }}"
                                    x-on:input="formatPrice($event)" style="padding-left: 45px;"
                                    class="w-full pr-4 py-2.5 bg-white border border-[#e5e5e5] rounded-lg text-[14px] text-[#1a1a1a] focus:outline-none focus:border-[#1a1a1a] transition-colors" inputmode="numeric" />
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Hidden legacy price --}}
                <input type="hidden" id="price" name="price" value="0" />

                {{-- Inventory --}}
                <div class="border-t border-[#e5e5e5] pt-6">
                    <h4 class="text-[13px] font-bold text-[#1a1a1a] uppercase tracking-wider mb-5">Inventory Source</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="stock_quantity" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Total Physical Stock</label>
                            <input type="number" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity ?? '0') }}" required
                                class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                                placeholder="0" />
                        </div>
                        <div>
                            <label for="minimum_stock" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Minimum Stock</label>
                            <input type="number" id="minimum_stock" name="minimum_stock" value="{{ old('minimum_stock', $product->minimum_stock ?? '5') }}" required
                                class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                                placeholder="5" />
                            <p class="text-[11px] text-[#999999] mt-1.5">Alert when total stock falls below this number.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section 3: Description --}}
            <div class="bg-white border border-[#e5e5e5] rounded-2xl p-6 md:p-8">
                <h3 class="text-[15px] font-bold text-[#1a1a1a] mb-6" style="font-family: var(--font-heading);">Description</h3>
                <div>
                    <label for="description" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Product Description</label>
                    <textarea id="description" name="description" rows="6"
                        class="w-full px-4 py-3 bg-[#fafafa] border {{ $errors->has('description') ? 'border-[#ef4444]' : 'border-[#e5e5e5]' }} rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200 resize-none"
                        placeholder="Describe the product features, specifications, and benefits...">{{ old('description', $product->description ?? '') }}</textarea>
                    @error('description')
                        <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Section 4: Images --}}
            <div class="bg-white border border-[#e5e5e5] rounded-2xl p-6 md:p-8">
                <h3 class="text-[15px] font-bold text-[#1a1a1a] mb-8" style="font-family: var(--font-heading);">Images</h3>

                {{-- Thumbnail Upload --}}
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-3">
                        <label class="text-[13px] font-medium text-[#1a1a1a]">Thumbnail</label>
                        <span class="text-[13px] font-semibold text-[#1a1a1a]" x-show="thumbnailPreview">
                            Image Selected
                        </span>
                    </div>
                    <div class="relative" x-on:dragover.prevent x-on:drop.prevent="handleThumbnailDrop($event)">
                        <input type="file" name="thumbnail" accept="image/jpeg,image/png,image/webp" class="absolute inset-0 opacity-0 w-full h-full cursor-pointer z-10" id="thumbnail-input" x-on:change="handleThumbnail($event)" />
                        <label for="thumbnail-input" class="block border-2 border-dashed rounded-xl p-8 text-center transition-all duration-200 cursor-pointer"
                            :class="thumbnailPreview ? 'border-[#1a1a1a]/20' : 'border-[#e5e5e5] hover:border-[#cccccc] hover:bg-[#fafafa]'">
                            <template x-if="thumbnailPreview">
                                <div class="relative">
                                    <img :src="thumbnailPreview" class="w-full h-48 object-cover rounded-lg" alt="Thumbnail preview" />
                                    <button type="button" @click="thumbnailPreview = ''; document.getElementById('thumbnail-input').value = ''" class="absolute top-2 right-2 w-6 h-6 bg-[#1a1a1a] text-white rounded-full flex items-center justify-center text-[12px] hover:bg-[#333333]">&times;</button>
                                </div>
                            </template>
                            <template x-if="!thumbnailPreview">
                                <div>
                                    <svg class="w-8 h-8 mx-auto text-[#cccccc] mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5a1.5 1.5 0 001.5-1.5V5.25a1.5 1.5 0 00-1.5-1.5H3.75a1.5 1.5 0 00-1.5 1.5v14.25a1.5 1.5 0 001.5 1.5z"></path></svg>
                                    <p class="text-[13px] text-[#666666] font-medium">Drop image here</p>
                                    <p class="text-[12px] text-[#999999] mt-1">or click to upload</p>
                                    <p class="text-[11px] text-[#cccccc] mt-2">JPG, PNG, WebP &bull; Max 20MB</p>
                                </div>
                            </template>
                        </label>
                    </div>
                    @error('thumbnail')
                        <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Gallery Upload --}}
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <label class="text-[13px] font-medium text-[#1a1a1a]">Gallery</label>
                        <span class="text-[13px] font-semibold text-[#1a1a1a]" x-show="galleryPreviews.length > 0">
                            <span x-text="galleryPreviews.length"></span> <span x-text="galleryPreviews.length === 1 ? 'Photo' : 'Photos'"></span> Selected
                        </span>
                    </div>

                    {{-- Drop Zone --}}
                    <div class="relative" x-on:dragover.prevent x-on:drop.prevent="handleGalleryDrop($event)">
                        <input type="file" name="gallery[]" accept="image/jpeg,image/png,image/webp" multiple class="absolute inset-0 opacity-0 w-full h-full cursor-pointer z-10" id="gallery-input" x-on:change="handleGallery($event)" />
                        <label for="gallery-input" class="block border-2 border-dashed rounded-xl p-10 text-center transition-all duration-200 cursor-pointer"
                            :class="galleryPreviews.length > 0 ? 'border-[#1a1a1a]/20' : 'border-[#e5e5e5] hover:border-[#cccccc] hover:bg-[#fafafa]'">
                            <svg class="w-10 h-10 mx-auto text-[#cccccc] mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5a1.5 1.5 0 001.5-1.5V5.25a1.5 1.5 0 00-1.5-1.5H3.75a1.5 1.5 0 00-1.5 1.5v14.25a1.5 1.5 0 001.5 1.5z"></path></svg>
                            <p class="text-[14px] text-[#1a1a1a] font-semibold mb-1">Drop Product Images Here</p>
                            <p class="text-[13px] text-[#666666] mb-3">or Click to Browse</p>
                            <div class="flex items-center justify-center gap-2 flex-wrap">
                                <span class="inline-block px-2 py-0.5 text-[10px] font-medium text-[#666666] bg-[#f5f5f0] rounded">JPG</span>
                                <span class="inline-block px-2 py-0.5 text-[10px] font-medium text-[#666666] bg-[#f5f5f0] rounded">PNG</span>
                                <span class="inline-block px-2 py-0.5 text-[10px] font-medium text-[#666666] bg-[#f5f5f0] rounded">WEBP</span>
                                <span class="text-[11px] text-[#999999] mx-1">&bull;</span>
                                <span class="text-[11px] text-[#999999]">Multiple Images</span>
                                <span class="text-[11px] text-[#999999] mx-1">&bull;</span>
                                <span class="text-[11px] text-[#999999]">Max 20MB Each</span>
                            </div>
                        </label>
                    </div>
                    @error('gallery')
                        <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                    @enderror
                    @error('gallery.*')
                        <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                    @enderror

                    {{-- Action Bar --}}
                    <div class="flex items-center justify-between mt-5" x-show="galleryPreviews.length > 0">
                        <button type="button" @click="document.getElementById('gallery-input').click()" class="inline-flex items-center gap-1.5 text-[13px] font-medium text-[#1a1a1a] hover:text-[#666666] transition-colors duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                            Add More Images
                        </button>
                        <button type="button" @click="clearAllGallery()" class="inline-flex items-center gap-1.5 text-[13px] font-medium text-[#ef4444] hover:text-[#b91c1c] transition-colors duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Clear All
                        </button>
                    </div>

                    {{-- Gallery Preview Grid --}}
                    <div class="mt-5" x-show="galleryPreviews.length > 0">
                        <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-3">
                            <template x-for="(img, index) in galleryPreviews" :key="img.id">
                                <div class="relative group aspect-square">
                                    <img :src="img.url" class="w-full h-full object-cover rounded-lg border border-[#e5e5e5]" alt="Gallery preview" loading="lazy" />
                                    <button type="button" @click="typeof img.id === 'number' ? deleteGalleryImage(img.id, index) : removeGalleryImage(index)" class="absolute -top-1.5 -right-1.5 w-5 h-5 bg-[#ef4444] text-white rounded-full flex items-center justify-center text-[10px] shadow-sm opacity-0 group-hover:opacity-100 transition-opacity duration-150 hover:bg-[#b91c1c]">&times;</button>
                                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/50 to-transparent rounded-b-lg p-1.5 opacity-0 group-hover:opacity-100 transition-opacity duration-150">
                                        <p class="text-[9px] text-white font-medium truncate" x-text="'#' + (index + 1)"></p>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section 5: Status & Display Order --}}
            <div class="bg-white border border-[#e5e5e5] rounded-2xl p-6 md:p-8">
                <h3 class="text-[15px] font-bold text-[#1a1a1a] mb-6" style="font-family: var(--font-heading);">Status & Display</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[13px] font-medium text-[#1a1a1a] mb-3">Visibility</label>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <label class="flex items-center gap-3 px-5 py-3 border border-[#e5e5e5] rounded-xl cursor-pointer hover:border-[#1a1a1a] transition-colors duration-200 has-[:checked]:border-[#1a1a1a] has-[:checked]:bg-[#fafafa]">
                                <input type="radio" name="is_visible" value="1" {{ old('is_visible', $product->is_visible ?? '1') == '1' ? 'checked' : '' }} class="w-4 h-4 text-[#1a1a1a] border-[#e5e5e5] focus:ring-[#1a1a1a]" />
                                <span class="text-[14px] text-[#1a1a1a] font-medium">Published</span>
                            </label>
                            <label class="flex items-center gap-3 px-5 py-3 border border-[#e5e5e5] rounded-xl cursor-pointer hover:border-[#1a1a1a] transition-colors duration-200 has-[:checked]:border-[#1a1a1a] has-[:checked]:bg-[#fafafa]">
                                <input type="radio" name="is_visible" value="0" {{ old('is_visible', $product->is_visible ?? '1') == '0' ? 'checked' : '' }} class="w-4 h-4 text-[#1a1a1a] border-[#e5e5e5] focus:ring-[#1a1a1a]" />
                                <span class="text-[14px] text-[#1a1a1a] font-medium">Draft</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <label for="display_order" class="block text-[13px] font-medium text-[#1a1a1a] mb-3">Display Order</label>
                        <input type="number" id="display_order" name="display_order" value="{{ old('display_order', $product->display_order ?? '0') }}"
                            class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                            placeholder="0" min="0" />
                        <p class="text-[11px] text-[#999999] mt-1.5">Lower numbers appear first.</p>
                    </div>
                </div>
            </div>

            {{-- Section 6: SEO --}}
            <div class="bg-white border border-[#e5e5e5] rounded-2xl p-6 md:p-8">
                <h3 class="text-[15px] font-bold text-[#1a1a1a] mb-6" style="font-family: var(--font-heading);">SEO</h3>
                <div class="space-y-5">
                    <div>
                        <label for="meta_title" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Meta Title</label>
                        <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $product->meta_title ?? '') }}"
                            class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                            placeholder="SEO title for search engines" />
                    </div>
                    <div>
                        <label for="meta_description" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Meta Description</label>
                        <textarea id="meta_description" name="meta_description" rows="3"
                            class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200 resize-none"
                            placeholder="Brief description for search engines">{{ old('meta_description', $product->meta_description ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Bottom Actions --}}
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 pb-8">
                <a href="{{ route('admin.products.index') }}" class="text-[14px] text-[#666666] hover:text-[#1a1a1a] transition-colors duration-200">Cancel</a>
                <div class="flex items-center gap-3">
                    <button type="submit"
                        class="px-6 py-2.5 bg-[#1a1a1a] text-white text-[14px] font-semibold rounded-lg hover:bg-[#333333] transition-colors duration-200">
                        {{ $product ? 'Save Changes' : 'Create Product' }}
                    </button>
                </div>
            </div>

        </div>
    </form>

</div>
@endsection
