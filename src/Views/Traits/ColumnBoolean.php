<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Views\Traits;

trait ColumnBoolean
{
    public bool $showAsBoolean = false;

    /**
     * Show content as boolean.
     */
    public function showAsBoolean(): self
    {
        $this->showAsBoolean = true;

        // Force the boolean type
        $this->toBoolean();

        return $this;
    }
}
