<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Components\Traits;

use Daguilarm\BelichTables\Exceptions\UnsupportedExportFormat;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Excel;

trait Exports
{
    public string $exportFileName = 'data';

    /**
     * @var array<string>
     */
    public array $exportAllowedFormats = ['csv', 'xls', 'xlsx', 'pdf'];

    /**
     * @var array<string>
     */
    public array $exports = [];

    /**
     * Export file with the selected format.
     */
    public function export(string $type): ?object
    {
        $type = strtolower($type);

        if (! in_array($type, $this->exportAllowedFormats, true)) {
            throw new UnsupportedExportFormat(__('This export type is not supported.'));
        }

        if (! in_array($type, array_map('strtolower', $this->exports), true)) {
            throw new UnsupportedExportFormat(__('This export type is not set on this table component.'));
        }

        switch ($type) {
            case 'csv':
                default:
                $writer = Excel::CSV;
                break;

            case 'xls':
                $writer = Excel::XLS;
                break;

            case 'xlsx':
                $writer = Excel::XLSX;
                break;

            case 'pdf':
                $writer = Excel::DOMPDF;
                $library = Str::of(config('belich-tables.pdf_library'))
                    ->lower()
                    ->__toString();

                if (! in_array($library, ['dompdf', 'mpdf'], true)) {
                    throw new UnsupportedExportFormat(__('This PDF export library is not supported.'));
                }

                if ($library === 'mpdf') {
                    $writer = Excel::MPDF;
                }
                break;
        }

        $class = config('belich-tables.exports');

        $download = (new $class($this->models(), $this->columns()))
            ->download($this->exportFileName.'.'.$type, $writer);

        if($download) {
            flash(trans('belich-tables::strings.messages.download.success'))->success()->livewire($this);

            return $download;

        } else {
            flash(trans('belich-tables::strings.messages.download.error'))->error()->livewire($this);

            return null;
        }
    }
}
