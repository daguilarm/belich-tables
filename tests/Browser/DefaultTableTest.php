<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Tests\Browser;

use Daguilarm\BelichTables\Tests\BrowserTestCase as TestCase;

// test --filter=DefaultTableTest
class DefaultTableTest extends TestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    // test --filter=test_users_table_order_by_id
    public function test_users_table_order_by_id(): void
    {
        $this->browse(function ($browser) {
            $browser
                ->visit('/testing/users')
                // Assert see in first row
                ->assertSeeIn($this->getTablePositionSelector(1), 'Damián Aguilar')
                // Assert see in second row
                ->assertSeeIn($this->getTablePositionSelector(2), 'Antonio Aguilar')
                // Order the column
                ->click('@column-id')
                ->waitFor('@belich-tables-loading')
                ->waitUntilMissing('@belich-tables-loading')
                // Assert see in first row
                ->assertSeeIn($this->getTablePositionSelector(1), 'Paula Ferrani')
                // Assert see in last row
                ->assertSeeIn($this->getTablePositionSelector(25), 'Carmen Porteros');

            // Assert total results are 25
            $this->assertEquals(25, $this->getTotalTableRows($browser));
        });
    }

    // test --filter=test_users_table_search
    public function test_users_table_search(): void
    {
        $this->browse(function ($browser) {
            $browser
                ->visit('/testing/users')
                // Assert see in first row
                ->type('@belich-table-search', 'Aguilar')
                ->pause(300)
                ->waitUntilMissing('@belich-tables-loading');

            // Assert total results are 2
            $this->assertEquals(2, $this->getTotalTableRows($browser));

            // Reset search
            $browser
                ->click('@belich-table-clear-search')
                ->waitUntilMissing('@belich-tables-loading');

            // Assert total results are 25
            $this->assertEquals(25, $this->getTotalTableRows($browser));
        });
    }

    // test --filter=test_users_table_per_page
    public function test_users_table_per_page(): void
    {
        $this->browse(function ($browser) {
            $browser
                ->visit('/testing/users');

            // Assert total results are 25
            $this->assertEquals(25, $this->getTotalTableRows($browser));

            $browser
                // Assert see in first row
                ->select('@table-index-per-page', 50)
                ->waitUntilMissing('@belich-tables-loading');

            // Assert total results are 30
            $this->assertEquals(30, $this->getTotalTableRows($browser));
        });
    }

    // test --filter=test_users_table_pagination
    public function test_users_table_pagination(): void
    {
        $this->browse(function ($browser) {
            $browser
                ->visit('/testing/users');

            // Assert total results are 25
            $this->assertEquals(25, $this->getTotalTableRows($browser));

            $browser
                // Assert see in first row
                ->click('@pagination-next')
                ->waitUntilMissing('@belich-tables-loading');

            // Assert total results are 5
            $this->assertEquals(5, $this->getTotalTableRows($browser));

            $browser
                // Assert see in first row
                ->click('@pagination-previus')
                ->waitUntilMissing('@belich-tables-loading');

            // Assert total results are 25
            $this->assertEquals(25, $this->getTotalTableRows($browser));
        });
    }
}
