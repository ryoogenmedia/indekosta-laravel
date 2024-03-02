<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'username' => 'muh bintang',
                'email' => 'muhbintang650@gmail.com',
                'email_verified_at' => now(),
                'roles' => 'admin',
                'password' => bcrypt('bintang123'),
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
