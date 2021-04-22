<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Views\Traits;

trait ColumnView
{
    /**
     * @var Closure
     */
    protected $renderCallback;

    /**
     * Set the format callback.
     */
    public function render(callable $callable): self
    {
        $this->renderCallback = $callable;

        // Set object type
        $this->toObject();

        return $this;
    }

    /**
     * Check if the view is callable.
     */
    public function isRenderable(): bool
    {
        return is_callable($this->renderCallback);
    }

    /**
     * Format the callback.
     */
    public function renderCallback(object $model): object
    {
        return call_user_func($this->renderCallback, $model);
    }
}
