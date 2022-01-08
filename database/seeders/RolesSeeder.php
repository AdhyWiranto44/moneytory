<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
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
              'name' => 'Administrator',
              'created_at' => now(),
              'updated_at' => now()
            ],
            [
              'name' => 'Staff',
              'created_at' => now(),
              'updated_at' => now()
            ],
          ])->each(function($role) {
              DB::table('roles')->insert($role);
          });
    }
}
