<?php

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
        Schema::create('gio_hang', function (Blueprint $table) {
            $table->unsignedBigInteger('ma_gio_hang')->autoIncrement();
            $table->unsignedBigInteger('ma_nguoi_dung');
            $table->unsignedBigInteger('ma_chi_tiet_san_pham');
            $table->unsignedInteger('so_luong');
            $table->timestamps();

            $table->foreign('ma_nguoi_dung')
                ->references('ma_nguoi_dung')->on('nguoi_dung')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('ma_chi_tiet_san_pham')
                ->references('ma_chi_tiet_san_pham')->on('chi_tiet_san_pham')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gio_hang');
    }
};