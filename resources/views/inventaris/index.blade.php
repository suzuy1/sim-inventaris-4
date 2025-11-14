@extends('dashboard')

@section('content')
    <div class="p-4 sm:p-6 lg:p-8">
        <!-- Header Section yang Diperbaiki -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="mb-4 md:mb-0">
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Manajemen Inventaris</h1>
                    <p class="mt-2 text-sm text-gray-600 max-w-2xl">
                        Kelola dan pantau semua barang inventaris Anda dalam satu tempat. Data dikelompokkan berdasarkan nama barang untuk kemudahan analisis.
                    </p>
                </div>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('inventaris.create') }}"
                       class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-indigo-600 to-purple-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200"
                       aria-label="Tambah inventaris baru">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Tambah Inventaris
                    </a>
                    <button onclick="document.getElementById('importModal').classList.remove('hidden')"
                            class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-green-600 to-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200"
                            aria-label="Buka modal impor data inventaris">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        Impor Data
                    </button>
                    <a href="{{ route('inventaris.export') }}"
                       class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-blue-600 to-cyan-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200"
                       aria-label="Ekspor data inventaris">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                        Ekspor Data
                    </a>
                    <a href="{{ route('inventaris.print_all') }}"
                       target="_blank"
                       class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-gray-600 to-slate-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200"
                       aria-label="Cetak semua data inventaris">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd" />
                        </svg>
                        Cetak Semua
                    </a>
                </div>
            </div>
        </div>

        <!-- Pencarian yang Diperbaiki -->
        <div class="mb-6">
            <form action="{{ route('inventaris.index') }}" method="GET" class="flex gap-2">
                <div class="relative flex-1">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input
                        type="text"
                        name="search"
                        placeholder="Cari nama barang..."
                        class="block w-full rounded-lg border-0 bg-white/50 backdrop-blur-sm pl-10 pr-4 py-3 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all duration-200 sm:text-sm"
                        value="{{ request('search') }}"
                        aria-label="Cari nama barang"
                    >
                </div>
                <button type="submit"
                        class="rounded-lg bg-gradient-to-r from-gray-800 to-slate-800 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200"
                        aria-label="Cari inventaris">
                    Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('inventaris.index') }}"
                       class="rounded-lg bg-gradient-to-r from-gray-200 to-slate-200 px-6 py-3 text-sm font-semibold text-gray-800 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200"
                       aria-label="Reset pencarian inventaris">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <!-- Statistik Ringkas dengan Glassmorphism -->
        <div class="mb-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Total Barang Baik -->
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-green-500 via-green-600 to-emerald-700 p-6 text-white shadow-2xl transform hover:scale-105 transition-transform duration-300">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/10 rounded-full"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-green-100 text-sm font-medium">Total Barang Baik</p>
                            <p class="text-3xl font-bold mt-2">{{ $inventaris->sum('total_baik') }}</p>
                            <p class="text-green-100 text-xs mt-1 opacity-90">Dalam kondisi baik</p>
                        </div>
                        <div class="bg-white/20 p-3 rounded-xl backdrop-blur-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-green-400/30">
                        <div class="flex items-center text-green-100 text-sm">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Siap digunakan</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rusak Ringan -->
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-yellow-500 via-yellow-600 to-amber-700 p-6 text-white shadow-2xl transform hover:scale-105 transition-transform duration-300">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/10 rounded-full"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-yellow-100 text-sm font-medium">Rusak Ringan</p>
                            <p class="text-3xl font-bold mt-2">{{ $inventaris->sum('total_rusak_ringan') }}</p>
                            <p class="text-yellow-100 text-xs mt-1 opacity-90">Perlu perbaikan ringan</p>
                        </div>
                        <div class="bg-white/20 p-3 rounded-xl backdrop-blur-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-yellow-400/30">
                        <div class="flex items-center text-yellow-100 text-sm">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <span>Butuh perhatian</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rusak Berat -->
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-red-500 via-red-600 to-rose-700 p-6 text-white shadow-2xl transform hover:scale-105 transition-transform duration-300">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/10 rounded-full"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-red-100 text-sm font-medium">Rusak Berat</p>
                            <p class="text-3xl font-bold mt-2">{{ $inventaris->sum('total_rusak_berat') }}</p>
                            <p class="text-red-100 text-xs mt-1 opacity-90">Perlu perbaikan serius</p>
                        </div>
                        <div class="bg-white/20 p-3 rounded-xl backdrop-blur-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-red-400/30">
                        <div class="flex items-center text-red-100 text-sm">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <span>Prioritas perbaikan</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jenis Barang -->
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-500 via-blue-600 to-sky-700 p-6 text-white shadow-2xl transform hover:scale-105 transition-transform duration-300">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/10 rounded-full"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-blue-100 text-sm font-medium">Jenis Barang</p>
                            <p class="text-3xl font-bold mt-2">{{ $inventaris->count() }}</p>
                            <p class="text-blue-100 text-xs mt-1 opacity-90">Kategori berbeda</p>
                        </div>
                        <div class="bg-white/20 p-3 rounded-xl backdrop-blur-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-blue-400/30">
                        <div class="flex items-center text-blue-100 text-sm">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 01-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/>
                            </svg>
                            <span>Total kategori</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel dengan Glassmorphism -->
        <div class="overflow-hidden rounded-2xl shadow-2xl border-0 bg-white/50 backdrop-blur-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200/50">
                    <thead class="bg-gray-50/80 backdrop-blur-sm">
                        <tr>
                            <th scope="col" rowspan="2" class="py-4 pl-6 pr-3 text-left text-sm font-semibold text-gray-900">No</th>
                            <th scope="col" rowspan="2" class="px-4 py-4 text-left text-sm font-semibold text-gray-900">Nama Inventaris</th>
                            <th scope="col" colspan="3" class="px-4 py-4 text-center text-sm font-semibold text-gray-900 border-b border-gray-200/50">Kondisi Barang</th>
                            <th scope="col" rowspan="2" class="px-4 py-4 text-left text-sm font-semibold text-gray-900">Keterangan</th>
                            <th scope="col" rowspan="2" class="relative py-4 pl-3 pr-6">
                                <span class="sr-only">Aksi</span>
                            </th>
                        </tr>
                        <tr>
                            <th scope="col" class="px-4 py-3 text-center text-sm font-semibold text-gray-900">
                                <span class="inline-flex items-center">
                                    <span class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2 shadow-sm"></span>
                                    Baik
                                </span>
                            </th>
                            <th scope="col" class="px-4 py-3 text-center text-sm font-semibold text-gray-900">
                                <span class="inline-flex items-center">
                                    <span class="h-2.5 w-2.5 rounded-full bg-yellow-500 mr-2 shadow-sm"></span>
                                    Rusak Ringan
                                </span>
                            </th>
                            <th scope="col" class="px-4 py-3 text-center text-sm font-semibold text-gray-900">
                                <span class="inline-flex items-center">
                                    <span class="h-2.5 w-2.5 rounded-full bg-red-500 mr-2 shadow-sm"></span>
                                    Rusak Berat
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200/30 bg-white/30">
                        @forelse ($inventaris as $item)
                            <tr class="hover:bg-white/50 transition-all duration-200 group">
                                <td class="whitespace-nowrap py-4 pl-6 pr-3 text-sm font-medium text-gray-900 group-hover:text-gray-700">
                                    {{ $loop->iteration + ($inventaris->currentPage() - 1) * $inventaris->perPage() }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-4 text-sm">
                                    <div class="font-semibold text-gray-900 group-hover:text-gray-800">{{ $item->nama_barang }}</div>
                                </td>
                                <td class="whitespace-nowrap px-4 py-4 text-sm text-center">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 shadow-sm border border-green-200">
                                        {{ $item->total_baik }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-4 py-4 text-sm text-center">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800 shadow-sm border border-yellow-200">
                                        {{ $item->total_rusak_ringan }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-4 py-4 text-sm text-center">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800 shadow-sm border border-red-200">
                                        {{ $item->total_rusak_berat }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-600 max-w-xs truncate group-hover:text-gray-500">
                                    {{ $item->keterangan ?: '-' }}
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-6 text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-x-4">
                                        <a href="{{ route('inventaris.show_grouped', $item) }}"
                                           class="inline-flex items-center text-indigo-600 hover:text-indigo-800 group-hover:scale-105 transition-all duration-200 font-semibold"
                                           aria-label="Lihat detail {{ $item->nama_barang }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                            </svg>
                                            Lihat Detail
                                        </a>
                                        <!-- PERUBAHAN: onsubmit dipanggil dengan parameter yang lebih lengkap dan ditambahkan data-id -->
                                        <form action="{{ route('inventaris.destroy', $item->id) }}" method="POST"
                                              onsubmit="return confirmDelete('{{ $item->nama_barang }}', {{ $item->id }});"
                                              class="delete-form" data-id="{{ $item->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center text-red-600 hover:text-red-800 group-hover:scale-105 transition-all duration-200 font-semibold"
                                                    aria-label="Hapus {{ $item->nama_barang }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 011-1h4a1 1 0 110 2H8a1 1 0 01-1-1zm-1 3a1 1 0 100 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                                </svg>
                                                <span>Hapus</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="whitespace-nowrap px-4 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-500">
                                        <div class="bg-gradient-to-br from-gray-200 to-gray-300 p-4 rounded-2xl mb-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m8-8V4a1 1 0 00-1-1h-2a1 1 0 00-1 1v1M9 7h6" />
                                            </svg>
                                        </div>
                                        <p class="text-lg font-semibold text-gray-900 mb-1">Tidak ada data inventaris</p>
                                        <p class="text-gray-500 mb-4">Mulai dengan menambahkan inventaris baru</p>
                                        <a href="{{ route('inventaris.create') }}"
                                           class="inline-flex items-center rounded-lg bg-gradient-to-r from-indigo-600 to-purple-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200"
                                           aria-label="Tambah inventaris pertama">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                            </svg>
                                            Tambah Inventaris Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination yang Diperbaiki -->
        @if($inventaris->hasPages())
            <div class="mt-8 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="text-sm text-gray-600 bg-white/50 backdrop-blur-sm rounded-lg px-4 py-2 shadow-sm">
                    Menampilkan 
                    <span class="font-semibold text-gray-900">{{ $inventaris->firstItem() }}</span>
                    sampai
                    <span class="font-semibold text-gray-900">{{ $inventaris->lastItem() }}</span>
                    dari
                    <span class="font-semibold text-gray-900">{{ $inventaris->total() }}</span>
                    hasil
                </div>
                <div class="flex justify-end">
                    {{ $inventaris->links() }}
                </div>
            </div>
        @endif
    </div>

    <!-- Modal Impor yang Diperbaiki -->
    <div id="importModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-gray-500/75 backdrop-blur-sm transition-opacity" onclick="document.getElementById('importModal').classList.add('hidden')"></div>
            
            <!-- Modal Panel -->
            <div class="relative transform overflow-hidden rounded-2xl bg-white px-4 pb-4 pt-5 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                        <h3 class="text-lg font-semibold leading-6 text-gray-900">Impor Data Inventaris</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Unggah file Excel (.xlsx, .xls) yang berisi data inventaris. Pastikan format file sesuai dengan template yang tersedia.
                            </p>
                        </div>
                    </div>
                </div>
                <form action="{{ route('inventaris.import') }}" method="POST" enctype="multipart/form-data" class="mt-5 sm:mt-6">
                    @csrf
                    <div class="mb-4">
                        <label for="file" class="block text-sm font-medium text-gray-700 mb-2">Pilih File</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="file" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-2xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors duration-200" tabindex="0">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span></p>
                                    <p class="text-xs text-gray-500">XLSX, XLS (MAX. 10MB)</p>
                                </div>
                                <input id="file" name="file" type="file" class="hidden" accept=".xlsx,.xls" required aria-label="Pilih file untuk diimpor" />
                            </label>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                        <button
                            type="submit"
                            class="inline-flex w-full justify-center rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 px-3 py-2.5 text-sm font-semibold text-white shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2"
                            aria-label="Impor data inventaris"
                        >
                            Impor Data
                        </button>
                        <button
                            type="button"
                            onclick="document.getElementById('importModal').classList.add('hidden')"
                            class="mt-3 inline-flex w-full justify-center rounded-xl bg-gradient-to-r from-gray-200 to-slate-200 px-3 py-2.5 text-sm font-semibold text-gray-900 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 sm:col-start-1 sm:mt-0"
                            aria-label="Tutup modal impor data"
                        >
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- PERUBAHAN: Script yang lebih sederhana dan andal -->
    <script>
        // Script untuk upload file (tidak berubah)
        document.getElementById('file').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name;
            if (fileName) {
                const label = document.querySelector('label[for="file"]');
                label.innerHTML = `
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <p class="text-sm font-medium text-gray-900">${fileName}</p>
                        <p class="text-xs text-gray-500 mt-1">File siap diupload</p>
                    </div>
                `;
            }
        });

        // FUNGSI DELETE YANG DIPERBAIKI
        // Fungsi ini meminta konfirmasi dan menambahkan logging untuk debugging
        function confirmDelete(itemName, itemId) {
            console.log('Attempting to delete item:', { itemName, itemId });
            
            if (confirm(`Apakah Anda yakin ingin menghapus master barang "${itemName}" beserta semua unit asetnya? Tindakan ini tidak dapat dibatalkan.`)) {
                console.log('User confirmed deletion for item ID:', itemId);
                return true;
            } else {
                console.log('User cancelled deletion for item ID:', itemId);
                return false;
            }
        }

        // Event listener untuk logging form submission
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-form').forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    const id = this.getAttribute('data-id');
                    const action = this.getAttribute('action');
                    console.log('Form submission detected:', {
                        id,
                        action,
                        method: this.querySelector('input[name="_method"]').value
                    });
                });
            });
        });
    </script>
    <!-- AKHIR PERUBAHAN -->
@endsection