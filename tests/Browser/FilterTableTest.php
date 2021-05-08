<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Tests\Browser;

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
            // Filter general values
            $browser
                ->visit('/testing/users')
                    ->assertVisible('@table-filter-button')
                    ->assertMissing('@table-filter-container')
                    ->assertMissing('@reset-all-filters')
                    ->click('@table-filter-button')
                    ->waitFor('@table-filter-container')
                    ->assertVisible('@table-filter-container')
            // Test boolean
            ->click('@table-filter-button')
                ->waitFor('@table-filter-container')
                ->select('@table-filter-boolean', 'false')
                ->press('@table-filter-close-button')
                ->waitUntilMissing('@belich-tables-loading');

            // Assert total results are 9
            $this->assertEquals(9, $this->getTotalTableRows($browser));

            // Reset filter
            $browser
                ->click('@reset-all-filters')
                    ->waitUntilMissing('@belich-tables-loading')
                    ->assertMissing('@table-filter-container')
                    ->click('@table-filter-button')
                    ->waitFor('@table-filter-container')

            // Testing filter by year
            ->select('@table-filter-year', '2020')
                ->press('@table-filter-close-button')
                ->waitUntilMissing('@belich-tables-loading');

            // Assert total results are 9
            $this->assertEquals(9, $this->getTotalTableRows($browser));

            // Reset filter
            $browser
                ->click('@reset-all-filters')
                    ->waitUntilMissing('@belich-tables-loading')
                    ->assertMissing('@table-filter-container')
                    ->click('@table-filter-button')
                    ->waitFor('@table-filter-container')

            // Testing filter by user
            ->select('@table-filter-user', 1)
                ->press('@table-filter-close-button')
                ->waitUntilMissing('@belich-tables-loading');

            // Assert total results are 1
            $this->assertEquals(1, $this->getTotalTableRows($browser));
        });
    }

    // test --filter=test_filter_table_by_date
    public function test_filter_table_by_date(): void
    {
        $this->browse(function ($browser) {
            // Filter by date start
            $browser
                ->visit('/testing/users')
                ->click('@table-filter-button')
                ->waitFor('@table-filter-container')
                ->keys('@table-filter-date_start', '01', '01', '2020')
                ->pause(200)
                ->press('@table-filter-close-button')
                ->waitUntilMissing('@belich-tables-loading');

            // Assert total results are 18
            $this->assertEquals(18, $this->getTotalTableRows($browser));

            // Filter by date end
            $browser
                ->visit('/testing/users')
                ->click('@table-filter-button')
                ->waitFor('@table-filter-container')
                ->keys('@table-filter-date_end', '01', '01', '2020')
                ->pause(200)
                ->press('@table-filter-close-button')
                ->waitUntilMissing('@belich-tables-loading');

            // Assert total results are 12
            $this->assertEquals(12, $this->getTotalTableRows($browser));

            // Filter by date start and end
            $browser
                ->visit('/testing/users')
                ->click('@table-filter-button')
                ->waitFor('@table-filter-container')
                ->keys('@table-filter-date_start', '30', '12', '2020')
                ->pause(200)
                ->keys('@table-filter-date_end', '30', '01', '2021')
                ->pause(200)
                ->press('@table-filter-close-button')
                ->waitUntilMissing('@belich-tables-loading');

            // Assert total results are 1
            $this->assertEquals(1, $this->getTotalTableRows($browser));
        });
    }
}
