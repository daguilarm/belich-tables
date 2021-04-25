<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Components\Traits;

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
     * The magic will happend in \Daguilarm\BelichTables\Traits\Model::models().
     */
    public function resolveFilters(): void
    {
        // Convert all the filters in a collection
        $this->filtersAsCollection()
            // Get each filter from the list
            ->each(function ($filter): void {
                // Get the value to filter
                $value = $this->getFilterValue($filter);
                // Create the new query base on the filter
                if ($value) {
                    // Execute the filter from each table component defined by the user
                    $filter->apply($this->sqlBuilder, $value);
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
     *
     * @return bool | string | array<string> | null
     */
    private function getFilterValue(object $filter): bool | string | array | null
    {
        return $this->filterValues[$filter->uriKey] ?? null;
    }
}
