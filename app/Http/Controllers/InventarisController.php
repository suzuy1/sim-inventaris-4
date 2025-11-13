<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventaris; // Model master
use App\Models\AsetDetail; // Model detail unit (BARU)
use App\Models\Room;
use App\Models\User; // (BARU) Untuk penanggung jawab
use App\Models\StokHabisPakai;
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

        $query = Inventaris::query()
            ->where('kategori', '!=', 'habis_pakai') // Fokus pada barang tidak habis pakai/aset
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

        if ($request->has('search')) {
            $query->where('nama_barang', 'like', '%' . $request->search . '%');
        }

        // Ambil data (termasuk yang tidak punya detail aset, misal baru dibuat)
        $inventaris = $query->paginate(10);

        // Untuk kartu statistik di atas (ini juga bisa disederhanakan)
        // $totalStats = [
        //     'total_baik' => $inventaris->sum('total_baik'),
        //     'total_rusak_ringan' => $inventaris->sum('total_rusak_ringan'),
        //     'total_rusak_berat' => $inventaris->sum('total_rusak_berat'),
        //     'total_jenis' => $inventaris->total()
        // ];
        // return view('inventaris.index', compact('inventaris', 'totalStats'));

        // Biarkan view lama menghitung SUM-nya sendiri
        return view('inventaris.index', compact('inventaris'));
    }

    /**
     * Show the form for creating a new resource.
     * FUNGSI BERUBAH: Menampilkan form untuk membuat MASTER BARANG baru
     */
    public function create()
    {
        $this->authorize('create', Inventaris::class);
        // View ini ('inventaris.create') perlu kita revisi nanti
        return view('inventaris.create');
    }

    /**
     * Store a newly created resource in storage.
     * LOGIKA DIUBAH: Hanya menyimpan data master (nama & kategori)
     */
    public function store(StoreInventarisRequest $request) // Validasi mungkin perlu disesuaikan
    {
        $this->authorize('create', Inventaris::class);
        $validatedData = $request->validated(); // Asumsi validasi minimal 'nama_barang' & 'kategori'

        DB::beginTransaction();
        try {
            // 1. Buat master inventaris
            $inventaris = Inventaris::create([
                'nama_barang' => $validatedData['nama_barang'],
                'kategori' => $validatedData['kategori'], // misal: 'tidak_habis_pakai'
            ]);

            // 2. Logika untuk barang habis pakai
            if ($validatedData['kategori'] === 'habis_pakai' && isset($validatedData['initial_stok'])) {
                StokHabisPakai::create([
                    'inventaris_id' => $inventaris->id,
                    'jumlah_masuk' => $validatedData['initial_stok'],
                    'jumlah_keluar' => 0,
                    'tanggal' => now()->toDateString(),
                ]);
            } 
            // 3. Logika untuk barang tidak habis pakai / aset tetap (membuat aset_detail awal)
            else if (in_array($validatedData['kategori'], ['tidak_habis_pakai', 'aset_tetap'])) {
                $kondisiBaik = $validatedData['kondisi_baik'] ?? 0;
                $kondisiRusakRingan = $validatedData['kondisi_rusak_ringan'] ?? 0;
                $kondisiRusakBerat = $validatedData['kondisi_rusak_berat'] ?? 0;

                // Buat AsetDetail untuk kondisi Baik
                for ($i = 0; $i < $kondisiBaik; $i++) {
                    AsetDetail::create([
                        'inventaris_id' => $inventaris->id,
                        'kondisi' => 'Baik',
                        'kode_inv' => $inventaris->id . '-B-' . ($i + 1), // Contoh kode inventaris
                        // Field lain bisa diisi default atau null
                    ]);
                }

                // Buat AsetDetail untuk kondisi Rusak Ringan
                for ($i = 0; $i < $kondisiRusakRingan; $i++) {
                    AsetDetail::create([
                        'inventaris_id' => $inventaris->id,
                        'kondisi' => 'Rusak Ringan',
                        'kode_inv' => $inventaris->id . '-RR-' . ($i + 1), // Contoh kode inventaris
                    ]);
                }

                // Buat AsetDetail untuk kondisi Rusak Berat
                for ($i = 0; $i < $kondisiRusakBerat; $i++) {
                    AsetDetail::create([
                        'inventaris_id' => $inventaris->id,
                        'kondisi' => 'Rusak Berat',
                        'kode_inv' => $inventaris->id . '-RB-' . ($i + 1), // Contoh kode inventaris
                    ]);
                }
            }

            DB::commit();

            // Redirect ke halaman detail (showGrouped) untuk master barang yg baru dibuat
            return redirect()->route('inventaris.show_grouped', $inventaris)
                             ->with('success', 'Master barang berhasil ditambahkan. Silakan tambahkan unit aset.');

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
        // View ini ('inventaris.edit') perlu kita revisi nanti
        return view('inventaris.edit', compact('inventaris'));
    }

    /**
     * Update the specified resource in storage.
     * FUNGSI: Update data MASTER BARANG
     */
    public function update(Request $request, Inventaris $inventaris)
    {
        $this->authorize('update', $inventaris);
        // Validasi simpel
        $validatedData = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|in:habis_pakai,tidak_habis_pakai,aset_tetap',
        ]);

        $inventaris->update($validatedData);

        // ... (handle jika kategori berubah dari/ke habis_pakai)
        
        return redirect()->route('inventaris.index')->with('success', 'Master barang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     * FUNGSI: Hapus MASTER BARANG (dan semua unitnya via cascade)
     * [PERBAIKAN]: Menambahkan Try-Catch dan DB Transaction
     */
    public function destroy(Inventaris $inventaris)
    {
        // Log untuk debugging - pastikan method ini dipanggil
        \Log::info('=== DELETE METHOD CALLED ===');
        \Log::info('Request method: ' . request()->method());
        \Log::info('Request URL: ' . request()->fullUrl());
        \Log::info('Inventaris ID: ' . $inventaris->id);
        \Log::info('Inventaris Name: ' . $inventaris->nama_barang);
        \Log::info('Inventaris Kategori: ' . $inventaris->kategori);
        \Log::info('User: ' . (auth()->user() ? auth()->user()->name : 'Guest'));
        
        try {
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

            // Hapus data terkait berdasarkan kategori
            if ($inventaris->kategori === 'habis_pakai') {
                $deletedStok = $inventaris->stokHabisPakai()->delete();
                \Log::info('Deleted stok habis pakai: ' . $deletedStok . ' records');
            } else {
                $deletedAsetDetails = $inventaris->asetDetails()->delete();
                \Log::info('Deleted aset details: ' . $deletedAsetDetails . ' records');
            }

            // Hapus transaksi dan permintaan terkait secara eksplisit
            // Meskipun ada onDelete('cascade') di migrasi, ini untuk memastikan
            $deletedTransactions = $inventaris->transactions()->delete();
            $deletedRequests = $inventaris->requests()->delete();
            \Log::info('Deleted transactions: ' . $deletedTransactions . ' records');
            \Log::info('Deleted requests: ' . $deletedRequests . ' records');

            // Hapus data master
            $deletedMaster = $inventaris->delete();
            \Log::info('Deleted master inventaris: ' . ($deletedMaster ? 'SUCCESS' : 'FAILED'));

            DB::commit();
            \Log::info('Transaction committed');
            \Log::info('=== DELETE SUCCESS ===');
            
            return redirect()->route('inventaris.index')
                            ->with('success', 'Master barang "' . $inventaris->nama_barang . '" (dan semua unitnya) berhasil dihapus.');

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
             ->with(['room', 'penanggungJawab']) // Eager load relasi
             ->paginate(10);
         
         // $namaBarang = $inventaris->nama_barang; (Kita ganti jadi passing objek utuh)
         
         // View ini ('inventaris.show_grouped') perlu kita ROMBAK TOTAL nanti
         return view('inventaris.show_grouped', compact('inventaris', 'inventarisDetails'));
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
        
        // View ini ('inventaris.detail.create') perlu kita BUAT BARU nanti
        return view('inventaris.detail.create', compact('inventaris', 'rooms', 'users'));
    }

    /**
     * [BARU] Menyimpan unit aset baru ke database (Permintaan Dosen)
     */
    public function storeAsetDetail(Request $request, Inventaris $inventaris)
    {
        $this->authorize('create', Inventaris::class);

        // Validasi untuk form detail aset
        $validatedData = $request->validate([
            'kode_inv' => 'required|string|max:255|unique:aset_details,kode_inv',
            'tgl_pembelian' => 'nullable|date',
            'harga_beli' => 'nullable|numeric|min:0',
            'sumber_dana' => 'nullable|string|max:255',
            'kondisi' => 'required|string|in:Baik,Rusak Ringan,Rusak Berat',
            'room_id' => 'nullable|exists:rooms,id',
            'penanggung_jawab_id' => 'nullable|exists:users,id',
            'keterangan' => 'nullable|string',
            'tgl_perbaikan' => 'nullable|date',
            'tgl_pengecekan' => 'nullable|date',
        ]);

        try {
            // Tambahkan inventaris_id dan simpan
            $dataToCreate = $validatedData;
            $dataToCreate['inventaris_id'] = $inventaris->id;
            
            AsetDetail::create($dataToCreate);

            // Redirect kembali ke halaman daftar unit
            return redirect()->route('inventaris.show_grouped', $inventaris)
                             ->with('success', 'Unit aset baru ('.$validatedData['kode_inv'].') berhasil ditambahkan.');

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

        // Load view 'edit.blade.php' yang akan kita buat
        return view('inventaris.detail.edit', compact('asetDetail', 'rooms', 'users'));
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
            'sumber_dana' => 'nullable|string|max:255',
            'kondisi' => 'required|string|in:Baik,Rusak Ringan,Rusak Berat',
            'room_id' => 'nullable|exists:rooms,id',
            'penanggung_jawab_id' => 'nullable|exists:users,id',
            'keterangan' => 'nullable|string',
            'tgl_perbaikan' => 'nullable|date',
            'tgl_pengecekan' => 'nullable|date',
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
        if ($inventaris->kategori === 'habis_pakai') {
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
