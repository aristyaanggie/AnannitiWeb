@extends('layouts.app')

@section('content')
<x-layout.navbar />

<section class="bg-white min-h-screen pt-24 pb-16 md:pt-32 md:pb-24">
    <div class="max-w-[700px] mx-auto px-6 md:px-8">

        {{-- Header --}}
        <div class="mb-10 md:mb-14">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-[13px] text-[#999999] hover:text-[#1a1a1a] transition-colors duration-200 mb-6">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path></svg>
                Back to Home
            </a>
            <h1 class="text-3xl md:text-4xl font-bold text-[#1a1a1a] mb-3" style="font-family: var(--font-heading);">Book a Tattoo</h1>
            <p class="text-[15px] text-[#666666] leading-relaxed">Fill in the form below and we will connect with you via WhatsApp to discuss your tattoo idea.</p>
        </div>

        {{-- Flash Message --}}
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

        {{-- Booking Form --}}
        <form method="POST" action="{{ route('booking.store') }}" class="space-y-8" x-data="{ service: '{{ old('service', $preselectedService) }}', hasReference: false }">
            @csrf
            <input type="hidden" name="whatsapp_number" value="{{ $whatsappNumber }}" />
            <input type="hidden" name="service" :value="service" />
            <input type="hidden" name="has_reference" :value="hasReference ? '1' : '0'" />

            {{-- Section 1: Personal Information --}}
            <div>
                <h2 class="text-[15px] font-bold text-[#1a1a1a] mb-5" style="font-family: var(--font-heading);">Personal Information</h2>
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Full Name <span class="text-[#ef4444]">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                            class="w-full px-4 py-3 bg-[#fafafa] border {{ $errors->has('name') ? 'border-[#ef4444]' : 'border-[#e5e5e5]' }} rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#999999] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                            placeholder="Your full name" />
                        @error('name') <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="country" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Country <span class="text-[#ef4444]">*</span></label>
                        <input type="text" id="country" name="country" value="{{ old('country') }}" required
                            class="w-full px-4 py-3 bg-[#fafafa] border {{ $errors->has('country') ? 'border-[#ef4444]' : 'border-[#e5e5e5]' }} rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#999999] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                            placeholder="e.g. Australia" />
                        @error('country') <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p> @enderror
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="phone" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Phone</label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                                class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#999999] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                                placeholder="+62 xxx xxx xxx" />
                        </div>
                        <div>
                            <label for="email" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                class="w-full px-4 py-3 bg-[#fafafa] border {{ $errors->has('email') ? 'border-[#ef4444]' : 'border-[#e5e5e5]' }} rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#999999] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                                placeholder="your@email.com" />
                            @error('email') <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section 2: Service --}}
            <div>
                <h2 class="text-[15px] font-bold text-[#1a1a1a] mb-5" style="font-family: var(--font-heading);">Service</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <button type="button" @click="service = 'studio'"
                        class="p-5 border-2 rounded-xl text-left transition-all duration-200"
                        :class="service === 'studio' ? 'border-[#1a1a1a] bg-[#fafafa]' : 'border-[#e5e5e5] hover:border-[#cccccc]'">
                        <div class="flex items-center gap-3 mb-2">
                            <svg class="w-5 h-5 text-[#1a1a1a]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5a1.5 1.5 0 001.5-1.5V5.25a1.5 1.5 0 00-1.5-1.5H3.75a1.5 1.5 0 00-1.5 1.5v14.25a1.5 1.5 0 001.5 1.5z"></path></svg>
                            <span class="text-[14px] font-semibold text-[#1a1a1a]">Studio Tattoo</span>
                        </div>
                        <p class="text-[13px] text-[#666666]">Get tattooed at our professional studio in Bali.</p>
                    </button>
                    <button type="button" @click="service = 'home_service'"
                        class="p-5 border-2 rounded-xl text-left transition-all duration-200"
                        :class="service === 'home_service' ? 'border-[#1a1a1a] bg-[#fafafa]' : 'border-[#e5e5e5] hover:border-[#cccccc]'">
                        <div class="flex items-center gap-3 mb-2">
                            <svg class="w-5 h-5 text-[#1a1a1a]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"></path></svg>
                            <span class="text-[14px] font-semibold text-[#1a1a1a]">Home Service</span>
                        </div>
                        <p class="text-[13px] text-[#666666]">We come to your location in Bali.</p>
                    </button>
                </div>
                @error('service') <p class="text-[12px] text-[#ef4444] mt-2">{{ $message }}</p> @enderror
            </div>

            {{-- Section 3: Tattoo Details --}}
            <div>
                <h2 class="text-[15px] font-bold text-[#1a1a1a] mb-5" style="font-family: var(--font-heading);">Tattoo Details</h2>
                <div class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="tattoo_style" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Tattoo Style <span class="text-[#ef4444]">*</span></label>
                            <input type="text" id="tattoo_style" name="tattoo_style" value="{{ old('tattoo_style') }}" required
                                class="w-full px-4 py-3 bg-[#fafafa] border {{ $errors->has('tattoo_style') ? 'border-[#ef4444]' : 'border-[#e5e5e5]' }} rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#999999] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                                placeholder="e.g. Blackwork, Realism" />
                            @error('tattoo_style') <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="budget" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Budget <span class="text-[#ef4444]">*</span></label>
                            <input type="text" id="budget" name="budget" value="{{ old('budget') }}" required
                                class="w-full px-4 py-3 bg-[#fafafa] border {{ $errors->has('budget') ? 'border-[#ef4444]' : 'border-[#e5e5e5]' }} rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#999999] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                                placeholder="e.g. Rp 2.000.000" />
                            @error('budget') <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="placement" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Placement</label>
                            <input type="text" id="placement" name="placement" value="{{ old('placement') }}"
                                class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#999999] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                                placeholder="e.g. Forearm, Back" />
                        </div>
                        <div>
                            <label for="size" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Size</label>
                            <input type="text" id="size" name="size" value="{{ old('size') }}"
                                class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#999999] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                                placeholder="e.g. Small, Medium, Large" />
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section 4: Location (Home Service only) --}}
            <div x-show="service === 'home_service'" x-transition>
                <h2 class="text-[15px] font-bold text-[#1a1a1a] mb-5" style="font-family: var(--font-heading);">Location</h2>
                <div class="space-y-4">
                    <div>
                        <label for="hotel" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Hotel</label>
                        <input type="text" id="hotel" name="hotel" value="{{ old('hotel') }}"
                            class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#999999] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                            placeholder="Hotel name" />
                    </div>
                    <div>
                        <label for="address" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Address</label>
                        <input type="text" id="address" name="address" value="{{ old('address') }}"
                            class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#999999] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                            placeholder="Full address" />
                    </div>
                    <div>
                        <label for="maps" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Google Maps Link</label>
                        <input type="url" id="maps" name="maps" value="{{ old('maps') }}"
                            class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#999999] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                            placeholder="https://maps.google.com/..." />
                    </div>
                </div>
            </div>

            {{-- Section 5: Date & Time --}}
            <div>
                <h2 class="text-[15px] font-bold text-[#1a1a1a] mb-5" style="font-family: var(--font-heading);">Date & Time</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="preferred_date" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Preferred Date</label>
                        <input type="text" id="preferred_date" name="preferred_date" value="{{ old('preferred_date') }}"
                            class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#999999] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                            placeholder="e.g. Next week, July 20" />
                    </div>
                    <div>
                        <label for="preferred_time" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Preferred Time</label>
                        <input type="text" id="preferred_time" name="preferred_time" value="{{ old('preferred_time') }}"
                            class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#999999] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                            placeholder="e.g. 10:00 AM, Afternoon" />
                    </div>
                </div>
            </div>

            {{-- Section 6: Notes --}}
            <div>
                <h2 class="text-[15px] font-bold text-[#1a1a1a] mb-5" style="font-family: var(--font-heading);">Notes</h2>
                <div class="space-y-4">
                    <div>
                        <label for="notes" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Additional Notes</label>
                        <textarea id="notes" name="notes" rows="4"
                            class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#999999] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200 resize-none"
                            placeholder="Any additional details about your tattoo idea...">{{ old('notes') }}</textarea>
                    </div>
                    <div>
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" @change="hasReference = $event.target.checked" class="w-4 h-4 rounded border-[#e5e5e5] text-[#1a1a1a] focus:ring-[#1a1a1a]" />
                            <span class="text-[14px] text-[#1a1a1a]">I have reference images ready</span>
                        </label>
                        <p class="text-[12px] text-[#999999] mt-1.5 ml-7">You can share reference images directly in WhatsApp after submitting.</p>
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="pt-4">
                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 bg-black text-white text-sm font-semibold rounded-lg transition-all duration-200 hover:bg-neutral-800 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                    Send via WhatsApp
                </button>
                <p class="text-[12px] text-[#999999] mt-3">You will be redirected to WhatsApp to complete your booking inquiry.</p>
            </div>
        </form>

    </div>
</section>

<x-layout.footer />
@endsection
