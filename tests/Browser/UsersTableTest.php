<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Tests\Browser;

use Daguilarm\BelichTables\Tests\App\Models\Profile;
use Daguilarm\BelichTables\Tests\App\Models\User;
use Daguilarm\BelichTables\Tests\BrowserTestCase as TestCase;

// test --filter=UsersTableTest
class UsersTableTest extends TestCase
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
}
