<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Tests;

use Daguilarm\BelichTables\Tests\App\Http\Livewire\UsersTable;
use Daguilarm\BelichTables\Tests\TestCaseBase;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Orchestra\Testbench\Dusk\Options as DuskOptions;
use Orchestra\Testbench\Dusk\TestCase as BaseTestCase;

/**
 * @see https://github.com/livewire/livewire/blob/master/tests/Browser/TestCase.php
 */
class BrowserTestCase extends BaseTestCase
{
    use DuskElements,
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
            Route::get('/testing/users', function() {
                return view('users-table');
            });
        });
    }

    /**
     * Setup environment.
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup the application
        $app['config']->set('app.key', 'base64:Hupx3yAySikrM2/edkZQNQHslgDWYfiBfCuSThJ5SK8=');
    }
}
