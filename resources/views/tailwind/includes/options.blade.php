<div class="pb-3 flex items-center justify-between">

    <!-- Left side -->
    <div class="flex mt-3">
        <div class="flex rounded-md">
            <div class="relative flex-grow">
                <!-- Add search field -->
                @includeWhen($showSearch, LivewireTables::include('includes.options.search'))
            </div>
        </div>

        <!-- Add all the filters -->
        @includeWhen(isset($filters) && count($filters) > 0, LivewireTables::include('includes.options.filters'))
    </div>

    <!-- Right side -->
    <div class="flex">
        <!-- Add perpage selector -->
        @includeWhen($showPerPage, LivewireTables::include('includes.options.perPage'))

        <!-- Add new resource button -->
        @includeWhen($newResource, LivewireTables::include('includes.options.new-resource'))

        <!-- Add export button -->
        @includeWhen($checkboxValues && count($exports) > 0, LivewireTables::include('includes.options.export'))

        <!-- Add mass delete button (only if there is checkboxes checked) -->
        @includeWhen($checkboxValues, LivewireTables::include('includes.options.bulk-delete'))
    </div>

</div>
