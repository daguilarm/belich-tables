<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Components\Table\Relationships;

trait RelationshipValue
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
}
