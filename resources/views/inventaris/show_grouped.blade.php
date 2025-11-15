@extends('dashboard')

@section('content')
<div class="p-4 sm:p-6 lg:p-8">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="mb-4 md:mb-0">
                <div class="flex items-center gap-3 mb-3">
                    <div class="p-2 bg-indigo-100 rounded-lg">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900">
                            Detail Unit Aset
                        </h1>
                        <p class="text-lg text-indigo-600 font-semibold">
                            {{ $inventaris->nama_barang }} • {{ $inventaris->kategori }}
                        </p>
                    </div>
                </div>
                <p class="mt-2 text-sm text-gray-600 max-w-2xl">
                    Daftar lengkap semua unit aset untuk {{ $inventaris->nama_barang }} dalam kategori {{ $inventaris->kategori }}.
                </p>
                <div class="mt-3">
                    <a href="{{ route('inventaris.pilih_jenis') }}" 
                       class="inline-flex items-center gap-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke Pilih Jenis Inventaris
                    </a>
                </div>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('inventaris.detail.create', $inventaris) }}" 
                   class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 px-5 py-3 text-sm font-semibold text-white shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 hover:from-indigo-700 hover:to-purple-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Unit Aset
                </a>
                <a href="{{ route('inventaris.index', ['kategori' => $inventaris->kategori]) }}" 
                   class="inline-flex items-center gap-2 rounded-xl border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 hover:bg-gray-50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Index
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Section - Improved -->
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
            Statistik Ringkas
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Units -->
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-50 to-indigo-100 p-6 shadow-lg border border-blue-100 transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-blue-600 mb-1">Total Unit</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $summaryStatistics->total_units }}</p>
                        <p class="text-xs text-blue-500 mt-1">Semua unit</p>
                    </div>
                    <div class="bg-blue-500/10 p-3 rounded-xl">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Kondisi Baik -->
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-green-50 to-emerald-100 p-6 shadow-lg border border-green-100 transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-green-600 mb-1">Kondisi Baik</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $summaryStatistics->total_baik }}</p>
                        <p class="text-xs text-green-500 mt-1">Siap digunakan</p>
                    </div>
                    <div class="bg-green-500/10 p-3 rounded-xl">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Rusak Ringan -->
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-yellow-50 to-amber-100 p-6 shadow-lg border border-yellow-100 transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-yellow-600 mb-1">Rusak Ringan</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $summaryStatistics->total_rusak_ringan }}</p>
                        <p class="text-xs text-yellow-500 mt-1">Perlu perbaikan</p>
                    </div>
                    <div class="bg-yellow-500/10 p-3 rounded-xl">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Rusak Berat -->
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-red-50 to-rose-100 p-6 shadow-lg border border-red-100 transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-red-600 mb-1">Rusak Berat</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $summaryStatistics->total_rusak_berat }}</p>
                        <p class="text-xs text-red-500 mt-1">Prioritas perbaikan</p>
                    </div>
                    <div class="bg-red-500/10 p-3 rounded-xl">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">
                    Daftar Unit Aset
                    <span class="text-sm text-gray-500 font-normal ml-2">({{ $inventarisDetails->total() }} item)</span>
                </h3>
                @if($inventarisDetails->isNotEmpty())
                <div class="text-sm text-gray-500">
                    Halaman {{ $inventarisDetails->currentPage() }} dari {{ $inventarisDetails->lastPage() }}
                </div>
                @endif
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="py-4 pl-6 pr-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">No</th>
                        <th scope="col" class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Kode Unit</th>
                        <th scope="col" class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tipe Barang</th>
                        <th scope="col" class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Kondisi</th>
                        <th scope="col" class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Lokasi/Ruangan</th>
                        <th scope="col" class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">P. Jawab</th>
                        <th scope="col" class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Sumber Dana</th>
                        <th scope="col" class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tgl Beli</th>
                        <th scope="col" class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Harga Beli</th>
                        <th scope="col" class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Keterangan</th>
                        <th scope="col" class="relative py-4 pl-3 pr-6">
                            <span class="sr-only">Aksi</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($inventarisDetails as $detail)
                        <tr class="hover:bg-gray-50 transition-colors duration-150 group">
                            <td class="whitespace-nowrap py-4 pl-6 pr-3 text-sm font-medium text-gray-900">
                                {{ $loop->iteration + ($inventarisDetails->currentPage() - 1) * $inventarisDetails->perPage() }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-4 text-sm font-semibold text-gray-900 font-mono">
                                {{ $detail->kode_inv }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-600">
                                {{ $detail->tipe_barang ?? '-' }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-4 text-sm">
                                @if($detail->kondisi == 'Baik')
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-green-100 text-green-800 border border-green-200">
                                        <span class="h-2 w-2 rounded-full bg-green-500 mr-2"></span>
                                        Baik
                                    </span>
                                @elseif($detail->kondisi == 'Rusak Ringan')
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800 border border-yellow-200">
                                        <span class="h-2 w-2 rounded-full bg-yellow-500 mr-2"></span>
                                        Rusak Ringan
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-red-100 text-red-800 border border-red-200">
                                        <span class="h-2 w-2 rounded-full bg-red-500 mr-2"></span>
                                        Rusak Berat
                                    </span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-600">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ $detail->room->nama_ruangan ?? '-' }}
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-600">
                                {{ $detail->penanggungJawab->name ?? '-' }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-600">
                                {{ $detail->sumberDana->nama_sumber_dana ?? '-' }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-600">
                                {{ $detail->tgl_pembelian ? \Carbon\Carbon::parse($detail->tgl_pembelian)->format('d/m/Y') : '-' }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                {{ $detail->harga_beli ? 'Rp ' . number_format($detail->harga_beli, 0, ',', '.') : '-' }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-600">
                                {{ $detail->keterangan ?? '-' }}
                            </td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-6 text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                    <a href="{{ route('aset-detail.edit', $detail) }}" 
                                       class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-semibold transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </a>

                                    <form action="{{ route('aset-detail.destroy', $detail) }}" method="POST" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus unit {{ $detail->kode_inv }} ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center text-red-600 hover:text-red-800 font-semibold transition-colors duration-200">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="px-6 py-12 text-center">
                                <div class="text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                    <h3 class="mt-4 text-lg font-semibold text-gray-900">Belum ada unit aset</h3>
                                    <p class="mt-2 text-gray-500 max-w-sm mx-auto">
                                        Mulai dengan menambahkan unit aset pertama untuk {{ $inventaris->nama_barang }}.
                                    </p>
                                    <div class="mt-6">
                                        <a href="{{ route('inventaris.detail.create', $inventaris) }}" 
                                           class="inline-flex items-center rounded-lg bg-gradient-to-r from-indigo-600 to-purple-600 px-5 py-3 text-sm font-semibold text-white shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                            </svg>
                                            Tambah Unit Aset Pertama
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($inventarisDetails->hasPages())
        <div class="mt-8">
            {{ $inventarisDetails->links() }}
        </div>
    @endif
</div>
@endsection
