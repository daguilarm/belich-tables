<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Components\Table;

trait Pagination
{
    /**
     * The default pagination theme.
     */
    protected string $paginationTheme;

    /**
     * Displays per page and pagination links.
     */
    protected bool $showPagination = true;

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
