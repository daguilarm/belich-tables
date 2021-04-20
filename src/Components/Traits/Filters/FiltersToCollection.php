<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Components\Traits\Filters;

use Illuminate\Support\Collection;

class FiltersToCollection
{
    /**
     * Convert all the filters into a collection of filters.
     *
     * @param array<string> $filters
     */
    public function handle(array $filters): Collection
    {
        return collect($filters)
            ->map(static function ($filter) {
                return collect([
                    // Set the value to be rendered in the view
                    'all' => $filter,
                    'name' => $filter->name,
                    'view' => $filter->view,
                    'values' => $filter->values(),
                ]);
            })
            ->filter();
    }
}
