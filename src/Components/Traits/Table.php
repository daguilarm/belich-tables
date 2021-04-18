<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Components\Traits;

trait Table
{
    /**
     * Whether or not to display the table header.
     */
    public bool $showTableHead = true;

    /**
     * Whether or not to display the table footer.
     */
    public bool $showTableFooter = false;
}
