<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Views\Traits;

use Daguilarm\LivewireTables\Facades\LivewireTables;
use Daguilarm\LivewireTables\Views\Column;

trait ColumnResolve
{
    public bool $asHtml = false;

    /**
     * Html column.
     */
    public function asHtml(): self
    {
        $this->asHtml = true;

        return $this;
    }

    /**
     * Check if the column is raw.
     */
    public function isHtml(): bool
    {
        return $this->asHtml === true;
    }

    /**
     * Resolve the column.
     */
    public function resolveColumn(Column $column, object $model): bool | int | float | object | string | null
    {
        // Get the value
        $value = data_get($model, $column->getAttribute());

        // Resolve type for value
        $value = $this->resolveType($value);

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
