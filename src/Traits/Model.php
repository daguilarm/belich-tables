<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Traits;

use Daguilarm\LivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait Model
{
    /**
     * Set the model builder
     */
    public function models(): Builder
    {
        // Init the builder
        $builder = $this->query();

        // If the search is enabled and the search input is not empty...
        if ($this->searchEnabled && $this->searchString() !== '') {
            $builder = $this->modelSearch($builder);
        }

        // If the column is searchable
        if (($column = $this->getColumnByAttribute($this->sortField)) !== false && is_callable($column->getSortCallback())) {
            return app()
                ->call($column->getSortCallback(), [
                    'builder' => $builder,
                    'direction' => $this->sortDirection
                ]);
        }

        // Get the builder result
        return $builder->orderBy(
            $this->getSortField($builder),
            $this->sortDirection
        );
    }

    /**
     * Search the model
     */
    private function modelSearch(Builder $builder): Builder
    {
        return $builder->where(function (Builder $builder): void {
            foreach ($this->columns() as $column) {

                // The column is searchable
                if ($column->isSearchable()) {

                    // The column is callable
                    if ($this->columnIsCallable($column)) {

                        $builder = $this->modelSearchCallable($builder);

                    // The column has a relationship
                    } elseif ($this->columnHasRealationship($column)) {

                        // Get the relationship
                        $relationship = $this->relationship($column->getAttribute());

                        // If has a relationship
                        $builder->orWhereHas($relationship->name, function (Builder $builder) use ($relationship): void {

                            // Search into the relationship
                            $builder->where(
                                // Set the relationship attribute
                                $relationship->attribute,
                                // Search option
                                'like',
                                // The search value
                                $this->searchString()
                            );

                        });

                    // Only search the column
                    } else {
                        $builder->orWhere(
                            // Set the column attribute
                            $this->columnAttribute($builder, $column),
                            // Search option
                            'like',
                            // The search value
                            $this->searchString()
                        );
                    }
                }
            }
        });
    }

    /**
     * Callable model search
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
     * Check if the column is callable
     */
    private function columnIsCallable(Column $column): bool
    {
        return is_callable($column->getSearchCallback());
    }

    /**
     * Check if the column has relationships
     */
    private function columnHasRealationship(Column $column): bool
    {
        return Str::contains(
            $column->getAttribute(),
            '.'
        );
    }

    /**
     * Get the column attribute
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
     * Set the search string
     */
    private function searchString(): string
    {
        return '%' . trim($this->search) . '%';
    }
}
