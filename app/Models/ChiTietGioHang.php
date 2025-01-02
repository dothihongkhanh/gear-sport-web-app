<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietGioHang extends Model
{
    use HasFactory;

    protected $table = 'chi_tiet_gio_hang';
    protected $primaryKey = 'ma_chi_tiet_gio_hang';
    protected $fillable = [
        'ma_gio_hang',
        'ma_chi_tiet_san_pham',
        'so_luong',
    ];

    public function gioHang()
    {
        return $this->belongsTo(NguoiDung::class, 'ma_gio_hang', 'ma_gio_hang');
    }

    public function chiTietSanPham()
    {
        return $this->belongsTo(ChiTietSanPham::class, 'ma_chi_tiet_san_pham', 'ma_chi_tiet_san_pham');
    }
}
