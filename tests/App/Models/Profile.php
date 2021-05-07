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
