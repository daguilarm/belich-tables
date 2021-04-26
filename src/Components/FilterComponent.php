<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Components;

use Daguilarm\BelichTables\Contracts\FilterContract;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

abstract class FilterComponent extends Component implements FilterContract
{
    public string $tableColumn;
    public int | float | string $value;
    public string $view;

    /**
     * Init constructor.
     */
    public function __construct(public ?string $uriKey, public ?string $model = null)
    {
    }

    /**
     * Set the filter attributes.
     */
    public static function make(int | string | null ...$attributes): FilterComponent
    {
        //Set the field values
        return new static(...$attributes);
    }


    /**
     * Set model to filter.
     */
    public function model(string $value): self
    {
        $this->model = $value;

        return $this;
    }

    /**
     * Set table column.
     */
    public function tableColumn(string $value): self
    {
        $this->tableColumn = $value;

        return $this;
    }

    /**
     * Set view path [livewire-tables::filters.year].
     */
    public function view(string $value): self
    {
        $this->class = $value;

        return $this;
    }

    /**
     * Get the column name from table.
     */
    protected function getColumn(Builder $model, ?string $tableColumnName = null): string
    {
        return sprintf(
            // Pattern
            '%s.%s',
            // Table name
            $this->getTableNameFromBuilder($model),
            // Column name
            $tableColumnName ?? $this->tableColumn,
        );
    }

    /**
     * Get the table name from the builder.
     */
    private function getTableNameFromBuilder(Builder $builder): string
    {
        return $builder?->getQuery()?->from;
    }
}
