<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Traits;

trait Checkboxes
{
    /**
     * Whether or not checkboxes are enabled. Enable by default.
     */
    public bool $checkboxEnable = true;

    /**
     * Whether or not all checkboxes are currently selected.
     */
    public bool $checkboxAll = false;

    /**
     * The currently selected values of the checkboxes.
     *
     * @var array<int>
     */
    public array $checkboxValues = [];

    /**
     * Adds all the id's to the checkbox array.
     */
    public function updatedCheckboxAll(): void
    {
        $this->checkboxValues = [];

        if ($this->checkboxAll) {
            // Update checkboxes
            $this->models()
                ->each(function ($model): void {
                    $this->checkboxValues[] = (int) $model->id;
                });
        }
    }

    /**
     * Toggles the checkbox that selects/deselects all of the checkboxes.
     */
    public function updatedCheckboxValues(): void
    {
        $this->checkboxAll = false;
    }
}
