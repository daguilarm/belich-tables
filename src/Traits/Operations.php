<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Traits;

trait Operations
{
    /**
     * List of modules to show (Equivalent to Laravel Nova actions).
     *
     * @var  array<string>
     */
    public array $operations = [];

    /**
     * Merge the default operation's values with the rest of the operations.
     *
     * @return array<string>
     */
    private function mergeOperations(): array
    {
        return array_merge(['delete'], $this->operations);
    }
}
