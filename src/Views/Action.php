<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Views;

final class Action
{
    /**
     * Action column constructor.
     */
    public static function make(
        ?string $routeName = null,
        ?string $view = null
    ): Column {
        return Column::make('')
            ->format(static function ($model) use ($view) {
                // Get the route name, Ex: dashboard.users
                $routeName = $routeName ?? request()->route()->getName();
                // Get the view for the action or the default view
                $component = $view ?? self::defaultView();

                return view($component, compact('model', 'routeName'));
            })
            ->excludeFromExport();
    }

    /**
     * Default action view.
     */
    private static function defaultView(): string
    {
        return sprintf(
            'livewire-tables::%s.includes.actions.default',
            config('livewire-tables.theme')
        );
    }
}
