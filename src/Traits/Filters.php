<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

trait Filters
{
    /**
     * Filter values.
     */
    public array $filterValues = [];

    /**
     * Resolve filters.
     */
    public function resolveFilters()
    {
        $model = $this->models();

        foreach($this->renderFilter() as $filter) {
            $value = $this->filterValues[$filter->get('name')] ?? null;
            if($value) {
                $model = $filter->get('filter')->query(
                    model: $this->models(),
                    value: $value,
                );
            }
        }

        return $model;
    }

    /**
     * Render the filters for the views
     */
    public function renderFilter(): Collection
    {
        return collect($this->filters())
            ->map(function($filter) {
                return collect([
                    'filter' => $filter,
                    'name' => $filter->name,
                    'view' => $filter->view,
                    'values' => $filter->values(),
                ]);
            })
            ->filter();
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
     * Get filter value
     */
    private function getFilterValue(string $filterName)
    {
        return $this->filterValues[$filterName] ?? null;
    }
}
