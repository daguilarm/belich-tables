<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Traits;

trait Pagination
{
    /**
     * Displays per page and pagination links.
     */
    public bool $paginationEnabled = true;

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
     * https://laravel-livewire.com/docs/pagination
     * Resetting Pagination After Filtering Data.
     */
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    /**
     * https://laravel-livewire.com/docs/pagination
     * Resetting Pagination After Changing the perPage.
     */
    public function updatingPerPage(): void
    {
        $this->resetPage();
    }
}
