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
    public array $exportAllowedFormats = [
        'csv',
        'xls',
        'xlsx',
        'pdf',
    ];

    /**
     * @var array<string>
     */
    public array $exports = [];

    /**
     * Export file with the selected format.
     */
    public function export(string $type): ?object
    {
        // Set the default export type
        $type = Str::of($type)
            ->lower()
            ->__toString();

        // Verify the export type is correct
        if (! in_array($type, $this->exportAllowedFormats, true)) {
            throw new UnsupportedExportFormat(__('This export type is not supported.'));
        }

        // and is allowed
        if (! in_array($type, array_map('strtolower', $this->exports), true)) {
            throw new UnsupportedExportFormat(__('This export type is not set on this table component.'));
        }

        // Set the export format
        $exportFormat = match ($type) {
            'csv' => Excel::CSV,
            'xls' => Excel::XLS,
            'xlsx' => Excel::XLSX,
            'pdf' => $this->selectPdfLibrary(),
        };

        // Download the file
        $download = $this->download($type, $exportFormat);

        // File is successfull downloaded
        if ($download) {
            // app('lwflash')->message(trans('belich-tables::strings.messages.download.success'), 'success')->livewire($this);
            flash(trans('belich-tables::strings.messages.download.success'))->success()->livewire($this);

            return $download;

        // Error with file download
        } else {
            flash(trans('belich-tables::strings.messages.download.error'))->error()->livewire($this);

            return null;
        }
    }

    /**
     * Download the file.
     */
    private function download(string $type, string $exportFormat)
    {
        // Get the download class
        $class = config('belich-tables.exports');
        $downloadClass = new $class(
            $this->models(),
            $this->columns()
        );

        // File name
        $fileName = sprintf('%s.%s', $this->exportFileName, $type);

        return $downloadClass
            ->download($fileName, $exportFormat);
    }

    /**
     * Select the PDF library.
     */
    private function selectPdfLibrary()
    {
        // Prepare the library
        $pdfLibrary = Str::of(config('belich-tables.pdf_library'))
            ->lower()
            ->__toString();

        // Library not supported
        if (! in_array($pdfLibrary, ['dompdf', 'mpdf'], true)) {
            throw new UnsupportedExportFormat(__('This PDF export library is not supported.'));
        }

        return match ($pdfLibrary) {
            'mpdf' => Excel::MPDF,
            default => Excel::DOMPDF,
        };
    }
}
