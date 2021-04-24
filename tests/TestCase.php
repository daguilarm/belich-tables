<?php

namespace Daguilarm\BelichTables\Tests;

use Daguilarm\BelichTables\BelichTablesServiceProvider;
use Daguilarm\BelichTables\Tests\TestSeed;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Livewire\LivewireServiceProvider;
use Maatwebsite\Excel\ExcelServiceProvider;
use MattLibera\LivewireFlash\LivewireFlashServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    use TestSeed;

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        // Clean up the test
        $this->afterApplicationCreated(function () {
            $this->makeACleanSlate();
        });

        $this->beforeApplicationDestroyed(function () {
            $this->makeACleanSlate();
        });

        parent::setUp();

        // Seed the database
        $this->seedUsers();
        $this->seedProfiles();
    }

    /**
     * Load the service providers.
     */
    protected function getPackageProviders($app)
    {
        return [
            BelichTablesServiceProvider::class,
            LivewireServiceProvider::class,
            ExcelServiceProvider::class,
            LivewireFlashServiceProvider::class,
        ];
    }

    /**
     * Setup the testing environment.
     */
    public function getEnvironmentSetUp($app)
    {
        // Setup the application
        $app['config']->set('view.paths', [
            __DIR__.'/views',
            resource_path('views'),
        ]);
        $app['config']->set('auth.providers.users.model', User::class);
        $app['config']->set('session.driver', 'file');
        $app['config']->set('app.key', 'base64:Hupx3yAySikrM2/edkZQNQHslgDWYfiBfCuSThJ5SK8=');
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);

        // Populate the DB
        include_once __DIR__.'/../database/migrations/create_test_tables.php.stub';
        (new \CreateTestTables())->up();
    }

    /**
     * Clean up for the test.
     */
    public function makeACleanSlate()
    {
        Artisan::call('view:clear');

        File::deleteDirectory($this->livewireViewsPath());
        File::deleteDirectory($this->livewireClassesPath());
        File::deleteDirectory($this->livewireTestsPath());
        File::delete(app()->bootstrapPath('cache/livewire-components.php'));
    }

    /**
     * Swap HTTP Kernel for application bootstrap.
     */
    protected function resolveApplicationHttpKernel($app)
    {
        $app->singleton('Illuminate\Contracts\Http\Kernel', 'Daguilarm\BelichTables\Tests\HttpKernel');
    }

    /**
     * Set the path for the livewire classes.
     */
    protected function livewireClassesPath($path = '')
    {
        return app_path('Http/Livewire'.($path ? '/'.$path : ''));
    }

    /**
     * Set the path for the livewire views.
     */
    protected function livewireViewsPath($path = '')
    {
        return resource_path('views').'/livewire'.($path ? '/'.$path : '');
    }

    /**
     * Set the path for the livewire tests.
     */
    protected function livewireTestsPath($path = '')
    {
        return base_path('tests/Feature/Livewire'.($path ? '/'.$path : ''));
    }
}
