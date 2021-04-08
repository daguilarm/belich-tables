<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Views;

use Daguilarm\LivewireTables\Traits\CanBeHidden;
use Illuminate\Support\Str;

class Column
{
    use CanBeHidden;

    protected string $text;
    protected string $attribute;
    protected bool $sortable = false;
    protected bool $searchable = false;
    protected bool $raw = false;
    protected bool $includeInExport = true;
    protected bool $exportOnly = false;

    /**
     * @var
     */
    protected $formatCallback;

    /**
     * @var
     */
    protected $exportFormatCallback;

    /**
     * @var
     */
    protected $sortCallback;

    /**
     * @var null
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

    public static function make(string $text, ?string $attribute = null): Column
    {
        return new static($text, $attribute);
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getAttribute(): string
    {
        return $this->attribute;
    }

    /**
     * @return mixed
     */
    public function getSortCallback()
    {
        return $this->sortCallback;
    }

    /**
     * @return mixed
     */
    public function getSearchCallback()
    {
        return $this->searchCallback;
    }

    public function isFormatted(): bool
    {
        return is_callable($this->formatCallback);
    }

    public function hasExportFormat(): bool
    {
        return is_callable($this->exportFormatCallback);
    }

    public function isSortable(): bool
    {
        return $this->sortable === true;
    }

    public function isSearchable(): bool
    {
        return $this->searchable === true;
    }

    public function isRaw(): bool
    {
        return $this->raw === true;
    }

    /**
     * @return $this
     */
    public function format(callable $callable): Column
    {
        $this->formatCallback = $callable;

        return $this;
    }

    /**
     * @return $this
     */
    public function exportFormat(callable $callable): Column
    {
        $this->exportFormatCallback = $callable;

        return $this;
    }

    /**
     * @param $model
     * @param $column
     *
     * @return mixed
     */
    public function formatted($model, $column)
    {
        return app()->call($this->formatCallback, ['model' => $model, 'column' => $column]);
    }

    /**
     * @param $model
     * @param $column
     *
     * @return mixed
     */
    public function formattedForExport($model, $column)
    {
        return app()->call($this->exportFormatCallback, ['model' => $model, 'column' => $column]);
    }

    /**
     * @return $this
     */
    public function sortable(?callable $callable = null): self
    {
        $this->sortCallback = $callable;
        $this->sortable = true;

        return $this;
    }

    /**
     * @return $this
     */
    public function searchable(?callable $callable = null): self
    {
        $this->searchCallback = $callable;
        $this->searchable = true;

        return $this;
    }

    /**
     * @return $this
     */
    public function raw(): self
    {
        $this->raw = true;

        return $this;
    }

    public function includedInExport(): bool
    {
        return $this->includeInExport === true;
    }

    /**
     * @return $this
     */
    public function exportOnly(): self
    {
        $this->hidden = true;
        $this->exportOnly = true;

        return $this;
    }

    public function isExportOnly(): bool
    {
        return $this->exportOnly === true;
    }

    /**
     * @return $this
     */
    public function excludeFromExport(): self
    {
        $this->includeInExport = false;

        return $this;
    }
}
