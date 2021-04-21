<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Components\Traits;

use Daguilarm\LivewireTables\Components\Traits\Models\Search;
use Daguilarm\LivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;

trait Model
{
    /**
     * Set the model builder.
     */
    public function models(): Builder
    {
        // Resolve the filters
        $this->resolveFilters();

        // Initialize the constructor
        $builder = $this->sqlBuilder;

        // Get the default sort attribute
        $sortAttribute = $this->getSortAttribute($builder);

        // Get the column.
        $column = $this->getColumnByAttribute($this->sortField);

        // Initialize the search
        // @See Daguilarm\LivewireTables\Components\Traits\Models\Search:class
        $search = new Search();

        // If the search is enabled, and the search input is not empty, then the search can start.
        $builder = $search->handle(
            builder: $builder,
            columns: $this->columns(),
            search: $this->search,
            showSearch: $this->showSearch,
        );

        // // If the column is callable
        // if ($column !== false && is_callable($column->getSortCallback())) {
        //     $search->columnCallback(
        //         builder: $builder,
        //         column: $column,
        //         direction: $this->sortDirection
        //     );
        // }

        // Sort by relationship [Daguilarm\LivewireTables\Components\Traits\SortingRelatioships]
        if ($this->columnHasRealationship($column)) {
            [$builder, $sortAttribute] = $this->sortingByRelationship($builder, $column);
        }

        // Get the final result.
        return $builder->reorder($sortAttribute, $this->sortDirection);
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
     * Get current model instance.
     */
    public function getModel(): object
    {
        return app($this->getModelClass());
    }

    /**
     * Set the sort attribute.
     */
    private function getSortAttribute(Builder $builder): string
    {
        $tableName = $builder->getQuery()->from;

        return sprintf('%s.%s', $tableName, $this->getSortField($builder));
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
}
