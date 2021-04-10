<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Views;

class Action
{
    public static function make($model, string $routeName, ?string $view = null)
    {
        $component = $view ?? self::defaultView();

        return Column::make('')
            ->format(function ($model) use ($component, $routeName) {
                return view($component, compact('model', 'routeName'));
            })
            ->excludeFromExport();
    }

    private static function defaultView()
    {
        return 'livewire-tables::'.config('livewire-tables.theme').'.includes.actions.default';
    }
}
