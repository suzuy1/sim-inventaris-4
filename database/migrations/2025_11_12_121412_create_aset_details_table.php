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
        Schema::create('aset_details', function (Blueprint $table) {
            $table->id();
            
            // Foreign key ke tabel inventaris (master barang)
            $table->foreignId('inventaris_id')->constrained('inventaris')->onDelete('cascade');
            
            $table->string('kode_inv')->unique()->comment('Kode unik per unit, misal: KRS-001');
            $table->date('tgl_pembelian')->nullable();
            $table->decimal('harga_beli', 15, 2)->nullable();
            $table->string('sumber_dana')->nullable();
            
            // Ini 'kondisi' yang select (Baik, Rusak Ringan, Rusak Berat)
            $table->enum('kondisi', ['Baik', 'Rusak Ringan', 'Rusak Berat'])->default('Baik');
            
            // Asumsi 'Ruangan' = room_id dari tabel rooms
            $table->foreignId('room_id')->nullable()->constrained('rooms')->onDelete('set null');
            
            // Asumsi 'Penanggung Jawab' = user_id dari tabel users
            $table->foreignId('penanggung_jawab_id')->nullable()->constrained('users')->onDelete('set null');
            
            $table->text('keterangan')->nullable();
            
            // Opsional sesuai list kamu
            $table->date('tgl_perbaikan')->nullable();
            $table->date('tgl_pengecekan')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aset_details');
    }
};
