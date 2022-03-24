<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyProfilesSeeder extends Seeder
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
                'name' => 'Adisoft Inc',
                'phone_number' => '0987654321',
                'email' => 'customer@adisoft.id',
                'address' => 'Cirebon, Indonesia',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ])->each(function($company_profile) {
            DB::table('company_profiles')->insert($company_profile);
        });
    }
}
