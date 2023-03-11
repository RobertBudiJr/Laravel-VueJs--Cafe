<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'nama_user' => 'Jon Wahyu',
                'role' => '1',
                'username' => 'JonAdmin',
                'email' => 'jonadmin@gmail.com',
                'password' => bcrypt('123456')
            ],
            [
                'nama_user' => 'Jin Wahyuning',
                'role' => '2',
                'username' => 'JinKasir',
                'email' => 'jinkasir@gmail.com',
                'password' => bcrypt('123456')
            ],
            [
                'nama_user' => 'Jun Setyono',
                'role' => '3',
                'username' => 'JunManager',
                'email' => 'junmanager@gmail.com',
                'password' => bcrypt('123456')
            ],
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
