@php
    $years = range(date('Y'), date('Y') - 10);
@endphp

<div class="filter-container">
    <label for="search_filter_year" class="flex">
        <div>
            {{-- Filter icon --}}
            <x-livewire-tables-filter-icon />
        </div>

        <div>{{ __('livewire-tables::filters.year') }}</div>
    </label>
    {{-- Select --}}
    <select
        id="table_filter_year"
        class="w-full px-10 my-1 py-1.5 shadow-md rounded-md text-gray-500 sm:text-sm focus:outline-none border border-transparent focus:border-gray-300 placeholder-gray-300"
        dusk="table-filter-year"
        wire:model="filterValues.year"
    >
        <option value=""></option>
        @foreach($years as $id => $value)
            <option value="{{ $value }}">{{ $value }}</option>
        @endforeach
    </select>
</div>
