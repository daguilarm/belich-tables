<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Views\Traits;

trait ColumnBoolean
{
    public bool $boolean = false;

    /**
     * Show content as boolean.
     */
    public function boolean(): self
    {
        $this->boolean = true;

        // Force the boolean type
        $this->toBoolean();

        return $this;
    }
}
