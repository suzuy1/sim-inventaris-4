@extends('dashboard')

@section('content')
{{-- Menggunakan max-w-7xl untuk layout yang lebih lebar, umum untuk dashboard --}}
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="md:flex md:items-center md:justify-between mb-8">
        <div class="flex-1 min-w-0">
            <h1 class="text-3xl font-bold leading-tight text-gray-900 bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">Tambah Transaksi Baru</h1>
            <p class="mt-2 text-sm text-gray-600">Buat transaksi inventaris baru untuk pencatatan yang akurat</p>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4">
            <a href="{{ route('transactions.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 transform hover:-translate-y-0.5">
                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Kembali ke Daftar
            </a>
        </div>
    </div>

    <div class="bg-white shadow-xl rounded-2xl border border-gray-100 overflow-hidden">
        <form action="{{ route('transactions.store') }}" method="POST" x-data="stockChecker({{ $inventaris->toJson() }})" x-init="init()">
            @csrf

            <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-purple-50 to-indigo-50">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Form Transaksi Inventaris</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-600">Isi detail transaksi dengan informasi yang valid</p>
            </div>
            
            {{-- 
              REVISI: 
              Menghilangkan card-di-dalam-card. 
              Input field sekarang langsung di dalam 'space-y-6' tanpa dibungkus bg-white/border/shadow-sm lagi.
              Ini membuat form terasa lebih menyatu dan bersih.
            --}}
            <div class="px-6 py-6 space-y-6 bg-gradient-to-br from-white to-gray-50">
                
                <div>
                    <label for="inventaris_id" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                        <svg class="w-5 h-5 text-purple-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        Pilih Inventaris
                    </label>
                    <select name="inventaris_id" id="inventaris_id" 
                            class="block w-full pl-4 pr-10 py-3 text-base border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 sm:text-sm transition-all duration-200 @error('inventaris_id') border-red-300 @enderror"
                            x-model="selectedInventarisId" 
                            @change="updateStockInfo()" 
                            required>
                        <option value="">Pilih Inventaris</option>
                        @foreach ($inventaris as $item)
                            <option value="{{ $item->id }}" {{ old('inventaris_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_barang }} ({{ $item->kode_inventaris }}) - {{ $item->kategori ?? 'N/A' }}
                            </option>
                        @endforeach
                    </select>
                    @error('inventaris_id')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- 
                  CATATAN: 
                  Blok ini sengaja dipertahankan style-nya (bg-blue-50) 
                  karena ini adalah "callout box" yang menyoroti info dinamis. Ini adalah praktik UI yang baik.
                --}}
                <div x-show="selectedInventarisId" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl border border-blue-200 p-6 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-8 w-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-semibold text-gray-900" x-text="selectedItemName"></h4>
                                    <p class="text-sm text-gray-600">Informasi stok terkini</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <div x-show="itemType === 'habis_pakai'" class="flex items-center space-x-3">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                        Habis Pakai
                                    </span>
                                    <span class="text-2xl font-bold text-blue-600" x-text="currentStock"></span>
                                    <span class="text-sm text-gray-500">unit tersedia</span>
                                </div>
                                <div x-show="itemType === 'tidak_habis_pakai' || itemType === 'aset_tetap'" class="flex items-center space-x-3">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        Tidak Habis Pakai
                                    </span>
                                    <span class="text-2xl font-bold text-green-600" x-text="currentStock"></span>
                                    <span class="text-sm text-gray-500">unit kondisi baik</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label for="jenis" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                            <svg class="w-5 h-5 text-indigo-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                            </svg>
                            Jenis Transaksi
                        </label>
                        <select name="jenis" id="jenis" 
                                class="block w-full pl-4 pr-10 py-3 text-base border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all duration-200 @error('jenis') border-red-300 @enderror" 
                                required>
                            <option value="">Pilih Jenis Transaksi</option>
                            <option value="penggunaan" {{ old('jenis') == 'penggunaan' ? 'selected' : '' }}>Penggunaan</option>
                            <option value="peminjaman" {{ old('jenis') == 'peminjaman' ? 'selected' : '' }}>Peminjaman</option>
                            <option value="pengembalian" {{ old('jenis') == 'pengembalian' ? 'selected' : '' }}>Pengembalian</option>
                            <option value="mutasi" {{ old('jenis') == 'mutasi' ? 'selected' : '' }}>Mutasi</option>
                        </select>
                        @error('jenis')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="jumlah" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                            <svg class="w-5 h-5 text-orange-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            Jumlah
                        </label>
                        <input type="number" 
                                name="jumlah" 
                                id="jumlah" 
                                class="block w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 sm:text-sm transition-all duration-200 @error('jumlah') border-red-300 @enderror" 
                                value="{{ old('jumlah') }}" 
                                required 
                                min="1"
                                placeholder="Masukkan jumlah">
                        @error('jumlah')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label for="tanggal" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                            <svg class="w-5 h-5 text-cyan-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Tanggal Transaksi
                        </label>
                        <input type="date" 
                                name="tanggal" 
                                id="tanggal" 
                                class="block w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm transition-all duration-200 @error('tanggal') border-red-300 @enderror" 
                                value="{{ old('tanggal', date('Y-m-d')) }}" 
                                required>
                        @error('tanggal')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="user_id" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                            <svg class="w-5 h-5 text-pink-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Pengguna
                        </label>
                        <select name="user_id" 
                                id="user_id" 
                                class="block w-full pl-4 pr-10 py-3 text-base border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 sm:text-sm transition-all duration-200 @error('user_id') border-red-300 @enderror" 
                                required>
                            <option value="">Pilih Pengguna</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="keterangan" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                        <svg class="w-5 h-5 text-teal-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                        </svg>
                        Keterangan (Opsional)
                    </label>
                    <textarea name="keterangan" 
                                id="keterangan" 
                                rows="4" 
                                class="block w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 sm:text-sm transition-all duration-200 @error('keterangan') border-red-300 @enderror" 
                                placeholder="Tambahkan keterangan transaksi jika diperlukan">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-white text-right border-t border-gray-200 rounded-b-2xl">
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('transactions.index') }}" class="inline-flex items-center px-6 py-3 border-2 border-gray-300 shadow-sm text-base font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 transform hover:-translate-y-0.5">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-8 py-3 border border-transparent shadow-sm text-base font-medium rounded-xl text-white bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 transform hover:-translate-y-0.5 hover:shadow-lg">
                        <svg class="-ml-1 mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Simpan Transaksi
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
