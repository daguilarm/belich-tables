@if ($paginationEnabled || $searchEnabled)
    <div class="pb-3 sm:flex sm:items-center sm:justify-between">
        <div class="sm:mt-3">
            <div class="flex rounded-md">
                <div class="relative flex-grow focus-within:z-10">
                    {{-- Add search --}}
                    @includeWhen($searchEnabled, 'livewire-tables::'.config('livewire-tables.theme').'.includes.search')
                </div>
            </div>
        </div>
        <div class="flex">
            {{-- Add perpage --}}
            @includeWhen($paginationEnabled && count($perPageOptions), 'livewire-tables::'.config('livewire-tables.theme').'.includes.perPage')

            {{-- Add export --}}
            @include('livewire-tables::'.config('livewire-tables.theme').'.includes.export')
        </div>
    </div>
@endif
