<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            [
                'role_id' => 1,
                'status_id' => 2,
                'username' => 'admin',
                'password' => '$2y$10$69YxYqgi7Svk8vCEOjHBp.AnsYNud.rW1OCFhsvfDeIaLQK6GUugG',
                'name' => 'Adhy Wiranto',
                'phone_number' => '0987654321',
                'email' => 'adhy@adisoft.id',
                'address' => 'Cirebon, Indonesia',
                'image' => NULL,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 2,
                'status_id' => 2,
                'username' => 'jeongyeon',
                'password' => '$2y$10$69YxYqgi7Svk8vCEOjHBp.AnsYNud.rW1OCFhsvfDeIaLQK6GUugG',
                'name' => 'Yoo Jeongyeon',
                'phone_number' => '0987654321',
                'email' => 'jeongyeon@adisoft.id',
                'address' => 'Seoul, Korea Selatan',
                'image' => NULL,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ])->each(function($user) {
            DB::table('users')->insert($user);
        });
    }
}
