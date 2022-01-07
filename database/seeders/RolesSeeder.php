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
            ],
            [
              'name' => 'Staff',
            ],
          ])->each(function($role) {
              DB::table('roles')->insert($role);
          });
    }
}
