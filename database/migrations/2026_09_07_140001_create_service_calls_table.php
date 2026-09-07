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
        if (!Schema::hasTable('service_calls')) {
            Schema::create('service_calls', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->foreignId('table_id')->constrained('tables')->cascadeOnDelete();
                $table->unsignedBigInteger('pengguna_id')->nullable();
                $table->string('type', 50)->default('panggil_pelayan')->comment('panggil_pelayan, minta_bill, minta_air, bersih_meja, lainnya');
                $table->text('notes')->nullable()->comment('catatan tambahan dari pelanggan');
                $table->string('status', 20)->default('pending')->comment('pending, selesai');
                $table->timestamps();
                $table->softDeletes();

                $table->foreign('pengguna_id')->references('id')->on('pengguna')->nullOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_calls');
    }
};
