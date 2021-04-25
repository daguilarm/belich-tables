<!-- Start pagination if is enable -->
@if ($paginator->hasPages())
    <nav class="bg-gray-50 px-4 py-3 my-1 flex items-center justify-between sm:px-6">
        <div class="hidden sm:block">
            <p class="text-sm text-gray-500">
                {{ trans('belich-tables::strings.pagination.results', [
                    'first' => $paginator->firstItem(),
                    'last' => $paginator->lastItem(),
                    'total' => $paginator->total(),
                ]) }}
            </p>
        </div>
        <div class="flex-1 flex justify-between sm:justify-end">

            <!-- Previous Page Link -->
            @if (!$paginator->onFirstPage())
                <div dusk="pagination-previus" wire:click="previousPage" rel="prev" class="relative cursor-pointer inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    {!! __('belich-tables::strings.pagination.previous') !!}
                </div>
            @else
                <div dusk="pagination-previus" wire:click="gotoPage(1)" rel="prev" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 cursor-default leading-5 rounded-md">
                    {!! __('belich-tables::strings.pagination.previous') !!}
                </div>
            @endif

            <!-- Next Page Link -->
            @if ($paginator->hasMorePages())
                <div dusk="pagination-next" wire:click="nextPage" rel="next" class="relative cursor-pointer ml-2 inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    {!! __('belich-tables::strings.pagination.next') !!}
                </div>
            @else
                <div dusk="pagination-next" class="relative ml-2 inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 cursor-default leading-5 rounded-md">
                    {!! __('belich-tables::strings.pagination.next') !!}
                </div>
            @endif

        </div>
    </nav>
@endif
