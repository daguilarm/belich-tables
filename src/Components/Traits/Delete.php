<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Components\Traits;

use MattLibera\LivewireFlash\LivewireFlashNotifier;

trait Delete
{
    /**
     * Delete an element base on its ID.
     */
    public function itemDelete(string $id): void
    {
        // First check if the user is authorized to delete the item
        $this->authorize('delete', [$this->model, $id]);

        // Delete item
        $operation = $this->model
            ->findOrFail($id)
            ->delete();
        // Send flash message
        $this->messageDelete($operation);
    }

    /**
     * Delete elements base on an array of Ids.
     */
    public function bulkDelete(): void
    {
        // First check if there is items to delete
        if ($this->checkboxValues) {
            // First check if the user is authorized to delete this items
            $this->authorize('deleteBulk', [$this->model, $this->checkboxValues]);

            // Delete the items
            $operation = $this->model
                ->whereIn('id', $this->checkboxValues)
                ->delete();
        }
        // Send flash message
        $this->messageDelete($operation > 0 ? true : false);
    }

    /**
     * Delete messages.
     */
    private function messageDelete(bool $deleteOperation): LivewireFlashNotifier
    {
        // Messages
        return $deleteOperation
            // Success message
            ? flash(trans('livewire-tables::strings.messages.delete.success'))->success()->livewire($this)
            // Error message
            : flash(trans('livewire-tables::strings.messages.delete.error'))->error()->livewire($this);
    }
}
