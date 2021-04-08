<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Traits;

/**
 * Trait CanBeHidden.
 */
trait CanBeHidden
{
    protected bool $hidden = false;

    public function hideIf($condition): self
    {
        $this->hidden = $condition;

        return $this;
    }

    public function hide(): self
    {
        $this->hidden = true;

        return $this;
    }

    public function isVisible(): bool
    {
        return $this->hidden !== true;
    }

    public function isHidden(): bool
    {
        return ! $this->isVisible();
    }
}
