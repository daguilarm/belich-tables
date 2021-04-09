{{-- Search icon --}}
<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
    <!-- Heroicon name: solid/search -->
    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
    </svg>
</div>

{{-- Search input --}}
<input
    @if (is_numeric($searchDebounce) && $searchUpdateMethod === 'debounce') wire:model.debounce.{{ $searchDebounce }}ms="search" @endif
    @if ($searchUpdateMethod === 'lazy') wire:model.lazy="search" @endif
    @if ($disableSearchOnLoading) wire:loading.attr="disabled" @endif
    class="focus:outline-none focus:border-gray-500 focus:border-transparent block w-full px-10 py-2 shadow-md border border-gray-300 rounded-md text-gray-500 sm:text-sm"
    type="text"
    placeholder="{{ __('livewire-tables::strings.search') }}"
/>

{{-- Clear search button --}}
@if ($clearSearchButton && trim($search))
    <div wire:click="clearSearch" class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer">
        <div class="p-1 hover:bg-gray-100 rounded-lg">
            <svg class="h-4 w-4 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </div>
    </div>
@endif
