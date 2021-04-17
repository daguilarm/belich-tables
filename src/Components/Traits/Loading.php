<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Components\Traits;

trait Loading
{
    /**
     * Whether or not to show a loading indicator when searching.
     */
    public bool $loadingIndicator = true;

    /**
     * Whether or not to disable the search bar when it is searching/loading new data.
     */
    public bool $disableSearchOnLoading = false;

    /**
     * When the table is loading, hide all data but the loading row
     * Otherwise the loading row gets shown above the data (makes the page less jumpy).
     */
    public bool $collapseDataOnLoading = false;
}
