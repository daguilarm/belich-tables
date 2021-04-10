<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Traits;

trait Delete
{
    /**
     * Delete elements from ID or List of IDs
     *
     * @param array|int $id
     */
    public function deleteById($id): void
    {
        // Get the element or elements
        $element = is_array($id)
            ? $this->models()->whereIn('id', $id)
            : $this->models()->findOrFail($id);

        // Messages
        if($element->delete()) {
            session()->flash('message.success', __('livewire-tables::strings.messages.delete.success'));
        } else {
            session()->flash('message.error', __('livewire-tables::strings.messages.delete.error'));
        }
    }
}
