<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Components\Filters;

use Daguilarm\LivewireTables\Components\FilterComponent;
use Daguilarm\LivewireTables\Facades\LivewireTables;
use Illuminate\Database\Eloquent\Builder;

final class FilterByDate extends FilterComponent
{
    /**
     * Create a new field.
     */
    public function __construct(?string $name = null)
    {
        parent::__construct($name);

        $this->view = LivewireTables::include('includes.options.filters.date');
        $this->name = $name ?? 'date';
    }

    /**
     * Set the filter query.
     *
     * @param int | float | string | null $value
     */
    public function apply(Builder $model, $value): Builder
    {
        if (isset($value['start'])) {
            $model->whereDate($this->getColumn($model), '>=', $value['start']);
        }

        if (isset($value['end'])) {
            $model->whereDate($this->getColumn($model), '<=', $value['end']);
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
