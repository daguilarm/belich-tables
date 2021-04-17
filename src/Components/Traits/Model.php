<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Components\Traits;

use Daguilarm\LivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;

trait Model
{
    /**
     * Set the model builder.
     */
    public function models(): Builder
    {
        // Init the builder passing (in first place) the filters.
        // This came from \Daguilarm\LivewireTables\Traits\Filters::resolveFilters().
        $builder = $this->sqlFilterBuilder;

        // If the search is enabled and the search input is not empty.
        if ($this->showSearch && $this->searchString() !== '') {
            $builder = $this->modelSearch($builder);
        }

        // If the column is searchable.
        $column = $this->getColumnByAttribute($this->sortField);

        if ($column !== false && is_callable($column->getSortCallback())) {
            return app()->call($column->getSortCallback(), [
                'builder' => $builder,
                'direction' => $this->sortDirection,
            ]);
        }

        // Get the builder result.
        return $builder->orderBy(
            $this->getSortField($builder),
            $this->sortDirection
        );
    }

    /**
     * Get current model class.
     */
    public function getModelClass(): string
    {
        return get_class(
            $this->models()->getModel()
        );
    }

    /**
     * Search the model.
     */
    private function modelSearch(Builder $builder): Builder
    {
        // Search in each column through all the options
        return $builder->where(function (Builder $builder): void {
            foreach ($this->columns() as $column) {
                // Search for each column
                $this->modelSearchResolve($builder, $column);
            }
        });
    }

    /**
     * Resolve the model search.
     *
     * @return Illuminate\Database\Eloquent\Builder | void
     */
    private function modelSearchResolve(Builder $builder, object $column)
    {
        // The column is searchable.
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
            $builder->orWhereHas($relationship->name, function (Builder $builder) use ($relationship): void {

                // Search into the relationship.
                $builder->where(
                    // Set the relationship attribute.
                    $relationship->attribute,
                    // Search option.
                    'like',
                    // The search value.
                    $this->searchString()
                );
            });

        // Only search the column.
        } else {
            $builder->orWhere(
                // Set the column attribute.
                $this->columnAttribute($builder, $column),
                // Search option.
                'like',
                // The search value.
                $this->searchString()
            );
        }
    }

    /**
     * Callable model search.
     */
    private function modelSearchCallable(Builder $builder): Builder
    {
        return app()->call(
            $column->getSearchCallback(),
            [
                'builder' => $builder,
                'term' => $this->searchString(),
            ]
        );
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
        return str_contains(
            $column->getAttribute(),
            '.'
        );
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
    private function searchString(): string
    {
        return '%'.trim($this->search).'%';
    }
}
