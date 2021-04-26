<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface FilterContract {
    /**
     * Set the filter query.
     *
     * @param bool | int | float | string | null $value
     */
    public function apply(Builder $model, $value): Builder;

    /**
     * Sent values for the view.
     *
     * @return  array<string>
     */
    public function options(): array;
}
