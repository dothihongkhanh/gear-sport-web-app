<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\NguoiDung as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class NguoiDung extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $table = 'nguoi_dung';
    protected $primaryKey = 'ma_nguoi_dung';
    protected $fillable = [
        'ten_nguoi_dung',
        'email',
        'thoi_gian_xac_thuc_email',
        'password',
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

     /**
     * Kiểm tra email đã được xác thực.
     *
     * @return bool
     */
    public function hasVerifiedEmail()
    {
        return !is_null($this->thoi_gian_xac_thuc_email);
    }

    /**
     * Đánh dấu email đã xác thực.
     *
     * @return bool
     */
    public function markEmailAsVerified()
    {
        return $this->forceFill([
            'thoi_gian_xac_thuc_email' => $this->freshTimestamp(),
        ])->save();
    }

    /**
     * Lấy ngày xác thực email.
     *
     * @return \Illuminate\Support\Carbon|null
     */
    public function getEmailVerifiedAtAttribute()
    {
        return $this->thoi_gian_xac_thuc_email;
    }
}
