<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Traits;

trait Table
{
    /**
     * Whether or not to display the table header.
     */
    public bool $tableHeaderEnabled = true;

    /**
     * Whether or not to display the table footer.
     */
    public bool $tableFooterEnabled = false;

    /**
     * Set the custom table head ID.
     */
    public function setTableHeadId(?string $attribute): ?string
    {
        return null;
    }

    /**
     * Set the the custom table head attributes.
     */
    public function setTableHeadAttributes(string|array $attribute): array
    {
        return [];
    }

    /**
     * Set the custom table row ID.
     */
    public function setTableRowId(?string $model): ?string
    {
        return null;
    }

    /**
     * Set the the custom table row attributes.
     */
    public function setTableRowAttributes(string|array $model): array
    {
        return [];
    }

    /**
     * Set the the custom table row url.
     */
    public function getTableRowUrl(?string $model): ?string
    {
        return null;
    }

    public function setTableDataId($attribute, $value): ?string
    {
        return null;
    }

    /**
     * @param $attribute
     * @param $value
     *
     * @return array
     */
    public function setTableDataAttributes($attribute, $value): array
    {
        return [];
    }
}
