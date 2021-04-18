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
        $operation = $this->getModel()
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
            $operation = $this->getModel()
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
