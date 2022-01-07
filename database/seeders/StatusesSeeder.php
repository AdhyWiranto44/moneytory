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
            ],
            [
              'name' => 'Aktif',
            ],
          ])->each(function($status) {
              DB::table('statuses')->insert($status);
          });
    }
}
