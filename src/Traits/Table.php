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
     * Set table head class
     */
    public function setTableHeadClass(?string $attribute): ?string
    {
        return null;
    }

    /**
     * Set table head ID
     */
    public function setTableHeadId(?string $attribute): ?string
    {
        return null;
    }

    /**
     * @param $attribute
     *
     * @return array|null
     */
    public function setTableHeadAttributes($attribute): array
    {
        return [];
    }

    public function setTableRowClass($model): ?string
    {
        return null;
    }

    public function setTableRowId($model): ?string
    {
        return null;
    }

    /**
     * @param $model
     *
     * @return array
     */
    public function setTableRowAttributes($model): array
    {
        return [];
    }

    public function getTableRowUrl($model): ?string
    {
        return null;
    }

    public function setTableDataClass($attribute, $value): ?string
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
