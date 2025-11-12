@extends('dashboard')

@section('content')
{{-- REVISI 1: Diubah dari max-w-4xl menjadi max-w-7xl --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
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
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Tambah Inventaris Baru</h1>
                <p class="text-gray-600">Tambahkan barang baru ke dalam sistem inventaris kampus</p>
            </div>
            {{-- REVISI 2: Dihapus tombol "Batal" di header, karena sudah ada di bawah form --}}
            <div class="flex gap-3">
                {{-- Tombol Batal dipindah ke bawah form untuk konsistensi --}}
            </div>
        </div>
    </div>

    @if(session('error'))
    <div class="rounded-xl bg-red-50 border border-red-200 p-4 mb-6 animate-fade-in">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
            </div>
        </div>
    </div>
    @endif

    @if(session('success'))
    <div class="rounded-xl bg-green-50 border border-green-200 p-4 mb-6 animate-fade-in">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
            </div>
        </div>
    </div>
    @endif

    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Form Tambah Inventaris</h2>
            <p class="text-sm text-gray-600 mt-1">Isi informasi lengkap untuk menambahkan barang baru</p>
        </div>

        <div class="p-6">
            <form action="{{ route('inventaris.store') }}" method="POST" x-data="{ 
                kategori: '{{ old('kategori', 'tidak_habis_pakai') }}',
                totalStok: 0,
                calculateTotal() {
                    const baik = parseInt(document.getElementById('kondisi_baik')?.value) || 0;
                    const ringan = parseInt(document.getElementById('kondisi_rusak_ringan')?.value) || 0;
                    const berat = parseInt(document.getElementById('kondisi_rusak_berat')?.value) || 0;
                    this.totalStok = baik + ringan + berat;
                }
            }" x-init="calculateTotal()">
                @csrf

                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <div class="bg-blue-100 text-blue-600 p-2 rounded-lg mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        Informasi Dasar Barang
                    </h3>
                    
                    {{-- REVISI 3: Grid diubah menjadi 4 kolom di layar large (lg:grid-cols-4) --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        {{-- REVISI 4: Nama Barang dibuat full width di semua ukuran (lg:col-span-4) --}}
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
                                    value="{{ old('nama_barang') }}" 
                                    required
                                    placeholder="Contoh: Laptop Dell Latitude, Meja Kerja, dll."
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

                        <div>
                            <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">
                                Kategori Inventaris <span class="text-red-500">*</span>
                            </label>
                            <select 
                                name="kategori" 
                                id="kategori" 
                                x-model="kategori"
                                class="block w-full pl-4 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                required
                            >
                                <option value="tidak_habis_pakai">Barang Tidak Habis Pakai</option>
                                <option value="habis_pakai">Barang Habis Pakai</option>
                                <option value="aset_tetap">Aset Tetap</option>
                            </select>
                            @error('kategori')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-2">
                                Lokasi <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="lokasi" 
                                id="lokasi" 
                                class="block w-full pl-4 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('lokasi') border-red-300 @enderror" 
                                value="{{ old('lokasi') }}" 
                                required
                                placeholder="Contoh: Gedung A, Ruang Lab Komputer, dll."
                            >
                            @error('lokasi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="kode_inventaris" class="block text-sm font-medium text-gray-700 mb-2">
                                Kode Inventaris <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="kode_inventaris" 
                                id="kode_inventaris" 
                                class="block w-full pl-4 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('kode_inventaris') border-red-300 @enderror" 
                                value="{{ old('kode_inventaris') }}" 
                                required
                                placeholder="Contoh: INV-001, LAB-A-001, dll."
                            >
                            @error('kode_inventaris')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div x-show="kategori === 'habis_pakai'" x-transition>
                            <label for="initial_stok" class="block text-sm font-medium text-gray-700 mb-2">
                                Stok Awal <span class="text-red-500">*</span>
                                <span class="text-xs text-gray-500">(untuk barang habis pakai)</span>
                            </label>
                            <input 
                                type="number" 
                                name="initial_stok" 
                                id="initial_stok" 
                                class="block w-full pl-4 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" 
                                value="{{ old('initial_stok', 0) }}" 
                                min="0"
                                placeholder="0"
                            >
                            @error('initial_stok')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <div class="bg-purple-100 text-purple-600 p-2 rounded-lg mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        Kondisi
                        <span class="ml-auto text-sm font-normal text-gray-500">
                            Total: <span class="font-semibold" x-text="totalStok"></span> unit
                        </span>
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
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
                                value="{{ old('kondisi_baik', 0) }}" 
                                min="0"
                                x-on:input="calculateTotal()"
                                placeholder="0"
                            >
                        </div>

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
                                value="{{ old('kondisi_rusak_ringan', 0) }}" 
                                min="0"
                                x-on:input="calculateTotal()"
                                placeholder="0"
                            >
                        </div>

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
                                value="{{ old('kondisi_rusak_berat', 0) }}" 
                                min="0"
                                x-on:input="calculateTotal()"
                                placeholder="0"
                            >
                        </div>
                    </div>
                </div>

                <div class="flex flex-col-reverse md:flex-row gap-3 md:justify-end pt-6 border-t border-gray-200">
                    <a href="{{ route('inventaris.index') }}" class="inline-flex justify-center items-center gap-2 rounded-lg bg-gray-600 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 transition-colors duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Batal
                    </a>
                    <button type="submit" class="inline-flex justify-center items-center gap-2 rounded-lg bg-gradient-to-r from-blue-600 to-purple-600 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Tambah Inventaris
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.animate-fade-in {
    animation: fadeIn 0.5s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
@endsection