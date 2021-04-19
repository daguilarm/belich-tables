<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Views\Traits;

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
        return app()->call($this->renderCallback, [
            'model' => $model ?? null,
        ]);
    }
}
