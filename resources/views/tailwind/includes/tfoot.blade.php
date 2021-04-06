@if ($tableFooterEnabled)
    <tfoot>
        @include('livewire-tables::'.config('livewire-tables.theme').'.includes.columns')
    </tfoot>
@endif
