<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Views;

use Daguilarm\LivewireTables\Facades\LivewireTables;

final class Action
{
    /**
     * Action column constructor.
     */
    public static function make(?string $view = null): Column
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
        return LivewireTables::include('includes.actions.default');
    }
}
