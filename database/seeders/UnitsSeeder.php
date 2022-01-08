<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitsSeeder extends Seeder
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
                'name' => 'Botol',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bungkus',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Dus',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Karung',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Kaleng',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Kg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Pcs',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Lembar',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Liter',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Pasang',
                'created_at' => now(),
                'updated_at' => now()
            ],
          ])->each(function($unit) {
              DB::table('units')->insert($unit);
          });
    }
}
