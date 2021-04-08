<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait Sorting
{
    /**
     * Sorting.
     */

    /**
     * The initial field to be sorting by.
     */
    public string $sortField = 'id';

    /**
     * The initial direction to sort.
     */
    public string $sortDirection = 'asc';

    /**
     * The default sort icon.
     */
    public string $sortDefaultIcon = '<i class="text-muted fas fa-sort"></i>';

    /**
     * The sort icon when currently sorting ascending.
     */
    public string $ascSortIcon = '<i class="fas fa-sort-up"></i>';

    /**
     * The sort icon when currently sorting descending.
     */
    public string $descSortIcon = '<i class="fas fa-sort-down"></i>';

    /**
     * Sorting columns
     */
    public function sort($attribute): void
    {
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';

        if ($this->sortField !== $attribute) {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $attribute;
    }

    /**
     * Sorting field
     */
    protected function getSortField(Builder $builder): string
    {
        if (Str::contains($this->sortField, '.')) {
            $relationship = $this->relationship($this->sortField);

            return $this->attribute($builder, $relationship->name, $relationship->attribute);
        }

        return $this->sortField;
    }
}
