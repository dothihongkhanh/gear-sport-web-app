<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChiTietDonHang extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'chi_tiet_don_hang';
    protected $primaryKey = 'ma_chi_tiet_don_hang';
    protected $fillable = [
        'ma_don_hang',
        'ma_chi_tiet_san_pham',
        'gia',
        'so_luong_dat',
    ];

    public function donHang()
    {
        return $this->belongsTo(DonHang::class, 'ma_don_hang', 'ma_don_hang');
    }

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'ma_chi_tiet_san_pham', 'ma_san_pham');
    }

    public function chiTietSanPham()
    {
        return $this->belongsTo(ChiTietSanPham::class, 'ma_chi_tiet_san_pham', 'ma_chi_tiet_san_pham');
    }

    public function thanhTien()
    {
        return $this->gia * $this->so_luong_dat;
    }
}
