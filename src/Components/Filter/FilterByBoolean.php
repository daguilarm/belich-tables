<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Components\Filter;

use Daguilarm\BelichTables\Components\FilterComponent;
use Daguilarm\BelichTables\Contracts\FilterContract;
use Daguilarm\BelichTables\Facades\BelichTables;
use Illuminate\Database\Eloquent\Builder;

final class FilterByBoolean extends FilterComponent implements FilterContract
{
    public string $status_active;
    public string $status_desactivated;

    /**
     * Create a new field.
     */
    public function __construct(?string $uriKey = null)
    {
        parent::__construct($uriKey);

        // Set the view
        $this->view = BelichTables::include('sections.options.filters.boolean');
        // Set the unique key
        $this->uriKey = $uriKey ?? 'boolean';
        // Set default values for boolean's fields
        $this->status_active = trans('belich-tables::filters.status.active');
        $this->status_desactivated = trans('belich-tables::filters.status.desactivated');
    }

    /**
     * Set the filter query.
     *
     * @param int | float | string | null $value
     */
    public function apply(Builder $model, $value): Builder
    {
        return $model
            ->where($this->getColumn($model), (bool) $value);
    }

    /**
     * Set the filter query.
     *
     * @return  array<string>
     */
    public function options(): array
    {
        return [
            $this->status_active,
            $this->status_desactivated,
        ];
    }

    /**
     * Set the $status_active value.
     */
    public function trueValue(string $value): self
    {
        $this->status_active = $value;

        return $this;
    }

    /**
     * Set the $status_desactivated value.
     */
    public function falseValue(string $value): self
    {
        $this->status_desactivated = $value;

        return $this;
    }
}
