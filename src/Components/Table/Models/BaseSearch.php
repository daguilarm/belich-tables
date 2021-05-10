<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Components\Table\Models;

use Daguilarm\BelichTables\Components\Table\Relationships\RelationshipValue;
use Daguilarm\BelichTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;

abstract class BaseSearch
{
    use RelationshipValue;

    /**
     * Resolve the model search.
     *
     * @return Illuminate\Database\Eloquent\Builder | void
     */
    protected function searchBuilder(Builder $builder, object $column, ?string $search)
    {
        /**
         * The column is not searchable.
         * @see Daguilarm\BelichTables\Views\Traits\ColumnHelpers
         */
        if (! $column->isSearchable()) {
            return $builder;
        }

        /**
         * The column is callable.
         * @see Daguilarm\BelichTables\Views\Traits\ColumnHelpers
         */
        if ($column->isCallable()) {
            return $this->modelSearchCallable($builder);
        }

        /**
         * The column has a relationship.
         * @see Daguilarm\BelichTables\Views\Traits\ColumnHelpers
         */
        if ($column->hasRealationship()) {
            // Get the relationship.
            $relationship = $this->relationship($column->getAttribute());

            // If has a relationship.
            $builder->orWhereHas($relationship->name, function (Builder $builder) use ($relationship, $search): void {
                // Search into the relationship.
                $builder->where(
                    $relationship->attribute,
                    'like',
                    $this->searchString($search),
                );
            });

        // Only search the column.
        } else {
            /**
             * Search into the column.
             * @see Daguilarm\BelichTables\Views\Traits\ColumnHelpers
             */
            $builder->orWhere(
                $column->getAttribute($builder),
                'like',
                $this->searchString($search),
            );
        }
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
