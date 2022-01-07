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
            ['name' => 'Botol'],
            ['name' => 'Bungkus'],
            ['name' => 'Dus'],
            ['name' => 'Karung'],
            ['name' => 'Kaleng'],
            ['name' => 'Kg'],
            ['name' => 'Pcs'],
            ['name' => 'Lembar'],
            ['name' => 'Liter'],
            ['name' => 'Pasang'],
          ])->each(function($unit) {
              DB::table('units')->insert($unit);
          });
    }
}
