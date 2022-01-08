<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DebtStatusesSeeder extends Seeder
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
              'name' => 'Berhutang',
              'created_at' => now(),
              'updated_at' => now()
            ],
            [
              'name' => 'Lunas',
              'created_at' => now(),
              'updated_at' => now()
            ],
          ])->each(function($debt_status) {
              DB::table('debt_statuses')->insert($debt_status);
          });
    }
}
