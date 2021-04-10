<div class="flex justify-end text-gray-400" >
    {{-- Show button --}}
    <a href="{{ routeAction($routeName, $routeAction = 'show', $model->id) }}" class="py-2 px-1 hover:text-green-600">
        {{-- icon: heroicon-o-eye --}}
        <svg class="h-6 xl:h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
        </svg>
    </a>

    {{-- Edit button --}}
    <a href="{{ routeAction($routeName, $routeAction = 'edit', $model->id) }}" class="py-2 px-1 hover:text-blue-600">
        {{-- icon: heroicon-o-pencil-alt --}}
        <svg class="h-6 xl:h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
        </svg>
    </a>

    {{-- Delete button --}}
    <div
        class="py-2 px-1 text-gray-300 hover:text-red-600"
        x-data="{ 'showModal': false, 'itemId': {{ $model->id }} }"
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
        @include('livewire-tables::'.config('livewire-tables.theme').'.includes.modals.delete-modal')
    </div>
</div>
