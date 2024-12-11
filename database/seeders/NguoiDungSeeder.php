<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NguoiDungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('nguoi_dung')->insert([
            [
                'ten_nguoi_dung' => 'admin',
                'email' => 'admin@gmail.com',
                'thoi_gian_xac_thuc_email' => Carbon::now(),
                'password' => bcrypt(123123),
                'remember_token' => null,
                'ma_google' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'ma_quyen' => 1,
            ],
            [
                'ten_nguoi_dung' => 'khh',
                'email' => 'khanh@gmail.com',
                'thoi_gian_xac_thuc_email' => Carbon::now(),
                'password' => bcrypt(123123),
                'remember_token' => null,
                'ma_google' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'ma_quyen' => 2,
            ],
        ]);
    }
}
