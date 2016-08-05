<?php

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        User::create([
            'username' => 'user',
            'password' => 'user',
            'display_name' => 'User',
            'status' => 1,
            'access_level' => 2,
            'change_password' => 0
        ]);
    }
}
