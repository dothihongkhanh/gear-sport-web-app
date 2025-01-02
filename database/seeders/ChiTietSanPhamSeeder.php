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
                'thuoc_tinh' => 'Màu hồng',
                'hinh_anh_chi_tiet' => '/storage/sanpham/chitiet/thamyoga_pink.jpg',
                'gia' => 50000,
                'so_luong' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_san_pham' => 1,
                'thuoc_tinh' => 'Màu xanh dương',
                'hinh_anh_chi_tiet' => '/storage/sanpham/chitiet/thamyoga_blue.jpg',
                'gia' => 45000,
                'so_luong' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_san_pham' => 1,
                'thuoc_tinh' => 'Màu tím',
                'hinh_anh_chi_tiet' => '/storage/sanpham/chitiet/thamyoga_purple.jpg',
                'gia' => 45000,
                'so_luong' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_san_pham' => 1,
                'thuoc_tinh' => 'Màu xanh lá',
                'hinh_anh_chi_tiet' => '/storage/sanpham/chitiet/thamyoga_green.jpg',
                'gia' => 50000,
                'so_luong' => 25,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_san_pham' => 2,
                'thuoc_tinh' => null,
                'hinh_anh_chi_tiet' => '/storage/sanpham/daynhay.jpg',
                'gia' => 80000,
                'so_luong' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_san_pham' => 3,
                'thuoc_tinh' => 'Màu tím',
                'hinh_anh_chi_tiet' => '/storage/sanpham/chitiet/daykeo_purple.jpg',
                'gia' => 30000,
                'so_luong' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_san_pham' => 3,
                'thuoc_tinh' => 'Màu hồng',
                'hinh_anh_chi_tiet' => '/storage/sanpham/chitiet/daykeo_pink.jpg',
                'gia' => 32000,
                'so_luong' => 27,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_san_pham' => 3,
                'thuoc_tinh' => 'Màu xanh',
                'hinh_anh_chi_tiet' => '/storage/sanpham/chitiet/daykeo_blue.jpg',
                'gia' => 32000,
                'so_luong' => 33,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
