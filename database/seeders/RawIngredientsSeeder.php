<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RawIngredientsSeeder extends Seeder
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
                'status_id' => 2,
                'code' => 'RAW001',
                'name' => 'Gula Pasir',
                'stock' => 1.0,
                'minimum_stock' => 0.2,
                'unit_id' => 6,
                'image' => NULL,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ])->each(function($rawIngredient) {
            DB::table('raw_ingredients')->insert($rawIngredient);
        });
    }
}
