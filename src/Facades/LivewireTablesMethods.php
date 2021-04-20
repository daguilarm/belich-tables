<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Facades;

final class LivewireTablesMethods
{
    /**
     * Get the include path for the views.
     */
    public function include(string $path): string
    {
        return sprintf('livewire-tables::'.config('livewire-tables.theme').'.%s', $path);
    }

    /**
     * No results.
     */
    public function noResults()
    {
        return config('livewire-tables.noResults');
    }
}
