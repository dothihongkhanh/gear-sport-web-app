<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DanhMuc extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ma_danh_muc',
        'ten_danh_muc',
    ];

    public function sanPham()
    {
        return $this->hasMany(SanPham::class, 'ma_danh_muc', 'ma_danh_muc');
    }
}