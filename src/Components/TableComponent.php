<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Components;

use Daguilarm\BelichTables\Components\Table\Checkboxes;
use Daguilarm\BelichTables\Components\Table\Delete;
use Daguilarm\BelichTables\Components\Table\Exports;
use Daguilarm\BelichTables\Components\Table\Filters;
use Daguilarm\BelichTables\Components\Table\Loading;
use Daguilarm\BelichTables\Components\Table\Model;
use Daguilarm\BelichTables\Components\Table\Operations;
use Daguilarm\BelichTables\Components\Table\Pagination;
use Daguilarm\BelichTables\Components\Table\PerPage;
use Daguilarm\BelichTables\Components\Table\Relationships;
use Daguilarm\BelichTables\Components\Table\Request;
use Daguilarm\BelichTables\Components\Table\Search;
use Daguilarm\BelichTables\Components\Table\Sorting;
use Daguilarm\BelichTables\Components\Table\Table;
use Daguilarm\BelichTables\Contracts\TableContract;
use Daguilarm\BelichTables\Facades\BelichTables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Class TableComponent.
 */
abstract class TableComponent extends Component implements TableContract
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
        Request,
        Search,
        Sorting,
        Table,
        WithPagination;

    /**
     * Add a new resource into the database for the current model.
     */
    protected string $newResource = '';

    /**
     * Whether or not to refresh the table at a certain interval (false is off).
     * By default will refresh every 2 seconds.
     */
    protected bool $refresh = false;

    /**
     * Refresh table each XX seconds.
     */
    protected int $refreshInSeconds = 2;

    /**
     * Whether or not to display an offline message when there is no connection.
     */
    protected bool $showOffline = true;

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
        $this->paginationTheme = BelichTables::theme();
        // Init the column's filter
        $this->sqlBuilder = $this->query();
        // Init the model
        $this->model = $this->getModel();
        // Get table name
        $this->tableName = $this->model->getTable();
    }

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
            'tableOptions' => $this->tableOptions(),
        ]);
    }

    /**
     * Set the table options.
     */
    public function tableOptions()
    {
        return collect([
            'checkboxes' => [
                'show' => $this->showCheckboxes,
            ],
            'export' => [
                'allowed' => $this->exportAllowedFormats,
                'selected' => Arr::sort($this->exports),
                'selectedTotal' => count($this->exports),
            ],
            'loading' => $this->showLoading,
            'newResource' => $this->newResource,
            'operations' => $this->mergeOperations(),
            'pagination' => $this->showPagination,
            'perPage' => [
                'options' => $this->perPageOptions,
                'show' => $this->showPerPage,
            ],
            'refresh' => $this->refresh,
            'refreshInSeconds' => $this->refreshInSeconds,
            'search' => [
                'clearButton' => $this->clearSearchButton,
                'debounce' => $this->searchDebounce,
                'show' => $this->showSearch,
                'updateMethod' => $this->searchUpdateMethod,
            ],
            'sort' => [
                'field' => $this->sortField,
                'direction' => $this->sortDirection,
            ],
            'table' => [
                'head' => $this->showTableHead,
                'footer' => $this->showTableFooter,
            ],
            'offline' => $this->showOffline,
        ]);
    }
}
