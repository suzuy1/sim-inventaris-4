# Rencana Perbaikan File resources/views/inventaris/index.blade.php

## Masalah yang Ditemukan

1. **Duplikasi kode parah**: File memiliki 4 blok kode yang hampir identik
2. **Struktur Blade tidak benar**: Beberapa `@endforelse` tanpa pasangan `@forelse`
3. **Kode di luar struktur Blade**: Sebagian besar file setelah baris 391 berada di luar struktur Blade yang benar
4. **Multiple `@endsection` tags**: Tag penutup section muncul beberapa kali

## Struktur File yang Benar

File seharusnya memiliki struktur berikut:
```php
@extends('dashboard')

@section('content')
    // Konten HTML dan Blade di sini
@endsection
```

## Rencana Perbaikan

### 1. Identifikasi Bagian yang Akan Dipertahankan

Dari analisis, bagian yang akan dipertahankan adalah:
- Baris 1-391: Bagian awal file yang sudah benar
- Hapus semua duplikasi dari baris 392-880
- Pastikan hanya ada satu `@endsection` di akhir file

### 2. Struktur yang Akan Diperbaiki

#### A. Header Section (Baris 1-41)
- Sudah benar, tidak perlu perubahan

#### B. Pencarian (Baris 43-69)
- Sudah benar, tidak perlu perubahan

#### C. Statistik Ringkas (Baris 71-180)
- Sudah benar, tidak perlu perubahan

#### D. Tabel (Baris 182-311)
- Sudah benar, tidak perlu perubahan

#### E. Modal Impor (Baris 313-391)
- Sudah benar, tidak perlu perubahan

### 3. Kode yang Akan Dihapus

Hapus semua kode dari baris 392-880 karena merupakan duplikasi dari bagian sebelumnya.

### 4. Variabel yang Diperlukan dari Controller

Berdasarkan analisis controller, variabel yang tersedia:
- `$inventaris`: Collection dari model Inventaris dengan relasi asetDetails
- Setiap item memiliki:
  - `nama_barang`
  - `total_baik`
  - `total_rusak_ringan`
  - `total_rusak_berat`
  - `keterangan`

### 5. JavaScript yang Akan Dipertahankan

Pertahankan JavaScript dari baris 835-879 (fungsi confirmDelete dan event listener)

## Implementasi

1. **Buat file baru dengan struktur yang benar**
2. **Salin bagian yang benar (baris 1-391)**
3. **Tambahkan JavaScript yang diperlukan**
4. **Pastikan semua direktif Blade memiliki pasangan yang benar**

## Struktur Akhir File

```php
@extends('dashboard')

@section('content')
    <div class="p-4 sm:p-6 lg:p-8">
        <!-- Header Section (baris 5-41) -->
        <div class="mb-8">
            <!-- Header content -->
        </div>

        <!-- Pencarian (baris 43-69) -->
        <div class="mb-6">
            <!-- Search form -->
        </div>

        <!-- Statistik Ringkas (baris 71-180) -->
        <div class="mb-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Statistics cards -->
        </div>

        <!-- Tabel (baris 182-311) -->
        <div class="overflow-hidden rounded-2xl shadow-2xl border-0 bg-white/50 backdrop-blur-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200/50">
                    <thead>
                        <!-- Table headers -->
                    </thead>
                    <tbody class="divide-y divide-gray-200/30 bg-white/30">
                        @forelse ($inventaris as $item)
                            <!-- Table rows with data -->
                        @empty
                            <!-- Empty state -->
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination (baris 295-310) -->
        @if($inventaris->hasPages())
            <!-- Pagination links -->
        @endif

        <!-- Modal Impor (baris 313-391) -->
        <div id="importModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
            <!-- Modal content -->
        </div>

        <!-- JavaScript (baris 835-879) -->
        <script>
            // JavaScript functions
        </script>
    </div>
@endsection
```

## Verifikasi Direktif Blade

### Direktif yang harus memiliki pasangan yang benar:

1. **@forelse / @endforelse** (baris 218-288)
   - Sudah benar dalam file asli
   - Menampilkan data inventaris atau empty state

2. **@if / @endif** (baris 295, 443, 590, 738)
   - Untuk pagination
   - Hanya perlu satu setelah duplikasi dihapus

3. **@section / @endsection**
   - Hanya satu di awal dan satu di akhir file
   - Saat ini ada 5 @endsection (baris 391, 539, 687, 835, 880)

### Variabel yang Digunakan dalam View

Berdasarkan analisis controller (`InventarisController.php` method `index`):

1. **$inventaris** (baris 52)
   - Tipe: LengthAwarePaginator
   - Berisi collection dari model Inventaris dengan relasi:
     - `asetDetails` (count)
     - `total_baik` (count)
     - `total_rusak_ringan` (count)
     - `total_rusak_berat` (count)

2. **Variabel yang tersedia untuk setiap $item:**
   - `$item->nama_barang` (dari tabel inventaris)
   - `$item->total_baik` (dari withCount)
   - `$item->total_rusak_ringan` (dari withCount)
   - `$item->total_rusak_berat` (dari withCount)
   - `$item->keterangan` (dari tabel inventaris)
   - `$item->id` (dari tabel inventaris)

3. **Variabel Loop:**
   - `$loop->iteration` (untuk nomor urut)
   - `$inventaris->currentPage()` (untuk pagination)
   - `$inventaris->perPage()` (untuk pagination)

4. **Request Variables:**
   - `request('search')` (untuk nilai input pencarian)

### Route yang Digunakan:

1. `route('inventaris.create')` - Form tambah inventaris
2. `route('inventaris.export')` - Export data
3. `route('inventaris.print_all')` - Cetak semua
4. `route('inventaris.index')` - Halaman index
5. `route('inventaris.show_grouped', $item)` - Detail inventaris
6. `route('inventaris.destroy', $item->id)` - Hapus inventaris
7. `route('inventaris.import')` - Import data

## Implementasi Langkah demi Langkah

### Langkah 1: Siapkan File Baru
1. Buat file sementara dengan nama `index_fixed.blade.php`
2. Salin struktur dasar dari rencana di atas

### Langkah 2: Salin Bagian yang Benar
1. Salin baris 1-391 dari file asli ke file baru
2. Pastikan semua direktif Blade terbuka dan tertutup dengan benar

### Langkah 3: Tambahkan JavaScript
1. Salin JavaScript dari baris 835-879
2. Tempatkan sebelum tag `@endsection`

### Langkah 4: Verifikasi Struktur
1. Pastikan hanya ada satu `@endsection` di akhir file
2. Periksa semua pasangan direktif Blade

### Langkah 5: Ganti File Asli
1. Backup file asli (rename menjadi `index.blade.php.old`)
2. Rename file baru menjadi `index.blade.php`

## Testing Setelah Perbaikan

### 1. Testing Basic Loading
- Akses URL: `http://127.0.0.1:8000/inventaris?kategori=tidak_habis_pakai`
- Pastikan tidak ada error "unexpected token endforeach"
- Halaman harus dimuat dengan benar

### 2. Testing Fungsionalitas
- **Pencarian**: Coba cari nama barang
- **Pagination**: Navigasi halaman harus berkerja
- **Modal Impor**: Klik tombol "Impor Data"
- **Tombol Hapus**: Klik hapus dan pastikan konfirmasi muncul

### 3. Testing Data Display
- Pastikan statistik kartu menampilkan data dengan benar
- Tabel harus menampilkan data inventaris
- Empty state harus muncul jika tidak ada data

### 4. Testing Responsive
- Test di berbagai ukuran layar (mobile, tablet, desktop)
- Pastikan layout tetap rapi

## Debugging Jika Masalah Masih Ada

### Jika Error "unexpected token" Masih Muncul:
1. Periksa lagi semua pasangan direktif Blade
2. Pastikan tidak ada karakter tersembunyi
3. Validasi sintaks Blade dengan Laravel Blade Linter

### Jika Data Tidak Muncul:
1. Periksa query di controller
2. Pastikan variabel dikirim dengan benar ke view
3. Debug dengan `dd($inventaris)` di controller

### Jika JavaScript Tidak Berkerja:
1. Periksa konsol browser untuk error
2. Pastikan jQuery dimuat (jika digunakan)
3. Verifikasi event listener terpasang dengan benar

## Rekomendasi Implementasi

### Mode Switch untuk Implementasi
Untuk menerapkan perbaikan ini, Anda perlu:
1. Switch ke **Code mode** untuk mengedit file Blade
2. Ikuti langkah-langkah implementasi yang telah diuraikan
3. Test perubahan setelah implementasi

### Ringkasan Solusi

**Masalah Utama**:
- File `resources/views/inventaris/index.blade.php` memiliki duplikasi kode 4 kali
- Struktur Blade tidak benar dengan multiple `@endsection` tags
- Kode di luar struktur Blade yang menyebabkan error "unexpected token endforeach"

**Solusi**:
1. Hapus semua duplikasi kode (baris 392-880)
2. Pertahankan hanya satu struktur yang benar (baris 1-391)
3. Tambahkan JavaScript yang diperlukan (baris 835-879)
4. Pastikan hanya ada satu `@endsection` di akhir file

**Hasil yang Diharapkan**:
- Halaman inventaris dapat dimuat tanpa error
- Semua fungsi berkerja dengan normal
- Kode lebih bersih dan mudah dipelihara

## Catatan Tambahan

- Error "unexpected token endforeach" disebabkan oleh struktur Blade yang tidak benar
- Setelah perbaikan, halaman seharusnya dapat dimuat tanpa error
- Pastikan untuk membackup file asli sebelum melakukan perubahan
- Test secara menyeluruh setelah perbaikan
- Monitor log Laravel untuk error yang mungkin muncul

## Langkah Selanjutnya

Setelah rencana ini disetujui:
1. Switch ke **Code mode**
2. Implementasikan perbaikan sesuai langkah-langkah di atas
3. Test halaman untuk memastikan error teratasi
4. Verifikasi semua fungsi berkerja dengan benar