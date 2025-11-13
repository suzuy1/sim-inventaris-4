<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventarisController; // Changed from ItemController
use App\Http\Controllers\AcquisitionController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\TransactionController; // Import the TransactionController
use App\Http\Controllers\RequestController; // Import the RequestController
use App\Http\Controllers\ReportController; // Import the ReportController
use App\Http\Controllers\StokHabisPakaiController;
use App\Http\Controllers\SettingsController;

Route::get("/",[LoginController::class,"index"])->name("login");
Route::get("/login",[LoginController::class,"index"])->name("login.get");
Route::post("/login",[LoginController::class,"store"])->name("login.post");
Route::middleware("auth")->group(function () {
    Route::get("/dashboard",[DashboardController::class,"index"])->name("dashboard");
    Route::post("/logout",[LoginController::class,"logout"])->name("logout");

    // Inventaris (Struktur Rute BARU)
    Route::get("/inventaris/print_all",[InventarisController::class,"printAll"])->name("inventaris.print_all");
    Route::get("/inventaris/print_single/{id}",[InventarisController::class,"printSingle"])->name("inventaris.print_single"); // Ini mungkin perlu diubah ke {asetDetail}
    Route::post("inventaris/import",[InventarisController::class,"import"])->name("inventaris.import");
    Route::get("inventaris/export",[InventarisController::class,"export"])->name("inventaris.export");

    // [DIUBAH] Rute ini sekarang pakai ID master inventaris, bukan nama_barang
    Route::get("inventaris/grouped/{inventaris}",[InventarisController::class,"showGrouped"])->name("inventaris.show_grouped"); 

    // [RUTE BARU] Untuk menambah unit aset detail (form permintaan dosen)
    Route::get("inventaris/{inventaris}/detail/create", [InventarisController::class, "createAsetDetail"])->name("inventaris.detail.create");
    Route::post("inventaris/{inventaris}/detail", [InventarisController::class, "storeAsetDetail"])->name("inventaris.detail.store");

    // [TAMBAHKAN DUA RUTE INI] - Rute untuk Edit & Update Unit Aset Detail
    Route::get("aset-detail/{asetDetail}/edit", [InventarisController::class, "editAsetDetail"])->name("aset-detail.edit");
    Route::patch("aset-detail/{asetDetail}", [InventarisController::class, "updateAsetDetail"])->name("aset-detail.update");

// [TAMBAHKAN RUTE INI] - Rute untuk Delete Unit Aset Detail
    Route::delete("aset-detail/{asetDetail}", [InventarisController::class, "destroyAsetDetail"])->name("aset-detail.destroy");

    // Resource Route untuk CRUD Master Inventaris
    Route::resource("inventaris", InventarisController::class);

    Route::resource("acquisitions",AcquisitionController::class);
    Route::resource("rooms",RoomController::class);

    // Stok Habis Pakai
    Route::resource("stok", StokHabisPakaiController::class);
    Route::resource("users",UserController::class);
    Route::resource("units",UnitController::class);
    Route::resource("transactions",TransactionController::class)->except(["edit","update"]);
    Route::resource("requests",RequestController::class);

    // Settings Route
    Route::get("/settings",[SettingsController::class,"index"])->name("settings.index");

    // Profile Routes
    Route::get("/profile",[UserController::class,"edit"])->name("profile.edit");
    Route::patch("/profile",[UserController::class,"update"])->name("profile.update");

    // Report Routes
    Route::get("reports/transactions",[ReportController::class,"transactionReport"])->name("reports.transactions");
    Route::get("reports/item-history",[ReportController::class,"itemHistoryReport"])->name("reports.item_history");
});
