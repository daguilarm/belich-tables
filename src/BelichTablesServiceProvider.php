<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables;

use Daguilarm\BelichTables\Components\DeleteComponent;
use Daguilarm\BelichTables\Facades\BelichTables;
use Daguilarm\BelichTables\Facades\BelichTablesProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire\Livewire;

/**
 * Class LaravelBelichTablesServiceProvider.
 */
final class BelichTablesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'belich-tables');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'belich-tables');

        // Blade Components
        $this->callAfterResolving(BladeCompiler::class, static function (): void {
            Blade::component('belich-tables::'.config('belich-tables.theme').'.components.filter-icon', 'belich-tables-filter-icon');
        });

        // Livewire Components
        Livewire::component('delete-button-component', DeleteComponent::class);

        // Set config values
        config()->set('livewire-flash.views.message', 'belich-tables::'.config('belich-tables.theme').'.components.flash-message');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/belich-tables.php' => config_path('belich-tables.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../config/livewire-flash.php' => config_path('livewire-flash.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/belich-tables'),
            ], 'views');

            $this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/belich-tables'),
            ], 'lang');
        }
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'belich-tables');

        $this->app->register(BelichTablesProvider::class);
        AliasLoader::getInstance()->alias('BelichTables', BelichTables::class);
    }
}
