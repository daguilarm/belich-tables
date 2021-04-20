{{-- Delete button --}}
<div
    id="delete_button_{{ $userId }}"
    dusk="delete-button-{{ $userId }}"
    class="py-2 px-1 text-gray-300 hover:text-red-600"
    x-data="{ 'showModal': false }"
    @keydown.escape="showModal = false"
>
    <a
        href="javascript:void(0)"
        @click="showModal = true"
    >
        {{-- icon: heroicon-o-trash --}}
        <svg class="h-6 xl:h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
        </svg>
    </a>

    {{-- Delete Modal --}}
    @include(LivewireTables::include('includes.modals.delete-modal'), ['onclick' => 'itemDelete('.$userId.')'])
</div>
