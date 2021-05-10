<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Components\Table;

trait PerPage
{
    /**
     * Amount of items to show per page.
     */
    public int $perPage = 25;

    /**
     * The options to limit the amount of results per page.
     *
     * @var array <int>
     */
    protected array $perPageOptions = [10, 25, 50, 100];

    /**
     * Show the per page select.
     */
    protected bool $showPerPage = true;
}
