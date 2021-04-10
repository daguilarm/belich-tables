<?php

declare(strict_types=1);

return [

    /*
     * The class to use to handle the export functionality
     */
    'exports' => \Daguilarm\LivewireTables\Exports\Export::class,

    /*
     * Which library you want to use for PDF generation
     * Supports dompdf, mpdf
     * You must install the appropriate third party package for each
     * See: https://docs.laravel-excel.com/3.1/exports/export-formats.html
     * And: https://phpspreadsheet.readthedocs.io/en/latest/topics/reading-and-writing-to-file/#pdf
     */
    'pdf_library' => 'dompdf',

    /*
     * The frontend styling framework to use
     * Options: tailwind
     */
    'theme' => 'tailwind',

    /*
     * The color for the loading indicador (by default 'blue').
     * It can be in rgb, rgba or hexadecimal... any valid format in css.
     */
    'loadingColor' => 'rgba(147, 197, 253, 1)',
];
