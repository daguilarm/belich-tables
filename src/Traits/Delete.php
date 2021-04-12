<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Traits;

trait Delete
{
    /**
     * Delete elements from ID or List of IDs.
     *
     * @param array|int $id
     */
    public function deleteItemById(?string $id = null): void
    {
        $element = match($id) {
            $id => $this->models()->findOrFail($id),
            is_null($id) && count($this->checkboxValues) > 0 => $this->models()->whereIn('id', $this->checkboxValues),
            default => null,
        };

        // Messages
        if ( !is_null($element) && $element->delete()) {
            // Success message
            flash(__('livewire-tables::strings.messages.delete.success'))->success()->livewire($this);
        } else {
            // Error message
            flash(__('livewire-tables::strings.messages.delete.error'))->error()->livewire($this);
        }
    }
}
