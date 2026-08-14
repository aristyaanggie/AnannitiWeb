@props([
    'id' => 'delete-modal',
    'title' => 'Delete Item?',
    'message' => 'This item will be permanently deleted. This action cannot be undone.',
    'actionLabel' => 'Delete',
])

<div id="{{ $id }}" class="fixed inset-0 z-50 items-center justify-center p-6" x-data="{ open: false, action: '#', modalTitle: '{{ $title }}', modalMessage: '{{ $message }}', modalActionLabel: '{{ $actionLabel }}' }" x-show="open" x-cloak x-on:open-delete-modal.window="open = true; action = $event.detail.action || '#'; if ($event.detail.title) modalTitle = $event.detail.title; if ($event.detail.message) modalMessage = $event.detail.message; if ($event.detail.actionLabel) modalActionLabel = $event.detail.actionLabel" x-on:close-delete-modal.window="open = false" x-on:keydown.escape.window="open = false">
    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-black/50 transition-opacity duration-200" x-show="open" x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="open = false"></div>

    {{-- Modal --}}
    <div class="relative bg-white rounded-2xl shadow-xl max-w-md w-full p-6 md:p-8" x-show="open" x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
        <div class="text-center">
            <div class="w-12 h-12 rounded-full bg-[#fef2f2] flex items-center justify-center mx-auto mb-4">
                <svg class="w-6 h-6 text-[#ef4444]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path></svg>
            </div>
            <h3 class="text-lg font-bold text-[#1a1a1a] mb-2" style="font-family: var(--font-heading);" x-text="modalTitle">{{ $title }}</h3>
            <p class="text-[14px] text-[#666666] mb-6" x-text="modalMessage">{{ $message }}</p>
            <div class="flex items-center justify-center gap-3">
                <button @click="open = false" class="px-5 py-2.5 border border-[#e5e5e5] text-[14px] font-medium text-[#666666] rounded-lg hover:bg-[#fafafa] transition-colors duration-200">Cancel</button>
                <form :action="action" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-5 py-2.5 bg-[#ef4444] text-white text-[14px] font-semibold rounded-lg hover:bg-[#dc2626] transition-colors duration-200" x-text="modalActionLabel">{{ $actionLabel }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
