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
        // Publish and configure resources and config
        $this->publishAndConfigure();

        // Blade Components
        $this->callAfterResolving(BladeCompiler::class, static function (): void {
            Blade::component('belich-tables::'.config('belich-tables.theme').'.components.filter-icon', 'belich-tables-filter-icon');
        });

        // Blade directives
        Blade::directive('belichTablesCss', static function ($expression) {
            $css = file_get_contents(__DIR__.'/../resources/css/belich-tables.min.css');
            $customCss = str_replace('@backGroundColor', BelichTables::config('belich-tables.loadingColor', 'belich.belich-tables.loadingColor'), $css);

            return sprintf('<style>%s</style>', trim($customCss));
        });

        // Livewire Components
        Livewire::component('delete-button-component', DeleteComponent::class);
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'belich-tables');

        // Facade
        $this->app->register(BelichTablesProvider::class);
        AliasLoader::getInstance()->alias('BelichTables', BelichTables::class);
    }

    /**
     * Publish and configure the config and the resources.
     */
    private function publishAndConfigure(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'belich-tables');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'belich-tables');

        // Only on console
        if ($this->app->runningInConsole()) {

            // Publish the config
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('belich-tables.php'),
            ], 'config');

            // Publish the views
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/belich-tables'),
            ], 'views');

            // Publish the localization
            $this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/belich-tables'),
            ], 'lang');
        }
    }
}
