<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Tests\Browser;

use Daguilarm\BelichTables\Tests\App\Models\Profile;
use Daguilarm\BelichTables\Tests\App\Models\User;
use Daguilarm\BelichTables\Tests\BrowserTestCase as TestCase;

// test --filter=FilterTableTest
class FilterTableTest extends TestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    // test --filter=test_filter_table_general
    public function test_filter_table_general(): void
    {
        $this->browse(function ($browser) {
            $browser
                ->visit('/testing/users')
                ->assertVisible('@table-filter-button')
                ->assertMissing('@table-filter-container')
                ->click('@table-filter-button')
                ->waitFor('@table-filter-container')
                ->assertVisible('@table-filter-container');
        });
    }

    // test --filter=test_filter_table_boolean
    public function test_filter_table_boolean(): void
    {
        $this->browse(function ($browser) {
            $browser
                ->visit('/testing/users')
                ->click('@table-filter-button')
                ->waitFor('@table-filter-container')
                ->select('@table-filter-boolean', 'false')
                ->press('@table-filter-close-button')
                ->waitUntilMissing('@belich-tables-loading');

            // Assert total results are 9
            $this->assertEquals(9, $this->getTotalTableRows($browser));
        });
    }

    // test --filter=test_filter_table_year
    public function test_filter_table_year(): void
    {
        $this->browse(function ($browser) {
            $browser
                ->visit('/testing/users')
                ->click('@table-filter-button')
                ->waitFor('@table-filter-container')
                ->pause(10000)
                ->select('@table-filter-year', '2020')
                ->press('@table-filter-close-button')
                ->waitUntilMissing('@belich-tables-loading');

            // Assert total results are 9
            $this->assertEquals(9, $this->getTotalTableRows($browser));
        });
    }
}
