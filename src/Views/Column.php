<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Views;

use Daguilarm\LivewireTables\Views\Traits\ColumnBoolean;
use Daguilarm\LivewireTables\Views\Traits\ColumnCallback;
use Daguilarm\LivewireTables\Views\Traits\ColumnExport;
use Daguilarm\LivewireTables\Views\Traits\ColumnHidden;
use Daguilarm\LivewireTables\Views\Traits\ColumnResolve;
use Daguilarm\LivewireTables\Views\Traits\ColumnType;
use Daguilarm\LivewireTables\Views\Traits\ColumnView;
use Daguilarm\LivewireTables\Views\Traits\ColumnVisibility;
use Illuminate\Support\Str;

final class Column
{
    use ColumnBoolean,
        ColumnCallback,
        ColumnExport,
        ColumnHidden,
        ColumnResolve,
        ColumnType,
        ColumnView,
        ColumnVisibility;

    protected string $text;
    protected string $attribute;
    protected bool $sortable = false;
    protected bool $searchable = false;
    protected bool $includeInExport = true;
    protected bool $exportOnly = false;

    /**
     * Column constructor.
     */
    public function __construct(string $text, ?string $attribute)
    {
        $this->text = $text;
        $this->attribute = $attribute ?? Str::snake(Str::lower($text));
    }

    /**
     * Column maker.
     */
    public static function make(string $text, ?string $attribute = null): Column
    {
        return new static($text, $attribute);
    }

    /**
     * Get column text.
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Get column attribute.
     */
    public function getAttribute(): string
    {
        return $this->attribute;
    }

    /**
     * Sortable column.
     */
    public function sortable(?callable $callable = null): self
    {
        $this->sortCallback = $callable;
        $this->sortable = true;

        return $this;
    }

    /**
     * Check if the column is sortable.
     */
    public function isSortable(): bool
    {
        return $this->sortable === true;
    }

    /**
     * Searchable column.
     */
    public function searchable(?callable $callable = null): self
    {
        $this->searchCallback = $callable;
        $this->searchable = true;

        return $this;
    }

    /**
     * Check if the column is searchable.
     */
    public function isSearchable(): bool
    {
        return $this->searchable === true;
    }
}
