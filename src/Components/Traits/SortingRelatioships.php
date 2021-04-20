<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Components\Traits;

use Daguilarm\LivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

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
            // Preventing the query from repeating
            $builder = $this->uniqueQuery(
                builder: $builder,
                key: $sortAttribute,
                table: $relationshipTable,
                first: $model->getQualifiedForeignKeyName(),
                second: $model->getQualifiedParentKeyName(),
            );
        }

        // Sort if relationship is: BelongsTo
        if ($model instanceof BelongsTo) {
            // Preventing the query from repeating
            $builder = $this->uniqueQuery(
                builder: $builder,
                key: $sortAttribute,
                table: $relationshipTable,
                first: $model->getRelated()->getQualifiedKeyName(),
                second: $model->getQualifiedOwnerKeyName(),
            );
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
        // Set values
        $relationship = $this->relationship($column->getAttribute());
        $relationshipName = $relationship->name;
        // Get values
        $relationshipTable = Str::of($relationshipName)->plural();
        $model = $builder->getRelation($relationshipName);
        $sortAttribute = sprintf('%s.%s', $relationshipTable, $relationship->attribute);

        return [
            $relationshipTable,
            $model,
            $sortAttribute,
        ];
    }
}
