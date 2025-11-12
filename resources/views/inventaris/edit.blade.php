@extends('dashboard')

@section('content')
{{-- REVISI 1: Diubah dari max-w-4xl menjadi max-w-7xl --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="mb-4 md:mb-0">
                <div class="flex items-center gap-3 mb-2">
                    <a href="{{ route('inventaris.index') }}" class="inline-flex items-center text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke Daftar
                    </a>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Edit Inventaris</h1>
                <div class="flex items-center gap-2 text-sm text-gray-600">
                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium">
                        ID: {{ $inventaris->id }}
                    </span>
                    <span>•</span>
                    <span>Terakhir update: {{ $inventaris->updated_at->format('d M Y') }}</span>
                </div>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('inventaris.show', $inventaris) }}" class="inline-flex items-center gap-2 rounded-lg bg-gray-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 transition-colors duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    Lihat Detail
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium">Total Stok</p>
                    <p class="text-2xl font-bold mt-1">
                        {{ $inventaris->kondisi_baik + $inventaris->kondisi_rusak_ringan + $inventaris->kondisi_rusak_berat }}
                    </p>
                </div>
                <div class="bg-white/20 p-3 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m8-8V4a1 1 0 00-1-1h-2a1 1 0 00-1 1v1M9 7h6"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-green-500 to-green-600 text-white rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium">Kondisi Baik</p>
                    <p class="text-2xl font-bold mt-1">{{ $inventaris->kondisi_baik }}</p>
                </div>
                <div class="bg-white/20 p-3 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-amber-500 to-amber-600 text-white rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-amber-100 text-sm font-medium">Perlu Perbaikan</p>
                    <p class="text-2xl font-bold mt-1">{{ $inventaris->kondisi_rusak_ringan + $inventaris->kondisi_rusak_berat }}</p>
                </div>
                <div class="bg-white/20 p-3 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Section -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Form Edit Inventaris</h2>
            <p class="text-sm text-gray-600 mt-1">Update informasi lengkap untuk barang: <span class="font-medium text-blue-600">{{ $inventaris->nama_barang }}</span></p>
        </div>

        <div class="p-6">
            <form action="{{ route('inventaris.update', $inventaris) }}" method="POST" x-data="{ 
                kategori: '{{ old('kategori', $inventaris->kategori) }}',
                totalStok: {{ $inventaris->kondisi_baik + $inventaris->kondisi_rusak_ringan + $inventaris->kondisi_rusak_berat }},
                calculateTotal() {
                    const baik = parseInt(document.getElementById('kondisi_baik').value) || 0;
                    const ringan = parseInt(document.getElementById('kondisi_rusak_ringan').value) || 0;
                    const berat = parseInt(document.getElementById('kondisi_rusak_berat').value) || 0;
                    this.totalStok = baik + ringan + berat;
                }
            }">
                @csrf
                @method('PUT')

                <!-- Basic Information -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <div class="bg-blue-100 text-blue-600 p-2 rounded-lg mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        Informasi Dasar
                    </h3>
                    
                    {{-- REVISI 2: Grid diubah menjadi 4 kolom di layar large (lg:grid-cols-4) --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Nama Barang -->
                        {{-- REVISI 3: Nama Barang dibuat full width di semua ukuran (lg:col-span-4) --}}
                        <div class="md:col-span-2 lg:col-span-4">
                            <label for="nama_barang" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Barang <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input 
                                    type="text" 
                                    name="nama_barang" 
                                    id="nama_barang" 
                                    class="block w-full pl-4 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('nama_barang') border-red-300 @enderror" 
                                    value="{{ old('nama_barang', $inventaris->nama_barang) }}" 
                                    required
                                    placeholder="Masukkan nama barang"
                                >
                                @error('nama_barang')
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                @enderror
                            </div>
                            @error('nama_barang')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kategori -->
                        <div>
                            <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                            <select 
                                name="kategori" 
                                id="kategori" 
                                x-model="kategori"
                                class="block w-full pl-4 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            >
                                <option value="tidak_habis_pakai" {{ old('kategori', $inventaris->kategori) == 'tidak_habis_pakai' ? 'selected' : '' }}>Barang Tidak Habis Pakai</option>
                                <option value="habis_pakai" {{ old('kategori', $inventaris->kategori) == 'habis_pakai' ? 'selected' : '' }}>Barang Habis Pakai</option>
                                <option value="aset_tetap" {{ old('kategori', $inventaris->kategori) == 'aset_tetap' ? 'selected' : '' }}>Aset Tetap</option>
                            </select>
                        </div>

                        <!-- Lokasi -->
                        <div>
                            <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-2">
                                Lokasi <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="lokasi" 
                                id="lokasi" 
                                class="block w-full pl-4 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('lokasi') border-red-300 @enderror" 
                                value="{{ old('lokasi', $inventaris->lokasi) }}" 
                                required
                                placeholder="Contoh: Gedung A, Ruang Lab Komputer, dll."
                            >
                            @error('lokasi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kode Inventaris -->
                        <div>
                            <label for="kode_inventaris" class="block text-sm font-medium text-gray-700 mb-2">
                                Kode Inventaris <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="kode_inventaris" 
                                id="kode_inventaris" 
                                class="block w-full pl-4 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('kode_inventaris') border-red-300 @enderror" 
                                value="{{ old('kode_inventaris', $inventaris->kode_inventaris) }}" 
                                required
                                placeholder="Contoh: INV-001, LAB-A-001, dll."
                            >
                            @error('kode_inventaris')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Condition Information -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <div class="bg-purple-100 text-purple-600 p-2 rounded-lg mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        Kondisi Barang
                        <span class="ml-auto text-sm font-normal text-gray-500">
                            Total Stok: <span class="font-semibold" x-text="totalStok"></span> unit
                        </span>
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Kondisi Baik -->
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <label for="kondisi_baik" class="block text-sm font-medium text-green-800 mb-2 flex items-center">
                                <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                Kondisi Baik
                            </label>
                            <input 
                                type="number" 
                                name="kondisi_baik" 
                                id="kondisi_baik" 
                                class="block w-full px-3 py-2 border border-green-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200 bg-white" 
                                value="{{ old('kondisi_baik', $inventaris->kondisi_baik) }}" 
                                min="0"
                                x-on:input="calculateTotal()"
                                placeholder="0"
                            >
                        </div>

                        <!-- Rusak Ringan -->
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <label for="kondisi_rusak_ringan" class="block text-sm font-medium text-yellow-800 mb-2 flex items-center">
                                <span class="w-2 h-2 bg-yellow-500 rounded-full mr-2"></span>
                                Rusak Ringan
                            </label>
                            <input 
                                type="number" 
                                name="kondisi_rusak_ringan" 
                                id="kondisi_rusak_ringan" 
                                class="block w-full px-3 py-2 border border-yellow-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition duration-200 bg-white" 
                                value="{{ old('kondisi_rusak_ringan', $inventaris->kondisi_rusak_ringan) }}" 
                                min="0"
                                x-on:input="calculateTotal()"
                                placeholder="0"
                            >
                        </div>

                        <!-- Rusak Berat -->
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <label for="kondisi_rusak_berat" class="block text-sm font-medium text-red-800 mb-2 flex items-center">
                                <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>
                                Rusak Berat
                            </label>
                            <input 
                                type="number" 
                                name="kondisi_rusak_berat" 
                                id="kondisi_rusak_berat" 
                                class="block w-full px-3 py-2 border border-red-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200 bg-white" 
                                value="{{ old('kondisi_rusak_berat', $inventaris->kondisi_rusak_berat) }}" 
                                min="0"
                                x-on:input="calculateTotal()"
                                placeholder="0"
                            >
                        </div>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <div class="bg-gray-100 text-gray-600 p-2 rounded-lg mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                            </svg>
                        </div>
                        Informasi Tambahan
                    </h3>
                    
                    <div>
                        <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                        <textarea 
                            name="keterangan" 
                            id="keterangan" 
                            rows="4" 
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="Tambahkan catatan atau keterangan tentang barang ini..."
                        >{{ old('keterangan', $inventaris->keterangan) }}</textarea>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col-reverse md:flex-row gap-3 md:justify-end pt-6 border-t border-gray-200">
                    <a href="{{ route('inventaris.index') }}" class="inline-flex justify-center items-center gap-2 rounded-lg bg-gray-600 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 transition-colors duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Batal
                    </a>
                    <button type="submit" class="inline-flex justify-center items-center gap-2 rounded-lg bg-gradient-to-r from-blue-600 to-purple-600 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Update Inventaris
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- REVISI 4: Menghapus script Alpine.js yang duplikat. 
     Logika x-data sudah didefinisikan di tag <form> di atas. --}}
{{-- 
<script>
// Alpine.js for interactive features
document.addEventListener('alpine:init', () => {
    Alpine.data('inventarisForm', () => ({
        kategori: '{{ old('kategori', $inventaris->kategori) }}',
        totalStok: {{ $inventaris->kondisi_baik + $inventaris->kondisi_rusak_ringan + $inventaris->kondisi_rusak_berat }},
        
        calculateTotal() {
            const baik = parseInt(document.getElementById('kondisi_baik').value) || 0;
            const ringan = parseInt(document.getElementById('kondisi_rusak_ringan').value) || 0;
            const berat = parseInt(document.getElementById('kondisi_rusak_berat').value) || 0;
            this.totalStok = baik + ringan + berat;
        }
    }));
});
</script>
--}}
@endsection