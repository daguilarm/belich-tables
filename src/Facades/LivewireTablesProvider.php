<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Facades;

use Illuminate\Support\ServiceProvider;

final class LivewireTablesProvider extends ServiceProvider
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
        $this->app->singleton('LivewireTables', static function () {
            return new LivewireTablesMethods();
        });
    }
}
