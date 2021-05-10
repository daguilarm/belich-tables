<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Components\Table;

use Illuminate\Database\Eloquent\Builder;

trait Sorting
{
    /**
     * The initial field to be sorting by.
     */
    public string $sortField = 'id';

    /**
     * The initial direction to sort.
     */
    public string $sortDirection = 'asc';

    /**
     * Sorting columns.
     */
    public function orderBy(string $attribute): void
    {
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';

        if ($this->sortField !== $attribute) {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $attribute;
    }
}
