<?php

namespace Daguilarm\LivewireTables\Traits;

trait Hidden
{
    /**
     * Whether or not checkboxes are enabled.
     */
    public string $show;

    public function hideFrom(string $value): self
    {
        switch ($value) {
            case 'sm':
                $show = 'hidden';
                break;
            case 'md':
                $show = 'hidden lg:visible';
                break;
            case 'lg':
                $show = 'hidden xl:visible';
                break;
            case 'xl':
                $show = 'visible xl:hidden';
                break;
        }

        $this->show = $show;

        return $this;
    }

    public function showOn(string $value): self
    {
        switch ($value) {
            case 'sm':
                $show = 'visible';
                break;
            case 'md':
                $show = 'hidden md:visible';
                break;
            case 'lg':
                $show = 'hidden lg:visible';
                break;
            case 'xl':
                $show = 'hidden xl:visible';
                break;
        }

        $this->show = $show;

        return $this;
    }
}
