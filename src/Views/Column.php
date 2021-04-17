<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Views;

use Daguilarm\LivewireTables\Components\Traits\CanBeHidden;
use Daguilarm\LivewireTables\Views\Traits\Hidden;
use Illuminate\Support\Str;

final class Column
{
    use CanBeHidden,
        Hidden;

    protected string $text;
    protected string $attribute;
    protected bool $sortable = false;
    protected bool $searchable = false;
    protected bool $raw = false;
    protected bool $includeInExport = true;
    protected bool $exportOnly = false;

    /**
     * @var Closure
     */
    protected $formatCallback;

    /**
     * @var Closure
     */
    protected $exportFormatCallback;

    /**
     * @var Closure
     */
    protected $sortCallback;

    /**
     * @var Closure
     */
    protected $searchCallback;

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
     * Create a sort callback. This part is something to elavorate.
     */
    public function getSortCallback(): ?callable
    {
        return $this->sortCallback;
    }

    /**
     * Create a search callback. This part is something to elavorate.
     */
    public function getSearchCallback(): ?callable
    {
        return $this->searchCallback;
    }

    /**
     * Check if the format callback is callable.
     */
    public function isFormatted(): bool
    {
        return is_callable($this->formatCallback);
    }

    /**
     * Check if the export format is callable.
     */
    public function hasExportFormat(): bool
    {
        return is_callable($this->exportFormatCallback);
    }

    /**
     * Check if the column is sortable.
     */
    public function isSortable(): bool
    {
        return $this->sortable === true;
    }

    /**
     * Check if the column is searchable.
     */
    public function isSearchable(): bool
    {
        return $this->searchable === true;
    }

    /**
     * Check if the column is raw.
     */
    public function isRaw(): bool
    {
        return $this->raw === true;
    }

    /**
     * Set the format callback.
     */
    public function format(callable $callable): self
    {
        $this->formatCallback = $callable;

        return $this;
    }

    /**
     * Set the export format callback.
     */
    public function exportFormat(callable $callable): self
    {
        $this->exportFormatCallback = $callable;

        return $this;
    }

    /**
     * Format the callback.
     */
    public function formatted(object $model, Column $column): object
    {
        return app()
            ->call($this->formatCallback, ['model' => $model, 'column' => $column]);
    }

    /**
     * Format the export callback.
     */
    public function formattedForExport(object $model, Column $column): object
    {
        return app()
            ->call($this->exportFormatCallback, ['model' => $model, 'column' => $column]);
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
     * Searchable column.
     */
    public function searchable(?callable $callable = null): self
    {
        $this->searchCallback = $callable;
        $this->searchable = true;

        return $this;
    }

    /**
     * Raw column.
     */
    public function raw(): self
    {
        $this->raw = true;

        return $this;
    }

    /**
     * Include column in export.
     */
    public function includedInExport(): bool
    {
        return $this->includeInExport === true;
    }

    /**
     * Include this column only for export.
     */
    public function exportOnly(): self
    {
        $this->hidden = true;
        $this->exportOnly = true;

        return $this;
    }

    /**
     * Check if the column is only for export.
     */
    public function isExportOnly(): bool
    {
        return $this->exportOnly === true;
    }

    /**
     * Exclude this column from export.
     */
    public function excludeFromExport(): self
    {
        $this->includeInExport = false;

        return $this;
    }
}
