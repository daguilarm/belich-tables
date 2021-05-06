<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables;

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
        return $this->belichConfig(
            'belich.belich-tables.noResults',
            'belich-tables.noResults'
        );
    }

    /**
     * Support for Belich Dev.
     */
    public function belichConfig(string $key, string $default): string
    {
        return app('config')
            ->get(
                $key,
                app('config')->get($default),
            );
    }

    /**
     * Support for Belich Dev.
     */
    public function theme(): string
    {
        return $this->belichConfig(
            'belich.belich-tables.theme',
            'belich-tables.theme'
        );
    }
}
