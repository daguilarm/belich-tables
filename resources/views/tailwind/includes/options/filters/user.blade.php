<div class="filter-container">
    <label for="search_filter_worker" class="flex">
        <div>
            {{-- Filter icon --}}
            <x-livewire-tables-filter-icon />
        </div>

        {{-- Filtrar por trabajador --}}
        <div>{{ __('livewire-tables::filters.user') }}</div>
    </label>
    {{-- Select --}}
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
