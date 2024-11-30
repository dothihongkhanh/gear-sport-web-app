<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThuongHieu extends Model
{
    use HasFactory;

    protected $fillable = [
        'ma_thuong_hieu',
        'ten_thuong_hieu',
    ];

    public function sanPham()
    {
        return $this->hasMany(SanPham::class, 'ma_thuong_hieu', 'ma_thuong_hieu');
    } 
}
