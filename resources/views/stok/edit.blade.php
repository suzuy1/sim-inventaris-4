@extends('dashboard')

@section('content')
    <div class="p-4 sm:p-6 lg:p-8">
        <x-breadcrumb :items="[
            ['url' => route('stok.index'), 'label' => 'Stok Habis Pakai'],
            ['url' => '#', 'label' => 'Edit Stok: ' . ($inventaris->nama_barang ?? 'N/A')]
        ]" />

        <x-card class="mt-6">
            <x-slot name="header">
                <h3 class="text-lg font-semibold text-gray-900">Edit Stok Barang Habis Pakai</h3>
                <p class="mt-1 text-sm text-gray-500">Perbarui detail master barang atau catat transaksi stok baru (masuk/keluar).</p>
            </x-slot>

            <form action="{{ route('stok.update', $inventaris) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Bagian 1: Master Barang --}}
                <div class="mb-8 p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <h4 class="text-md font-bold text-gray-800 mb-4 border-b pb-2">Master Data Barang</h4>
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                        
                        {{-- Nama Barang --}}
                        <div>
                            <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                            <input type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang', $inventaris->nama_barang ?? '') }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('nama_barang')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Kode Inventaris (Master) --}}
                        <div>
                            <label for="kode_inventaris" class="block text-sm font-medium text-gray-700">Kode Inventaris (Master)</label>
                            <input type="text" name="kode_inventaris" id="kode_inventaris" value="{{ old('kode_inventaris', $inventaris->kode_inventaris ?? '') }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" disabled>
                            {{-- Saya tambahkan 'disabled' karena kode master biasanya tidak boleh diedit --}}
                            @error('kode_inventaris')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Satuan (Dipindahkan ke Master Data karena lebih logis) --}}
                        <div>
                            <label for="satuan" class="block text-sm font-medium text-gray-700">Satuan</label>
                            <input type="text" name="satuan" id="satuan" value="{{ old('satuan', $stok->satuan ?? '') }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Contoh: Pcs, Box, Botol">
                            @error('satuan')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Bagian 2: Transaksi Stok Baru (Hanya Input Masuk atau Keluar) --}}
                <div class="mt-6 border-t border-gray-200 pt-6">
                    <h4 class="text-md font-bold text-gray-800 mb-4">Catat Transaksi Stok Baru (Opsional)</h4>
                    <p class="text-sm text-gray-600 mb-4">Masukkan nilai hanya pada field **Jumlah Masuk** atau **Jumlah Keluar** untuk mencatat transaksi stok baru. Kosongkan (atau biarkan 0) jika hanya ingin mengedit detail master barang di atas.</p>
                    
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        {{-- Jumlah Stok MASUK --}}
                        <div>
                            <label for="jumlah_masuk" class="block text-sm font-medium text-gray-700">Jumlah Masuk (Input Baru)</label>
                            {{-- Field diganti menjadi 'jumlah_masuk' dan default 0 --}}
                            <input type="number" name="jumlah_masuk" id="jumlah_masuk" value="{{ old('jumlah_masuk', 0) }}" min="0"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('jumlah_masuk')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Jumlah Stok KELUAR --}}
                        <div>
                            <label for="jumlah_keluar" class="block text-sm font-medium text-gray-700">Jumlah Keluar (Input Baru)</label>
                            {{-- Field baru 'jumlah_keluar' --}}
                            <input type="number" name="jumlah_keluar" id="jumlah_keluar" value="{{ old('jumlah_keluar', 0) }}" min="0"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('jumlah_keluar')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-3 mt-6">
                        {{-- Tanggal Kadaluarsa --}}
                        <div>
                            <label for="tgl_kadaluarsa" class="block text-sm font-medium text-gray-700">Tanggal Kadaluarsa (Opsional)</label>
                            <input type="date" name="tgl_kadaluarsa" id="tgl_kadaluarsa" value="{{ old('tgl_kadaluarsa', $stok->tgl_kadaluarsa) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('tgl_kadaluarsa')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tanggal Pengecekan --}}
                        <div>
                            <label for="tgl_pengecekan" class="block text-sm font-medium text-gray-700">Tanggal Pengecekan (Opsional)</label>
                            <input type="date" name="tgl_pengecekan" id="tgl_pengecekan" value="{{ old('tgl_pengecekan', $stok->tgl_pengecekan) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('tgl_pengecekan')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        {{-- Keterangan --}}
                        <div class="col-span-1 md:col-span-1">
                            <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan Transaksi (Opsional)</label>
                            <textarea name="keterangan" id="keterangan" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('keterangan', $stok->keterangan) }}</textarea>
                            @error('keterangan')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <a href="{{ route('stok.index') }}" class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 mr-3">Batal</a>
                    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Perbarui Stok
                    </button>
                </div>
            </form>
        </x-card>
    </div>
@endsection