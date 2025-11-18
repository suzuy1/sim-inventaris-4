@extends('layouts.app')

@section('content')
    <div class="p-4 sm:p-6 lg:p-8">
        <x-breadcrumb :items="[
            ['url' => route('stok.index'), 'label' => 'Stok Habis Pakai'],
            ['url' => '#', 'label' => 'Edit Stok: ' . ($stok->inventaris->nama_barang ?? 'N/A')]
        ]" />

        <x-card class="mt-6">
            <x-slot name="header">
                <h3 class="text-lg font-semibold text-gray-900">Edit Stok Barang Habis Pakai</h3>
                <p class="mt-1 text-sm text-gray-500">Perbarui detail master barang dan stok masuk.</p>
            </x-slot>

            <form action="{{ route('stok.update', $stok) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    {{-- Bagian Master Barang --}}
                    <div>
                        <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                        <input type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang', $stok->inventaris->nama_barang ?? '') }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('nama_barang')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="kode_inventaris" class="block text-sm font-medium text-gray-700">Kode Inventaris (Master)</label>
                        <input type="text" name="kode_inventaris" id="kode_inventaris" value="{{ old('kode_inventaris', $stok->inventaris->kode_inventaris ?? '') }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('kode_inventaris')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 border-t border-gray-200 pt-6">
                    <h4 class="text-md font-semibold text-gray-900 mb-4">Detail Stok Masuk (Batch)</h4>
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                        {{-- Jumlah Stok --}}
                        <div>
                            <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah Stok Masuk</label>
                            <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', $stok->jumlah_masuk) }}" required min="1"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('jumlah')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Satuan --}}
                        <div>
                            <label for="satuan" class="block text-sm font-medium text-gray-700">Satuan</label>
                            <input type="text" name="satuan" id="satuan" value="{{ old('satuan', $stok->satuan) }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Contoh: Pcs, Box, Botol">
                            @error('satuan')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tanggal Kadaluarsa --}}
                        <div>
                            <label for="tgl_kadaluarsa" class="block text-sm font-medium text-gray-700">Tanggal Kadaluarsa (Opsional)</label>
                            <input type="date" name="tgl_kadaluarsa" id="tgl_kadaluarsa" value="{{ old('tgl_kadaluarsa', $stok->tgl_kadaluarsa) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('tgl_kadaluarsa')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 mt-6">
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
                        <div>
                            <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan (Opsional)</label>
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