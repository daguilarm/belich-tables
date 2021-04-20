<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Views\Traits;

use Daguilarm\LivewireTables\Facades\LivewireTables;
use Daguilarm\LivewireTables\Views\Column;

trait ColumnResolve
{
    /**
     * Resolve the column.
     *
     * @return int | float | string | null
     */
    public function resolveColumn(Column $column, object $model)
    {
        // Get the value
        $value = data_get($model, $column->getAttribute());

        // Resolving the column as a view
        if ($column->isRenderable()) {
            return $column->renderCallback($model);
        }

        // Format the column
        if ($column->isFormatted()) {
            return $column->formatted($value);
        }

        return $value ?: LivewireTables::noResults();
    }
}
