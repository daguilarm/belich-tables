<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Components\Traits;

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
        $this->renderFilter()
            ->each(function ($filter): void {
                // Get the value to filter
                $filterValue = $this->getFilterValue($filter);
                // Create the new query base on the filter
                if ($filterValue) {
                    // Execute the filter from each table component defined by the user
                    $this->getFilterQuery($filter, $filterValue);
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
     * Render the filters for the views.
     */
    private function renderFilter(): Collection
    {
        return collect($this->filters())
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

    /**
     * Get filter value.
     */
    private function getFilterValue(Collection $filter): string | array | null
    {
        // Get the filter name
        $filterName = $filter?->get('name');
        // Get the filter value
        $value = $this->filterValues[$filterName] ?? null;

        // Get the filter value
        return $filterName && $value
            ? $this->filterValues[$filterName]
            : null;
    }

    /**
     * Get filter query.
     */
    private function getFilterQuery(Collection $filter, string | array | null $value): Builder
    {
        // The filter will be executed directly, no need to return the model
        return $filter
            ->get('all')
            ->query($this->models(), $value);
    }
}
