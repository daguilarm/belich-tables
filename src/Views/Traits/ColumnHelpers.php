<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Views\Traits;

trait ColumnHelpers
{
    /**
     * Check if the column has a relationship.
     */
    public function hasRealationship(): bool
    {
        return str_contains($this->getAttribute(), '.');
    }

    /**
     * Check if the column is callable.
     */
    public function isCallable(): bool
    {
        return is_callable($this->getSearchCallback());
    }

    /**
     * Get the column attribute.
     */
    public function getAttribute(Builder $builder): string
    {
        return sprintf(
            '%s.%s',
            $builder->getModel()->getTable(),
            $this->getAttribute(),
        );
    }
}
