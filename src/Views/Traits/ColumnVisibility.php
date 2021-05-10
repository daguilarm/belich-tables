<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Views\Traits;

trait ColumnVisibility
{
    protected string $show = '';

    /**
     * Hide content base on screen.
     */
    public function hideFrom(string $value): self
    {
        $this->show = match ($value) {
            'sm' => 'hidden',
            'md' => 'hidden lg:block',
            'lg' => 'hidden xl:block',
            'xl' => 'block xl:hidden',
            default => '',
        };

        return $this;
    }

    /**
     * Show content base on screen.
     */
    public function showOn(string $value): self
    {
        $this->show = match ($value) {
            'sm' => 'block',
            'md' => 'hidden md:block',
            'lg' => 'hidden lg:block',
            'xl' => 'hidden xl:block',
            default => '',
        };

        return $this;
    }

    /**
     * Get column visibility.
     */
    public function getVisibility()
    {
        return $this->show;
    }
}
