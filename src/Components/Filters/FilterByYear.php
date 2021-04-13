<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Components\Filters;

use Daguilarm\LivewireTables\Components\FilterComponent;

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
     * Set the filter query
     */
    function query()
    {
        return $this->model::Query()
            ->whereYear($this->tableColumn, $this->value)
            ->get();
    }
}
