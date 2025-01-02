<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GioHang extends Model
{
    use HasFactory;

    protected $table = 'gio_hang';
    protected $primaryKey = 'ma_gio_hang';
    protected $fillable = [
        'ma_nguoi_dung',
        'ma_chi_tiet_san_pham',
        'so_luong',
    ];

    public function nguoiDung()
    {
        return $this->belongsTo(NguoiDung::class, 'ma_nguoi_dung', 'ma_nguoi_dung');
    }

    public function chiTietGioHang()
    {
        return $this->hasMany(ChiTietGioHang::class, 'ma_gio_hang', 'ma_gio_hang');
    }
}
