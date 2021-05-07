<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Tests\Browser;

use Daguilarm\BelichTables\Tests\BrowserTestCase as TestCase;

// test --filter=UsersTableTest
class UsersTableTest extends TestCase
{
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
                ->click('@column_id')
                ->waitUntilMissing('#belich-tables-loading')
                // Assert see in first row
                ->assertSeeIn($this->getTablePositionSelector(1), 'Paula Ferrani')
                // Assert see in last row
                ->assertSeeIn($this->getTablePositionSelector(25), 'Carmen Porteros');

            // Assert total results are 25
            $this->assertEquals('25', $this->getTotalTableRows($browser));
        });
    }
}
