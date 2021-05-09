<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Tests\Browser;

use Daguilarm\BelichTables\Tests\App\Models\User;
use Daguilarm\BelichTables\Tests\BrowserTestCase as TestCase;

// test --filter=DeleteTableTest
class DeleteTableTest extends TestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    // test --filter=test_table_simple_delete
    public function test_table_simple_delete(): void
    {
        $this->browse(function ($browser) {
            $browser
                ->loginAs(User::find(1))
                ->visit('/testing/users/delete')
                ->assertSee('Antonio Aguilar')
                ->click('@delete-button-2')
                ->waitForText(trans('belich-tables::strings.delete.title'))
                ->press(trans('belich-tables::strings.delete.button'))
                ->waitForText(trans('belich-tables::strings.messages.delete.success'))
                ->assertSee(trans('belich-tables::strings.messages.delete.success'))
                ->assertDontSee('Antonio Aguilar');
        });
    }

    // test --filter=test_table_bulk_delete
    public function test_table_bulk_delete(): void
    {
        $this->browse(function ($browser) {
            $browser
                ->visit('/testing/users')
                ->assertMissing('@delete-mass-button-action')
                ->check('@table-index-checkbox-2')
                ->waitUntilMissing('@belich-tables-loading')
                ->check('@table-index-checkbox-3')
                ->waitUntilMissing('@belich-tables-loading')
                ->assertVisible('@delete-mass-button-action')
                ->assertSee('Antonio Aguilar')
                ->assertSee('Maria López')
                ->click('@delete-mass-button-action')
                ->waitForText(trans('belich-tables::strings.delete.title'))
                ->press(trans('belich-tables::strings.delete.button'))
                ->waitForText(trans('belich-tables::strings.messages.delete.success'))
                ->assertSee(trans('belich-tables::strings.messages.delete.success'))
                ->assertDontSee('Antonio Aguilar')
                ->assertDontSee('Maria López');
        });
    }

    // test --filter=test_table_user_can_delete_himself
    public function test_table_user_can_delete_himself(): void
    {
        $this->browse(function ($browser) {
            $browser
                ->loginAs(User::find(1))
                ->visit('/testing/users/delete')
                ->assertSee('Damián Aguilar')
                ->click('@delete-button-1')
                ->waitForText(trans('belich-tables::strings.delete.title'))
                ->press(trans('belich-tables::strings.delete.button'))
                ->waitForText(trans('belich-tables::strings.messages.delete.error'))
                ->assertSee(trans('belich-tables::strings.messages.delete.error'))
                ->assertSee('Damián Aguilar');
        });
    }
}
