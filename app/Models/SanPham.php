<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SanPham extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'san_pham';
    protected $primaryKey = 'ma_san_pham';
    protected $fillable = [
        'ma_danh_muc',
        'ma_thuong_hieu',
        'ten_san_pham',
        'mo_ta',
        'hinh_anh',
    ];

    public function danhMuc()
    {
        return $this->belongsTo(DanhMuc::class, 'ma_danh_muc', 'ma_danh_muc');
    }

    public function thuongHieu()
    {
        return $this->belongsTo(ThuongHieu::class, 'ma_thuong_hieu', 'ma_thuong_hieu');
    }

    public function chiTietSanPham()
    {
        return $this->hasMany(ChiTietSanPham::class, 'ma_san_pham', 'ma_san_pham')->withTrashed();
    }

    public function tongSoLuong()
    {
        return $this->chiTietSanPham->sum('so_luong');
    }
}
