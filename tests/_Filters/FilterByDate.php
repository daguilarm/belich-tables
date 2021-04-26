<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Tests\_Filters;

use Daguilarm\BelichTables\Components\FilterComponent;
use Daguilarm\BelichTables\Contracts\FilterContract;
use Daguilarm\BelichTables\Facades\BelichTables;
use Illuminate\Database\Eloquent\Builder;

final class FilterByDate extends FilterComponent implements FilterContract
{
    /**
     * Create a new field.
     */
    public function __construct(?string $uriKey = null)
    {
        parent::__construct($uriKey);

        $this->view = BelichTables::include('includes.options.filters.date');
        $this->uriKey = $uriKey ?? 'date';
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
