<?php

namespace Database\Seeders;

use App\Models\Product;
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
            ProcessStatusesSeeder::class,
            UnitsSeeder::class,
            MainMenusSeeder::class,
            MenusSeeder::class,
            CompanyProfilesSeeder::class,
            UsersSeeder::class,
            PrivilegesSeeder::class,
            // RawIngredientsSeeder::class,
            // OnProcessIngredientsSeeder::class,
            // ProductsSeeder::class
        ]);

        Product::factory(35)->create();
    }
}
