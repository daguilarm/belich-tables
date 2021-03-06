<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Components\Table;

trait Search
{
    /**
     * The initial search string.
     */
    public string $search = '';

    /**
     * Method to search by: debounce or lazy.
     */
    protected string $searchUpdateMethod = 'debounce';

    /**
     * Whether or not searching is enabled.
     */
    protected bool $showSearch = true;

    /**
     * false = disabled
     * int = Amount of time in ms to wait to send the search query and refresh the table.
     */
    protected int $searchDebounce = 350;

    /**
     * A button to clear the search box.
     */
    protected bool $clearSearchButton = true;

    /**
     * Resets the search string.
     */
    public function clearSearch(): void
    {
        $this->search = '';
    }
}
