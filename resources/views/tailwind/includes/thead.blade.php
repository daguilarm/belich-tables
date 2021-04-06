@if ($tableHeaderEnabled)
    <thead class="">
        @include('livewire-tables::'.config('livewire-tables.theme').'.includes.columns')
    </thead>
@endif
