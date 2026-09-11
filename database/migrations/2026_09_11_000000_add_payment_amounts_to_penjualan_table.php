<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penjualan', function (Blueprint $table) {
            $table->integer('uang_dibayar')->default(0)->after('total_pembayaran');
            $table->integer('kembalian')->default(0)->after('uang_dibayar');
        });
    }

    public function down(): void
    {
        Schema::table('penjualan', function (Blueprint $table) {
            $table->dropColumn(['uang_dibayar', 'kembalian']);
        });
    }
};