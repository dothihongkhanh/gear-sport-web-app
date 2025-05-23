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
        Schema::create('san_pham', function (Blueprint $table) {
            $table->unsignedBigInteger('ma_san_pham')->autoIncrement();
            $table->unsignedBigInteger('ma_danh_muc');
            $table->unsignedBigInteger('ma_thuong_hieu');
            $table->string('ten_san_pham');
            $table->text('mo_ta')->nullable();
            $table->text('hinh_anh');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('ma_danh_muc')
                ->references('ma_danh_muc')->on('danh_muc')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('ma_thuong_hieu')
                ->references('ma_thuong_hieu')->on('thuong_hieu')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('san_pham');
    }
};
