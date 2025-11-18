@extends('layouts.app')

@section('content')
    <div class="p-4 sm:p-6 lg:p-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="mb-4 md:mb-0">
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Manajemen Stok Barang Habis Pakai</h1>
                    <p class="mt-2 text-sm text-gray-600 max-w-2xl">
                        Kelola detail stok masuk untuk barang habis pakai (Medis, Kebersihan, ATK, Obat).
                    </p>
                </div>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('stok.create', ['kategori' => $kategori]) }}" class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Tambah Stok Baru
                    </a>
                    {{-- Tombol Impor/Ekspor/Cetak bisa ditambahkan di sini jika diperlukan --}}
                </div>
            </div>
        </div>

        <!-- Filter dan Pencarian -->
        <div class="mb-6 flex flex-col md:flex-row gap-4">
            <!-- Filter Kategori -->
            <form action="{{ route('stok.index') }}" method="GET" class="flex-shrink-0">
                <label for="kategori" class="sr-only">Filter Kategori</label>
                <select
                    name="kategori"
                    id="kategori"
                    onchange="this.form.submit()"
                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-colors duration-200"
                >
                    <option value="">Semua Kategori BHP</option>
                    @foreach ($bhpCategories as $cat)
                        <option value="{{ $cat }}" {{ $kategori == $cat ? 'selected' : '' }}>
                            {{ $cat }}
                        </option>
                    @endforeach
                </select>
                @if(request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif
            </form>

            <!-- Pencarian -->
            <form action="{{ route('stok.index') }}" method="GET" class="flex flex-1 gap-2">
                <div class="relative flex-1">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input
                        type="text"
                        name="search"
                        placeholder="Cari nama barang atau kode inventaris..."
                        class="block w-full rounded-lg border-gray-300 pl-10 pr-4 py-2.5 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-colors duration-200"
                        value="{{ request('search') }}"
                    >
                </div>
                <button type="submit" class="rounded-lg bg-gray-800 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-gray-700 transition-colors duration-200">
                    Cari
                </button>
                @if(request('search') || request('kategori'))
                    <a href="{{ route('stok.index') }}" class="rounded-lg bg-gray-200 px-4 py-2.5 text-sm font-semibold text-gray-800 shadow-sm hover:bg-gray-300 transition-colors duration-200">
                        Reset
                    </a>
                @endif
                @if(request('kategori'))
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                @endif
            </form>
        </div>

        <!-- Tabel Ringkasan Stok Habis Pakai -->
        <div class="overflow-hidden rounded-xl shadow border border-gray-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">No</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Nama Barang</th>
                            <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Stok Saat Ini</th>
                            <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Satuan</th>
                            <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Tgl Kadaluarsa</th>
                            <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Tgl Pengecekan</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Keterangan</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                <span class="sr-only">Aksi</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse ($stokBarang as $item)
                            @php
                                // Ambil detail dari transaksi stok terakhir (relasi stokHabisPakai dibatasi 1)
                                $lastStok = $item->stokHabisPakai->first();
                            @endphp
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $loop->iteration + ($stokBarang->currentPage() - 1) * $stokBarang->perPage() }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                    <div class="font-semibold text-gray-900">{{ $item->nama_barang }}</div>
                                    <div class="text-xs text-gray-500">{{ $item->kategori }}</div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-center font-medium {{ $item->stok_saat_ini > 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $item->stok_saat_ini ?? 0 }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-gray-500">
                                    {{ $lastStok->satuan ?? '-' }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-gray-500">
                                    {{ $lastStok && $lastStok->tgl_kadaluarsa ? \Carbon\Carbon::parse($lastStok->tgl_kadaluarsa)->format('d/m/Y') : '-' }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-gray-500">
                                    {{ $lastStok && $lastStok->tgl_pengecekan ? \Carbon\Carbon::parse($lastStok->tgl_pengecekan)->format('d/m/Y') : '-' }}
                                </td>
                                <td class="px-3 py-4 text-sm text-gray-500 max-w-xs truncate">{{ $lastStok->keterangan ?? '-' }}</td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    {{-- Karena ini adalah ringkasan stok, tombol edit/hapus harus mengarah ke master item atau ke halaman detail transaksi --}}
                                    {{-- Untuk saat ini, kita arahkan ke edit stok (yang perlu diubah logikanya nanti) --}}
                                    <a href="{{ route('stok.edit', $item->id) }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-900 transition-colors duration-200 mr-3">
                                        Edit
                                    </a>
                                    {{-- Hapus master item inventaris --}}
                                    <form action="{{ route('stok.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus master barang ini beserta semua riwayat stoknya? Tindakan ini tidak dapat dibatalkan.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 transition-colors duration-200">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="whitespace-nowrap px-3 py-8 text-sm text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m8-8V4a1 1 0 00-1-1h-2a1 1 0 00-1 1v1M9 7h6" />
                                        </svg>
                                        <p class="text-lg font-medium text-gray-900">Tidak ada data stok barang habis pakai</p>
                                        <p class="text-gray-500 mt-1">Mulai dengan menambahkan stok baru</p>
                                        <a href="{{ route('stok.create', ['kategori' => $kategori]) }}" class="mt-4 inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
                                            Tambah Stok Baru
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($stokBarang->hasPages())
            <div class="mt-6 flex items-center justify-between">
                <div class="text-sm text-gray-700">
                    Menampilkan
                    <span class="font-medium">{{ $stokBarang->firstItem() }}</span>
                    sampai
                    <span class="font-medium">{{ $stokBarang->lastItem() }}</span>
                    dari
                    <span class="font-medium">{{ $stokBarang->total() }}</span>
                    hasil
                </div>
                <div class="flex justify-end">
                    {{ $stokBarang->links() }}
                </div>
            </div>
        @endif
    </div>
@endsection