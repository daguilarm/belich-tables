<div class="pb-3 flex items-center justify-between">

    {{-- Left side --}}
    <div class="flex mt-3">
        <div class="flex rounded-md">
            <div class="relative flex-grow">
                {{-- Add search field --}}
                @includeWhen($showSearch, BelichTables::include('sections.options.search'))
            </div>
        </div>

        {{-- Add all the filters --}}
        @includeWhen(isset($filters) && count($filters) > 0, BelichTables::include('sections.options.filters'))
    </div>

    {{-- Right side --}}
    <div class="flex">
        {{-- Add perpage selector --}}
        @includeWhen($showPerPage, BelichTables::include('sections.options.perPage'))

        {{-- Add new resource button --}}
        @includeWhen($newResource, BelichTables::include('sections.options.new-resource'))

        {{-- Add export button --}}
        @includeWhen($checkboxValues && count($exports) > 0, BelichTables::include('sections.options.export'))

        {{-- Add mass delete button (only if there is checkboxes checked) --}}
        @includeWhen($checkboxValues, BelichTables::include('sections.options.bulk-delete'))
    </div>

</div>
