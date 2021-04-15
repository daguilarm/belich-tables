<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Traits;

trait Delete
{
    /**
     * Delete elements from ID.
     */
    public function deleteItemById(string $id): void
    {
        $operation = $this
            ->models()
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
            $operation = $this
                ->models()
                ->whereIn('id', $this->checkboxValues)
                ->delete();
        }

        $this->deleteMessages($operation > 0 ? true : false);
    }

    /**
     * Delete messages.
     */
    private function deleteMessages(bool $deleteOperation)
    {
        // Messages
        return $deleteOperation
            ? flash(trans('livewire-tables::strings.messages.delete.success'))->success()->livewire($this)
            : flash(trans('livewire-tables::strings.messages.delete.error'))->error()->livewire($this);
    }
}
