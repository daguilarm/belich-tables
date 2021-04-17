<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Components\Traits;

trait PerPage
{
    /**
     * The options to limit the amount of results per page.
     *
     * @var array <int>
     */
    public array $perPageOptions = [10, 25, 50, 100];

    /**
     * Amount of items to show per page.
     */
    public int $perPage = 25;

    /**
     * Show the per page select.
     */
    public bool $showPerPage = true;
}
