<div class="pb-3 flex items-center justify-between">
    <div class="flex mt-3">
        <div class="flex rounded-md">
            <div class="relative flex-grow">
                <!-- Add search field -->
                @includeWhen(
                    $showSearch,
                    'livewire-tables::'.config('livewire-tables.theme').'.includes.options.search'
                )
            </div>
        </div>

        <!-- Add all the filters -->
        @includeWhen(
            isset($filters) && count($filters) > 0,
            'livewire-tables::'.config('livewire-tables.theme').'.includes.options.filters'
        )
    </div>
    <div class="flex">
        <!-- Add perpage selector -->
        @includeWhen(
            $showPerPage,
            'livewire-tables::'.config('livewire-tables.theme').'.includes.options.perPage'
        )

        <!-- Add new resource button -->
        @includeWhen(
            $newResource,
            'livewire-tables::'.config('livewire-tables.theme').'.includes.options.new-resource'
        )

        <!-- Add export button -->
        @includeWhen(
            $checkboxValues && count($exports) > 0,
            'livewire-tables::'.config('livewire-tables.theme').'.includes.options.export'
        )

        <!-- Add mass delete button (only if there is checkboxes checked) -->
        @includeWhen(
            $checkboxValues,
            'livewire-tables::'.config('livewire-tables.theme').'.includes.options.mass-delete'
        )
    </div>
</div>
