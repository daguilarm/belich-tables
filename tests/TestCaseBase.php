<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Tests;

use Daguilarm\BelichTables\BelichTablesServiceProvider;
use Livewire\LivewireServiceProvider;
use Maatwebsite\Excel\ExcelServiceProvider;

trait TestCaseBase
{
    /**
     * Load the service providers.
     */
    public function getPackageProviders($app)
    {
        return [
            BelichTablesServiceProvider::class,
            LivewireServiceProvider::class,
            ExcelServiceProvider::class,
        ];
    }

    /**
     * Swap HTTP Kernel for application bootstrap.
     */
    public function resolveApplicationHttpKernel($app)
    {
        $app->singleton('Illuminate\Contracts\Http\Kernel', 'Daguilarm\BelichTables\Tests\HttpKernel');
    }
}
