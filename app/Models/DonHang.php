<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DonHang extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ma_don_hang',
        'ma_nguoi_dung',
        'ten_nguoi_nhan',
        'sdt_nhan_hang',
        'dia_chi_nhan_hang',
        'thoi_gian_thanh_toan',
        'thoi_gian_nhan_hang',
        'phuong_thuc_thanh_toan',
        'trang_thai',
        'ma_giao_dich_vnpay',
    ];

    public function nguoiDung()
    {
        return $this->belongsTo(NguoiDung::class, 'ma_nguoi_dung', 'ma_nguoi_dung');
    }


    public function chiTietDonHang()
    {
        return $this->hasMany(ChiTietDonHang::class, 'ma_don_hang', 'ma_don_hang');
    }

    public function tongGiaTri()
    {
        return $this->chiTietDonHang->sum(function ($chiTiet) {
            return $chiTiet->tongGiaTri(); // Tổng giá trị của mỗi chi tiết đơn hàng
        });
    }
}