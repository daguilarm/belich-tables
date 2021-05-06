<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Tests\Browser;

use Daguilarm\BelichTables\Tests\BrowserTestCase as TestCase;

// test --filter=UsersTableTest
class UsersTableTest extends TestCase
{
    // test --filter=test_users_table
    public function test_users_table(): void
    {
        $this->browse(function ($browser) {
            // Test simple dynamic selection
            $browser->visit('/testing/users')
                ->assertUrlIs('/testing/users');
        });
    }
}
