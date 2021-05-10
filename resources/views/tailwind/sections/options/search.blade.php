<!-- Search icon -->
<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
    <!-- icon: heroicon-s-search -->
    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
    </svg>
</div>

<!-- Search input -->
<input
    @if (data_get($tableOptions, 'search.debounce') && data_get($tableOptions, 'search.updateMethod') === 'debounce') wire:model.debounce.{{ data_get($tableOptions, 'search.debounce') }}ms="search" @endif
    @if (data_get($tableOptions, 'search.updateMethod') === 'lazy') wire:model.lazy="search" @endif
    class="block w-full px-10 py-2 shadow-md rounded-md text-gray-500 sm:text-sm focus:outline-none border border-transparent focus:border-gray-300 placeholder-gray-300"
    type="text"
    placeholder="{{ __('belich-tables::strings.search') }}"
    id="belich_table_search"
    dusk="belich-table-search"
/>

<!-- Clear search button -->
@if (data_get($tableOptions, 'search.clearButton') && trim($search))
    <div
        wire:click="clearSearch"
        class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer"
        dusk="belich-table-clear-search"
    >
        <!-- icon: heroicon-s-x-circle -->
        <svg class="h-5 w-5 text-red-500 hover:text-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
        </svg>
    </div>
@endif
