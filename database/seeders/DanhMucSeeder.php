<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DanhMucSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('danh_muc')->insert([
            ['ten_danh_muc' => 'Dụng cụ tập gym', 'created_at' => now(), 'updated_at' => now()],
            ['ten_danh_muc' => 'Dụng cụ tập yoga', 'created_at' => now(), 'updated_at' => now()],
            ['ten_danh_muc' => 'Dụng cụ bóng đá', 'created_at' => now(), 'updated_at' => now()],
            ['ten_danh_muc' => 'Dụng cụ bóng rổ', 'created_at' => now(), 'updated_at' => now()],
            ['ten_danh_muc' => 'Dụng cụ bơi lội', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
