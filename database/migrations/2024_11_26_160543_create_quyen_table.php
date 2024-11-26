<?php

use App\Enums\Quyen;
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
        Schema::create('quyen', function (Blueprint $table) {
            $table->id();
            $table->enum('ten_quyen',[Quyen::QuanTriVien, Quyen::KhachHang])->default(Quyen::KhachHang);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quyen');
    }
};
