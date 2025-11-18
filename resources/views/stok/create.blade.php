{{-- resources/views/stok/create.blade.php --}}
@extends('dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-red-50/30 p-4 sm:p-6 lg:p-8">
    <div class="max-w-5xl mx-auto mb-8">
        <a href="{{ route('stok.index') }}" 
           class="inline-flex items-center gap-2 text-sm font-medium text-gray-600 hover:text-red-600 transition-colors duration-200 group mb-6">
            <svg class="h-5 w-5 transform group-hover:-translate-x-1 transition-transform duration-200" 
                 fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span>Kembali ke Daftar Stok BHP</span>
        </a>

        <div class="space-y-2">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 tracking-tight">
                Tambah Master Barang Habis Pakai (BHP)
            </h1>
            <div class="flex items-center gap-2 text-sm text-gray-600">
                <svg class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
                <span>Formulir ini mencatat **Master** barang sekaligus **Stok Awal**.</span>
            </div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto">
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
            
            <form action="{{ route('stok.store') }}" method="POST" class="relative">
                @csrf
                
                <div class="p-8 lg:p-10 space-y-8">

                    {{-- Error Messages --}}
                    @if ($errors->any())
                        <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-5 shadow-sm" role="alert">
                            <div class="flex items-start gap-3">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-sm font-semibold text-red-800 mb-2">Terdapat beberapa kesalahan pada form:</h3>
                                    <ul class="space-y-1 text-sm text-red-700">
                                        @foreach ($errors->all() as $error)
                                            <li class="flex items-start gap-2">
                                                <span class="text-red-500 mt-0.5">•</span>
                                                <span>{{ $error }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-3 border-b border-gray-200">
                            <div class="p-2 bg-indigo-100 rounded-lg">
                                <svg class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-900">Master Barang</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="nama_barang" class="block text-sm font-semibold text-gray-900">Nama Barang <span class="text-red-500">*</span></label>
                                <input type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang') }}" required
                                        class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 py-3 px-4 text-gray-900 transition-all duration-200"
                                        placeholder="Contoh: Masker Medis, Pulpen Snowman">
                            </div>

                            <div class="space-y-2">
                                <label for="kode_inventaris" class="block text-sm font-semibold text-gray-900">Kode Inventaris <span class="text-red-500">*</span></label>
                                <input type="text" name="kode_inventaris" id="kode_inventaris" value="{{ old('kode_inventaris') }}" required
                                        class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 py-3 px-4 text-gray-900 transition-all duration-200"
                                        placeholder="Contoh: BHP/MEDIS/001">
                            </div>
                            
                            <div class="space-y-2 md:col-span-2">
                                <label for="kategori" class="block text-sm font-semibold text-gray-900">Kategori BHP <span class="text-red-500">*</span></label>
                                <select name="kategori" id="kategori" required
                                        class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 py-3 px-4 text-gray-900 transition-all duration-200">
                                    <option value="">Pilih Kategori</option>
                                    @foreach($bhpCategories as $cat)
                                        <option value="{{ $cat }}" @if(old('kategori') == $cat || (!old('kategori') && isset($selectedKategori) && $selectedKategori == $cat)) selected @endif>
                                            {{ $cat }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-3 border-b border-gray-200">
                            <div class="p-2 bg-red-100 rounded-lg">
                                <svg class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10m0 0h16m-4-4h4m-4 4h4m-8-12h2m-2 4h2m-2 4h2m-2 4h2m-4-8h10a2 2 0 012 2v8a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2z" />
                                </svg>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-900">Stok Awal & Detail BHP</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-2">
                                <label for="jumlah" class="block text-sm font-semibold text-gray-900">Jumlah Stok Awal <span class="text-red-500">*</span></label>
                                <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah') }}" required min="1"
                                        class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 py-3 px-4 text-gray-900 transition-all duration-200"
                                        placeholder="Min. 1">
                            </div>

                            <div class="space-y-2">
                                <label for="satuan" class="block text-sm font-semibold text-gray-900">Satuan <span class="text-red-500">*</span></label>
                                <input type="text" name="satuan" id="satuan" value="{{ old('satuan') }}" required
                                        class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 py-3 px-4 text-gray-900 transition-all duration-200"
                                        placeholder="Contoh: Box, Pcs, Roll, Tablet">
                            </div>

                            <div class="space-y-2">
                                <label for="tgl_kadaluarsa" class="block text-sm font-semibold text-gray-900">Tanggal Kadaluarsa</label>
                                <input type="date" name="tgl_kadaluarsa" id="tgl_kadaluarsa" value="{{ old('tgl_kadaluarsa') }}"
                                        class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 py-3 px-4 text-gray-900 transition-all duration-200">
                                <p class="text-xs text-gray-500">Opsional, penting untuk Obat/Medis.</p>
                            </div>

                            <div class="space-y-2 md:col-span-2">
                                <label for="tgl_pengecekan" class="block text-sm font-semibold text-gray-900">Tanggal Pengecekan Terakhir</label>
                                <input type="date" name="tgl_pengecekan" id="tgl_pengecekan" value="{{ old('tgl_pengecekan') }}"
                                        class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 py-3 px-4 text-gray-900 transition-all duration-200">
                                <p class="text-xs text-gray-500">Opsional.</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-3 border-b border-gray-200">
                            <div class="p-2 bg-amber-100 rounded-lg">
                                <svg class="h-5 w-5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-900">Keterangan</h2>
                        </div>

                        <div class="space-y-2">
                            <label for="keterangan" class="block text-sm font-semibold text-gray-900">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" rows="4"
                                    class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 py-3 px-4 text-gray-900 transition-all duration-200 resize-none"
                                    placeholder="Tambahkan detail penting seperti merek, jenis, atau catatan riwayat stok...">{{ old('keterangan') }}</textarea>
                            <p class="text-xs text-gray-500">Opsional: Detail tambahan tentang master barang ini.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-8 py-6 border-t border-gray-200 flex items-center justify-end">
                    <button type="submit" 
                            class="inline-flex items-center gap-2 px-8 py-3 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-red-600 to-pink-600 hover:from-red-700 hover:to-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Stok BHP
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
