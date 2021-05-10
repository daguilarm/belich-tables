<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Views\Traits;

use Illuminate\Support\Str;

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

    /**
     * Resolve the column callback.
     */
    public function callback(Builder $builder, string $direction): object
    {
        return app()->call($this->getSortCallback(), [
            'builder' => $builder,
            'direction' => $direction,
        ]);
    }

    /**
     * Get the column name.
     */
    public function getName(): string
    {
        return Str::lower($this->getText());
    }
}
