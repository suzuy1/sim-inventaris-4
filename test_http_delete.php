<?php

/**
 * Script untuk testing fungsi delete inventaris melalui HTTP request
 * Cara menjalankan: php test_http_delete.php
 */

require_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Inventaris;
use App\Http\Controllers\InventarisController;
use Illuminate\Http\JsonResponse;

echo "=== TESTING HTTP DELETE INVENTARIS ===\n\n";

try {
    // 1. Cari inventaris untuk testing
    $testInventaris = Inventaris::where('kategori', '!=', 'habis_pakai')->first();
    
    if (!$testInventaris) {
        echo "❌ Tidak ada data inventaris untuk diuji.\n";
        exit(0);
    }
    
    $inventarisId = $testInventaris->id;
    $inventarisName = $testInventaris->nama_barang;
    
    echo "1. Memilih inventaris untuk testing:\n";
    echo "   ID: {$inventarisId}\n";
    echo "   Nama: {$inventarisName}\n";
    echo "   Kategori: {$testInventaris->kategori}\n";
    
    // 2. Tampilkan data terkait sebelum delete
    echo "\n2. Data terkait sebelum delete:\n";
    $asetDetailsCount = $testInventaris->asetDetails()->count();
    $transactionsCount = $testInventaris->transactions()->count();
    $requestsCount = $testInventaris->requests()->count();
    
    echo "   Aset Details: {$asetDetailsCount}\n";
    echo "   Transactions: {$transactionsCount}\n";
    echo "   Requests: {$requestsCount}\n";
    
    // 3. Buat mock request dan controller
    echo "\n3. Membuat mock HTTP request...\n";
    
    // Mock user untuk authorization
    $mockUser = new class {
        public $name = 'Test User';
        public $role = 'admin';
        
        public function can($ability, $model) {
            return true; // Allow all for testing
        }
    };
    
    // Mock request
    $mockRequest = Request::create(
        "/inventaris/{$inventarisId}",
        'DELETE',
        [], // POST data
        [], // FILES
        [], // COOKIE
        [], // SERVER
        [] // CONTENT
    );
    
    // Set user in request
    $mockRequest->setUserResolver(function() use ($mockUser) {
        return $mockUser;
    });
    
    // Mock auth
    auth()->shouldReceive('user')->andReturn($mockUser);
    auth()->shouldReceive('check')->andReturn(true);
    
    echo "   Mock request created: DELETE /inventaris/{$inventarisId}\n";
    
    // 4. Test controller method
    echo "\n4. Testing controller destroy method...\n";
    
    $controller = new InventarisController();
    
    // Simulate the destroy method call
    try {
        // We need to mock the authorization since we're in console
        $reflection = new ReflectionClass($controller);
        $method = $reflection->getMethod('destroy');
        $method->setAccessible(true);
        
        echo "   Memanggil method destroy...\n";
        
        // Call the destroy method
        $result = $method->invoke($controller, $testInventaris);
        
        echo "   Method destroy berhasil dipanggil\n";
        
        // Check if result is a redirect response
        if ($result instanceof \Illuminate\Http\RedirectResponse) {
            echo "   Response type: RedirectResponse\n";
            echo "   Target URL: " . $result->getTargetUrl() . "\n";
            
            // Check for success message
            $session = $result->getSession();
            if ($session && $session->has('success')) {
                echo "   Success message: " . $session->get('success') . "\n";
            }
        }
        
    } catch (\Exception $e) {
        echo "   ERROR: " . $e->getMessage() . "\n";
        echo "   File: " . $e->getFile() . "\n";
        echo "   Line: " . $e->getLine() . "\n";
    }
    
    // 5. Verifikasi data setelah delete
    echo "\n5. Verifikasi data setelah delete:\n";
    
    $checkInventaris = Inventaris::find($inventarisId);
    $checkAsetDetails = \App\Models\AsetDetail::where('inventaris_id', $inventarisId)->count();
    
    echo "   Inventaris masih ada: " . ($checkInventaris ? 'YES' : 'NO') . "\n";
    echo "   Sisa aset details: {$checkAsetDetails}\n";
    
    if (!$checkInventaris && $checkAsetDetails == 0) {
        echo "\n✅ HTTP DELETE BERHASIL! Semua data terhapus dengan benar.\n";
    } else {
        echo "\n❌ HTTP DELETE GAGAL! Masih ada data tersisa.\n";
    }
    
    // 6. Test route registration
    echo "\n6. Verifikasi route registration:\n";
    $routes = app('router')->getRoutes();
    $deleteRoute = null;
    
    foreach ($routes as $route) {
        if ($route->methods()[0] === 'DELETE' && str_contains($route->uri(), 'inventaris')) {
            $deleteRoute = $route;
            break;
        }
    }
    
    if ($deleteRoute) {
        echo "   ✅ DELETE route ditemukan: " . $deleteRoute->uri() . "\n";
        echo "   Controller: " . $deleteRoute->getAction('uses') . "\n";
    } else {
        echo "   ❌ DELETE route tidak ditemukan!\n";
    }
    
    echo "\n=== HTTP TESTING SELESAI ===\n";
    
} catch (\Exception $e) {
    echo "\nERROR: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}