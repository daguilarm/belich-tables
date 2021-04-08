<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Traits;

/**
 * Trait CanBeHidden.
 */
trait CanBeHidden
{
    /**
     * @var bool
     */
    protected $hidden = false;

    /**
     * @param $condition
     *
     * @return $this
     */
    public function hideIf($condition): self
    {
        $this->hidden = $condition;

        return $this;
    }

    /**
     * @return $this
     */
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
