<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Components;

use Daguilarm\LivewireTables\Traits\Checkboxes;
use Daguilarm\LivewireTables\Traits\Delete;
use Daguilarm\LivewireTables\Traits\Exports;
use Daguilarm\LivewireTables\Traits\Filters;
use Daguilarm\LivewireTables\Traits\Loading;
use Daguilarm\LivewireTables\Traits\Model;
use Daguilarm\LivewireTables\Traits\Operations;
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
        Delete,
        Exports,
        Filters,
        Loading,
        Model,
        Operations,
        Pagination,
        Search,
        Sorting,
        Table,
        WithPagination,
        Yajra;

    /**
     * Filter values.
     *
     * @var array<string>
     */
    public array $filterValues = [];

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
     * Set the model builder.
     */
    protected Builder $sqlFilterBuilder;

    /**
     * Delete listeners.
     *
     * @var array<string>
     */
    protected $listeners = ['deleteItemById'];

    /**
     * TableComponent constructor.
     */
    public function __construct(?string $id = null)
    {
        parent::__construct($id);

        // Set the pagination theme
        $this->paginationTheme = config('livewire-tables.theme');
        // Init the column's filter
        $this->sqlFilterBuilder = $this->query();
    }

    /**
     * Set the columns.
     *
     * @return  array<string>
     */
    abstract public function columns(): array;

    /**
     * Set the filters.
     *
     * @return  array<string>
     */
    abstract public function filters(): array;

    /**
     * Set the query builder.
     */
    abstract public function query(): Builder;

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
        $this->resolveFilters();

        return view($this->viewName(), [
            'columns' => $this->columns(),
            'filters' => $this->filters(),
            'models' => $this->paginationEnabled
                ? $this->models()->paginate((int) $this->perPage)
                : $this->models()->get(),
            'operations' => $this->mergeOperations(),
        ]);
    }
}
