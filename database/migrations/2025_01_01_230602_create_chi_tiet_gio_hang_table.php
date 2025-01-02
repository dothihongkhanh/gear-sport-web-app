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
        Schema::create('chi_tiet_gio_hang', function (Blueprint $table) {
            $table->unsignedBigInteger('ma_chi_tiet_gio_hang')->autoIncrement();
            $table->unsignedBigInteger('ma_gio_hang');
            $table->unsignedBigInteger('ma_chi_tiet_san_pham');
            $table->unsignedInteger('so_luong');
            $table->timestamps();

            $table->foreign('ma_gio_hang')
                ->references('ma_gio_hang')->on('gio_hang')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('ma_chi_tiet_san_pham')
                ->references('ma_chi_tiet_san_pham')->on('chi_tiet_san_pham')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_gio_hang');
    }
};
