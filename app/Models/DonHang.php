<?php

namespace App\Models;

use App\Enums\TrangThaiDonHang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DonHang extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'don_hang';
    protected $primaryKey = 'ma_don_hang';
    protected $fillable = [
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
            return $chiTiet->thanhTien(); // Tổng giá trị của mỗi chi tiết đơn hàng
        });
    }

    public function dangChoXuLy(): bool
    {
        return $this->trang_thai === TrangThaiDonHang::DangChoXuLy;
    }

    public function dangGiaoHang(): bool
    {
        return $this->trang_thai === TrangThaiDonHang::DangGiaoHang;
    }

    public function hoanThanh(): bool
    {
        return $this->trang_thai === TrangThaiDonHang::HoanThanh;
    }

    public function daHuy(): bool
    {
        return $this->trang_thai === TrangThaiDonHang::DaHuy;
    }
}
