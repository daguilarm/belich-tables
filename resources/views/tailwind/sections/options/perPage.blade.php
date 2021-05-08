<div class="flex mt-3 w-400 justify-end">
    <!-- Text -->
    <div class="flex items-center text-sm leading-5 font-medium text-gray-500">
        @lang('belich-tables::strings.per_page'): &nbsp;
    </div>
    <!-- Options -->
    <select
        wire:model="perPage"
        class="h-9 py-0 px-auto text-normal border-gray-300 rounded-md shadow-md text-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300"
        id="table_index_per_page"
        dusk="table-index-per-page"
    >
        @foreach ($perPageOptions as $option)
            <option>{{ $option }}</option>
        @endforeach
    </select>
</div>
