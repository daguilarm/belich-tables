<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Components;

use Daguilarm\BelichTables\Components\Traits\Checkboxes;
use Daguilarm\BelichTables\Components\Traits\Delete;
use Daguilarm\BelichTables\Components\Traits\Exports;
use Daguilarm\BelichTables\Components\Traits\Filters;
use Daguilarm\BelichTables\Components\Traits\Loading;
use Daguilarm\BelichTables\Components\Traits\Model;
use Daguilarm\BelichTables\Components\Traits\Operations;
use Daguilarm\BelichTables\Components\Traits\Pagination;
use Daguilarm\BelichTables\Components\Traits\PerPage;
use Daguilarm\BelichTables\Components\Traits\Relationships;
use Daguilarm\BelichTables\Components\Traits\Search;
use Daguilarm\BelichTables\Components\Traits\Sorting;
use Daguilarm\BelichTables\Components\Traits\SortingRelatioships;
use Daguilarm\BelichTables\Components\Traits\Table;
use Daguilarm\BelichTables\Components\Traits\Testing;
use Daguilarm\BelichTables\Facades\BelichTables;
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
        Testing,
        WithPagination;

    /**
     * Add a new resource into the database for the current model.
     */
    public string $newResource;

    /**
     * Whether or not to refresh the table at a certain interval (false is off).
     * By default will refresh every 2 seconds.
     */
    public bool $refresh = false;

    /**
     * Refresh table each XX seconds.
     */
    public int $refreshInSeconds = 2;

    /**
     * Whether or not to display an offline message when there is no connection.
     */
    public bool $showOffline = true;

    /**
     * Set the model builder.
     */
    protected Builder $sqlBuilder;

    /**
     * Get the table name from model.
     */
    protected string $getTableName;

    /**
     * Delete listeners.
     *
     * @var array<string>
     */
    protected $listeners = ['itemDelete', 'fileDownloadNotification'];

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
        $this->paginationTheme = config('belich-tables.theme');
        // Init the column's filter
        $this->sqlBuilder = $this->query();
        // Init the model
        $this->model = $this->getModel();
        // Get table name
        $this->tableName = $this->model->getTable();
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
    public function viewName(?string $viewName = null): string
    {
        return $viewName ?? BelichTables::include('table-component');
    }

    /**
     * Render the view in the blade template.
     */
    public function render(): View
    {
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
