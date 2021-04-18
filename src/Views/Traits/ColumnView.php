<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Views\Traits;

use Daguilarm\LivewireTables\Views\Column;

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
    public function renderCallback(object $model)
    {
        return app()->call($this->renderCallback, [
            'model' => $model ?? null,
        ]);
    }
}
