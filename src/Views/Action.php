<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Views;

class Action
{
    public static function make($model, string $routeName, ?string $view = null)
    {
        return Column::make('')
            ->format(static function ($model) {
                // Get the route name, Ex: dashboard.users
                $routeName = request()->route()->getName();
                // Get the view for the action or the default view
                $component = $view ?? self::defaultView();

                return view($component, compact('model', 'routeName'));
            })
            ->excludeFromExport();
    }

    private static function defaultView()
    {
        return sprintf(
            'livewire-tables::%s.includes.actions.default',
            config('livewire-tables.theme')
        );
    }
}
