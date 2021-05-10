<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Components\Table\Relationships;

use Daguilarm\BelichTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

trait RelationshipSort
{
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
            // HasOne relationship query
            $builder->join(
                table: $relationshipTable,
                first: $model->getQualifiedForeignKeyName(),
                operator: '=',
                second: $model->getQualifiedParentKeyName(),
            );
        }

        // Sort if relationship is: BelongsTo
        if ($model instanceof BelongsTo) {
            // BelongsTo relationship query
            $builder->join(
                table: $relationshipTable,
                first: $model->getRelated()->getQualifiedKeyName(),
                operator: '=',
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
        // Get default values
        $relationship = $this->getRelationship($column);
        $relationshipName = $this->getRelationshipName($relationship);

        return [
            $relationshipTable = $this->getRelationshipTable($relationshipName),
            $model = $builder->getRelation($relationshipName),
            $orderBy = $this->getRelationshipOrderBy($relationship),
        ];
    }

    /**
     * Get relationship.
     */
    private function getRelationship(Column $column): object
    {
        return $this->relationship($column->getAttribute());
    }

    /**
     * Get relationship name.
     */
    private function getRelationshipName(object $relationship): string
    {
        return $relationship->name;
    }

    /**
     * Get relationship table.
     */
    private function getRelationshipTable(string $relationshipName): string
    {
        return Str::of($relationshipName)->plural()->__toString();
    }

    /**
     * Get relationship order by.
     */
    private function getRelationshipOrderBy(object $relationship): string
    {
        return sprintf(
            '%s.%s',
            $this->getRelationshipTable($relationship->name),
            $relationship->attribute,
        );
    }
}
