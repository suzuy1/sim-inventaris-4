@extends('dashboard')

@section('content')
    <div class="p-4 sm:p-6 lg:p-8">
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Edit Master Inventaris</h1>
                    <p class="mt-2 text-sm text-gray-600">Perbarui informasi dasar untuk master barang {{ $inventaris->nama_barang }}.</p>
                </div>
                <a href="{{ route('inventaris.index', ['kategori' => $inventaris->kategori]) }}"
                   class="inline-flex items-center gap-2 text-sm font-semibold text-indigo-600 hover:text-indigo-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Kembali ke Daftar Inventaris
                </a>
            </div>
        </div>

        <div class="max-w-4xl mx-auto bg-white/50 backdrop-blur-sm rounded-2xl shadow-2xl p-6 lg:p-8">
            <form action="{{ route('inventaris.update', $inventaris->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
                    <div>
                        <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                        <div class="mt-1">
                            <input type="text" name="nama_barang" id="nama_barang"
                                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                   value="{{ old('nama_barang', $inventaris->nama_barang) }}" required>
                        </div>
                        @error('nama_barang')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
                        <div class="mt-1">
                            <select id="kategori" name="kategori"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                @php
                                    $kategoriList = [
                                        'Elektronik', 'Furniture', 'Kendaraan', 'Alat Tulis Kantor',
                                        'Peralatan Listrik', 'Peralatan Kebersihan', 'Peralatan Dapur',
                                        'Peralatan Medis', 'Peralatan Teknologi',
                                        'Barang Habis Pakai Medis', 'Barang Habis Pakai Kebersihan',
                                        'Barang Habis Pakai ATK', 'Obat',
                                    ];
                                @endphp
                                @foreach($kategoriList as $kategoriOption)
                                    <option value="{{ $kategoriOption }}"
                                            {{ old('kategori', $inventaris->kategori) == $kategoriOption ? 'selected' : '' }}>
                                        {{ $kategoriOption }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('kategori')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="sumber_dana_id" class="block text-sm font-medium text-gray-700">Sumber Dana</label>
                        <div class="mt-1">
                            <select id="sumber_dana_id" name="sumber_dana_id"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="">Pilih Sumber Dana</option>
                                @foreach($sumberDanas as $sumberDana)
                                    <option value="{{ $sumberDana->id }}"
                                            {{ old('sumber_dana_id', $inventaris->sumber_dana_id) == $sumberDana->id ? 'selected' : '' }}>
                                        {{ $sumberDana->nama_sumber_dana }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('sumber_dana_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                        <div class="mt-1">
                            <textarea id="keterangan" name="keterangan" rows="3"
                                      class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('keterangan', $inventaris->keterangan) }}</textarea>
                        </div>
                        @error('keterangan')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <button type="submit"
                            class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
