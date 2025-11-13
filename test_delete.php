<?php

/**
 * Script untuk testing fungsi delete inventaris melalui terminal
 * Cara menjalankan: php test_delete.php
 */

require_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Inventaris;
use App\Models\AsetDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

echo "=== TESTING DELETE INVENTARIS ===\n\n";

try {
    // 1. Tampilkan data inventaris yang ada
    echo "1. Menampilkan data inventaris yang ada:\n";
    $inventarisList = Inventaris::where('kategori', '!=', 'habis_pakai')->get();
    
    if ($inventarisList->isEmpty()) {
        echo "   Tidak ada data inventaris untuk diuji.\n";
        exit(0);
    }
    
    foreach ($inventarisList as $inv) {
        $detailCount = $inv->asetDetails()->count();
        echo "   ID: {$inv->id}, Nama: {$inv->nama_barang}, Kategori: {$inv->kategori}, Detail Count: {$detailCount}\n";
    }
    
    // 2. Pilih inventaris pertama untuk testing
    $testInventaris = $inventarisList->first();
    $inventarisId = $testInventaris->id;
    $inventarisName = $testInventaris->nama_barang;
    
    echo "\n2. Memilih inventaris untuk testing:\n";
    echo "   ID: {$inventarisId}\n";
    echo "   Nama: {$inventarisName}\n";
    
    // 3. Tampilkan data terkait sebelum delete
    echo "\n3. Data terkait sebelum delete:\n";
    $asetDetailsCount = $testInventaris->asetDetails()->count();
    $transactionsCount = $testInventaris->transactions()->count();
    $requestsCount = $testInventaris->requests()->count();
    
    echo "   Aset Details: {$asetDetailsCount}\n";
    echo "   Transactions: {$transactionsCount}\n";
    echo "   Requests: {$requestsCount}\n";
    
    // 4. Tampilkan detail aset jika ada
    if ($asetDetailsCount > 0) {
        echo "\n   Detail Aset:\n";
        $details = $testInventaris->asetDetails()->get();
        foreach ($details as $detail) {
            echo "   - ID: {$detail->id}, Kode: {$detail->kode_inv}, Kondisi: {$detail->kondisi}\n";
        }
    }
    
    // 5. Konfirmasi delete
    echo "\n4. Melakukan delete...\n";
    
    DB::beginTransaction();
    
    try {
        // Log sebelum delete
        Log::info('=== TEST DELETE START ===');
        Log::info("Deleting inventaris ID: {$inventarisId}, Name: {$inventarisName}");
        
        // Hapus data terkait
        if ($testInventaris->kategori === 'habis_pakai') {
            $deletedStok = $testInventaris->stokHabisPakai()->delete();
            echo "   Deleted stok habis pakai: {$deletedStok} records\n";
        } else {
            $deletedAsetDetails = $testInventaris->asetDetails()->delete();
            echo "   Deleted aset details: {$deletedAsetDetails} records\n";
        }
        
        // Hapus transaksi dan permintaan
        $deletedTransactions = $testInventaris->transactions()->delete();
        $deletedRequests = $testInventaris->requests()->delete();
        echo "   Deleted transactions: {$deletedTransactions} records\n";
        echo "   Deleted requests: {$deletedRequests} records\n";
        
        // Hapus master
        $deletedMaster = $testInventaris->delete();
        echo "   Deleted master inventaris: " . ($deletedMaster ? 'SUCCESS' : 'FAILED') . "\n";
        
        DB::commit();
        Log::info('=== TEST DELETE SUCCESS ===');
        echo "\n   Delete berhasil dilakukan!\n";
        
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('TEST DELETE FAILED: ' . $e->getMessage());
        echo "\n   ERROR: " . $e->getMessage() . "\n";
        echo "   File: " . $e->getFile() . "\n";
        echo "   Line: " . $e->getLine() . "\n";
    }
    
    // 6. Verifikasi data setelah delete
    echo "\n5. Verifikasi data setelah delete:\n";
    
    $checkInventaris = Inventaris::find($inventarisId);
    $checkAsetDetails = AsetDetail::where('inventaris_id', $inventarisId)->count();
    
    echo "   Inventaris masih ada: " . ($checkInventaris ? 'YES' : 'NO') . "\n";
    echo "   Sisa aset details: {$checkAsetDetails}\n";
    
    if (!$checkInventaris && $checkAsetDetails == 0) {
        echo "\n✅ DELETE BERHASIL! Semua data terhapus dengan benar.\n";
    } else {
        echo "\n❌ DELETE GAGAL! Masih ada data tersisa.\n";
    }
    
    echo "\n=== TESTING SELESAI ===\n";
    
} catch (\Exception $e) {
    echo "\nERROR: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
}