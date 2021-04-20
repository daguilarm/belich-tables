<!-- Hide container by default -->
<div
    x-data="{ isOpenFilters: false, isFiltersActive: {{ count($filterValues) <= 0 ? 'false' : 'true' }} }"
    class="hidden md:block"
>
    <div
        class="relative text-left"
        @click.away="isOpenFilters = false"
    >
       <!-- Filter button -->
        <button type="button"
            x-on:click="isOpenFilters = !isOpenFilters"
            class="inline-flex items-center ml-2 p-2 bg-white hover:bg-yellow-400 text-yellow-500 hover:text-white shadow-lg rounded-lg focus:outline-none focus:bg-yellow-400 focus:text-white"
            id="table_filter_button"
            dusk="table-filter-button"
        >
            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
            </svg>
        </button>
        <!-- Reset button -->
        <button
            type="button"
            x-show="isFiltersActive"
            x-on:click="isOpenFilters = false"
            wire:click="resetAllFilters()"
            class="inline-flex items-center p-2 border border-gray-200 bg-white hover:bg-red-400 text-red-400 hover:text-white shadow-lg rounded-lg focus:outline-none"
            id="reset_all_filters"
            dusk="reset-all-filters"
            x-cloak
        >
            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
        <!-- Options -->
        <div
            x-show="isOpenFilters"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="absolute z-50 origin-top-left left-0 mt-1 ml-2 w-64 bg-yellow-100 border border-yellow-200 rounded-lg overflow-auto shadow-lg"
            id="table_filter_container"
            dusk="table-filter-container"
            x-cloak
        >
            <!-- Filter's form -->
            <form wire:submit.prevent="resolveFilters">
                <!-- Add filters -->
                @foreach($filters as $filter)
                    <span wire:key="{{ md5(Str::random() . time()) }}">
                        <div class="py-2 px-4 text-yellow-700 font-normal">
                            @includeIf($filter->view, compact('filter'))
                        </div>
                    </span>

                    <!-- Filter separator -->
                    @unless($loop->last)
                        <div class="w-full h-1 border-dotted border-t border-yellow-300 mt-4 mb-2"></div>
                    @endunless
                @endforeach

                <!-- Submit filter -->
                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="flex m-4 py-2 px-4 rounded-lg border border-yellow-500 hover:border-yellow-700 bg-yellow-400 hover:bg-yellow-600 text-white shadow cursor-pointer"
                        x-on:click="isOpenFilters = false"
                        id="table_filter_close_button"
                        dusk="table-filter-close-button"
                    >
                        <!-- Filter icon: heroicon-o-adjustment -->
                        <svg class="h-6 w-6 py-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>

                        <!-- Filter title -->
                        <span>{{ __('livewire-tables::filters.filter') }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
