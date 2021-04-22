<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Facades;

use Illuminate\Support\ServiceProvider;

final class BelichTablesProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        $this->app->singleton('BelichTables', static function () {
            return new BelichTablesMethods();
        });
    }
}
