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
            $table->id();
            $table->unsignedBigInteger('ma_nguoi_dung');
            $table->unsignedBigInteger('ma_chi_tiet_san_pham');
            $table->unsignedInteger('so_luong');
            $table->timestamps();

            $table->foreign('ma_nguoi_dung')
                ->references('id')->on('nguoi_dung')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('ma_chi_tiet_san_pham')
                ->references('id')->on('chi_tiet_san_pham')->onUpdate('cascade')->onDelete('cascade');
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
