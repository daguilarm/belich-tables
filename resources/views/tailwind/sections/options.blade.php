<div class="pb-3 flex items-center justify-between">

    {{-- Left side --}}
    <div class="flex mt-3">
        <div class="flex rounded-md">
            <div class="relative flex-grow">
                {{-- Add search field --}}
                @includeWhen(
                    data_get($tableOptions, 'search.show'),
                    BelichTables::include('sections.options.search')
                )
            </div>
        </div>

        {{-- Add all the filters --}}
        @includeWhen(
            isset($filters) && count($filters) > 0,
            BelichTables::include('sections.options.filters')
        )
    </div>

    {{-- Right side --}}
    <div class="flex">
        {{-- Add perpage selector --}}
        @includeWhen(
            data_get($tableOptions, 'perPage.show'),
            BelichTables::include('sections.options.perPage')
        )

        {{-- Add new resource button --}}
        @includeWhen(
            $tableOptions->get('newResource'),
            BelichTables::include('sections.options.new-resource')
        )

        {{-- Add export button --}}
        @includeWhen(
            $checkboxValues && data_get($tableOptions, 'export.selectedTotal') > 0,
            BelichTables::include('sections.options.export')
        )

        {{-- Add mass delete button (only if there is checkboxes checked) --}}
        @includeWhen(
            $checkboxValues,
            BelichTables::include('sections.options.bulk-delete')
        )
    </div>

</div>
