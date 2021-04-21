<!-- Filter -->
<div class="filter-container">
    <label for="search_filter_year" class="flex mb-1">
        <div>
            <!-- icon: heroicons-s-view-list -->
            <svg class="h-6 w-6 py-1 opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
            </svg>
        </div>
        <div>{{ __('livewire-tables::filters.year') }}</div>
    </label>
    <!-- Select -->
    <select
        id="table_filter_year"
        class="w-full px-10 my-1 py-1.5 shadow-md rounded-md text-gray-500 sm:text-sm focus:outline-none border border-transparent focus:border-gray-300 placeholder-gray-300"
        dusk="table-filter-year"
        wire:model.defer="filterValues.year"
    >
        <!-- Blank option -->
        <option value=""></option>
        <!-- Options -->
        @foreach($filter->options() as $id => $value)
            <option value="{{ $value }}">{{ $value }}</option>
        @endforeach
    </select>
</div>
