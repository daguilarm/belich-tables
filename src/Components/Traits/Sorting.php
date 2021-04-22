<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Components\Traits;

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

    /**
     * Sorting field.
     */
    protected function getSortField(Builder $builder): string
    {
        if (str_contains($this->sortField, '.')) {
            $relationship = $this->relationship($this->sortField);

            return $this->attribute(
                $builder,
                $relationship->name,
                $relationship->attribute
            );
        }

        return $this->sortField;
    }
}
