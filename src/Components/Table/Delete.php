<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Components\Table;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

trait Delete
{
    /**
     * Delete an element base on its ID.
     */
    public function itemDelete(string $id): void
    {
        // Set the default user
        $user = $this->requestUser();

        // First check if the user is authorized to delete the item
        if ($user->can('delete', [$this->model, $id])) {
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

        // Set the default user
        $user = $this->requestUser();

        // Check if the items can be deleted
        $authItems = collect($this->checkboxValues)
            ->filter(function ($value, $key) use ($user) {
                // Return only the authorized ones
                return $user->can('delete', [
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
    private function messageDelete(bool $deleteOperation)
    {
        session()->forget('message');

        // Messages
        return $deleteOperation
            // Success message
            ? session()->flash('message', ['success', trans('belich-tables::strings.messages.delete.success'), Str::random(20)])
            // Error message
            : session()->flash('message', ['danger', trans('belich-tables::strings.messages.delete.error'), Str::random(20)]);
    }
}
