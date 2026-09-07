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
        if (Schema::hasTable('order_items') && !Schema::hasColumn('order_items', 'notes')) {
            Schema::table('order_items', function (Blueprint $table) {
                $table->text('notes')->nullable()->after('subtotal')->comment('Kustomisasi pesanan seperti es, gula, catatan khusus');
            });
        }

        if (Schema::hasTable('orders') && !Schema::hasColumn('orders', 'catatan')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->text('catatan')->nullable()->after('status_pembayaran')->comment('Catatan umum untuk pesanan / meja');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('order_items') && Schema::hasColumn('order_items', 'notes')) {
            Schema::table('order_items', function (Blueprint $table) {
                $table->dropColumn('notes');
            });
        }

        if (Schema::hasTable('orders') && Schema::hasColumn('orders', 'catatan')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn('catatan');
            });
        }
    }
};
