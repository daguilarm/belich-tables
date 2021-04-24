<?php

namespace Daguilarm\BelichTables\Tests\Feature;

use Daguilarm\BelichTables\Tests\TestCase;
use Daguilarm\BelichTables\Tests\_Http\Livewire\UsersTable;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

// test --filter=ExportTableComponentTest
class ExportTableComponentTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    // test --filter=test_tablecomponent_export_attributes
    public function test_tablecomponent_export_attributes(): void
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

    // test --filter=test_tablecomponent_export_file
    public function test_tablecomponent_export_file(): void
    {
        // Assert see the export element
        Livewire::test(UsersTable::class)
            ->assertDontSeeHtml('dusk="table-export-button"')
            ->set('checkboxAll', true)
            ->assertSeeHtml('dusk="table-export-button"')
            ->call('export', 'csv')
            ->assertEmitted('fileDownload', true);
    }
}
