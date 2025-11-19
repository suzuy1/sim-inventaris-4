<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventaris; // Model master
use App\Models\AsetDetail; // Model detail unit (BARU)
use App\Models\Room;
use App\Models\User; // (BARU) Untuk penanggung jawab
use App\Models\StokHabisPakai;
use App\Models\SumberDana; // Import SumberDana model
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InventarisExport;
use App\Imports\InventarisImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreInventarisRequest; // Ini mungkin perlu direvisi nanti
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;

class InventarisController extends Controller
{
    use AuthorizesRequests;

    /**
 * Display a listing of the resource.
 * LOGIKA DIUBAH TOTAL: Menampilkan master inventaris + count kondisi dari aset_details
 */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Inventaris::class);

        $kategori = $request->input('kategori');
        $search = $request->input('search');

        $habisPakaiKategori = [
            'Barang Habis Pakai Medis',
            'Barang Habis Pakai Kebersihan',
            'Barang Habis Pakai ATK',
            'Obat'
        ];

        $isConsumable = in_array($kategori, $habisPakaiKategori);

        if ($isConsumable) {
            // Redirect ke halaman stok.index jika kategori adalah barang habis pakai
            return redirect()->route('stok.index', ['kategori' => $kategori]);
        } else {
            $query = Inventaris::query()
                ->withCount([
                    'asetDetails', // Menghitung total unit
                    'asetDetails as total_baik' => function ($q) {
                        $q->where('kondisi', 'Baik');
                    },
                    'asetDetails as total_rusak_ringan' => function ($q) {
                        $q->where('kondisi', 'Rusak Ringan');
                    },
                    'asetDetails as total_rusak_berat' => function ($q) {
                        $q->where('kondisi', 'Rusak Berat');
                    },
                ]);

            if ($kategori) {
                $query->where('kategori', $kategori);
            }

            if ($search) {
                $query->where('nama_barang', 'like', '%' . $search . '%');
            }

            $inventaris = $query->paginate(10);

            // ===================================================================
            // [BARU] Hitung data untuk persentase real-time (bulan ini vs bulan lalu)
            // ===================================================================
            $currentMonth = now()->month;
            $currentYear = now()->year;
            $lastMonth = now()->subMonth()->month;
            $lastMonthYear = now()->subMonth()->year;

            // Query dasar untuk bulan lalu
            $lastMonthQuery = Inventaris::query();
            
            // Filter kategori jika ada
            if ($kategori) {
                $lastMonthQuery->where('kategori', $kategori);
            }

            // Hitung data bulan lalu berdasarkan tanggal pembuatan aset_details
            $lastMonthStats = $lastMonthQuery
                ->withCount([
                    'asetDetails as last_month_total_baik' => function ($q) use ($lastMonth, $lastMonthYear) {
                        $q->where('kondisi', 'Baik')
                          ->whereMonth('created_at', '<=', $lastMonth)
                          ->whereYear('created_at', '<=', $lastMonthYear);
                    },
                    'asetDetails as last_month_total_rusak_ringan' => function ($q) use ($lastMonth, $lastMonthYear) {
                        $q->where('kondisi', 'Rusak Ringan')
                          ->whereMonth('created_at', '<=', $lastMonth)
                          ->whereYear('created_at', '<=', $lastMonthYear);
                    },
                    'asetDetails as last_month_total_rusak_berat' => function ($q) use ($lastMonth, $lastMonthYear) {
                        $q->where('kondisi', 'Rusak Berat')
                          ->whereMonth('created_at', '<=', $lastMonth)
                          ->whereYear('created_at', '<=', $lastMonthYear);
                    },
                ])
                ->get();

            // Aggregasi data bulan lalu
            $lastMonthBarangBaik = $lastMonthStats->sum('last_month_total_baik') ?: 1;
            $lastMonthRusakRingan = $lastMonthStats->sum('last_month_total_rusak_ringan') ?: 1;
            $lastMonthRusakBerat = $lastMonthStats->sum('last_month_total_rusak_berat') ?: 1;
            $lastMonthJenisBarang = $lastMonthStats->count() ?: 1;

            // Data bulan ini (dari $inventaris yang sudah ada)
            $currentBarangBaik = $inventaris->sum('total_baik');
            $currentRusakRingan = $inventaris->sum('total_rusak_ringan');
            $currentRusakBerat = $inventaris->sum('total_rusak_berat');
            $currentJenisBarang = $inventaris->count();

            // Hitung persentase
            $percentageData = [
                'barang_baik' => $this->calculatePercentage($currentBarangBaik, $lastMonthBarangBaik),
                'rusak_ringan' => $this->calculatePercentage($currentRusakRingan, $lastMonthRusakRingan),
                'rusak_berat' => $this->calculatePercentage($currentRusakBerat, $lastMonthRusakBerat),
                'jenis_barang' => $this->calculatePercentage($currentJenisBarang, $lastMonthJenisBarang),
            ];
        }

        return view('inventaris.index', compact('inventaris', 'kategori', 'percentageData', 'isConsumable'));
    }

/**
 * [BARU] Helper function untuk menghitung persentase perubahan
 */
private function calculatePercentage($current, $previous)
{
    if ($previous == 0) return 0;
    return round((($current - $previous) / $previous) * 100, 1);
}
    /**
     * Show the form for creating a new resource.
     * FUNGSI BERUBAH: Menampilkan form untuk membuat MASTER BARANG baru
     */
    public function create(Request $request)
    {
        $this->authorize('create', Inventaris::class);
        $kategori = $request->query('kategori'); // Get the category from the query string
        return view('inventaris.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     * LOGIKA DIUBAH: Hanya menyimpan data master (nama & kategori)
     */
    public function store(StoreInventarisRequest $request)
    {
        $this->authorize('create', Inventaris::class);
        $validatedData = $request->validated();

        // [REVISI] Definisikan kategori yg habis pakai
        $habisPakaiKategori = [
            'Barang Habis Pakai Medis',
            'Barang Habis Pakai Kebersihan',
            'Barang Habis Pakai ATK',
            'Obat'
        ];

        DB::beginTransaction();
        try {
            // 1. Buat master inventaris
            $inventaris = Inventaris::create([
                'nama_barang' => $validatedData['nama_barang'],
                'kategori' => $validatedData['kategori'],
                'keterangan' => $validatedData['keterangan'] ?? null, // Keterangan for Inventaris master
            ]);

            // 2. Jika kategori adalah barang habis pakai, buat entri di stok_habis_pakais
            if (in_array($validatedData['kategori'], $habisPakaiKategori)) {
                StokHabisPakai::create([
                    'inventaris_id' => $inventaris->id,
                    'jumlah_masuk' => $validatedData['stock'] ?? 0, // Use 'stock' from form
                    'jumlah_keluar' => 0, // Initial keluar is 0
                    'satuan' => $validatedData['satuan'] ?? null,
                    'tgl_kadaluarsa' => $validatedData['tgl_kadaluarsa'] ?? null,
                    'tgl_pengecekan' => $validatedData['tgl_pengecekan'] ?? null,
                    'keterangan' => $validatedData['stok_keterangan'] ?? null, // Keterangan for StokHabisPakai
                ]);
            }

            DB::commit();

            // Redirect ke halaman detail (showGrouped)
            return redirect()->route('inventaris.show_grouped', $inventaris)
                             ->with('success', 'Master barang berhasil ditambahkan.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal menyimpan master inventaris: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     * FUNGSI BERUBAH: Redirect ke halaman showGrouped
     */
    public function show(Inventaris $inventaris)
    {
        $this->authorize('view', $inventaris);
        // Langsung arahkan ke halaman detail unit
        return redirect()->route('inventaris.show_grouped', $inventaris);
    }

    /**
     * Show the form for editing the specified resource.
     * FUNGSI: Edit data MASTER BARANG
     */
    public function edit(Inventaris $inventaris)
    {
        $this->authorize('update', $inventaris);
        $sumberDanas = SumberDana::all();
        return view('inventaris.edit', compact('inventaris', 'sumberDanas'));
    }

    /**
     * Update the specified resource in storage.
     * FUNGSI: Update data MASTER BARANG
     */
    public function update(Request $request, Inventaris $inventaris)
    {
        $this->authorize('update', $inventaris);
        
        // [REVISI] Validasi dilonggarkan
        $validatedData = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|max:255', // Tidak pakai 'in:' lagi
            'keterangan' => 'nullable|string', // Add validation for keterangan
        ]);

        $inventaris->update($validatedData);
        
        // [REVISI] Arahkan kembali ke 'index' (yang sudah difilter)
        // Kita tambahkan parameter 'kategori' agar kembalinya pas
        return redirect()->route('inventaris.index', ['kategori' => $inventaris->kategori])
                         ->with('success', 'Master barang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     * FUNGSI: Hapus MASTER BARANG (dan semua unitnya via cascade)
     * [PERBAIKAN]: Menambahkan Try-Catch dan DB Transaction dengan ModelNotFoundException
     */
    public function destroy($id)
    {
        // Log untuk debugging - pastikan method ini dipanggil
        \Log::info('=== DELETE METHOD CALLED ===');
        \Log::info('Request method: ' . request()->method());
        \Log::info('Request URL: ' . request()->fullUrl());
        \Log::info('Raw Route Parameter (inventaris): ' . request()->route('inventaris'));
        \Log::info('ID Parameter: ' . $id);
        
        try {
            // Cari model dengan findOrFail untuk menangani kasus tidak ditemukan
            $inventaris = Inventaris::findOrFail($id);
            
            \Log::info('Inventaris ID: ' . $inventaris->id);
            \Log::info('Inventaris Name: ' . $inventaris->nama_barang);
            \Log::info('Inventaris Kategori: ' . $inventaris->kategori);
            \Log::info('User: ' . (auth()->user() ? auth()->user()->name : 'Guest'));
            
            // Verifikasi authorization
            $this->authorize('delete', $inventaris);
            \Log::info('Authorization passed');
            
            DB::beginTransaction();
            \Log::info('Transaction started');

            // Log sebelum menghapus - dapatkan data untuk verifikasi
            $asetDetailsCount = $inventaris->asetDetails()->count();
            $stokCount = $inventaris->stokHabisPakai()->count();
            $transactionsCount = $inventaris->transactions()->count();
            $requestsCount = $inventaris->requests()->count();
            
            \Log::info("Data sebelum delete:");
            \Log::info("- Aset Details count: " . $asetDetailsCount);
            \Log::info("- Stok count: " . $stokCount);
            \Log::info("- Transactions count: " . $transactionsCount);
            \Log::info("- Requests count: " . $requestsCount);

            // [REVISI] Definisikan kategori yg habis pakai
            $habisPakaiKategori = [
                'Barang Habis Pakai Medis',
                'Barang Habis Pakai Kebersihan',
                'Barang Habis Pakai ATK',
                'Obat'
            ];
            
            // Hapus data terkait berdasarkan kategori
            if (in_array($inventaris->kategori, $habisPakaiKategori)) {
                $deletedStok = $inventaris->stokHabisPakai()->delete();
                \Log::info('Deleted stok habis pakai: ' . $deletedStok . ' records');
            } else {
                $deletedAsetDetails = $inventaris->asetDetails()->delete();
                \Log::info('Deleted aset details: ' . $deletedAsetDetails . ' records');
            }

            // Hapus transaksi dan permintaan terkait secara eksplisit
            // Meskipun ada onDelete('cascade') di migrasi, ini untuk memastikan
            $deletedAcquisitions = $inventaris->acquisitions()->delete(); // Pastikan relasinya ada di Model
            \Log::info('Deleted acquisitions: ' . $deletedAcquisitions . ' records');

            $deletedTransactions = $inventaris->transactions()->delete();
            $deletedRequests = $inventaris->requests()->delete();
            \Log::info('Deleted transactions: ' . $deletedTransactions . ' records');
            \Log::info('Deleted requests: ' . $deletedRequests . ' records');

            // Hapus data master
            $deletedMaster = $inventaris->delete();
            
            if ($deletedMaster) {
                DB::commit();
                \Log::info('Transaction committed');
                \Log::info('=== DELETE SUCCESS ===');
                return redirect()->route('inventaris.index', ['kategori' => $inventaris->kategori])
                                ->with('success', 'Master barang "' . $inventaris->nama_barang . '" (dan semua unitnya) berhasil dihapus.');
            } else {
                DB::rollBack();
                \Log::error('Transaction rolled back: Master inventaris delete failed.');
                \Log::error('DELETE FAILED: Master inventaris could not be deleted.');
                return redirect()->route('inventaris.index')
                                ->with('error', 'Gagal menghapus data: Master barang tidak dapat dihapus.');
            }

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            \Log::error('Inventaris not found for ID: ' . $id);
            return redirect()->route('inventaris.index')
                             ->with('error', 'Data inventaris tidak ditemukan.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Transaction rolled back');
            
            \Log::error('DELETE FAILED: ' . $e->getMessage());
            \Log::error('Error in file: ' . $e->getFile());
            \Log::error('Error on line: ' . $e->getLine());
            \Log::error('Stack trace: ' . $e->getTraceAsString());

            return redirect()->route('inventaris.index')
                            ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    // ====================================================================
    // METODE BARU UNTUK ASET DETAIL (UNIT)
    // ====================================================================

    /**
     * FUNGSI UTAMA: Menampilkan halaman detail (daftar unit/aset)
     * Ini menggantikan `showGrouped` lama.
     */
    public function showGrouped(Inventaris $inventaris)
    {
         $this->authorize('view', $inventaris);
         
         // Load semua unit/aset detail milik master barang ini
         $inventarisDetails = AsetDetail::where('inventaris_id', $inventaris->id)
             ->with(['room', 'penanggungJawab', 'sumberDana']) // Eager load relasi
             ->paginate(10);
         
         // Ambil statistik ringkas untuk inventaris ini
         $summaryStatistics = AsetDetail::where('inventaris_id', $inventaris->id)
             ->selectRaw('COUNT(*) as total_units')
             ->selectRaw('COUNT(CASE WHEN kondisi = "Baik" THEN 1 END) as total_baik')
             ->selectRaw('COUNT(CASE WHEN kondisi = "Rusak Ringan" THEN 1 END) as total_rusak_ringan')
             ->selectRaw('COUNT(CASE WHEN kondisi = "Rusak Berat" THEN 1 END) as total_rusak_berat')
             ->first();

         // View ini ('inventaris.show_grouped') perlu kita ROMBAK TOTAL nanti
         return view('inventaris.show_grouped', compact('inventaris', 'inventarisDetails', 'summaryStatistics'));
    }

    /**
     * [BARU] Menampilkan form untuk menambah unit aset baru (Permintaan Dosen)
     */
    public function createAsetDetail(Inventaris $inventaris)
    {
        $this->authorize('create', Inventaris::class); // Asumsi policy sama

        // Ambil data untuk dropdown
        $rooms = Room::all();
        $users = User::all(); // Nanti bisa difilter misal hanya role tertentu
        $sumberDanas = SumberDana::all(); // Get all SumberDana for the dropdown
        
        // View ini ('inventaris.detail.create') perlu kita BUAT BARU nanti
        return view('inventaris.detail.create', compact('inventaris', 'rooms', 'users', 'sumberDanas'));
    }

    public function storeAsetDetail(Request $request, Inventaris $inventaris)
    {
        $this->authorize('create', Inventaris::class);

        // Validasi
        $validatedData = $request->validate([
            'tgl_pembelian' => 'nullable|date',
            'harga_beli' => 'nullable|numeric|min:0',
            'sumber_dana_id' => 'required|exists:sumber_danas,id',
            'kondisi' => 'required|string|in:Baik,Rusak Ringan,Rusak Berat',
            'room_id' => 'nullable|exists:rooms,id_room',
            'penanggung_jawab_id' => 'nullable|exists:users,id',
            'keterangan' => 'nullable|string',
            'tgl_perbaikan' => 'nullable|date',
            'tgl_pengecekan' => 'nullable|date',
            'tipe_barang' => 'nullable|string|max:255',
        ]);

        try {
            Log::info('Validated Data for AsetDetail:', $validatedData);

            // ================================
            // 1. Ambil kode sumber dana
            // ================================
            $sumberDana = SumberDana::find($validatedData['sumber_dana_id']);
            $kodeSumberDana = $sumberDana->kode_sumber_dana; // Mengambil kode singkat (misalnya BOS)

            // ==========================================
            // 2. Cari nomor urut terakhir berdasarkan:
            // inventaris_id + sumber dana
            // ==========================================
            $last = AsetDetail::where('inventaris_id', $inventaris->id)
                    ->where('sumber_dana_id', $validatedData['sumber_dana_id'])
                    ->orderBy('id', 'DESC')
                    ->first();

            if ($last) {
                // Ambil nomor urut terakhir dari kode_inv lama
                // Format: INV/BOS/12/003 → ambil "003"
                $lastNumber = intval(substr($last->kode_inv, strrpos($last->kode_inv, '/') + 1));
                $nextNumber = $lastNumber + 1;
            } else {
                $nextNumber = 1;
            }

            // nomor urut 3 digit
            $noUrut = str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

            // ==========================================
            // 3. Generate kode inventaris otomatis
            // ==========================================
            $kodeInv = "INV/{$kodeSumberDana}/{$inventaris->id}/{$noUrut}";

            // ==========================================
            // 4. Simpan data
            // ==========================================
            $dataToCreate = $validatedData;
            $dataToCreate['inventaris_id'] = $inventaris->id;
            $dataToCreate['kode_inv'] = $kodeInv;

            AsetDetail::create($dataToCreate);

            return redirect()->route('inventaris.show_grouped', $inventaris)
                    ->with('success', "Unit aset baru ($kodeInv) berhasil ditambahkan.");

        } catch (\Exception $e) {
            Log::error('Gagal menyimpan unit aset: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    /**
     * [BARU] Menampilkan form untuk MENGEDIT unit aset yang sudah ada.
     */
    public function editAsetDetail(AsetDetail $asetDetail)
    {
        // $asetDetail sudah otomatis di-load oleh Laravel
        $this->authorize('update', $asetDetail->inventaris); // Asumsi policy-nya menempel di master

        // Ambil data untuk dropdown
        $rooms = Room::all();
        $users = User::all();
        $sumberDanas = SumberDana::all(); // Get all SumberDana for the dropdown

        // Load view 'edit.blade.php' yang akan kita buat
        return view('inventaris.detail.edit', compact('asetDetail', 'rooms', 'users', 'sumberDanas'));
    }

    /**
     * [BARU] Menyimpan perubahan dari form edit unit aset.
     */
    public function updateAsetDetail(Request $request, AsetDetail $asetDetail)
    {
        $this->authorize('update', $asetDetail->inventaris);

        // Validasi data (mirip store, tapi rule 'unique' diubah)
        $validatedData = $request->validate([
            'kode_inv' => [
                'required',
                'string',
                'max:255',
                // Pastikan kode_inv unik, TAPI hiraukan (ignore) ID milik kita sendiri
                Rule::unique('aset_details')->ignore($asetDetail->id),
            ],
            'tgl_pembelian' => 'nullable|date',
            'harga_beli' => 'nullable|numeric|min:0',
            'sumber_dana_id' => 'nullable|exists:sumber_danas,id', // Change to foreign key
            'kondisi' => 'required|string|in:Baik,Rusak Ringan,Rusak Berat',
            'room_id' => 'nullable|exists:rooms,id_room',
            'penanggung_jawab_id' => 'nullable|exists:users,id',
            'keterangan' => 'nullable|string',
            'tgl_perbaikan' => 'nullable|date',
            'tgl_pengecekan' => 'nullable|date',
            'tipe_barang' => 'nullable|string|max:255', // Add tipe_barang validation
        ]);

        try {
            // Update data di database
            $asetDetail->update($validatedData);

            // Redirect kembali ke halaman daftar unit (show_grouped)
            // Kita ambil masternya dari relasi
            return redirect()->route('inventaris.show_grouped', $asetDetail->inventaris)
                             ->with('success', 'Unit aset ('.$asetDetail->kode_inv.') berhasil diperbarui.');

        } catch (\Exception $e) {
            Log::error('Gagal update unit aset: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    /**
     * [BARU] Menghapus unit aset dari database.
     */
    public function destroyAsetDetail(AsetDetail $asetDetail)
    {
        // $asetDetail sudah otomatis di-load
        $this->authorize('delete', $asetDetail->inventaris); // Asumsi policy di master inventaris

        try {
            // Simpan nama master dan kode unit untuk pesan sukses
            $namaMaster = $asetDetail->inventaris->nama_barang;
            $kodeInv = $asetDetail->kode_inv;
            $inventarisMaster = $asetDetail->inventaris;

            // Hapus data dari database
            $asetDetail->delete();

            // Redirect kembali ke halaman daftar unit (show_grouped)
            return redirect()->route('inventaris.show_grouped', $inventarisMaster)
                             ->with('success', 'Unit aset ('.$kodeInv.') berhasil dihapus dari '.$namaMaster.'.');

        } catch (\Exception $e) {
            Log::error('Gagal hapus unit aset: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus: ' . $e->getMessage());
        }
    }

    /**
     * [BARU] Menampilkan halaman detail untuk satu unit aset.
     */
    public function showAsetDetail(AsetDetail $asetDetail)
    {
        $this->authorize('view', $asetDetail->inventaris); // Asumsi policy di master inventaris

        // Eager load relasi yang dibutuhkan untuk tampilan detail
        $asetDetail->load(['inventaris', 'room', 'penanggungJawab', 'sumberDana']);

        return view('inventaris.detail.show', compact('asetDetail'));
    }

    /**
     * [BARU] Menampilkan halaman untuk memilih jenis inventaris (Elektronik, Furniture, dll.)
     */
    // [REVISI] Method baru untuk menampilkan halaman pilih jenis
    public function pilihJenis()
    {
        $this->authorize('viewAny', Inventaris::class); // Pakai policy yang sama dengan index

        $kategoriList = [
            'Elektronik',
            'Furniture',
            'Kendaraan',
            'Alat Tulis Kantor',
            'Peralatan Listrik',
            'Peralatan Kebersihan',
            'Peralatan Dapur',
            'Peralatan Medis',
            'Peralatan Teknologi',
            'Barang Habis Pakai Medis',
            'Barang Habis Pakai Kebersihan',
            'Barang Habis Pakai ATK',
            'Obat',
        ];

        $habisPakaiKategori = [
            'Barang Habis Pakai Medis',
            'Barang Habis Pakai Kebersihan',
            'Barang Habis Pakai ATK',
            'Obat'
        ];

        $kategoriCounts = [];

        foreach ($kategoriList as $kategori) {
            // For all categories, count the number of master inventaris items
            // The 'jumlah barang' in this view should represent the number of distinct item types.
            $count = Inventaris::where('kategori', $kategori)->count();
            $kategoriCounts[$kategori] = $count;
        }

        return view('inventaris.pilih-jenis', compact('kategoriList', 'kategoriCounts'));
    }


    // --- Method Bawaan (Perlu Penyesuaian Nanti) ---

    public function export()
    {
        // $this->authorize('export', Inventaris::class);
        // LOGIKA EXPORT PERLU DIUBAH (mau export master atau detail?)
        // return Excel::download(new InventarisExport, 'inventaris.xlsx');
        return redirect()->route('inventaris.index')->with('info', 'Fitur export perlu disesuaikan.');
    }

    public function import(Request $request)
    {
        // $this->authorize('import', Inventaris::class);
        // LOGIKA IMPORT PERLU DIUBAH (mau import master atau detail?)
        // $request->validate(['file' => 'required|mimes:xlsx,xls,csv']);
        // Excel::import(new InventarisImport, $request->file('file'));
        return redirect()->route('inventaris.index')->with('info', 'Fitur import perlu disesuaikan.');
    }

    public function printAll()
    {
        // $this->authorize('print', Inventaris::class);
        // LOGIKA PRINT PERLU DIUBAH
        // $inventaris = Inventaris::all();
        // return view('inventaris.print_all', compact('inventaris'));
        return redirect()->route('inventaris.index')->with('info', 'Fitur print perlu disesuaikan.');
    }

    public function printSingle($id)
    {
        // LOGIKA PRINT PERLU DIUBAH (print master atau detail?)
        // $inventaris = Inventaris::with(['stokHabisPakai'])->findOrFail($id);
        // $this->authorize('print', $inventaris);
        // return view('inventaris.print_single', compact('inventaris'));
        return redirect()->route('inventaris.index')->with('info', 'Fitur print perlu disesuaikan.');
    }
    
    public function getStock(Inventaris $inventaris)
    {
        // [REVISI] Definisikan kategori yg habis pakai
        $habisPakaiKategori = [
            'Barang Habis Pakai Medis',
            'Barang Habis Pakai Kebersihan',
            'Barang Habis Pakai ATK',
            'Obat'
        ];
        
        if (in_array($inventaris->kategori, $habisPakaiKategori)) {
            $sisaStok = StokHabisPakai::where('inventaris_id', $inventaris->id)
                                    ->sum(DB::raw('jumlah_masuk - jumlah_keluar'));
            return response()->json(['sisa_stok' => $sisaStok]);
        } else {
            // Untuk barang tidak habis pakai, stok adalah jumlah unit dengan kondisi 'Baik'
            $sisaStok = $inventaris->asetDetails()->where('kondisi', 'Baik')->count();
            return response()->json(['sisa_stok' => $sisaStok]);
        }
    }
}
