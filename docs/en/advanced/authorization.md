# Authorization

**Belichs Tables**  have two points where Authorization is used: when you delete an item or when you delete multiple items. In these cases, before deleting the elements, the package check if we have authorization to performe the action.

For example, let's imagine we want to delete users. The first thing we would have to do is create a **Policy** for the `User` **Model**, or every time we try to delete a user the package will notify us that the operation could not be performed.

In this case, what we are going to do is prevent us from deleting ourselves:

```php
<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given post can be delete by the user.
     */
    public function delete(User $user, User $target, int $id): bool
    {
        return $user->id !== $id;
    }
}
```

From the **Livewire Componet**, the **Model** to check (`$target`) and the element ID (`$id`). On the other hand, the **Livewire Component** works as follows:

```php
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
```

In the **Bulk Delete** case, what the system does is check in the same way, each element from the `array`:

```php
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
```
