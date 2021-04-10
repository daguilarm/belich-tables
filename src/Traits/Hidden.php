<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Traits;

trait Hidden
{
    public string $show;

    /**
     * Hide content base on screen
     */
    public function hideFrom(string $value): self
    {
        $this->show = match($value) {
            'sm' => 'hidden',
            'md' => 'hidden lg:visible',
            'lg' => 'hidden xl:visible',
            'xl' => 'visible xl:hidden',
        };

        return $this;
    }

    /**
     * Show content base on screen
     */
    public function showOn(string $value): self
    {
        $this->show = match($value) {
            'sm' => 'visible',
            'md' => 'hidden md:visible',
            'lg' => 'hidden lg:visible',
            'xl' => 'hidden xl:visible',
        };

        return $this;
    }
}
