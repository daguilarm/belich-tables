<?php

namespace Daguilarm\BelichTables\Tests\App\Models;

use Daguilarm\BelichTables\Tests\Browser\Database\TableSeeder;
use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class Profile extends Model
{
    use Sushi, TableSeeder;

    public function getRows()
    {
        return $this->tableSeederProfiles();
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
