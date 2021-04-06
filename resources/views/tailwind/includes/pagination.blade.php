@if ($paginationEnabled)
    <div class="flex flex-wrap ">
        <div class="relative flex-grow max-w-full flex-1 px-4">
            {{ $models->links() }}
        </div>

        <div class="relative flex-grow max-w-full flex-1 px-4 text-right text-gray-700">
            @lang('livewire-tables::strings.results', [
                'first' => $models->count() ? $models->firstItem() : 0,
                'last' => $models->count() ? $models->lastItem() : 0,
                'total' => $models->total()
            ])
        </div>
    </div>
@endif
