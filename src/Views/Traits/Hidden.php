<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Views\Traits;

trait Hidden
{
    public string $show = '';

    /**
     * Hide content base on screen.
     */
    public function hideFrom(string $value): self
    {
        $this->show = match($value) {
            'sm' => 'invisible',
            'md' => 'invisible lg:visible',
            'lg' => 'invisible xl:visible',
            'xl' => 'visible xl:invisible',
            default => '',
        };

        return $this;
    }

    /**
     * Show content base on screen.
     */
    public function showOn(string $value): self
    {
        $this->show = match($value) {
            'sm' => 'visible',
            'md' => 'invisible md:visible',
            'lg' => 'invisible lg:visible',
            'xl' => 'invisible xl:visible',
            default => '',
        };

        return $this;
    }
}
