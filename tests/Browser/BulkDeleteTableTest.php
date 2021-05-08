<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Tests\Browser;

use Daguilarm\BelichTables\Tests\BrowserTestCase as TestCase;

// test --filter=BulkDeleteTableTest
class BulkDeleteTableTest extends TestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    // test --filter=test_table_bulk_delete
    public function test_table_bulk_delete(): void
    {
        $this->browse(function ($browser) {
            $browser
                ->visit('/testing/users')
                ->check('@table-index-checkbox-2')
                ->waitUntilMissing('@belich-tables-loading')
                ->check('@table-index-checkbox-3')
                ->waitUntilMissing('@belich-tables-loading')
                ->assertVisible('@delete-mass-button-action');
        });
    }
}
