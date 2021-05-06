<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Tests;

use Daguilarm\BelichTables\Tests\App\Models\Profile;
use Daguilarm\BelichTables\Tests\App\Models\User;

trait TestSeed
{
    protected function seedUsers()
    {
        return User::insert([
            ['id' => 1, 'name' => 'Damián Aguilar', 'email' => 'damian.aguilar@email.com', 'active' => 1, 'date' => '2021-04-22 00:00:01'],
            ['id' => 2, 'name' => 'Antonio Aguilar', 'email' => 'antonio.aguilar@email.com', 'active' => 0, 'date' => '2020-04-22 00:00:01'],
            ['id' => 3, 'name' => 'Maria Aguilar', 'email' => 'maria.aguilar@email.com', 'active' => 1, 'date' => '2019-04-22 00:00:01'],
            ['id' => 4, 'name' => 'Fernando Aguilar', 'email' => 'fernando.aguilar@email.com', 'active' => 1, 'date' => '2021-04-22 00:00:01'],
            ['id' => 5, 'name' => 'Emilio Aguilar', 'email' => 'emilio.aguilar@email.com', 'active' => 0, 'date' => '2020-04-22 00:00:01'],
            ['id' => 6, 'name' => 'Carmen Aguilar', 'email' => 'carmen.aguilar@email.com', 'active' => 1, 'date' => '2019-04-22 00:00:01'],
            ['id' => 7, 'name' => 'Silvia Aguilar', 'email' => 'silvia.aguilar@email.com', 'active' => 1, 'date' => '2021-04-22 00:00:01'],
            ['id' => 8, 'name' => 'Julio Aguilar', 'email' => 'julio.aguilar@email.com', 'active' => 0, 'date' => '2020-04-22 00:00:01'],
            ['id' => 9, 'name' => 'Elena Aguilar', 'email' => 'elena.aguilar@email.com', 'active' => 1, 'date' => '2019-04-22 00:00:01'],
        ]);
    }

    protected function seedProfiles()
    {
        return Profile::insert([
            ['id' => 1, 'user_id' => 1, 'profile_telephone' => '000000001'],
            ['id' => 2, 'user_id' => 2, 'profile_telephone' => '000000002'],
            ['id' => 3, 'user_id' => 3, 'profile_telephone' => '000000003'],
            ['id' => 4, 'user_id' => 4, 'profile_telephone' => '000000004'],
            ['id' => 5, 'user_id' => 5, 'profile_telephone' => '000000005'],
            ['id' => 6, 'user_id' => 6, 'profile_telephone' => '000000006'],
            ['id' => 7, 'user_id' => 7, 'profile_telephone' => '000000007'],
            ['id' => 8, 'user_id' => 8, 'profile_telephone' => '000000008'],
            ['id' => 9, 'user_id' => 9, 'profile_telephone' => '000000009'],
        ]);
    }
}
