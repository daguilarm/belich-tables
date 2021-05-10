<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Components\Table\Export;

use Daguilarm\BelichTables\Exceptions\UnsupportedExportFormat;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Excel;

trait PdfLibrary
{
    /**
     * Select the PDF library.
     */
    protected function selectPdfLibrary()
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
