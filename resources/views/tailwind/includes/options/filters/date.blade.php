{{-- Filter --}}
<div class="filter-container">
    <label for="search_filter_date" class="flex">
        <div>
            {{-- Filter icon --}}
            <x-livewire-tables-filter-icon />
        </div>

        {{-- Filtrar por fecha --}}
        <div>{{ __('livewire-tables::filters.date') }}</div>
    </label>
    {{-- Date start --}}
    <input
        type="date"
        id="table_filter_date_start"
        class="w-full px-10 my-1 py-1.5 shadow-md rounded-md text-gray-500 sm:text-sm focus:outline-none border border-transparent focus:border-gray-300 placeholder-gray-300 mb-3"
        dusk="table-filter-date_start"
        max="2050-12-31"
        wire:model.defer="filterValues.date.start"
        x-ref="date_start"
    >
    {{-- Date end --}}
    <input
        type="date"
        id="table_filter_date_end"
        class="w-full px-10 my-1 py-1.5 shadow-md rounded-md text-gray-500 sm:text-sm focus:outline-none border border-transparent focus:border-gray-300 placeholder-gray-300 mb-3"
        dusk="table-filter-date_end"
        max="2050-12-31"
        wire:model.defer="filterValues.date.end"
        x-ref="date_end"
    >

    <div class="w-full flex justify-end">
        <button
            type="button"
            dusk="table-filter-date-button"
            class="flex mt-4 py-2 px-4 ml-2 rounded-lg bg-yellow-400 hover:bg-yellow-500 text-white shadow cursor-pointer"
            x-on:click="filterByDate($wire, $refs)"
        >
            {{-- icon: heroicon-o-search --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 opacity-50 mr-1 mt-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
            </svg>

            {{-- Filtrar --}}
            <span>{{ __('livewire-tables::filters.filter') }}</span>
        </button>
    </div>
</div>

@push('livewire-tables-javascript')
    @once
        <script>
            function filterByDate(livewire, referece) {
                if(referece.date_start.value) {
                    livewire.set('filterValues.date_start', referece.date_start.value);
                }
                if(referece.date_end.value) {
                    livewire.set('filterValues.date_end', referece.date_end.value);
                }
            }
        </script>
    @endonce
@endpush
