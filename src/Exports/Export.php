<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Exports;

use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

final class Export implements FromQuery, WithHeadings, WithMapping
{
    use Exportable,
        ExportHelper;

    public Builder $builder;

    /**
     * @var array<object>
     */
    public array $columns;

    /**
     * CSVExport constructor.
     *
     * @param  array<string>  $columns
     */
    public function __construct(Builder $builder, array $columns = [])
    {
        $this->builder = $builder;
        $this->columns = $columns;
    }

    /**
     * Get the query builder.
     */
    public function query(): Builder
    {
        return $this->builder;
    }

    /**
     * Get the heading row.
     *
     * @return  array<string>
     */
    public function headings(): array
    {
        return $this->getHeadingRow();
    }

    /**
     * Generate the export file map.
     *
     * @param object $row
     *
     * @return  array<string>
     */
    public function map($row): array
    {
        $map = [];

        foreach ($this->columns as $column) {
            if ($column->isExportOnly() || ($column->isVisible() && $column->includedInExport())) {
                if ($column->isFormatted()) {
                    if ($column->hasExportFormat()) {
                        $map[] = $column->formattedForExport($row, $column);
                    } else {
                        $map[] = strip_tags($column->formatted($row, $column));
                    }
                } else {
                    $map[] = data_get($row, $column->getAttribute());
                }
            }
        }

        return $map;
    }
}
