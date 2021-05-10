<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables;

use Daguilarm\BelichTables\Views\Column;
use Illuminate\Support\Collection;

final class BelichTables
{
    /**
     * Get the include path for the views.
     */
    public function include(string $path): string
    {
        // Get the theme variable
        $theme = $this->theme();

        return sprintf('belich-tables::'.$theme.'.%s', $path);
    }

    /**
     * No results.
     */
    public function noResults(): string
    {
        return $this->config(
            'belich.belich-tables.noResults',
            'belich-tables.noResults'
        );
    }

    /**
     * Support for Belich Dev.
     */
    public function config(string $key, string $default): string
    {
        return app('config')
            ->get(
                $key,
                app('config')->get($default),
            );
    }

    /**
     * Set column order.
     */
    public function orderBy(Column $column, Collection $options): string
    {
        return $column->getAttribute() !== data_get($options, 'sort.field')
            ? 'reorder'
            : data_get($options, 'sort.direction');
    }

    /**
     * Support for Belich Dev.
     */
    public function theme(): string
    {
        return $this->config(
            'belich.belich-tables.theme',
            'belich-tables.theme'
        );
    }
}
