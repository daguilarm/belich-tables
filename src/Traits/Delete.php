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
    public function deleteById(?string $id = null): void
    {
        $element = match($id) {
            // $id => $this->models()->findOrFail($id),
            // is_null($id) && count($this->checkboxValues) > 0 => $this->models()->whereIn('id', $this->checkboxValues),
            default => null,
        };

        // Messages
        if ($element && $element->delete()) {
            session()->flash('message.success', __('livewire-tables::strings.messages.delete.success'));
        } else {
            session()->flash('message.error', __('livewire-tables::strings.messages.delete.error'));
        }
    }
}
