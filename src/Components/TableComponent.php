<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Components;

use Daguilarm\LivewireTables\Components\Traits\Checkboxes;
use Daguilarm\LivewireTables\Components\Traits\Delete;
use Daguilarm\LivewireTables\Components\Traits\Exports;
use Daguilarm\LivewireTables\Components\Traits\Filters;
use Daguilarm\LivewireTables\Components\Traits\Loading;
use Daguilarm\LivewireTables\Components\Traits\Model;
use Daguilarm\LivewireTables\Components\Traits\Operations;
use Daguilarm\LivewireTables\Components\Traits\Pagination;
use Daguilarm\LivewireTables\Components\Traits\PerPage;
use Daguilarm\LivewireTables\Components\Traits\Relationships;
use Daguilarm\LivewireTables\Components\Traits\Search;
use Daguilarm\LivewireTables\Components\Traits\Sorting;
use Daguilarm\LivewireTables\Components\Traits\SortingRelatioships;
use Daguilarm\LivewireTables\Components\Traits\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Class TableComponent.
 */
abstract class TableComponent extends Component
{
    use AuthorizesRequests,
        Checkboxes,
        Delete,
        Exports,
        Filters,
        Loading,
        Model,
        Operations,
        Pagination,
        PerPage,
        Relationships,
        Search,
        Sorting,
        SortingRelatioships,
        Table,
        WithPagination;

    /**
     * Add a new resource into the database for the current model.
     */
    public string $newResource;

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
    public bool $showOffline = true;

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
     * Set the model instance.
     */
    protected object $model;

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
        // Init the model
        $this->model = $this->getModel();
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
            'models' => $this->showPagination
                ? $this->models()->paginate((int) $this->perPage)
                : $this->models()->get(),
            'operations' => $this->mergeOperations(),
        ]);
    }
}
