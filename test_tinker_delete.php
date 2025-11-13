<?php

/**
 * Script untuk testing fungsi delete inventaris menggunakan artisan tinker commands
 * Cara menjalankan: php artisan tinker --execute="include 'test_tinker_delete.php';"
 */

echo "=== TESTING DELETE DENGAN TINKER ===\n\n";

try {
    // 1. Cari inventaris untuk testing
    $inventaris = \App\Models\Inventaris::where('kategori', '!=', 'habis_pakai')->first();
    
    if (!$inventaris) {
        echo "❌ Tidak ada data inventaris untuk diuji.\n";
        return;
    }
    
    $id = $inventaris->id;
    $nama = $inventaris->nama_barang;
    
    echo "1. Data inventaris yang akan dihapus:\n";
    echo "   ID: {$id}\n";
    echo "   Nama: {$nama}\n";
    echo "   Kategori: {$inventaris->kategori}\n";
    
    // 2. Tampilkan data terkait
    echo "\n2. Data terkait sebelum delete:\n";
    $detailsCount = $inventaris->asetDetails()->count();
    $transactionsCount = $inventaris->transactions()->count();
    $requestsCount = $inventaris->requests()->count();
    
    echo "   Aset Details: {$detailsCount}\n";
    echo "   Transactions: {$transactionsCount}\n";
    echo "   Requests: {$requestsCount}\n";
    
    if ($detailsCount > 0) {
        echo "\n   Detail Aset:\n";
        $details = $inventaris->asetDetails()->get();
        foreach ($details as $detail) {
            echo "   - ID: {$detail->id}, Kode: {$detail->kode_inv}, Kondisi: {$detail->kondisi}\n";
        }
    }
    
    // 3. Lakukan delete
    echo "\n3. Melakukan delete...\n";
    
    \Illuminate\Support\Facades\DB::beginTransaction();
    
    try {
        // Log untuk debugging
        \Illuminate\Support\Facades\Log::info('=== TINKER DELETE TEST ===');
        \Illuminate\Support\Facades\Log::info("Deleting inventaris ID: {$id}, Name: {$nama}");
        
        // Hapus data terkait
        if ($inventaris->kategori === 'habis_pakai') {
            $deletedStok = $inventaris->stokHabisPakai()->delete();
            echo "   Deleted stok habis pakai: {$deletedStok} records\n";
        } else {
            $deletedDetails = $inventaris->asetDetails()->delete();
            echo "   Deleted aset details: {$deletedDetails} records\n";
        }
        
        // Hapus transaksi dan permintaan
        $deletedTransactions = $inventaris->transactions()->delete();
        $deletedRequests = $inventaris->requests()->delete();
        echo "   Deleted transactions: {$deletedTransactions} records\n";
        echo "   Deleted requests: {$deletedRequests} records\n";
        
        // Hapus master
        $deletedMaster = $inventaris->delete();
        echo "   Deleted master inventaris: " . ($deletedMaster ? 'SUCCESS' : 'FAILED') . "\n";
        
        \Illuminate\Support\Facades\DB::commit();
        \Illuminate\Support\Facades\Log::info('=== TINKER DELETE SUCCESS ===');
        echo "\n   ✅ Delete berhasil dilakukan!\n";
        
    } catch (\Exception $e) {
        \Illuminate\Support\Facades\DB::rollBack();
        \Illuminate\Support\Facades\Log::error('TINKER DELETE FAILED: ' . $e->getMessage());
        echo "\n   ❌ ERROR: " . $e->getMessage() . "\n";
        echo "   File: " . $e->getFile() . "\n";
        echo "   Line: " . $e->getLine() . "\n";
    }
    
    // 4. Verifikasi hasil
    echo "\n4. Verifikasi hasil:\n";
    
    $checkInventaris = \App\Models\Inventaris::find($id);
    $checkDetails = \App\Models\AsetDetail::where('inventaris_id', $id)->count();
    
    echo "   Inventaris masih ada: " . ($checkInventaris ? 'YES' : 'NO') . "\n";
    echo "   Sisa aset details: {$checkDetails}\n";
    
    if (!$checkInventaris && $checkDetails == 0) {
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