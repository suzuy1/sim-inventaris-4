<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\AcquisitionController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StokHabisPakaiController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SumberDanaController;

Route::get("/",[LoginController::class,"index"])->name("login");
Route::get("/login",[LoginController::class,"index"])->name("login.get");
Route::post("/login",[LoginController::class,"store"])->name("login.post");

Route::middleware("auth")->group(function () {
    Route::get("/dashboard",[DashboardController::class,"index"])->name("dashboard");
    Route::get("/dashboard/total-inventory-types",[DashboardController::class,"getTotalInventoryTypes"])->name("dashboard.total_inventory_types");
    Route::post("/logout",[LoginController::class,"logout"])->name("logout");

    Route::get("/inventaris/pilih-jenis", [InventarisController::class, "pilihJenis"])->name("inventaris.pilih_jenis");

    // Inventaris Routes
    Route::get("/inventaris/print_all",[InventarisController::class,"printAll"])->name("inventaris.print_all");
    Route::get("/inventaris/print_single/{id}",[InventarisController::class,"printSingle"])->name("inventaris.print_single");
    Route::post("inventaris/import",[InventarisController::class,"import"])->name("inventaris.import");
    Route::get("inventaris/export",[InventarisController::class,"export"])->name("inventaris.export");
    Route::get("inventaris/grouped/{inventaris}",[InventarisController::class,"showGrouped"])->name("inventaris.show_grouped");
    
    // Custom Inventaris Edit/Update Routes (for master data only)
    Route::get("/inventaris/{inventaris}/edit", [InventarisController::class, "edit"])->name("inventaris.edit");
    Route::put("/inventaris/{inventaris}", [InventarisController::class, "update"])->name("inventaris.update");

    // Aset Detail Routes
    Route::get("inventaris/{inventaris}/detail/create", [InventarisController::class, "createAsetDetail"])->name("inventaris.detail.create");
    Route::post("inventaris/{inventaris}/detail", [InventarisController::class, "storeAsetDetail"])->name("inventaris.detail.store");
    Route::get("aset-detail/{asetDetail}", [InventarisController::class, "showAsetDetail"])->name("aset-detail.show");
    Route::get("aset-detail/{asetDetail}/edit", [InventarisController::class, "editAsetDetail"])->name("aset-detail.edit");
    Route::patch("aset-detail/{asetDetail}", [InventarisController::class, "updateAsetDetail"])->name("aset-detail.update");
    Route::delete("aset-detail/{asetDetail}", [InventarisController::class, "destroyAsetDetail"])->name("aset-detail.destroy");

    // Resource Routes
    Route::resource("inventaris", InventarisController::class)->parameters([
        'inventaris' => 'inventaris'
    ]);
    Route::resource("acquisitions", AcquisitionController::class);
    Route::resource("rooms", RoomController::class);
    Route::resource("stok", StokHabisPakaiController::class)->parameters([
        'stok' => 'inventaris'
    ]);

    // StokHabisPakai Routes (Custom)
    Route::get("/stok/print_all",[StokHabisPakaiController::class,"printAll"])->name("stok.print_all");
    Route::get("/stok/print_single/{id}",[StokHabisPakaiController::class,"printSingle"])->name("stok.print_single");
    Route::post("stok/import",[StokHabisPakaiController::class,"import"])->name("stok.import");
    Route::get("stok/export",[StokHabisPakaiController::class,"export"])->name("stok.export");

    Route::resource("users", UserController::class);
    Route::resource("units", UnitController::class);
    Route::get('/units/{unit}/room-count', [UnitController::class, 'getRoomCount'])->name('units.room-count');
    Route::resource("transactions", TransactionController::class)->except(["edit","update"]);
    Route::resource("requests", RequestController::class);
    Route::resource("sumber_danas", SumberDanaController::class);

    // Settings & Profile Routes
    Route::get("/settings",[SettingsController::class,"index"])->name("settings.index");
    Route::get("/profile",[UserController::class,"edit"])->name("profile.edit");
    Route::patch("/profile",[UserController::class,"update"])->name("profile.update");

    // Report Routes
    Route::get("reports/transactions",[ReportController::class,"transactionReport"])->name("reports.transactions");
    Route::get("reports/item-history",[ReportController::class,"itemHistoryReport"])->name("reports.item_history");

    // Activity Log Routes
    Route::get("/activity/logs",[DashboardController::class,"activityLogs"])->name("activity.logs");
});
