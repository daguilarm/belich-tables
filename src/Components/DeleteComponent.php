<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Components;

use Daguilarm\BelichTables\Facades\BelichTables;
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
        return view(BelichTables::include('components.delete-button'));
    }

    /**
     * Delete elements from ID or List of IDs.
     */
    public function itemDelete(?string $id = null): void
    {
        $this->emit('itemDelete', $id);
    }
}
