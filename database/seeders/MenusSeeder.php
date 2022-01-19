<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenusSeeder extends Seeder
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
                'role_id' => '2',
                'url' => '/',
                'icon' => 'bi bi-speedometer2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bahan Mentah',
                'role_id' => '2',
                'url' => '/raw-ingredients',
                'icon' => 'bi bi-cart4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bahan Dalam Proses',
                'role_id' => '2',
                'url' => '/on-process-ingredients',
                'icon' => 'bi bi-cpu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Barang Jadi',
                'role_id' => '2',
                'url' => '/products',
                'icon' => 'bi bi-bag-check',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pemasukan',
                'role_id' => '2',
                'url' => '/incomes',
                'icon' => 'bi bi-arrow-down-circle',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pengeluaran',
                'role_id' => '2',
                'url' => '/expenses',
                'icon' => 'bi bi-arrow-up-circle',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hutang',
                'role_id' => '2',
                'url' => '/debts',
                'icon' => 'bi bi-emoji-dizzy',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pengguna',
                'role_id' => '1',
                'url' => '/users',
                'icon' => 'bi bi-people',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pengaturan',
                'role_id' => '2',
                'url' => '/settings',
                'icon' => 'bi bi-gear',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ])->each(function($menu) {
            DB::table('menus')->insert($menu);
        });
    }
}
