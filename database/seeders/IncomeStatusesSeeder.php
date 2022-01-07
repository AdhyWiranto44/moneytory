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
            ],
            [
              'name' => 'Lunas',
            ],
          ])->each(function($incomeStatus) {
              DB::table('income_statuses')->insert($incomeStatus);
          });
    }
}
