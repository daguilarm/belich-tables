@if ($paginationEnabled || $searchEnabled)
    <div class="pb-3 sm:flex sm:items-center sm:justify-between">
        <div class="sm:mt-3">
            <label for="search_candidate" class="sr-only">Search</label>
            <div class="flex rounded-md">
                <div class="relative flex-grow focus-within:z-10">
                    {{-- Add search --}}
                    @includeWhen($searchEnabled, 'livewire-tables::'.config('livewire-tables.theme').'.includes.search')
                </div>
            </div>
        </div>
        <div class="flex">
            @if ($paginationEnabled && count($perPageOptions))
                <div class="sm:mt-3 flex w-400 justify-end mr-3">
                    <div class="flex items-center">
                        @lang('livewire-tables::strings.per_page'): &nbsp;
                    </div>
                    <select wire:model="perPage" class="max-w-lg flex-1 focus:ring-indigo-500 focus:border-indigo-500 w-full sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                        @foreach ($perPageOptions as $option)
                            <option>{{ $option }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            @include('livewire-tables::'.config('livewire-tables.theme').'.includes.export')
        </div>
    </div>
@endif
