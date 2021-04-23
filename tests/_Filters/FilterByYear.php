<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Tests\_Filters;

use Daguilarm\BelichTables\Components\FilterComponent;
use Daguilarm\BelichTables\Facades\BelichTables;
use Illuminate\Database\Eloquent\Builder;

final class FilterByYear extends FilterComponent
{
    /**
     * Create a new field.
     */
    public function __construct(?string $name = null)
    {
        parent::__construct($name);

        $this->view = BelichTables::include('includes.options.filters.year');
        $this->name = $name ?? 'year';
    }

    /**
     * Set the filter query.
     *
     * @param int | float | string | null $value
     */
    public function apply(Builder $model, $value): Builder
    {
        return $model
            ->whereYear($this->getColumn($model), $value);
    }

    /**
     * Set the filter query.
     *
     * @return  array<string>
     */
    public function options(): array
    {
        return range(
            date('Y'),
            date('Y') - 10
        );
    }
}
