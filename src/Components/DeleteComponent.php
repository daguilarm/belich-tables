<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Components;

use Livewire\Component;

/**
 * Class TableComponent.
 */
final class DeleteComponent extends Component
{
    public object $model;

    /**
     * Render component.
     */
    public function render()
    {
        return view('livewire-tables::'.config('livewire-tables.theme').'.components.delete-button');
    }

    /**
     * Delete elements from ID or List of IDs.
     */
    public function deleteItemById(?string $id = null): void
    {
        $this->emit('deleteItemById', $id);
    }
}
