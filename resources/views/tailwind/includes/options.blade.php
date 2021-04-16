<div class="pb-3 sm:flex sm:items-center sm:justify-between">
    <div class="flex sm:mt-3">
        <div class="flex rounded-md">
            <div class="relative flex-grow">
                <!-- Add search field -->
                @includeWhen(
                    $searchEnabled,
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
            $paginationEnabled && count($perPageOptions),
            'livewire-tables::'.config('livewire-tables.theme').'.includes.options.perPage'
        )

        <!-- Add new resource button -->
        @includeWhen(
            $newResource,
            'livewire-tables::'.config('livewire-tables.theme').'.includes.options.new-resource'
        )

        <!-- Add export button -->
        @includeWhen(
            count($exports) > 0,
            'livewire-tables::'.config('livewire-tables.theme').'.includes.options.export'
        )

        <!-- Add mass delete button (only if there is checkboxes checked) -->
        @includeWhen(
            $checkboxValues,
            'livewire-tables::'.config('livewire-tables.theme').'.includes.options.mass-delete'
        )
    </div>
</div>
