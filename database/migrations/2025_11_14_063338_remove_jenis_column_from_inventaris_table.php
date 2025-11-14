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
            if (Schema::hasColumn('inventaris', 'jenis')) {
                $table->dropColumn('jenis');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventaris', function (Blueprint $table) {
            // Jika Anda ingin mengembalikan kolom 'jenis' saat rollback, definisikan di sini.
            // Misalnya: $table->string('jenis')->nullable();
        });
    }
};
