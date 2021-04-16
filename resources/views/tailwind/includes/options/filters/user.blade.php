<!-- Filter -->
<div class="filter-container">
    <label for="search_filter_worker" class="flex mb-1">
        <div>
            <!-- Icon: heroicon-s-user -->
            <svg class="h-6 w-6 py-1 opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
            </svg>
        </div>

        <!-- Filtrar por trabajador -->
        <div>{{ __('livewire-tables::filters.user') }}</div>
    </label>
    <!-- Select -->
    <select
        id="table_filter_user"
        class="w-full px-10 my-1 py-1.5 shadow-md rounded-md text-gray-500 sm:text-sm focus:outline-none border border-transparent focus:border-gray-300 placeholder-gray-300"
        dusk="table-filter-user"
        wire:model.defer="filterValues.user"
    >
        <option value=""></option>
        @foreach($values as $id => $value)
            <option value="{{ $id }}">{{ $value }}</option>
        @endforeach
    </select>
</div>
