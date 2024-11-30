<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChiTietSanPham extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ma_chi_tiet_san_pham',
        'ma_san_pham',
        'thuoc_tinh',
        'gia',
        'so_luong',
    ];

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'ma_san_pham', 'ma_san_pham');
    }
}
