<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Components\Filters;

use Daguilarm\LivewireTables\Components\FilterComponent;
use Illuminate\Database\Eloquent\Builder;

class FilterByYear extends FilterComponent
{
    /**
     * Create a new field.
     */
    public function __construct($name)
    {
        parent::__construct($name);

        $this->view = 'livewire-tables::'.config('livewire-tables.theme').'.includes.options.filters.year';
    }

    /**
     * Set the filter query.
     */
    public function query(Builder $model, ?string $value): Builder
    {
        return $model
            ->whereYear($this->tableColumn, $value);
    }

    /**
     * Set the filter query.
     */
    public function values()
    {
        return range(
            date('Y'),
            date('Y') - 10
        );
    }
}
