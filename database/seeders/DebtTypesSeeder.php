<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DebtTypesSeeder extends Seeder
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
              'name' => 'Terhutang',
            ],
            [
              'name' => 'Penghutang',
            ],
          ])->each(function($debt_type) {
              DB::table('debt_types')->insert($debt_type);
          });
    }
}
