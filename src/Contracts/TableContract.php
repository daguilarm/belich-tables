<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface TableContract
{
    /**
     * Set the columns.
     *
     * @return  array<string>
     */
    public function columns(): array;

    /**
     * Set the filters.
     *
     * @return  array<string>
     */
    public function filters(): array;

    /**
     * Set the query builder.
     */
    public function query(): Builder;
}
