<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Components\Traits\Models;

// use Daguilarm\BelichTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;

final class Search extends SearchBuilder
{
    /**
     * Search in all the selected columns.
     *
     * @param array<string> $columns
     */
    public function handle(Builder $builder, array $columns, ?string $search, bool $showSearch): Builder
    {
        // If there is a search...
        if ($showSearch && $search) {
            // Start the search
            return $builder
                // Search the columns
                ->where(function (Builder $builder) use ($columns, $search): void {
                    foreach ($columns as $column) {
                        // Search in each column
                        $this->searchBuilder($builder, $column, $search);
                    }
                });
        }

        return $builder;
    }

    // /**
    //  * Resolve the column callback.
    //  */
    // public function columnCallback(Builder $builder, Column $column, string $direction): object
    // {
    //     return app()->call($column->getSortCallback(), [
    //         'builder' => $builder,
    //         'direction' => $direction,
    //     ]);
    // }
}
