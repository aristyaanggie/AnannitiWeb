@props([
    'name' => '',
    'label' => '',
    'value' => '',
    'placeholder' => '',
    'rows' => 4,
])

<div>
    <label for="{{ $name }}" class="block text-[13px] font-medium text-[#1a1a1a] mb-2">{{ $label }}</label>
    <textarea id="{{ $name }}" name="{{ $name }}" rows="{{ $rows }}" placeholder="{{ $placeholder }}"
        class="w-full px-4 py-3 bg-[#fafafa] border border-[#e5e5e5] rounded-xl text-[14px] text-[#1a1a1a] placeholder:text-[#777777] focus:outline-none focus:border-[#1a1a1a] transition-colors duration-200 resize-none">{{ old($name, $value) }}</textarea>
    @error($name)
        <p class="text-[12px] text-[#ef4444] mt-1.5">{{ $message }}</p>
    @enderror
</div>
