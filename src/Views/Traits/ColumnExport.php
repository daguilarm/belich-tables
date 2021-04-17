<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Views\Traits;

use Daguilarm\LivewireTables\Views\Column;

trait ColumnExport
{
    /**
     * Check if the export format is callable.
     */
    public function hasExportFormat(): bool
    {
        return is_callable($this->exportFormatCallback);
    }

    /**
     * Set the export format callback.
     */
    public function exportFormat(callable $callable): self
    {
        $this->exportFormatCallback = $callable;

        return $this;
    }

    /**
     * Format the export callback.
     */
    public function formattedForExport(object $model, Column $column): object
    {
        return app()->call($this->exportFormatCallback, ['model' => $model, 'column' => $column]);
    }

    /**
     * Exclude this column from export.
     */
    public function excludeFromExport(): self
    {
        $this->includeInExport = false;

        return $this;
    }

    /**
     * Include column in export.
     */
    public function includedInExport(): bool
    {
        return $this->includeInExport === true;
    }

    /**
     * Include this column only for export.
     */
    public function exportOnly(): self
    {
        $this->hidden = true;
        $this->exportOnly = true;

        return $this;
    }

    /**
     * Check if the column is only for export.
     */
    public function isExportOnly(): bool
    {
        return $this->exportOnly === true;
    }
}
