<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Tests;

use Daguilarm\BelichTables\Tests\App\Http\Livewire\UsersTable;
use Daguilarm\BelichTables\Tests\App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Orchestra\Testbench\Dusk\Options as DuskOptions;

/**
 * @see https://github.com/livewire/livewire/blob/master/tests/Browser/TestCase.php
 */
class BrowserTestCase extends \Orchestra\Testbench\Dusk\TestCase
{
    use BrowserCustomMethods,
        DuskElements,
        RefreshDatabase,
        TestCaseBase;

    /**
     * Setup for testing.
     */
    public function setUp(): void
    {
        // DuskOptions::withoutUI();
        if (isset($_SERVER['CI'])) {
            DuskOptions::withoutUI();
        }

        parent::setUp();

        // Define the testing routes
        $this->tweakApplication(function () {
            // Enable debug
            config()->set('app.debug', true);

            // Configure the view folder
            app('config')->set('view.paths', [
                __DIR__.'/../tests/Browser/resources/views',
                resource_path('views'),
            ]);

            // CSRF hack
            app('session')->put('_token', 'this-is-a-hack-because-something-about-validating-the-csrf-token-is-broken');

            //Components for testing
            Livewire::component('users-table', UsersTable::class);

            //Routes for testing
            Route::get('/testing/users', function () {
                return view('users');
            })->name('testing.users');
        });
    }

    /**
     * Setup environment.
     */
    public function getEnvironmentSetUp($app)
    {
        // Setup the application
        $app['config']->set('app.key', 'base64:2fl+Ktvkfl+Fuz4Qp/A75G2RTiWVA/ZoKZvp6fiiM10=');
        $app['config']->set('filesystems.disks.dusk-downloads', [
            'driver' => 'local',
            'root' => __DIR__.'/downloads',
        ]);

        // Populate the DB
        include_once __DIR__.'/../tests/Browser/database/migrations/create_test_tables.php.stub';
        (new \CreateTestTables())->up();
    }
}
