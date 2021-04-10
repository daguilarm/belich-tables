<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables;

use Daguilarm\LivewireTables\Traits\Checkboxes;
use Daguilarm\LivewireTables\Traits\Exports;
use Daguilarm\LivewireTables\Traits\Hidden;
use Daguilarm\LivewireTables\Traits\Loading;
use Daguilarm\LivewireTables\Traits\Model;
use Daguilarm\LivewireTables\Traits\Pagination;
use Daguilarm\LivewireTables\Traits\Search;
use Daguilarm\LivewireTables\Traits\Sorting;
use Daguilarm\LivewireTables\Traits\Table;
use Daguilarm\LivewireTables\Traits\Yajra;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Class TableComponent.
 */
abstract class TableComponent extends Component
{
    use Checkboxes,
        Exports,
        Hidden,
        Loading,
        Model,
        Pagination,
        Search,
        Sorting,
        Table,
        WithPagination,
        Yajra;

    /**
     * The default pagination theme.
     */
    public string $paginationTheme = 'tailwind';

    /**
     * Whether or not to refresh the table at a certain interval
     * false is off
     * If it's an integer it will be treated as milliseconds (2000 = refresh every 2 seconds)
     * If it's a string it will call that function every 5 seconds.
     */
    public bool $refresh = false;

    /**
     * Whether or not to display an offline message when there is no connection.
     */
    public bool $offlineIndicator = true;

    /**
     * TableComponent constructor.
     */
    public function __construct(?string $id = null)
    {
        $this->paginationTheme = config('livewire-tables.theme');

        parent::__construct($id);
    }

    /**
     * Set the query builder.
     */
    abstract public function query(): Builder;

    /**
     * Set the columns.
     */
    abstract public function columns(): array;

    /**
     * Set the view.
     */
    public function viewName(): string
    {
        return 'livewire-tables::'.config('livewire-tables.theme').'.table-component';
    }

    /**
     * Render the view in the blade template.
     */
    public function render(): View
    {
        return view($this->viewName(), [
            'columns' => $this->columns(),
            'models' => $this->paginationEnabled
                ? $this->models()->paginate($this->perPage)
                : $this->models()->get(),
        ]);
    }
}
