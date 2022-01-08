<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
                'username' => 'admin',
                'password' => Hash::make('12345', ['rounds' => 10]),
                'name' => 'Adhy Wiranto',
                'phone_number' => '088976685446',
                'email' => null,
                'address' => null,
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ])->each(function($user) {
            DB::table('users')->insert($user);
        });
    }
}
