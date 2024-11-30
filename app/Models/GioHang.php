<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GioHang extends Model
{
    use HasFactory;

    protected $fillable = [
        'ma_gio_hang',
        'ma_nguoi_dung',
        'ma_chi_tiet_san_pham',
        'so_luong',
    ];

    public function nguoiDung()
    {
        return $this->belongsTo(NguoiDung::class, 'ma_nguoi_dung', 'ma_nguoi_dung');
    }

    public function chiTietSanPham()
    {
        return $this->hasMany(ChiTietSanPham::class, 'ma_chi_tiet_san_pham', 'ma_chi_tiet_san_pham');
    }
}
