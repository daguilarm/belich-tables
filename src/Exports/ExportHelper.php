<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Exports;

trait ExportHelper
{
    /**
     * @return array<string>
     */
    public function getHeadingRow(): array
    {
        $headers = [];

        foreach ($this->columns as $column) {
            if ($column->isExportOnly() || ($column->isVisible() && $column->includedInExport())) {
                $headers[] = $column->getText();
            }
        }

        return $headers;
    }
}
