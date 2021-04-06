@if ($paginationEnabled || $searchEnabled)
    <div class="flex flex-wrap  mb-4">
        @if ($paginationEnabled && count($perPageOptions))
            <div class="relative flex-grow max-w-full flex-1 px-4 flex items-center">
                @lang('livewire-tables::strings.per_page'): &nbsp;

                <select wire:model="perPage" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                    @foreach ($perPageOptions as $option)
                        <option>{{ $option }}</option>
                    @endforeach
                </select>
            </div><!--col-->
        @endif

        @if ($searchEnabled)
            <div class="relative flex-grow max-w-full flex-1 px-4">
                @if ($clearSearchButton)
                    <div class="relative flex items-stretch w-full">
                        @endif
                        <input
                            @if (is_numeric($searchDebounce) && $searchUpdateMethod === 'debounce') wire:model.debounce.{{ $searchDebounce }}ms="search" @endif
                            @if ($searchUpdateMethod === 'lazy') wire:model.lazy="search" @endif
                            @if ($disableSearchOnLoading) wire:loading.attr="disabled" @endif
                            class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"
                            type="text"
                            placeholder="{{ __('livewire-tables::strings.search') }}"
                        />
                        @if ($clearSearchButton)
                            <div class="input-group-append">
                                <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline text-gray-900 border-gray-900 hover:bg-gray-900 hover:text-white bg-white hover:bg-gray-900" type="button" wire:click="clearSearch">@lang('livewire-tables::strings.clear')</button>
                            </div>
                    </div>
                @endif
            </div>
        @endif

        @include('livewire-tables::'.config('livewire-tables.theme').'.includes.export')
    </div><!--row-->
@endif
