<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Components\Table;

trait Request
{
    /**
     * Delete an element base on its ID.
     */
    public function requestUser(): object
    {
        // Just for testing the package
        if (app()->environment() === 'testing') {
            return \Daguilarm\BelichTables\Tests\App\Models\User::find(1);
        }

        // The regular way
        return request()->user();
    }
}
