<?php

use Illuminate\Database\Seeder;
use App\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->username = 'admin';
        $user->password = bcrypt('123123');
        $user->status = 'ADMIN';
        $user->profile_id = 0;
        $user->activated = 1;
        $user->save();
    }
}
