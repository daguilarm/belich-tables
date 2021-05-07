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
        ['id' => 11, 'name' => 'Sergio Linares', 'email' => '1110@email.com', 'active' => 1, 'date' => '2021-04-22 00:00:01'],
        ['id' => 12, 'name' => 'Antonio Ginés', 'email' => '34234@email.com', 'active' => 0, 'date' => '2020-04-22 00:00:01'],
        ['id' => 13, 'name' => 'Gemma Lima', 'email' => '7657567z@email.com', 'active' => 1, 'date' => '2019-04-22 00:00:01'],
        ['id' => 14, 'name' => 'Fernando Abrasto', 'email' => '324234@email.com', 'active' => 1, 'date' => '2021-04-22 00:00:01'],
        ['id' => 15, 'name' => 'Emilio Hernaz', 'email' => '5435345@email.com', 'active' => 0, 'date' => '2020-04-22 00:00:01'],
        ['id' => 16, 'name' => 'Carmen Borrás', 'email' => '4534543@email.com', 'active' => 1, 'date' => '2019-04-22 00:00:01'],
        ['id' => 17, 'name' => 'Silvia Kinster', 'email' => '123123@email.com', 'active' => 1, 'date' => '2021-04-22 00:00:01'],
        ['id' => 18, 'name' => 'Julio Dominio', 'email' => '65467567@email.com', 'active' => 0, 'date' => '2020-04-22 00:00:01'],
        ['id' => 19, 'name' => 'Elena Nuñez', 'email' => '4234234@email.com', 'active' => 1, 'date' => '2019-04-22 00:00:01'],
        ['id' => 20, 'name' => 'Paula Hilario', 'email' => '234234@email.com', 'active' => 1, 'date' => '2019-04-22 00:00:01'],
        ['id' => 21, 'name' => 'Julian Comas', 'email' => '234234234@email.com', 'active' => 1, 'date' => '2021-04-22 00:00:01'],
        ['id' => 22, 'name' => 'Antonio Feridio', 'email' => '345345@email.com', 'active' => 0, 'date' => '2020-04-22 00:00:01'],
        ['id' => 23, 'name' => 'Maria Lianes', 'email' => '345345345@email.com', 'active' => 1, 'date' => '2019-04-22 00:00:01'],
        ['id' => 24, 'name' => 'Fernando Grome', 'email' => '6756757@email.com', 'active' => 1, 'date' => '2021-04-22 00:00:01'],
        ['id' => 25, 'name' => 'Emilio Cremades', 'email' => 'emilio.cremades@email.com', 'active' => 0, 'date' => '2020-04-22 00:00:01'],
        ['id' => 26, 'name' => 'Carmen Pertás', 'email' => '1526346@email.com', 'active' => 1, 'date' => '2019-04-22 00:00:01'],
        ['id' => 27, 'name' => 'Silvia Justo', 'email' => '6257@email.com', 'active' => 1, 'date' => '2021-04-22 00:00:01'],
        ['id' => 28, 'name' => 'Julio Esternio', 'email' => '423623@email.com', 'active' => 0, 'date' => '2020-04-22 00:00:01'],
        ['id' => 29, 'name' => 'Elena Luan', 'email' => '63623546@email.com', 'active' => 1, 'date' => '2019-04-22 00:00:01'],
        ['id' => 30, 'name' => 'Paula Ferrani', 'email' => 'paula.ferrani@email.com', 'active' => 1, 'date' => '2019-04-22 00:00:01'],
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
