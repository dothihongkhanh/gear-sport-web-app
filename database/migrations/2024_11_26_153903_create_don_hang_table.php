<?php

use App\Enums\PhuongThucThanhToan;
use App\Enums\TrangThaiDonHang;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('don_hang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ma_nguoi_dung');
            $table->string('ten_nguoi_nhan');
            $table->string('sdt_nhan_hang');
            $table->string('dia_chi_nhan_hang');
            $table->dateTime('thoi_gian_thanh_toan');
            $table->dateTime('thoi_gian_nhan_hang');
            $table->enum('phuong_thuc_thanh_toan', [PhuongThucThanhToan::VNPay, PhuongThucThanhToan::ThanhToanKhiNhanHang])->default(PhuongThucThanhToan::ThanhToanKhiNhanHang);
            $table->enum('trang_thai', [TrangThaiDonHang::DangChoXuLy, TrangThaiDonHang::DangGiaoHang, TrangThaiDonHang::HoanThanh, TrangThaiDonHang::DaHuy])->default(TrangThaiDonHang::DangChoXuLy);
            $table->uuid('ma_giao_dich_vnpay')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('ma_nguoi_dung')
                ->references('id')->on('nguoi_dung')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('don_hang');
    }
};
