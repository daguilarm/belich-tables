<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Components\Traits;

use MattLibera\LivewireFlash\LivewireFlashNotifier;

trait Delete
{
    /**
     * Delete an element base on its ID.
     */
    public function itemDelete(string $id): void
    {
        // First check if the user is authorized to delete the item
        if (request()->user()->can('delete', [$this->model, $id])) {
            // Delete item
            $operation = $this->model
                ->findOrFail($id)
                ->delete();
        }

        // Send flash message
        $this->messageDelete($operation ?? false);
    }

    /**
     * Delete elements base on an array of Ids.
     */
    public function bulkDelete(): void
    {
        // Set default value to 0
        $operation = 0;

        // Check if the items can be deleted
        $authItems = collect($this->checkboxValues)
            ->filter(function ($value, $key) {
                // Return only the authorized ones
                return request()
                    ->user()
                    ->can('delete', [
                        $this->model,
                        $value,
                    ]);
            })
            ->toArray();

        // Check if there is items to delete
        if ($authItems > 0) {
            // Delete the items
            $operation = $this->model
                ->whereIn('id', $authItems)
                ->delete();
        }

        // Send flash message
        $this->messageDelete($operation > 0 ? true : false);
    }

    /**
     * Delete messages.
     */
    private function messageDelete(bool $deleteOperation): LivewireFlashNotifier
    {
        // Messages
        return $deleteOperation
            // Success message
            ? flash(trans('belich-tables::strings.messages.delete.success'))->success()->livewire($this)
            // Error message
            : flash(trans('belich-tables::strings.messages.delete.error'))->error()->livewire($this);
    }
}
