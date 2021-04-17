<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables;

use Daguilarm\LivewireTables\Components\DeleteComponent;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire\Livewire;

/**
 * Class LaravelLivewireTablesServiceProvider.
 */
final class LivewireTablesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'livewire-tables');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'livewire-tables');

        // Blade Components
        $this->callAfterResolving(BladeCompiler::class, static function (): void {
            Blade::component('livewire-tables::'.config('livewire-tables.theme').'.components.filter-icon', 'livewire-tables-filter-icon');
        });

        // Livewire Components
        Livewire::component('delete-button-component', DeleteComponent::class);

        // Set config values
        config()->set('livewire-flash.views.message', 'livewire-tables::'.config('livewire-tables.theme').'.components.flash-message');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('livewire-tables.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../config/livewire-flash.php' => config_path('livewire-flash.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/livewire-tables'),
            ], 'views');

            $this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/livewire-tables'),
            ], 'lang');
        }
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'livewire-tables');
    }
}
