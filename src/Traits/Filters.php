<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Traits;

trait Filters
{
    /**
     * List of filters.
     */
    public array $filters = [];

    /**
     * Store the filter's values.
     */
    public array $filterValues = [];

    /**
     * Resolve fields.
     */
    private function resolveFilters(): object
    {
        $model = $this->models();

        foreach ($this->filters as $items) {
            [$filter, $field] = array_values($items);
            $value = $this->filterValues[$filter] ?? null;

            if ($value) {
                $model = ($filter === 'date')
                    ? $this->filterByDate($value, $field, $model)
                    : $model->where($field, $value);
            }
        }

        return $model;
    }

    /**
     * Filter by date.
     */
    private function filterByDate($value, $field, $model): object
    {
        if (isset($value['start'])) {
            $model = $model
                ->whereDate($field, '>=', $value['start']);
        }

        if (isset($value['end'])) {
            $model = $model
                ->whereDate($field, '<=', $value['end']);
        }

        return $model;
    }

    /**
     * Reset all the filters.
     */
    public function resetAllFilters(): void
    {
        $this->filterValues = [];
        $this->search = '';
    }
}
