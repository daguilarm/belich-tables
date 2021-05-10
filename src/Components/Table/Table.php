<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Components\Table;

trait Table
{
    /**
     * Whether or not to display the table header.
     */
    protected bool $showTableHead = true;

    /**
     * Whether or not to display the table footer.
     */
    protected bool $showTableFooter = false;
}
