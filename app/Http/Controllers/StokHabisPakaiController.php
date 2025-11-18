<?php

namespace App\Http\Controllers;

use App\Models\StokHabisPakai;
use App\Models\Inventaris; // Penting untuk relasi
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Jika Anda perlu transaksi

class StokHabisPakaiController extends Controller
{
    protected $bhpCategories = [
        'Barang Habis Pakai Medis',
        'Barang Habis Pakai Kebersihan',
        'Barang Habis ATK',
        'Obat',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $kategori = $request->input('kategori');

        // 1. Tentukan kategori yang akan difilter
        $categoriesToFilter = $this->bhpCategories;
        if ($kategori && in_array($kategori, $this->bhpCategories)) {
            $categoriesToFilter = [$kategori];
        }

        // 2. Query Inventaris (Master Barang)
        $query = Inventaris::whereIn('kategori', $categoriesToFilter);

        // 3. Hitung Stok Total (Stok Masuk - Stok Keluar)
        $query->withSum('stokHabisPakai as total_masuk', 'jumlah_masuk')
              ->withSum('stokHabisPakai as total_keluar', 'jumlah_keluar')
              ->select('inventaris.*') // Penting untuk memilih semua kolom inventaris
              ->addSelect(DB::raw('(COALESCE(total_masuk, 0) - COALESCE(total_keluar, 0)) as stok_saat_ini'));

        // 4. Ambil Detail Transaksi Terakhir (untuk Satuan, Tgl Kadaluarsa, Pengecekan, Keterangan)
        // Kita menggunakan relasi stokHabisPakai yang diurutkan dan dibatasi 1
        $query->with(['stokHabisPakai' => function ($q) {
            $q->orderBy('tanggal', 'desc')->limit(1);
        }]);

        // 5. Pencarian
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_barang', 'like', "%{$search}%")
                  ->orWhere('kode_inventaris', 'like', "%{$search}%");
            });
        }

        $stokBarang = $query->orderBy('nama_barang', 'asc')->paginate(15);

        // Kirim kategori yang tersedia ke view
        $bhpCategories = $this->bhpCategories;

        return view('stok.index', compact('stokBarang', 'bhpCategories', 'kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil data inventaris yang relevan (misal, yang kategorinya ATK)
        // $inventarisItems = Inventaris::where('kategori', 'ATK')->get(); 
        // return view('stok.create', compact('inventarisItems'));
        
        // Atau jika Anda ingin buat barang baru sekaligus stoknya
        return view('stok.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            // 'inventaris_id' => 'required|exists:inventaris,id', // Jika memilih barang yang ada
            'nama_barang' => 'required|string|max:255', // Jika input baru
            'kode_inventaris' => 'required|string|unique:inventaris,kode_inventaris', // Jika input baru
            'satuan' => 'required|string|max:50',
            'jumlah' => 'required|integer|min:0',
            'tgl_kadaluarsa' => 'nullable|date',
            'tgl_pengecekan' => 'nullable|date',
            'keterangan' => 'nullable|string',
        ]);

        // SANGAT DIREKOMENDASIKAN pakai DB Transaction
        // karena Anda menyentuh 2 tabel (inventaris & stok)
        try {
            DB::beginTransaction();

            // 1. Buat data di tabel 'inventaris' dulu
            // Perhatikan: Model Inventaris Anda akan auto-generate kode unik jika 'kode_inventaris' tidak diisi
            // Tapi untuk BHP, kodenya mungkin diinput manual
            $itemInventaris = Inventaris::create([
                'nama_barang' => $request->nama_barang,
                'kode_inventaris' => $request->kode_inventaris, // Pastikan ini unik
                'kategori' => 'Barang Habis Pakai', // atau 'ATK' atau sesuai kebutuhan
                'pemilik' => $request->pemilik ?? 'UBBG', // Sesuaikan
                'sumber_dana' => $request->sumber_dana ?? 'UBBG', // Sesuaikan
                'tahun_beli' => $request->tahun_beli ?? date('Y'),
                'kondisi_baik' => 0, // BHP tidak pakai kondisi ini
                'kondisi_rusak_ringan' => 0,
                'kondisi_rusak_berat' => 0,
                // 'unit_id' => ... (Opsional)
                // 'room_id' => ... (Opsional, misal gudang ATK)
            ]);

            // 2. Buat data di tabel 'stok_habis_pakais'
            $stok = new StokHabisPakai();
            $stok->inventaris_id = $itemInventaris->id; // Hubungkan ke inventaris
            $stok->jumlah_masuk = $request->jumlah; // Menggunakan jumlah_masuk
            $stok->satuan = $request->satuan;
            $stok->tgl_kadaluarsa = $request->tgl_kadaluarsa;
            $stok->tgl_pengecekan = $request->tgl_pengecekan;
            $stok->keterangan = $request->keterangan;
            $stok->tanggal = now(); // Tambahkan tanggal transaksi
            $stok->save();

            DB::commit(); // Simpan perubahan jika sukses

            return redirect()->route('stok.index')->with('success', 'Stok barang habis pakai berhasil ditambahkan.');

        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan jika ada error
            // Tampilkan pesan error
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventaris $inventaris)
    {
        // Tampilkan detail master barang dan riwayat stoknya
        $inventaris->load('stokHabisPakai'); // Load semua riwayat stok
        return view('stok.show', compact('inventaris'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventaris $inventaris)
    {
        // Kita perlu data stok terakhir untuk mengisi form edit
        $inventaris->load(['stokHabisPakai' => function ($q) {
            $q->orderBy('tanggal', 'desc')->limit(1);
        }]);
        
        $stok = $inventaris->stokHabisPakai->first(); // Ambil transaksi stok terakhir
        
        // Kirim inventaris dan stok terakhir ke view
        return view('stok.edit', compact('inventaris', 'stok'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventaris $inventaris)
    {
        // Validasi untuk update master barang dan mencatat transaksi stok baru
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
            'jumlah_masuk' => 'nullable|integer|min:0', // Jumlah masuk baru (opsional)
            'jumlah_keluar' => 'nullable|integer|min:0', // Jumlah keluar baru (opsional)
            'tgl_kadaluarsa' => 'nullable|date',
            'tgl_pengecekan' => 'nullable|date',
            'keterangan' => 'nullable|string',
            'kategori' => 'required|in:' . implode(',', $this->bhpCategories), // Pastikan kategori valid
        ]);
        
        try {
            DB::beginTransaction();
            
            // 1. Update tabel 'inventaris' (Master Barang)
            $inventaris->update([
                'nama_barang' => $request->nama_barang,
                'kategori' => $request->kategori,
                'keterangan' => $request->keterangan, // Update keterangan master jika ada
            ]);

            // 2. Catat transaksi stok baru jika ada perubahan jumlah
            if ($request->jumlah_masuk > 0 || $request->jumlah_keluar > 0) {
                StokHabisPakai::create([
                    'inventaris_id' => $inventaris->id,
                    'jumlah_masuk' => $request->jumlah_masuk ?? 0,
                    'jumlah_keluar' => $request->jumlah_keluar ?? 0,
                    'tanggal' => now(),
                    'satuan' => $request->satuan,
                    'tgl_kadaluarsa' => $request->tgl_kadaluarsa,
                    'tgl_pengecekan' => $request->tgl_pengecekan,
                    'keterangan' => $request->keterangan, // Keterangan transaksi
                ]);
            }
            // Jika tidak ada perubahan jumlah, kita hanya update master barang.

            DB::commit();

            return redirect()->route('stok.index')->with('success', 'Master barang habis pakai berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventaris $inventaris)
    {
        try {
            DB::beginTransaction();
            
            // Hapus semua riwayat stok terkait
            $inventaris->stokHabisPakai()->delete();
            
            // Hapus master barang
            $inventaris->delete();
            
            DB::commit();

            return redirect()->route('stok.index')->with('success', 'Master barang habis pakai berhasil dihapus.');
        
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('stok.index')->with('error', 'Gagal menghapus master barang: ' . $e->getMessage());
        }
    }
}