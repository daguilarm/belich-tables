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
        $this->authorize('delete', [$this->model, $id]);

        $operation = $this->model
            ->findOrFail($id)
            ->delete();

        $this->deleteMessages($operation);
    }

    /**
     * Delete elements from ID.
     */
    public function deleteListOfItemById(): void
    {
        if ($this->checkboxValues) {

            $this->authorize('deleteBulk', [$this->model, $this->checkboxValues]);

            $operation = $this->model
                ->whereIn('id', $this->checkboxValues)
                ->delete();
        }

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
