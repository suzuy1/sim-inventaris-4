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
            // Drop the existing string column if it exists
            if (Schema::hasColumn('inventaris', 'sumber_dana')) {
                $table->dropColumn('sumber_dana');
            }

            // Add the new foreign key column
            $table->foreignId('sumber_dana_id')->nullable()->after('kategori')->constrained('sumber_danas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventaris', function (Blueprint $table) {
            // Drop the foreign key constraint and column
            if (Schema::hasColumn('inventaris', 'sumber_dana_id')) {
                $table->dropConstrainedForeignId('sumber_dana_id');
                $table->dropColumn('sumber_dana_id');
            }

            // Re-add the original string column if it was dropped
            if (!Schema::hasColumn('inventaris', 'sumber_dana')) {
                $table->string('sumber_dana')->nullable()->after('kategori');
            }
        });
    }
};
