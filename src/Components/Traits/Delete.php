<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Components\Traits;

use MattLibera\LivewireFlash\LivewireFlashNotifier;

trait Delete
{
    /**
     * Delete elements from ID.
     */
    public function deleteItemById(string $id): void
    {
        // First check if the user is authorized to delete the item
        $this->authorize('delete', [$this->model, $id]);
        // Delete item
        $operation = $this->model
            ->findOrFail($id)
            ->delete();
        // Send flash message
        $this->deleteMessages($operation);
    }

    /**
     * Delete elements from ID.
     */
    public function deleteListOfItemById(): void
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
        $this->deleteMessages($operation > 0 ? true : false);
    }

    /**
     * Delete messages.
     */
    private function deleteMessages(bool $deleteOperation): LivewireFlashNotifier
    {
        // Messages
        return $deleteOperation
            ? flash(trans('livewire-tables::strings.messages.delete.success'))
                ->success()
                ->livewire($this)
            : flash(trans('livewire-tables::strings.messages.delete.error'))
                ->error()
                ->livewire($this);
    }
}
