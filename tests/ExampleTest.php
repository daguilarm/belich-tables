<?php

namespace Daguilarm\LivewireTables\Tests;

use Daguilarm\LivewireTables\LaravelLivewireTablesServiceProvider;
use Orchestra\Testbench\TestCase;

class ExampleTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [LaravelLivewireTablesServiceProvider::class];
    }

    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
