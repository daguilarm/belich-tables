<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables;

use Daguilarm\LivewireTables\Traits\Exports;
use Daguilarm\LivewireTables\Traits\Loading;
use Daguilarm\LivewireTables\Traits\Model;
use Daguilarm\LivewireTables\Traits\Options;
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
    use Exports,
        Loading,
        Model,
        Options,
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
    public bool | string $refresh = false;

    /**
     * Whether or not to display an offline message when there is no connection.
     */
    public bool $offlineIndicator = true;

    /**
     * TableComponent constructor.
     *
     * @param  null  $id
     */
    public function __construct($id = null)
    {
        if (config('livewire-tables.theme') === 'bootstrap-4') {
            $this->paginationTheme = 'bootstrap';
        }

        $this->setOptions($this->options);

        parent::__construct($id);
    }

    /**
     * Set the query builder
     */
    abstract public function query(): Builder;

    /**
     * Set the columns
     */
    abstract public function columns(): array;

    /**
     * Set the view
     */
    public function view(): string
    {
        return 'livewire-tables::' . config('livewire-tables.theme').'.table-component';
    }

    /**
     * Render the view in the blade template
     */
    public function render(): View
    {
        return view($this->view(), [
            'columns' => $this->columns(),
            'models' => $this->paginationEnabled
                ? $this->models()->paginate($this->perPage)
                : $this->models()->get(),
        ]);
    }
}
