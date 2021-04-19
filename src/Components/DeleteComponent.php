<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Components;

use Daguilarm\LivewireTables\Facades\LivewireTables;
use Livewire\Component;

/**
 * Class TableComponent.
 */
final class DeleteComponent extends Component
{
    public string $userId;

    /**
     * Render component.
     *
     * @return  Illuminate\View\View
     */
    public function render()
    {
        return view(LivewireTables::include('components.delete-button'));
    }

    /**
     * Delete elements from ID or List of IDs.
     */
    public function deleteItemById(?string $id = null): void
    {
        $this->emit('deleteItemById', $id);
    }
}
