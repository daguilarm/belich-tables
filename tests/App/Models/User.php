<?php

namespace Daguilarm\BelichTables\Tests\App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use \Sushi\Sushi;

    protected $rows = [
        ['id' => 1, 'name' => 'Damián Aguilar', 'email' => 'damian.aguilar@email.com', 'active' => 1, 'date' => '2021-04-22 00:00:01'],
        ['id' => 2, 'name' => 'Antonio Aguilar', 'email' => 'antonio.aguilar@email.com', 'active' => 0, 'date' => '2020-04-22 00:00:01'],
        ['id' => 3, 'name' => 'Maria López', 'email' => 'maria.lopez@email.com', 'active' => 1, 'date' => '2019-04-22 00:00:01'],
        ['id' => 4, 'name' => 'Fernando Arahujo', 'email' => 'fernando.arahujo@email.com', 'active' => 1, 'date' => '2021-04-22 00:00:01'],
        ['id' => 5, 'name' => 'Emilio Cremades', 'email' => 'emilio.cremades@email.com', 'active' => 0, 'date' => '2020-04-22 00:00:01'],
        ['id' => 6, 'name' => 'Carmen Porteros', 'email' => 'carmen.porteros@email.com', 'active' => 1, 'date' => '2019-04-22 00:00:01'],
        ['id' => 7, 'name' => 'Silvia Bosqueje', 'email' => 'silvia.bosqueje@email.com', 'active' => 1, 'date' => '2021-04-22 00:00:01'],
        ['id' => 8, 'name' => 'Julio Santalucia', 'email' => 'julio.santalucia@email.com', 'active' => 0, 'date' => '2020-04-22 00:00:01'],
        ['id' => 9, 'name' => 'Elena Juares', 'email' => 'elena.juares@email.com', 'active' => 1, 'date' => '2019-04-22 00:00:01'],
        ['id' => 10, 'name' => 'Paula Gómez', 'email' => 'paula.gomez@email.com', 'active' => 1, 'date' => '2019-04-22 00:00:01'],
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
