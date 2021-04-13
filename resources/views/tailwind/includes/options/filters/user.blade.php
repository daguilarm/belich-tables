@php
    $workers = \App\Models\User::get()
        ->pluck('name', 'id')
        ->toArray();
@endphp

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
        class="form-select select"
        dusk="table-filter-user"
        wire:model="filterValues.user"
    >
        <option value=""></option>
        @foreach($workers as $id => $value)
            <option value="{{ $id }}">{{ $value }}</option>
        @endforeach
    </select>
</div>
