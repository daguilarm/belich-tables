<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Exports;

use Daguilarm\LivewireTables\Traits\ExportHelper;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

final class Export implements FromQuery, WithHeadings, WithMapping
{
    use Exportable,
        ExportHelper;

    /**
     * @var array
     */
    public array $builder;

    /**
     * @var array
     */
    public array $columns;

    /**
     * CSVExport constructor.
     *
     * @param  array  $columns
     */
    public function __construct(Builder $builder, array $columns = [])
    {
        $this->builder = $builder;
        $this->columns = $columns;
    }

    /**
     * @return array|\Illuminate\Database\Query\Builder
     */
    public function query()
    {
        return $this->builder;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return $this->getHeadingRow();
    }

    /**
     * @param  mixed  $row
     *
     * @return array
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
