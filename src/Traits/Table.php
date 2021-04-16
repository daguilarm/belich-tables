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
     *
     * @return  array<string>
     */
    public function setTableHeadAttributes(string | array $attribute): array
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
     *
     * @return  array<string>
     */
    public function setTableRowAttributes(string | array $model): array
    {
        return [];
    }

    /**
     * Set the the custom table column id for the data view.
     */
    public function setTableDataId(?string $attribute, ?string $value): ?string
    {
        return null;
    }

    /**
     * Set the the custom table column attributes for the data view.
     *
     * @return  array<string>
     */
    public function setTableDataAttributes(?string $attribute, ?string $value): array
    {
        return [];
    }
}
