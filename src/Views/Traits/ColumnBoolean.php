<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Views\Traits;

trait ColumnBoolean
{
    /**
     * Show content base on screen.
     */
    public function boolean(): self
    {
        $this->boolean = true;

        return $this;
    }
}
