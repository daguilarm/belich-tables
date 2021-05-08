<?php

namespace Daguilarm\BelichTables\Tests\App\Models;

use Daguilarm\BelichTables\Tests\Browser\Database\TableSeeder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Sushi\Sushi;

class User extends Authenticatable
{
    use Sushi, TableSeeder;

    public function getRows()
    {
        return $this->tableSeederUsers();
    }

    protected $schema = [
        'active' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}
