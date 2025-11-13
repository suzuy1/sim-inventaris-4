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
        Schema::table('inventaris', function (Blueprint $table) {
            // Hapus kolom-kolom ini
            $table->dropColumn('lokasi');
            $table->dropColumn('kode_inventaris');
            $table->dropColumn('kondisi_baik');
            $table->dropColumn('kondisi_rusak_ringan');
            $table->dropColumn('kondisi_rusak_berat');
            
            // Hapus juga foreign key dan kolom unit_id
            // (Cek nama foreign key di file migrasi 2025_11_12_032505_add_unit_id_to_inventaris_table.php)
            // Biasanya 'inventaris_unit_id_foreign'
            // $table->dropForeign(['unit_id']); // Hati-hati, jika nama beda, sesuaikan
            $table->dropForeign('inventaris_unit_id_foreign'); // Laravel 10+
            $table->dropColumn('unit_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventaris', function (Blueprint $table) {
            // Jika di-rollback, kembalikan kolomnya
            $table->string('lokasi')->nullable();
            $table->string('kode_inventaris')->nullable();
            $table->integer('kondisi_baik')->default(0);
            $table->integer('kondisi_rusak_ringan')->default(0);
            $table->integer('kondisi_rusak_berat')->default(0);
            $table->foreignId('unit_id')->nullable()->constrained('units')->onDelete('set null');
        });
    }
};
