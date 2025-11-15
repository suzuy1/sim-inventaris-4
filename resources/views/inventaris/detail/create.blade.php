@extends('dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 sm:p-6 lg:p-8">
    <!-- Header Section -->
    <div class="max-w-5xl mx-auto mb-8">
        <!-- Back Button -->
        <a href="{{ route('inventaris.show_grouped', $inventaris) }}" 
           class="inline-flex items-center gap-2 text-sm font-medium text-gray-600 hover:text-indigo-600 transition-colors duration-200 group mb-6">
            <svg class="h-5 w-5 transform group-hover:-translate-x-1 transition-transform duration-200" 
                 fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span>Kembali ke Detail Aset</span>
        </a>

        <!-- Page Title -->
        <div class="space-y-2">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 tracking-tight">
                Tambah Unit Aset Baru
            </h1>
            <div class="flex items-center gap-2 text-sm text-gray-600">
                <svg class="h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                <span>Master Barang: <span class="font-semibold text-gray-900">{{ $inventaris->nama_barang }}</span></span>
            </div>
        </div>
    </div>

    <!-- Main Form Card -->
    <div class="max-w-5xl mx-auto">
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
            
            <form action="{{ route('inventaris.detail.store', $inventaris) }}" method="POST" class="relative">
                @csrf
                
                <!-- Form Content -->
                <div class="p-8 lg:p-10 space-y-8">

                    <!-- Error Messages -->
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

                    <!-- Section 1: Informasi Dasar -->
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-3 border-b border-gray-200">
                            <div class="p-2 bg-indigo-100 rounded-lg">
                                <svg class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-900">Informasi Dasar</h2>
                        </div>

                        <!-- Tipe Barang -->
                        <div class="space-y-2">
                            <label for="tipe_barang" class="flex items-center gap-2 text-sm font-semibold text-gray-900">
                                <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                Tipe Barang
                            </label>
                            <input type="text" 
                                   name="tipe_barang" 
                                   id="tipe_barang" 
                                   value="{{ old('tipe_barang') }}"
                                   class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 text-gray-900 placeholder-gray-400 transition-all duration-200"
                                   placeholder="Contoh: Laptop Asus ROG, Meja Kayu Jati">
                            <p class="flex items-start gap-1.5 text-xs text-gray-500">
                                <svg class="h-4 w-4 text-gray-400 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Tipe spesifik dari master barang ini (misal: Laptop Asus ROG untuk master Laptop)</span>
                            </p>
                        </div>

                        <!-- Kondisi -->
                        <div class="space-y-2">
                            <label for="kondisi" class="flex items-center gap-2 text-sm font-semibold text-gray-900">
                                <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Kondisi
                                <span class="text-red-500">*</span>
                            </label>
                            <select name="kondisi" 
                                    id="kondisi" 
                                    required
                                    class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 text-gray-900 transition-all duration-200">
                                <option value="Baik" @if(old('kondisi') == 'Baik') selected @endif>
                                    ✓ Baik - Berfungsi dengan sempurna
                                </option>
                                <option value="Rusak Ringan" @if(old('kondisi') == 'Rusak Ringan') selected @endif>
                                    ⚠ Rusak Ringan - Perlu perbaikan kecil
                                </option>
                                <option value="Rusak Berat" @if(old('kondisi') == 'Rusak Berat') selected @endif>
                                    ✗ Rusak Berat - Tidak dapat digunakan
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Section 2: Pembelian & Keuangan -->
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-3 border-b border-gray-200">
                            <div class="p-2 bg-emerald-100 rounded-lg">
                                <svg class="h-5 w-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-900">Pembelian & Keuangan</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Sumber Dana -->
                            <div class="space-y-2">
                                <label for="sumber_dana_id" class="flex items-center gap-2 text-sm font-semibold text-gray-900">
                                    <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Sumber Dana
                                </label>
                                <select name="sumber_dana_id" 
                                        id="sumber_dana_id"
                                        class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 text-gray-900 transition-all duration-200">
                                    <option value="">Pilih Sumber Dana</option>
                                    @foreach($sumberDanas as $sumberDana)
                                        <option value="{{ $sumberDana->id }}" @if(old('sumber_dana_id') == $sumberDana->id) selected @endif>
                                            {{ $sumberDana->kode }} - {{ $sumberDana->nama_sumber_dana }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Tanggal Pembelian -->
                            <div class="space-y-2">
                                <label for="tgl_pembelian" class="flex items-center gap-2 text-sm font-semibold text-gray-900">
                                    <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Tanggal Pembelian
                                </label>
                                <input type="date" 
                                       name="tgl_pembelian" 
                                       id="tgl_pembelian" 
                                       value="{{ old('tgl_pembelian') }}"
                                       class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 text-gray-900 transition-all duration-200">
                            </div>

                            <!-- Harga Beli -->
                            <div class="space-y-2 md:col-span-2">
                                <label for="harga_beli" class="flex items-center gap-2 text-sm font-semibold text-gray-900">
                                    <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Harga Beli
                                </label>
                                <div class="relative">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                        <span class="text-gray-500 font-medium">Rp</span>
                                    </div>
                                    <input type="number" 
                                           name="harga_beli" 
                                           id="harga_beli" 
                                           value="{{ old('harga_beli') }}"
                                           class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 pl-12 pr-4 text-gray-900 placeholder-gray-400 transition-all duration-200"
                                           placeholder="5.000.000"
                                           step="1000">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Lokasi & Pengelolaan -->
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-3 border-b border-gray-200">
                            <div class="p-2 bg-purple-100 rounded-lg">
                                <svg class="h-5 w-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-900">Lokasi & Pengelolaan</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Ruangan / Lokasi -->
                            <div class="space-y-2">
                                <label for="room_id" class="flex items-center gap-2 text-sm font-semibold text-gray-900">
                                    <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    Ruangan / Lokasi
                                </label>
                                <select name="room_id" 
                                        id="room_id"
                                        class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 text-gray-900 transition-all duration-200">
                                    <option value="">Pilih Ruangan</option>
                                    @foreach($rooms as $room)
                                        <option value="{{ $room->id }}" @if(old('room_id') == $room->id) selected @endif>
                                            {{ $room->nama_ruangan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Penanggung Jawab -->
                            <div class="space-y-2">
                                <label for="penanggung_jawab_id" class="flex items-center gap-2 text-sm font-semibold text-gray-900">
                                    <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Penanggung Jawab
                                </label>
                                <select name="penanggung_jawab_id" 
                                        id="penanggung_jawab_id"
                                        class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 text-gray-900 transition-all duration-200">
                                    <option value="">Pilih Penanggung Jawab</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" @if(old('penanggung_jawab_id') == $user->id) selected @endif>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Section 4: Keterangan Tambahan -->
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-3 border-b border-gray-200">
                            <div class="p-2 bg-amber-100 rounded-lg">
                                <svg class="h-5 w-5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-900">Keterangan Tambahan</h2>
                        </div>

                        <!-- Keterangan -->
                        <div class="space-y-2">
                            <label for="keterangan" class="flex items-center gap-2 text-sm font-semibold text-gray-900">
                                <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Keterangan
                            </label>
                            <textarea name="keterangan" 
                                      id="keterangan" 
                                      rows="4"
                                      class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 text-gray-900 placeholder-gray-400 transition-all duration-200 resize-none"
                                      placeholder="Tambahkan catatan penting, riwayat perbaikan, atau informasi tambahan lainnya...">{{ old('keterangan') }}</textarea>
                            <p class="flex items-start gap-1.5 text-xs text-gray-500">
                                <svg class="h-4 w-4 text-gray-400 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Detail penting seperti nomor seri, spesifikasi teknis, atau catatan kondisi khusus</span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="bg-gray-50 px-8 py-6 border-t border-gray-200 flex items-center justify-between flex-wrap gap-4">
                    <div class="flex items-start gap-2 text-xs text-gray-500 max-w-md">
                        <svg class="h-4 w-4 text-gray-400 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Pastikan semua data telah diisi dengan benar sebelum menyimpan</span>
                    </div>
                    
                    <div class="flex items-center gap-3">
                        <a href="{{ route('inventaris.show_grouped', $inventaris) }}" 
                           class="inline-flex items-center gap-2 px-6 py-3 border-2 border-gray-300 rounded-xl text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-200 shadow-sm">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Batal
                        </a>
                        
                        <button type="submit" 
                                class="inline-flex items-center gap-2 px-8 py-3 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            Simpan Unit Aset
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Additional Info Card -->
        <div class="mt-6 bg-blue-50 border border-blue-100 rounded-2xl p-6 shadow-sm">
            <div class="flex gap-4">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-blue-900 mb-2">Tips Pengisian Form</h3>
                    <ul class="space-y-1 text-sm text-blue-800">
                        <li class="flex items-start gap-2">
                            <span class="text-blue-600 mt-0.5">•</span>
                            <span>Isi <strong>Tipe Barang</strong> dengan spesifikasi detail untuk memudahkan identifikasi</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-blue-600 mt-0.5">•</span>
                            <span>Pilih <strong>Kondisi</strong> sesuai keadaan fisik dan fungsional aset saat ini</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-blue-600 mt-0.5">•</span>
                            <span>Lengkapi informasi <strong>Harga Beli</strong> dan <strong>Sumber Dana</strong> untuk keperluan audit</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-blue-600 mt-0.5">•</span>
                            <span>Tentukan <strong>Ruangan</strong> dan <strong>Penanggung Jawab</strong> untuk tracking aset yang lebih baik</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
    /* Smooth transitions for all interactive elements */
    input[type="text"],
    input[type="number"],
    input[type="date"],
    select,
    textarea {
        transition: all 0.2s ease-in-out;
    }

    /* Enhanced focus states */
    input[type="text"]:focus,
    input[type="number"]:focus,
    input[type="date"]:focus,
    select:focus,
    textarea:focus {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.15);
    }

    /* Hover effect for select dropdowns */
    select:hover {
        border-color: #818cf8;
    }

    /* Custom scrollbar for textarea */
    textarea::-webkit-scrollbar {
        width: 8px;
    }

    textarea::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }

    textarea::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    textarea::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* Animated gradient background */
    @keyframes gradient-shift {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }

    .bg-gradient-to-br {
        background-size: 200% 200%;
        animation: gradient-shift 15s ease infinite;
    }

    /* Loading state animation (optional) */
    @keyframes pulse-ring {
        0% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(99, 102, 241, 0.7);
        }
        70% {
            transform: scale(1);
            box-shadow: 0 0 0 10px rgba(99, 102, 241, 0);
        }
        100% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(99, 102, 241, 0);
        }
    }

    /* Number input hide spinner (cleaner look) */
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
    }
</style>

<!-- Optional: JavaScript for enhanced interactions -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Format currency input
        const hargaBeliInput = document.getElementById('harga_beli');
        if (hargaBeliInput) {
            hargaBeliInput.addEventListener('blur', function(e) {
                if (this.value) {
                    // Format number with thousand separators
                    const value = parseInt(this.value.replace(/\D/g, ''));
                    if (!isNaN(value)) {
                        this.value = value;
                    }
                }
            });
        }

        // Add visual feedback on form submission
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.innerHTML = `
                        <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span>Menyimpan...</span>
                    `;
                    submitBtn.disabled = true;
                }
            });
        }

        // Auto-resize textarea
        const textarea = document.getElementById('keterangan');
        if (textarea) {
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = this.scrollHeight + 'px';
            });
        }
    });
</script>
@endsection