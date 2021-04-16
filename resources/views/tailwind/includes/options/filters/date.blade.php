<!-- Filter -->
<div class="filter-container">
    <label for="search_filter_date" class="flex">
        <div>
            <!--Filter icon -->
            <svg class="h-6 w-6 py-1 opacity-30" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
            </svg>
        </div>

        <!--Filtrar por fecha -->
        <div>{{ __('livewire-tables::filters.date') }}</div>
    </label>
    <!--Date start -->
    <input
        type="date"
        id="table_filter_date_start"
        class="w-full px-10 my-1 py-1.5 shadow-md rounded-md text-gray-500 sm:text-sm focus:outline-none border border-transparent focus:border-gray-300 placeholder-gray-300 mb-3"
        dusk="table-filter-date_start"
        max="2050-12-31"
        wire:model.defer="filterValues.date.start"
    >
    <!--Date end -->
    <input
        type="date"
        id="table_filter_date_end"
        class="w-full px-10 my-1 py-1.5 shadow-md rounded-md text-gray-500 sm:text-sm focus:outline-none border border-transparent focus:border-gray-300 placeholder-gray-300 mb-3"
        dusk="table-filter-date_end"
        max="2050-12-31"
        wire:model.defer="filterValues.date.end"
    >
</div>
