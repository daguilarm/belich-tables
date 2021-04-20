<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Components\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Stringable;

trait UniqueQuery
{
    /**
     * @var array<string>
     */
    protected array $queryKey = [];

    /**
     * Preventing the query from repeating
     */
    private function uniqueQuery(Builder $builder, string $key, string | Stringable $table, string $first, string $second, string $operator = '='): Builder
    {
        // Check if the query exists
        if (! in_array($key, $this->queryKey)) {
            // Sete the query unique key
            $this->queryKey[] = $key;
            // Sorting result
            return $builder->join(
                $table,
                $first,
                $operator,
                $second
            );
        }
    }
}
