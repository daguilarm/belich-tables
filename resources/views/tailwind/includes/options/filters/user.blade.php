@php
    $workers = \App\Models\User::get()
        ->pluck('name', 'id')
        ->toArray();
@endphp

<div class="filter-container">
    <label for="search_filter_worker" class="flex">
        <div>
            @svg('heroicon-o-adjustments', ['class' => 'h-6 opacity-50 mr-1 py-1 fill-current'])
        </div>
        {{-- Filtrar por trabajador --}}
        <div>{{ __('filters.worker') }}</div>
    </label>
    {{-- Select --}}
    <select
        id="table_filter_worker"
        class="form-select select"
        dusk="table-filter-worker"
        wire:model="filterValues.worker"
    >
        <option value=""></option>
        @foreach($workers as $id => $value)
            <option value="{{ $id }}">{{ $value }}</option>
        @endforeach
    </select>
</div>
