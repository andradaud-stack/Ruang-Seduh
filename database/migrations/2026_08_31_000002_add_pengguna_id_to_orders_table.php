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
        if (! Schema::hasColumn('orders', 'pengguna_id')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->unsignedBigInteger('pengguna_id')->nullable()->after('user_id');
                $table->foreign('pengguna_id')->references('id')->on('pengguna')->nullOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('orders', 'pengguna_id')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropForeign(['pengguna_id']);
                $table->dropColumn('pengguna_id');
            });
        }
    }
};
