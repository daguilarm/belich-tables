<?php

namespace Daguilarm\BelichTables\Tests\App\Policies;

use Daguilarm\BelichTables\Tests\App\Models\User;
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
