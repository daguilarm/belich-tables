<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Components\Filters;

use Daguilarm\LivewireTables\Components\FilterComponent;
use Illuminate\Database\Eloquent\Builder;

final class FilterByYear extends FilterComponent
{
    /**
     * Create a new field.
     */
    public function __construct(?string $name = null)
    {
        parent::__construct($name);

        $this->view = 'livewire-tables::'.config('livewire-tables.theme').'.includes.options.filters.year';
        $this->name = $name ?? 'year';
    }

    /**
     * Set the filter query.
     *
     * @param string | array | null $value
     */
    public function query(Builder $model, $value): Builder
    {
        return $model->whereYear($this->tableColumn, $value);
    }

    /**
     * Set the filter query.
     */
    public function values(): array
    {
        return range(
            date('Y'),
            date('Y') - 10
        );
    }
}
