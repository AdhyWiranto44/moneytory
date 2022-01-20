<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
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
                'unit_id' => 7,
                'code' => 'PROD001',
                'name' => 'Roti Coklat',
                'base_price' => 1500,
                'profit' => 500,
                'stock' => 2.0,
                'minimum_stock' => 100.0,
                'image' => NULL,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ])->each(function($product) {
            DB::table('products')->insert($product);
        });
    }
}
