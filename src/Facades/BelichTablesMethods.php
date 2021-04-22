<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Facades;

final class BelichTablesMethods
{
    /**
     * Get the include path for the views.
     */
    public function include(string $path): string
    {
        return sprintf('belich-tables::'.config('belich-tables.theme').'.%s', $path);
    }

    /**
     * No results.
     */
    public function noResults(): string
    {
        return config('belich-tables.noResults');
    }
}
