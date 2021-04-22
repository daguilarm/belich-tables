<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Components\Traits;

trait Search
{
    /**
     * The initial search string.
     */
    public string $search = '';

    /**
     * Method to search by: debounce or lazy.
     */
    public string $searchUpdateMethod = 'debounce';

    /**
     * Whether or not searching is enabled.
     */
    public bool $showSearch = true;

    /**
     * false = disabled
     * int = Amount of time in ms to wait to send the search query and refresh the table.
     */
    public int $searchDebounce = 350;

    /**
     * A button to clear the search box.
     */
    public bool $clearSearchButton = true;

    /**
     * Resets the search string.
     */
    public function clearSearch(): void
    {
        $this->search = '';
    }
}
