<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NguoiDung extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'nguoi_dung';
    protected $primaryKey = 'ma_nguoi_dung';
    protected $fillable = [
        'ten_nguoi_dung',
        'email',
        'thoi_gian_xac_thuc_email',
        'mat_khau',
        'ma_google',
        'ma_quyen',
    ];

    public function donHang()
    {
        return $this->hasMany(DonHang::class, 'ma_nguoi_dung', 'ma_nguoi_dung');
    }

    public function soDonHang()
    {
        return $this->donHang()->count();
    }
}
