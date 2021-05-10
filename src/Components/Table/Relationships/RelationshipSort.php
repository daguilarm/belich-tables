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
        [$model, $order, $table] = $this->defaultRelationshipVariables($builder, $column);

        // Sort if relationship is: HasOne
        if ($model instanceof HasOne) {
            // HasOne relationship query
            $builder->join(
                table: $table,
                first: $model->getQualifiedForeignKeyName(),
                operator: '=',
                second: $model->getQualifiedParentKeyName(),
            );
        }

        // Sort if relationship is: BelongsTo
        if ($model instanceof BelongsTo) {
            // BelongsTo relationship query
            $builder->join(
                table: $table,
                first: $model->getRelated()->getQualifiedKeyName(),
                operator: '=',
                second: $model->getQualifiedOwnerKeyName(),
            );
        }

        return [
            $builder,
            $order,
        ];
    }

    /**
     * Set the default relationship variables.
     *
     * @return  array<string> [$model, $order, $table]
     */
    private function defaultRelationshipVariables(Builder $builder, Column $column): array
    {
        // Get default values
        $relationship = $this->getRelationship($column);
        $model = $builder->getRelation($relationship->name);
        $table = $model->getRelated()->getTable();
        $order = $this->getRelationshipOrderBy($table, $relationship->attribute);

        return [$model, $order, $table];
    }

    /**
     * Get relationship.
     */
    private function getRelationship(Column $column): object
    {
        $attribute = $column->getAttribute();

        return $this->relationship($attribute);
    }

    /**
     * Get relationship order by.
     */
    private function getRelationshipOrderBy(string $table, string $attribute): string
    {
        return sprintf(
            '%s.%s',
            $table,
            $attribute,
        );
    }
}
