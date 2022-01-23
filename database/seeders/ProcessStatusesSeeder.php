<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProcessStatusesSeeder extends Seeder
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
              'name' => 'Selesai',
              'created_at' => now(),
              'updated_at' => now()
            ],
            [
              'name' => 'Sedang Diproses',
              'created_at' => now(),
              'updated_at' => now()
            ],
          ])->each(function($process_status) {
              DB::table('process_statuses')->insert($process_status);
          });
    }
}
