<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Views\Traits;

trait ColumnCallback
{
    /**
     * @var Closure
     */
    protected $formatCallback;

    /**
     * @var Closure
     */
    protected $sortCallback;

    /**
     * @var Closure
     */
    protected $searchCallback;

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
     * Set the format callback.
     */
    public function format(callable $callable): self
    {
        $this->formatCallback = $callable;

        return $this;
    }

    /**
     * Format the callback.
     *
     * @param bool | int | float | object | string | null $value
     */
    public function formatted($value): bool | int | float | object | string | null
    {
        return call_user_func($this->formatCallback, $value);
    }
}
