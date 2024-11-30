<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SanPhamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('san_pham')->insert([
            [
                'ma_danh_muc' => 2,
                'ma_thuong_hieu' => 1,
                'ten_san_pham' => 'Thảm yoga ProFit',
                'mo_ta' => 'Thảm yoga ProFit, chất liệu cao cấp, độ bám tốt, giúp bạn tập yoga thoải mái và an toàn.',
                'hinh_anh' => 'tham_yoga_profit.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
