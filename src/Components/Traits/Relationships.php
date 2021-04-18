<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Components\Traits;

use Daguilarm\LivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;

trait Relationships
{
    /**
     * Set relationship.
     */
    public function relationship(string $attribute): object
    {
        $parts = explode('.', $attribute);

        return (object) [
            'attribute' => array_pop($parts),
            'name' => implode('.', $parts),
        ];
    }

    /**
     * Set atribute.
     */
    public function attribute(Builder $query, string $relationships, string $attribute): string
    {
        // Set the default values
        [$baseQuery, $table] = $this->getDefaultValues($query);

        foreach (explode('.', $relationships) as $relationship) {

            // Default model
            $model = $baseQuery->getRelation($relationship);

            // Values base on the relationship type
            [$table, $foreign, $other, $baseQuery, $query] = match($model) {
                $model instanceof BelongsToMany => $this->BelongsToMany($model, $baseQuery, $query),
                $model instanceof HasOneOrMany => $this->getHasOneOrMany($model, $baseQuery, $query),
                $model instanceof BelongsTo => $this->getBelongsTo($model, $baseQuery, $query),
                default => $this->getNullRelationship(),
            };

            // Null relationship
            if ($query === null) {
                return $attribute;
            }

            // Set the query values
            $query->leftJoin($table, $foreign, $other);
            $baseQuery = $model->getQuery();
        }

        return $table.'.'.$attribute;
    }

    /**
     * Get the column attribute.
     */
    protected function getColumnByAttribute(string $attribute): Column | bool
    {
        foreach ($this->columns() as $column) {
            if ($column->getAttribute() === $attribute) {
                return $column;
            }
        }

        return false;
    }

    /**
     * Get the default values.
     *
     * @return array<string>
     */
    private function getDefaultValues(Builder $query): array
    {
        return [$query, ''];
    }

    /**
     * Get the values for a BelongsToMany realtionship.
     *
     * @return array<string>
     */
    private function BelongsToMany(BelongsToMany $model, Builder $baseQuery, Builder $query): array
    {
        $pivot = $model->getTable();
        $pivotPK = $model->getExistenceCompareKey();
        $pivotFK = $model->getQualifiedParentKeyName();
        $query->leftJoin($pivot, $pivotPK, $pivotFK);

        $related = $model->getRelated();
        $table = $related->getTable();
        $tablePK = $related->getForeignKey();
        $foreign = $pivot.'.'.$tablePK;
        $other = $related->getQualifiedKeyName();

        $baseQuery->addSelect($table.'.'.$attribute);
        $query->leftJoin($table, $foreign, $other);

        return [
            $table,
            $foreign,
            $other,
            $baseQuery,
            $query,
        ];
    }

    /**
     * Get the values for a HasOne or HasMany realtionship.
     *
     * @return array<string>
     */
    private function getHasOneOrMany(HasOneOrMany $model, Builder $baseQuery, Builder $query): array
    {
        return [
            $model->getRelated()->getTable(),
            $model->getQualifiedForeignKeyName(),
            $model->getQualifiedParentKeyName(),
            $baseQuery,
            $query,
        ];
    }

    /**
     * Get the values for a BelongsTo realtionship.
     *
     * @return array<string>
     */
    private function getBelongsTo(BelongsTo $model, Builder $baseQuery, Builder $query): array
    {
        return [
            $model->getRelated()->getTable(),
            $model->getQualifiedForeignKeyName(),
            $model->getQualifiedOwnerKeyName(),
            $baseQuery,
            $query,
        ];
    }

    /**
     * Get the values for a null realtionship.
     */
    private function getNullRelationship()
    {
        return [null, null, null, null, null];
    }
}
