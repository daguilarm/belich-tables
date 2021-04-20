<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Components\Traits;

use Daguilarm\LivewireTables\Components\Traits\Filters\FiltersToCollection;
use Daguilarm\LivewireTables\Components\Traits\Filters\GetFilterValueFromView;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

trait Filters
{
    /**
     * Filter values.
     *
     * @var array<string>
     */
    public array $filterValues = [];

    /**
     * Resolve filters.
     * The magic will happend in \Daguilarm\LivewireTables\Traits\Model::models().
     */
    public function resolveFilters(): void
    {
        // Convert all the filters in a collection
        $this->filtersAsCollection()
            // Get each filter from the list
            ->each(function ($filter): void {
                // Get the value to filter
                $value =  $this->getFilterValue($filter);
                // Create the new query base on the filter
                if ($value) {
                    // Execute the filter from each table component defined by the user
                    $filter->query($this->sqlBuilder, $value);
                }
            });
    }

    /**
     * Reset all the filters.
     */
    public function resetAllFilters(): void
    {
        $this->filterValues = [];
        $this->search = '';
    }

    /**
     * Collect all the filters.
     */
    private function filtersAsCollection(): Collection
    {
        return collect($this->filters());
    }

    /**
     * Get filter name.
     */
    private function getFilterValue(object $filter): ?string
    {
        return $this->filterValues[$filter->name] ?? null;
    }
}
