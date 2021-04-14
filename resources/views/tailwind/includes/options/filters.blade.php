<div x-data="{ isOpenFilters: false }">
    <div class="relative text-left" @click.away="isOpenFilters = false">
        <button type="button"
            x-on:click="isOpenFilters = !isOpenFilters"
            class="inline-flex items-center bg-yellow-100 hover:bg-yellow-400 text-yellow-500 hover:text-white shadow-xs border border-yellow-500 ml-2 rounded-lg p-1 focus:outline-none focus:bg-yellow-400 focus:text-white"
            id="table_filter_button"
            dusk="table-filter-button"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
            </svg>
        </button>
        <button
            type="button"
            wire:click="resetAllFilters()"
            x-on:click="isOpenFilters = false"
            class="inline-flex items-center p-1 bg-white hover:bg-red-500 text-red-400 hover:text-white shadow-xs border border-red-400 rounded-lg focus:outline-none"
            id="reset_all_filters"
            dusk="reset-all-filters"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
      {{-- Options --}}
        <div
            x-show="isOpenFilters"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="absolute z-50 origin-top-left left-0 mt-1 ml-2 w-64 bg-yellow-100 border-2 border-yellow-300 rounded-lg overflow-auto shadow-lg"
            id="table_filter_container"
            dusk="table-filter-container"
            x-cloak
        >
            {{-- Add filters --}}
            @foreach($filters as $filter)
                <span wire:key="{{ md5(Str::random() . time()) }}">
                    <div class="py-2 px-4">
                        @includeIf($filter->get('view'), ['values' => $filter->get('values')])
                    </div>
                </span>

                {{-- Separator --}}
                <div class="w-full h-1 border-t border-yellow-300 mt-4 mb-2"></div>
            @endforeach

            {{-- <div class="flex justify-end">
                <button
                    type="button"
                    class="flex mt-4 py-2 px-4 rounded-lg border border-red-300 bg-gray-50 hover:bg-red-500 text-red-500 hover:text-white shadow cursor-pointer"
                    x-on:click="isOpenFilters = false"
                    id="table_filter_close_button"
                    dusk="table-filter-close-button"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 opacity-50 mr-1 mt-1 fill-current" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>

                    <span>{{ __('livewire-tables::strings.close') }}</span>
                </button>
            </div> --}}
        </div>
    </div>
</div>
