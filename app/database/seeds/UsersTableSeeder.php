<?php

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        User::create([
            'username' => 'admin',
            'password' => 'admin',
            'display_name' => 'Admin',
            'status' => 1,
            'access_level' => 3,
            'change_password' => 0
        ]);

        User::create([
            'username' => 'play',
            'password' => 'play',
            'display_name' => 'Play User',
            'status' => 1,
            'access_level' => 2,
            'change_password' => 0
        ]);


        User::create([
            'username' => 'trial',
            'password' => 'trial',
            'display_name' => 'Trial User',
            'status' => 1,
            'access_level' => 1,
            'change_password' => 0
        ]);
    }
}
