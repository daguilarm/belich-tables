<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Tests;

use Daguilarm\BelichTables\Tests\App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Orchestra\Testbench\TestCase as BaseTestCase;

/**
 * @see https://github.com/livewire/livewire/blob/master/tests/Unit/TestCase.php
 */
class TestCase extends BaseTestCase
{
    use TestCaseBase;

    /**
     * Setup the test environment.
     */
    public function setUp(): void
    {
        // Clean up the test
        $this->afterApplicationCreated(function () {
            $this->makeACleanSlate();
        });

        $this->beforeApplicationDestroyed(function () {
            $this->makeACleanSlate();
        });

        parent::setUp();
    }

    /**
     * Setup the testing environment.
     */
    public function getEnvironmentSetUp($app)
    {
        // Setup the application
        $app['config']->set('view.paths', [
            __DIR__.'/../tests/Browser/resources/views/',
            resource_path('views'),
        ]);
        $app['config']->set('auth.providers.users.model', User::class);
        $app['config']->set('session.driver', 'file');
        $app['config']->set('app.key', 'base64:Hupx3yAySikrM2/edkZQNQHslgDWYfiBfCuSThJ5SK8=');
    }

    /**
     * Clean up for the test.
     */
    public function makeACleanSlate()
    {
        Artisan::call('view:clear');
    }

    /**
     * Get all the dusk attributes.
     */
    public function getDuskAttributes($html)
    {
        preg_match_all('/dusk="(.*)"/', $html, $results);

        return $results[1];
    }
}
