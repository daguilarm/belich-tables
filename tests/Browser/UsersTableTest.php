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
                ->assertSeeIn('table > tbody > tr:nth-child(1)', 'Damián Aguilar')
                // Assert see in second row
                ->assertSeeIn('table > tbody > tr:nth-child(2)', 'Antonio Aguilar')
                // Order the column
                ->click('@column_id')
                ->waitUntilMissing('.loading')
                // Assert see in first row
                ->assertSeeIn('table > tbody > tr:nth-child(1)', 'Paula Gómez')
                // Assert see in last row
                ->assertSeeIn('table > tbody > tr:nth-child(10)', 'Damián Aguilar');
        });
    }
}
