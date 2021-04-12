<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Traits;

trait Operations
{
    /**
     * List of modules to show (Equivalent to Laravel Nova actions).
     */
    public array $operations = [];

    private function mergeOperations(): array
    {
        return array_merge(['delete'], $this->operations);
    }
}
