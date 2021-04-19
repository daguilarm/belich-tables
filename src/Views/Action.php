<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Views;

final class Action
{
    /**
     * Action column constructor.
     */
    public static function make(?string $routeName = null, ?string $view = null): Column
    {
        return Column::make('')
            ->render(static function ($model) use ($view) {
                // Get the view for the action or the default view
                $component = $view ?? self::defaultView();

                return view($component)
                    ->withId($model->id)
                    ->withResource($model->getTable());
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
