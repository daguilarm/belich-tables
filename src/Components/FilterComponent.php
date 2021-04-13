<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Components;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

abstract class FilterComponent extends Component
{
    public string $tableColumn;
    public int | float | string $value;
    public string $view;

    /**
     * Init constructor.
     */
    public function __construct(
        public string $name,
        public ?string $model = null
    ) {
    }

    /**
     * Set the field attributes.
     */
    abstract public static function make(...$attributes);

    /**
     * Set filter database query.
     */
    abstract public function query();

    /**
     * Set model to filter.
     */
    public function modal(string $value): self
    {
        $this->modal = $value;

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
     * Reset all the filters.
     */
    public function resetAllFilters(): void
    {
        $this->filterValues = [];
        $this->search = '';
    }
}
