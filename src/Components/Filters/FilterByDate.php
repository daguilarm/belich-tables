<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Components\Filters;

use Daguilarm\LivewireTables\Components\FilterComponent;
use Illuminate\Database\Eloquent\Builder;

final class FilterByDate extends FilterComponent
{
    /**
     * Create a new field.
     */
    public function __construct(?string $name = null)
    {
        parent::__construct($name);

        $this->view = 'livewire-tables::'.config('livewire-tables.theme').'.includes.options.filters.date';
        $this->name = $name ?? 'date';
    }

    /**
     * Set the filter query.
     *
     * @param string | array | null $value
     */
    public function query(Builder $model, $value): Builder
    {
        if (isset($value['start'])) {
            $model->whereDate($this->tableColumn, '>=', $value['start']);
        }

        if (isset($value['end'])) {
            $model->whereDate($this->tableColumn, '<=', $value['end']);
        }

        return $model;
    }

    /**
     * Set the filter query.
     */
    public function values(): array
    {
        return [];
    }
}
