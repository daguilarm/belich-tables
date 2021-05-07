<?php

namespace Daguilarm\BelichTables\Tests\App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use \Sushi\Sushi;

    protected $rows = [
        ['id' => 1, 'user_id' => 1, 'profile_telephone' => '000000001'],
        ['id' => 2, 'user_id' => 2, 'profile_telephone' => '000000002'],
        ['id' => 3, 'user_id' => 3, 'profile_telephone' => '000000003'],
        ['id' => 4, 'user_id' => 4, 'profile_telephone' => '000000004'],
        ['id' => 5, 'user_id' => 5, 'profile_telephone' => '000000005'],
        ['id' => 6, 'user_id' => 6, 'profile_telephone' => '000000006'],
        ['id' => 7, 'user_id' => 7, 'profile_telephone' => '000000007'],
        ['id' => 8, 'user_id' => 8, 'profile_telephone' => '000000008'],
        ['id' => 9, 'user_id' => 9, 'profile_telephone' => '000000009'],
        ['id' => 10, 'user_id' => 10, 'profile_telephone' => '000000010'],
        ['id' => 11, 'user_id' => 11, 'profile_telephone' => '000000001'],
        ['id' => 12, 'user_id' => 12, 'profile_telephone' => '000000002'],
        ['id' => 13, 'user_id' => 13, 'profile_telephone' => '000000003'],
        ['id' => 14, 'user_id' => 14, 'profile_telephone' => '000000004'],
        ['id' => 15, 'user_id' => 15, 'profile_telephone' => '000000005'],
        ['id' => 16, 'user_id' => 16, 'profile_telephone' => '000000006'],
        ['id' => 17, 'user_id' => 17, 'profile_telephone' => '000000007'],
        ['id' => 18, 'user_id' => 18, 'profile_telephone' => '000000008'],
        ['id' => 19, 'user_id' => 19, 'profile_telephone' => '000000009'],
        ['id' => 20, 'user_id' => 20, 'profile_telephone' => '000000010'],
        ['id' => 21, 'user_id' => 21, 'profile_telephone' => '000000001'],
        ['id' => 22, 'user_id' => 22, 'profile_telephone' => '000000002'],
        ['id' => 23, 'user_id' => 23, 'profile_telephone' => '000000003'],
        ['id' => 24, 'user_id' => 24, 'profile_telephone' => '000000004'],
        ['id' => 25, 'user_id' => 25, 'profile_telephone' => '000000005'],
        ['id' => 26, 'user_id' => 26, 'profile_telephone' => '000000006'],
        ['id' => 27, 'user_id' => 27, 'profile_telephone' => '000000007'],
        ['id' => 28, 'user_id' => 28, 'profile_telephone' => '000000008'],
        ['id' => 29, 'user_id' => 29, 'profile_telephone' => '000000009'],
        ['id' => 30, 'user_id' => 30, 'profile_telephone' => '000000030'],
    ];

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
