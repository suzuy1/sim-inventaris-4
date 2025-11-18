@extends('dashboard')

@section('content')
<div class="p-4 sm:p-6 lg:p-8">
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="mb-4 md:mb-0">
                <div class="flex items-center gap-3 mb-3">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900">
                            Detail Unit Aset
                        </h1>
                        <p class="text-lg text-blue-600 font-semibold">
                            {{ $asetDetail->kode_inv }}
                        </p>
                    </div>
                </div>
                <p class="mt-2 text-sm text-gray-600 max-w-2xl">
                    Informasi lengkap mengenai unit aset **{{ $asetDetail->kode_inv }}** dari **{{ $asetDetail->inventaris->nama_barang }}**.
                </p>
                <div class="mt-3">
                    <a href="{{ route('inventaris.show_grouped', $asetDetail->inventaris) }}" 
                       class="inline-flex items-center gap-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke Daftar Unit Aset
                    </a>
                </div>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('aset-detail.edit', $asetDetail) }}" 
                   class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-lg hover:bg-indigo-700 transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Unit Aset
                </a>
                <form action="{{ route('aset-detail.destroy', $asetDetail) }}" method="POST" 
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus unit {{ $asetDetail->kode_inv }} ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="inline-flex items-center gap-2 rounded-xl border border-red-300 bg-white px-5 py-3 text-sm font-semibold text-red-700 shadow-lg hover:bg-red-50 transition-colors duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus Unit Aset
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden p-6 mt-8">
        <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
            </svg>
            Detail Informasi
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
            <x-detail-row label="Nama Barang" :value="$asetDetail->inventaris->nama_barang" />
            <x-detail-row label="Kategori" :value="$asetDetail->inventaris->kategori" />
            <x-detail-row label="Kode Unit" :value="$asetDetail->kode_inv" />
            <x-detail-row label="Tipe Barang" :value="$asetDetail->tipe_barang ?? '-'" />
            <x-detail-row label="Kondisi" :value="$asetDetail->kondisi" />
            <x-detail-row label="Lokasi/Ruangan" :value="$asetDetail->room->nama_ruangan ?? '-'" />
            <x-detail-row label="Penanggung Jawab" :value="$asetDetail->penanggungJawab->name ?? '-'" />
            <x-detail-row label="Sumber Dana" :value="$asetDetail->sumberDana->nama_sumber_dana ?? '-'" />
            <x-detail-row label="Tanggal Pembelian" :value="$asetDetail->tgl_pembelian ? \Carbon\Carbon::parse($asetDetail->tgl_pembelian)->format('d/m/Y') : '-'" />
            <x-detail-row label="Harga Beli" :value="$asetDetail->harga_beli ? 'Rp ' . number_format($asetDetail->harga_beli, 0, ',', '.') : '-'" />
            
            {{-- START: Tambahan Baris Tanggal Perbaikan dan Pengecekan --}}
            <x-detail-row label="Tanggal Perbaikan" :value="$asetDetail->tgl_perbaikan ? \Carbon\Carbon::parse($asetDetail->tgl_perbaikan)->format('d/m/Y') : '-'" />
            <x-detail-row label="Tanggal Pengecekan" :value="$asetDetail->tgl_pengecekan ? \Carbon\Carbon::parse($asetDetail->tgl_pengecekan)->format('d/m/Y') : '-'" />
            {{-- END: Tambahan Baris Tanggal Perbaikan dan Pengecekan --}}

            {{-- Pindahkan Keterangan ke baris terakhir agar menempati satu baris penuh jika layout custom --}}
            <div class="md:col-span-2">
                 <x-detail-row label="Keterangan" :value="$asetDetail->keterangan ?? '-'" />
            </div>
           
        </div>
    </div>
</div>
@endsection