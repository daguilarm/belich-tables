<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Components\Table;

use Daguilarm\BelichTables\Components\Table\Export\Notification;
use Daguilarm\BelichTables\Components\Table\Export\PdfLibrary;
use Daguilarm\BelichTables\Exceptions\UnsupportedExportFormat;
use Daguilarm\BelichTables\Facades\BelichTables;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

trait Exports
{
    use Notification, PdfLibrary;

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
    public function export(string $type): BinaryFileResponse | null
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

        // Download the file
        $download = $this->download($type);

        // File download response
        return $this->downloadResponse($download);
    }

    /**
     * Download the file.
     */
    private function download(string $type): BinaryFileResponse | null
    {
        // Set the export format
        $exportFormat = $this->exportFormat($type);

        // Get the download class name
        $class = BelichTables::config('belich.belich-tables.exports', 'belich-tables.exports');

        // Init the download class
        $downloadClass = new $class(
            $this->models(),
            $this->columns()
        );

        // File name
        $fileName = sprintf('%s.%s', $this->exportFileName, $type);

        return $downloadClass->download($fileName, $exportFormat);
    }

    /**
     * Export type for the file.
     */
    private function exportFormat(string $type): string
    {
        return match ($type) {
            'csv' => Excel::CSV,
            'xls' => Excel::XLS,
            'xlsx' => Excel::XLSX,
            'pdf' => $this->selectPdfLibrary(),
        };
    }

    /**
     * Get the download response.
     */
    private function downloadResponse($download): BinaryFileResponse | null
    {
        // File is successful downloaded
        if ($download) {
            // Notify successful - only for testing
            $this->emit('fileDownloadNotification', true);

            return $download;
        }

        // Error with file download
        // Notify failure - only for testing
        $this->emit('fileDownloadNotification', false);

        return null;
    }
}
