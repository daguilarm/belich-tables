<?php

namespace Daguilarm\LivewireTables\Traits;

trait Checkboxes
{
    /**
     * Whether or not checkboxes are enabled.
     */
    public bool $checkbox = false;

    /**
     * Whether or not all checkboxes are currently selected.
     */
    public bool $checkboxAll = false;

    /**
     * The currently selected values of the checkboxes.
     *
     * @var array
     */
    public array $checkboxValues = [];

    /**
     * Adds all the id's to the checkbox array.
     */
    public function updatedCheckboxAll(): void
    {
        $this->checkboxValues = [];

        if ($this->checkboxAll) {
            $this->models()->each(function ($model) {
                $this->checkboxValues[] = (string) $model->id;
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
