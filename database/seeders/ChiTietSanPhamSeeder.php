<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChiTietSanPhamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('chi_tiet_san_pham')->insert([
            [
                'ma_san_pham' => 1,
                'thuoc_tinh' => 'Màu Xanh lá cây',
                'gia' => 350000,
                'so_luong' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_san_pham' => 1,
                'thuoc_tinh' => 'Màu Tím',
                'gia' => 350000,
                'so_luong' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
