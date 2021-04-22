<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Components\Traits\Models;

use Daguilarm\BelichTables\Components\Traits\RelationshipsMethod;
use Daguilarm\BelichTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;

abstract class SearchBuilder
{
    use RelationshipsMethod;

    /**
     * Resolve the model search.
     *
     * @return Illuminate\Database\Eloquent\Builder | void
     */
    protected function searchBuilder(Builder $builder, object $column, ?string $search)
    {
        // The column is not searchable.
        if (! $column->isSearchable()) {
            return $builder;
        }

        // The column is callable.
        if ($this->columnIsCallable($column)) {
            return $this->modelSearchCallable($builder);
        }

        // The column has a relationship.
        if ($this->columnHasRealationship($column)) {

            // Get the relationship.
            $relationship = $this->relationship($column->getAttribute());

            // If has a relationship.
            $builder->orWhereHas($relationship->name, function (Builder $builder) use ($relationship, $search): void {
                // Search into the relationship.
                $builder->where($relationship->attribute, 'like', $this->searchString($search));
            });

        // Only search the column.
        } else {
            // Search into the column
            $builder->orWhere($this->columnAttribute($builder, $column), 'like', $this->searchString($search));
        }
    }

    /**
     * Check if the column is callable.
     */
    private function columnIsCallable(Column $column): bool
    {
        return is_callable($column->getSearchCallback());
    }

    /**
     * Check if the column has relationships.
     */
    private function columnHasRealationship(Column $column): bool
    {
        return str_contains($column->getAttribute(), '.');
    }

    /**
     * Get the column attribute.
     */
    private function columnAttribute(Builder $builder, Column $column): string
    {
        return sprintf(
            '%s.%s',
            $builder->getModel()->getTable(),
            $column->getAttribute()
        );
    }

    /**
     * Set the search string.
     */
    private function searchString(?string $search): string
    {
        return $search
            ? '%'.trim($search).'%'
            : '';
    }
}
