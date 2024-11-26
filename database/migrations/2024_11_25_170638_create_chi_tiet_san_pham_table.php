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
        Schema::create('chi_tiet_san_pham', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ma_san_pham');
            $table->text('thuoc_tinh')->nullable();
            $table->integer('so_luong');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('ma_san_pham')
                ->references('id')->on('san_pham')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_san_pham');
    }
};
