<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Components\Filters;

use Daguilarm\LivewireTables\Components\FilterComponent;
use Daguilarm\LivewireTables\Facades\LivewireTables;
use Illuminate\Database\Eloquent\Builder;

final class FilterByYear extends FilterComponent
{
    /**
     * Create a new field.
     */
    public function __construct(?string $name = null)
    {
        parent::__construct($name);

        $this->view = LivewireTables::include('includes.options.filters.year');
        $this->name = $name ?? 'year';
    }

    /**
     * Set the filter query.
     *
     * @param int | float | string | null $value
     */
    public function query(Builder $model, $value): Builder
    {
        return $model
            ->whereYear($this->getColumn($model), $value);
    }

    /**
     * Set the filter query.
     *
     * @return  array<string>
     */
    public function values(): array
    {
        return range(
            date('Y'),
            date('Y') - 10
        );
    }
}
