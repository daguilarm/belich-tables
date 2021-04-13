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
        class="form-select select"
        dusk="table-filter-year"
        wire:model="filterValues.year"
    >
        <option value=""></option>
        @foreach($years as $id => $value)
            <option value="{{ $value }}">{{ $value }}</option>
        @endforeach
    </select>
</div>
