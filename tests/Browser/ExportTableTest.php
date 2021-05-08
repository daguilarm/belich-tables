<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Tests\Browser;

use Daguilarm\BelichTables\Tests\BrowserTestCase as TestCase;

// test --filter=ExportTableTest
class ExportTableTest extends TestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    // test --filter=test_export_table_component
    public function test_export_table_component(): void
    {
        $this->browse(function ($browser) {
            $browser
                ->visit('/testing/users')
                ->assertMissing('@table-export-button')
                ->click('@table-index-checkbox-all')
                ->waitFor('@table-export-button')
                ->assertVisible('@table-export-button');
        });
    }
}
