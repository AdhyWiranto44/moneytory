<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OnProcessIngredientsSeeder extends Seeder
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
                'raw_ingredient_id' => 1,
                'code' => 'PROC001',
                'purpose' => 'Membuat kue ultah',
                'amount' => 0.5,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ])->each(function($onProcessIngredient) {
            DB::table('on_process_ingredients')->insert($onProcessIngredient);
        });
    }
}
