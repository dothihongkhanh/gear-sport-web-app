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
        Schema::table('nguoi_dung', function (Blueprint $table) {
            $table->unsignedBigInteger('ma_quyen')->default(2);

            $table->foreign('ma_quyen')
                ->references('ma_quyen')->on('quyen')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nguoi_dung', function (Blueprint $table) {
            $table->dropForeign(['ma_quyen']);
            $table->dropColumn('ma_quyen');
        });
    }
};