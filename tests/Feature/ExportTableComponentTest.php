<?php

namespace Daguilarm\BelichTables\Tests\Feature;

use Daguilarm\BelichTables\Tests\App\Http\Livewire\UsersTable;
use Daguilarm\BelichTables\Tests\TestCase;
use Livewire\Livewire;

// test --filter=ExportTableComponentTest
class ExportTableComponentTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    // test --filter=test_table_component_export_attributes
    public function test_table_component_export_attributes(): void
    {
        Livewire::test(UsersTable::class)
            // Export attributes
            ->set('exportAllowedFormats', ['csv', 'xls', 'xlsx', 'pdf'])
            ->assertSet('exportAllowedFormats', ['csv', 'xls', 'xlsx', 'pdf'])
            ->assertCount('exportAllowedFormats', 4)
            ->set('exportFileName', 'myCustomFile')
            ->assertSet('exportFileName', 'myCustomFile')
            ->assertNotSet('exportFileName', 'data');
    }

    // test --filter=test_table_component_export_file
    public function test_table_component_export_file(): void
    {
        // Assert see the export element
        Livewire::test(UsersTable::class)
            ->assertDontSeeHtml('dusk="table-export-button"')
            ->set('checkboxAll', true)
            ->assertSeeHtml('dusk="table-export-button"')
            ->call('export', 'csv')
            ->assertEmitted('fileDownloadNotification', true);
    }

    // test --filter=test_table_component_download_file
    public function test_table_component_download_file(): void
    {
        // Assert file download
        Livewire::test(UsersTable::class)
            ->set('checkboxAll', true)
            ->call('export', 'csv')
            ->assertFileDownloaded('data.csv');
    }
}
