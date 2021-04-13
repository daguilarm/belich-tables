@php
    $years = range(date('Y'), date('Y') - 10);
@endphp

<div class="filter-container">
    <label for="search_filter_year" class="flex">
        <div>
            @svg('heroicon-o-adjustments', ['class' => 'h-6 opacity-50 mr-1 py-1 fill-current'])
        </div>
        <div>Years</div>
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
