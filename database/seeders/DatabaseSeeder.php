<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DebtStatusesSeeder::class,
            DebtTypesSeeder::class,
            IncomeStatusesSeeder::class,
            RolesSeeder::class,
            StatusesSeeder::class,
            UnitsSeeder::class,
            MenusSeeder::class
        ]);
    }
}
