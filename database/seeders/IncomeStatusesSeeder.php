<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncomeStatusesSeeder extends Seeder
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
              'name' => 'Belum Lunas',
              'created_at' => now(),
              'updated_at' => now()
            ],
            [
              'name' => 'Lunas',
              'created_at' => now(),
              'updated_at' => now()
            ],
          ])->each(function($incomeStatus) {
              DB::table('income_statuses')->insert($incomeStatus);
          });
    }
}
