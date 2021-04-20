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
        app(FiltersToCollection::class)
            ->handle($this->filters())
            // Get each filter from the list
            ->each(function ($filter): void {
                // Get the value to filter
                $value = app(GetFilterValueFromView::class)->handle($filter, $this->filterValues);
                // Create the new query base on the filter
                if ($value) {
                    // Execute the filter from each table component defined by the user
                    $this->getFilterQuery($filter, $value);
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
     * Get filter query.
     */
    private function getFilterQuery(Collection $filter, string | array | null $value): Builder
    {
        // Get the filter name
        $filterName = $this->getFilterName($filter);

        // Preventing the filter from repeating
        if (! in_array($filterName, $this->queryKey)) {
            // Query unique key
            $this->queryKey[] = $filterName;
            // The filter will be executed directly, no need to return the model
            $this->sqlBuilder = $filter
                ->get('all')
                ->query($this->sqlBuilder, $value);
        }

        // The filter will be executed directly, no need to return the model
        return $this->sqlBuilder;
    }

    /**
     * Get filter name.
     */
    private function getFilterName(Collection $filter): ?string
    {
        return $filter?->get('name');
    }
}
