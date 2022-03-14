<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MainMenusSeeder extends Seeder
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
                'name' => 'Dashboard',
                'icon' => 'bi bi-speedometer2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bahan Mentah',
                'icon' => 'bi bi-cart4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bahan Dalam Proses',
                'icon' => 'bi bi-cpu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Barang Jadi',
                'icon' => 'bi bi-bag-check',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pemasukan',
                'icon' => 'bi bi-arrow-down-circle',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pengeluaran',
                'icon' => 'bi bi-arrow-up-circle',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hutang',
                'icon' => 'bi bi-emoji-dizzy',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pengguna',
                'icon' => 'bi bi-people',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pengaturan',
                'icon' => 'bi bi-gear',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ])->each(function($main_menu) {
            DB::table('main_menus')->insert($main_menu);
        });
    }
}
