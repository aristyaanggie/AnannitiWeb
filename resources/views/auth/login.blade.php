@extends('layouts.auth')

@php
    $loginLogo = setting('logo');
@endphp

@section('content')
<div class="min-h-screen flex items-center justify-center px-6">
    <div class="w-full max-w-md">
        {{-- Logo --}}
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-lg bg-[#0a0a0a] mb-6">
                @if($loginLogo)
                    <img src="{{ asset('storage/' . $loginLogo) }}" alt="Logo" class="w-10 h-10 object-contain" />
                @else
                    <span class="text-sm font-bold tracking-wider text-white">AT</span>
                @endif
            </div>
            <h1 class="text-2xl font-bold text-[#1a1a1a]" style="font-family: var(--font-heading);">Admin Portal</h1>
            <p class="text-[14px] text-[#999999] mt-2">Authorized access only.</p>
        </div>

        {{-- Form --}}
        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="email"
                    class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-lg text-[14px] text-[#1a1a1a] placeholder:text-[#999999] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                    placeholder="admin@anannititattoo.com"
                />
                @error('email')
                    <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-lg text-[14px] text-[#1a1a1a] placeholder:text-[#999999] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200"
                    placeholder="••••••••"
                />
                @error('password')
                    <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded border-[#e5e5e5] text-[#1a1a1a] focus:ring-[#1a1a1a]">
                    <span class="text-[13px] text-[#666666]">Remember Me</span>
                </label>
                <a href="#" class="text-[13px] text-[#666666] hover:text-[#1a1a1a] transition-colors duration-200">Forgot Password?</a>
            </div>

            <button
                type="submit"
                class="w-full px-4 py-3 bg-[#1a1a1a] text-white text-[14px] font-semibold rounded-lg hover:bg-[#333333] transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#1a1a1a] focus:ring-offset-2"
            >
                Login
            </button>
        </form>

        {{-- Footer --}}
        <p class="text-center text-[12px] text-[#999999] mt-8">&copy; {{ date('Y') }} Ananniti Tattoo Bali</p>
    </div>
</div>
@endsection
