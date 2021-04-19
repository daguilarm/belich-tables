<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Components\Traits;

use Daguilarm\LivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

trait SortingRelatioships
{
    /**
     * @var array<string>
     */
    protected array $queryKey = [];

    /**
     * Sort table base on relationship.
     *
     * @return  array<string> [$builder, $sortAttribute]
     */
    public function sortingByRelationship(Builder $builder, Column $column): array
    {
        // Get the relationship default variables
        [$relationshipTable, $model, $sortAttribute] = $this->defaultRelationshipVariables($builder, $column);

        // Sort if relationship is: HasOne
        if ($model instanceof HasOne) {
            // Preventing the filter from repeating
            if (! in_array($sortAttribute, $this->queryKey)) {
                // Query unique key
                $this->queryKey[] = $sortAttribute;
                // Sorting result
                $builder->join($relationshipTable, $model->getQualifiedForeignKeyName(), '=', $model->getQualifiedParentKeyName());
            }
        }

        // Sort if relationship is: BelongsTo
        if ($model instanceof BelongsTo) {
            // Preventing the filter from repeating
            if (! in_array($sortAttribute, $this->queryKey)) {
                // Query unique key
                $this->queryKey[] = $sortAttribute;
                // Sorting result
                $builder->join($relationshipTable, $model->getRelated()->getQualifiedKeyName(), '=', $model->getQualifiedOwnerKeyName());
            }
        }

        return [
            $builder,
            $sortAttribute,
        ];
    }

    /**
     * Set the default relationship variables.
     *
     * @return  array<string> [$relationshipTable, $model, $sortAttribute]
     */
    private function defaultRelationshipVariables(Builder $builder, Column $column): array
    {
        $relationship = $this->relationship($column->getAttribute());
        $relationshipName = $relationship->name;
        $relationshipTable = Str::of($relationshipName)->plural();

        return [
            $relationshipTable,
            $builder->getRelation($relationshipName),
            sprintf('%s.%s', $relationshipTable, $relationship->attribute),
        ];
    }
}
