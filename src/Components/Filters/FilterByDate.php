<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Components\Filters;

use Daguilarm\BelichTables\Components\FilterComponent;
use Daguilarm\BelichTables\Facades\BelichTables;
use Illuminate\Database\Eloquent\Builder;

final class FilterByDate extends FilterComponent
{
    /**
     * Create a new field.
     */
    public function __construct(?string $name = null)
    {
        parent::__construct($name);

        $this->view = BelichTables::include('sections.options.filters.date');
        $this->name = $name ?? 'date';
    }

    /**
     * Set the filter query.
     *
     * @param int | float | string | null $value
     */
    public function apply(Builder $model, $value): Builder
    {
        // Set default values
        $column = $this->getColumn($model);
        $start = $value['start'] ?? null;
        $end = $value['end'] ?? null;

        if ($start) {
            $model->whereDate($column, '>=', $start);
        }

        if ($end) {
            $model->whereDate($column, '<=', $end);
        }

        return $model;
    }

    /**
     * Set the filter query.
     *
     * @return  array<string>
     */
    public function options(): array
    {
        return [];
    }
}
