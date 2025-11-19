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
            // Hapus foreign keys dulu jika ada
            // Karena tabel di-rename dari 'items' ke 'inventaris',
            // nama foreign key constraint kemungkinan masih menggunakan 'items_'.
            
            // Drop foreign key for 'unit_id'
            if (Schema::hasColumn('inventaris', 'unit_id')) {
                // Explicitly drop using the original table name's foreign key convention
                $table->dropForeign('items_unit_id_foreign'); 
            }
            
            // Drop foreign key for 'room_id'
            if (Schema::hasColumn('inventaris', 'room_id')) {
                // Explicitly drop using the original table name's foreign key convention
                $table->dropForeign('items_room_id_foreign');
            }

            $table->dropColumn([
                'pemilik',
                'sumber_dana',
                'tahun_beli',
                'nomor_unit',
                'keterangan',
                'lokasi',
                'unit_id',
                'room_id',
                'kode_inventaris' // Kode inventaris juga dihapus karena logikanya rusak
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventaris', function (Blueprint $table) {
            // Tambahkan kembali kolom jika migration di-rollback
            $table->string('pemilik')->nullable();
            $table->string('sumber_dana')->nullable();
            $table->date('tahun_beli')->nullable();
            $table->integer('nomor_unit')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('lokasi')->nullable();
            $table->foreignId('unit_id')->nullable()->constrained('units');
            $table->foreignId('room_id')->nullable()->constrained('rooms', 'id_room');
            $table->string('kode_inventaris')->nullable()->unique();
        });
    }
};
