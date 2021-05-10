<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Components\Table;

trait Sorting
{
    /**
     * The initial field to be sorting by.
     */
    protected string $sortField = 'id';

    /**
     * The initial direction to sort.
     */
    protected string $sortDirection = 'asc';

    /**
     * Sorting columns.
     */
    public function orderBy(string $attribute, string $direction): void
    {
        $this->sortField = $attribute;
        $this->sortDirection = $this->toogleDirection($direction);
    }

    /**
     * Sorting field.
     */
    public function getSortField(): string
    {
        return $this->sortField;
    }

    /**
     * Sorting direction.
     */
    public function getSortDirection(): string
    {
        return $this->sortDirection;
    }

    /**
     * Update order.
     */
    private function toogleDirection(string $direction): string
    {
        return $direction === 'asc'
            ? 'desc'
            : 'asc';
    }
}
