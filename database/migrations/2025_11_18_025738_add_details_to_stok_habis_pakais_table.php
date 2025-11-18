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
        Schema::table('stok_habis_pakais', function (Blueprint $table) {
            // Kolom baru
            $table->string('satuan', 50)->nullable()->after('jumlah_keluar');
            $table->date('tgl_kadaluarsa')->nullable()->after('satuan');
            $table->date('tgl_pengecekan')->nullable()->after('tgl_kadaluarsa');
            $table->text('keterangan')->nullable()->after('tgl_pengecekan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stok_habis_pakais', function (Blueprint $table) {
            $table->dropColumn(['satuan', 'tgl_kadaluarsa', 'tgl_pengecekan', 'keterangan']);
        });
    }
};
