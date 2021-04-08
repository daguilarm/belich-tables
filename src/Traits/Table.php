<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Traits;

/**
 * Trait Table.
 */
trait Table
{
    /**
     * Whether or not to display the table header.
     *
     * @var bool
     */
    public $tableHeaderEnabled = true;

    /**
     * Whether or not to display the table footer.
     *
     * @var bool
     */
    public $tableFooterEnabled = false;

    public function setTableHeadClass($attribute): ?string
    {
        return null;
    }

    public function setTableHeadId($attribute): ?string
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
