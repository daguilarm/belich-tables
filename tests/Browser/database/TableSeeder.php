<?php

namespace Daguilarm\BelichTables\Tests\Browser\Database;

trait TableSeeder
{
    protected function tableSeederUsers()
    {
        return [
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
    }

    protected function tableSeederProfiles()
    {
        return [
            ['id' => 1, 'user_id' => 1, 'profile_telephone' => '100000001'],
            ['id' => 2, 'user_id' => 2, 'profile_telephone' => '100000002'],
            ['id' => 3, 'user_id' => 3, 'profile_telephone' => '100000003'],
            ['id' => 4, 'user_id' => 4, 'profile_telephone' => '100000004'],
            ['id' => 5, 'user_id' => 5, 'profile_telephone' => '100000005'],
            ['id' => 6, 'user_id' => 6, 'profile_telephone' => '100000006'],
            ['id' => 7, 'user_id' => 7, 'profile_telephone' => '100000007'],
            ['id' => 8, 'user_id' => 8, 'profile_telephone' => '100000008'],
            ['id' => 9, 'user_id' => 9, 'profile_telephone' => '100000009'],
            ['id' => 10, 'user_id' => 10, 'profile_telephone' => '100000010'],
            ['id' => 11, 'user_id' => 11, 'profile_telephone' => '100000011'],
            ['id' => 12, 'user_id' => 12, 'profile_telephone' => '100000012'],
            ['id' => 13, 'user_id' => 13, 'profile_telephone' => '100000013'],
            ['id' => 14, 'user_id' => 14, 'profile_telephone' => '100000014'],
            ['id' => 15, 'user_id' => 15, 'profile_telephone' => '100000015'],
            ['id' => 16, 'user_id' => 16, 'profile_telephone' => '100000016'],
            ['id' => 17, 'user_id' => 17, 'profile_telephone' => '100000017'],
            ['id' => 18, 'user_id' => 18, 'profile_telephone' => '100000018'],
            ['id' => 19, 'user_id' => 19, 'profile_telephone' => '100000019'],
            ['id' => 20, 'user_id' => 20, 'profile_telephone' => '100000020'],
            ['id' => 21, 'user_id' => 21, 'profile_telephone' => '100000021'],
            ['id' => 22, 'user_id' => 22, 'profile_telephone' => '100000022'],
            ['id' => 23, 'user_id' => 23, 'profile_telephone' => '100000023'],
            ['id' => 24, 'user_id' => 24, 'profile_telephone' => '100000024'],
            ['id' => 25, 'user_id' => 25, 'profile_telephone' => '100000025'],
            ['id' => 26, 'user_id' => 26, 'profile_telephone' => '100000026'],
            ['id' => 27, 'user_id' => 27, 'profile_telephone' => '100000027'],
            ['id' => 28, 'user_id' => 28, 'profile_telephone' => '100000028'],
            ['id' => 29, 'user_id' => 29, 'profile_telephone' => '100000029'],
            ['id' => 30, 'user_id' => 30, 'profile_telephone' => '100000030'],
        ];
    }
}
