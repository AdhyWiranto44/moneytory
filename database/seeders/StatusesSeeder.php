<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusesSeeder extends Seeder
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
              'name' => 'Nonaktif',
              'created_at' => now(),
              'updated_at' => now()
            ],
            [
              'name' => 'Aktif',
              'created_at' => now(),
              'updated_at' => now()
            ],
          ])->each(function($status) {
              DB::table('statuses')->insert($status);
          });
    }
}
