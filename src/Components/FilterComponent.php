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
        public ?string $name,
        public ?string $model = null
    ) {}

    /**
     * Set the filter attributes.
     */
    public static function make(int | string | null ...$attributes): FilterComponent
    {
        //Set the field values
        return new static(...$attributes);
    }

    /**
     * Set the filter query.
     *
     * @param string | int | null $value
     */
    abstract public function query(Builder $model, $value): Builder;

    /**
     * Sent values for the view.
     *
     * @return  array<string>
     */
    abstract public function values(): array;

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
}
