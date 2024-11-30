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
        Schema::create('chi_tiet_don_hang', function (Blueprint $table) {
            $table->unsignedBigInteger('ma_chi_tiet_don_hang')->autoIncrement();
            $table->unsignedBigInteger('ma_don_hang');
            $table->unsignedBigInteger('ma_chi_tiet_san_pham');
            $table->decimal('gia');
            $table->unsignedInteger('so_luong_dat');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('ma_don_hang')->references('ma_don_hang')->on('don_hang')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ma_chi_tiet_san_pham')->references('ma_chi_tiet_san_pham')->on('chi_tiet_san_pham')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_don_hang');
    }
};
