<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThuongHieuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('thuong_hieu')->insert([
            ['ten_thuong_hieu' => 'Nike', 'created_at' => now(), 'updated_at' => now()],
            ['ten_thuong_hieu' => 'Adidas', 'created_at' => now(), 'updated_at' => now()],
            ['ten_thuong_hieu' => 'Puma', 'created_at' => now(), 'updated_at' => now()],
            ['ten_thuong_hieu' => 'Reebok', 'created_at' => now(), 'updated_at' => now()],
            ['ten_thuong_hieu' => 'New Balance', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
