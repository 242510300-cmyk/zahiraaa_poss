<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->foreignId('jenis_makanan_id')
                  ->nullable()
                  ->after('nama')
                  ->constrained('jenis_makanans')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->dropForeign(['jenis_makanan_id']);
            $table->dropColumn('jenis_makanan_id');
        });
    }
};