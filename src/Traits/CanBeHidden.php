<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Traits;

trait CanBeHidden
{
    protected bool $hidden = false;

    /**
     * Hide content if condition.
     */
    public function hideIf(bool $condition): self
    {
        $this->hidden = $condition;

        return $this;
    }

    /**
     * Hide content.
     */
    public function hide(): self
    {
        $this->hidden = true;

        return $this;
    }

    /**
     * Check if content is visible.
     */
    public function isVisible(): bool
    {
        return $this->hidden !== true;
    }

    /**
     * Check if content is hidden.
     */
    public function isHidden(): bool
    {
        return ! $this->isVisible();
    }
}
