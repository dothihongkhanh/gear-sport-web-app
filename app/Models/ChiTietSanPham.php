<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChiTietSanPham extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'chi_tiet_san_pham';
    protected $primaryKey = 'ma_chi_tiet_san_pham';
    protected $fillable = [
        'ma_san_pham',
        'thuoc_tinh',
        'hinh_anh_chi_tiet',
        'gia',
        'so_luong',
    ];

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'ma_san_pham', 'ma_san_pham');
    }

    public function hetHang()
    {
        return $this->so_luong == 0;
    }
    
    public function chiTietDonHang()
    {
        return $this->hasMany(ChiTietDonHang::class, 'ma_chi_tiet_san_pham', 'ma_chi_tiet_san_pham');
    }
}
