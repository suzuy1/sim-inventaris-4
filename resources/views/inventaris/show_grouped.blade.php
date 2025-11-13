@extends('dashboard')

@section('content')
<div class="p-4 sm:p-6 lg:p-8">
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="mb-4 md:mb-0">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">
                    Detail Unit Aset: {{ $inventaris->nama_barang }}
                </h1>
                <p class="mt-2 text-sm text-gray-600 max-w-2xl">
                    Berikut adalah daftar semua unit aset untuk {{ $inventaris->nama_barang }}.
                </p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('inventaris.detail.create', $inventaris) }}" class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-indigo-600 to-purple-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Tambah Unit Aset
                </a>
                <a href="{{ route('inventaris.index') }}" class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-gray-200 to-slate-200 px-4 py-2.5 text-sm font-semibold text-gray-800 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Kembali ke Index
                </a>
            </div>
        </div>
    </div>

    <div class="overflow-hidden rounded-2xl shadow-2xl border-0 bg-white/50 backdrop-blur-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200/50">
                <thead class="bg-gray-50/80 backdrop-blur-sm">
                    <tr>
                        <th scope="col" class="py-4 pl-6 pr-3 text-left text-sm font-semibold text-gray-900">No</th>
                        <th scope="col" class="px-4 py-4 text-left text-sm font-semibold text-gray-900">Kode Unit</th>
                        <th scope="col" class="px-4 py-4 text-left text-sm font-semibold text-gray-900">Kondisi</th>
                        <th scope="col" class="px-4 py-4 text-left text-sm font-semibold text-gray-900">Lokasi/Ruangan</th>
                        <th scope="col" class="px-4 py-4 text-left text-sm font-semibold text-gray-900">P. Jawab</th>
                        <th scope="col" class="px-4 py-4 text-left text-sm font-semibold text-gray-900">Tgl Beli</th>
                        <th scope="col" class="px-4 py-4 text-left text-sm font-semibold text-gray-900">Harga Beli</th>
                        <th scope="col" class="relative py-4 pl-3 pr-6">
                            <span class="sr-only">Aksi</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200/30 bg-white/30">
                    @forelse ($inventarisDetails as $detail)
                        <tr class="hover:bg-white/50 transition-all duration-200 group">
                            <td class="whitespace-nowrap py-4 pl-6 pr-3 text-sm font-medium text-gray-900">
                                {{ $loop->iteration + ($inventarisDetails->currentPage() - 1) * $inventarisDetails->perPage() }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-4 text-sm font-semibold text-gray-900">
                                {{ $detail->kode_inv }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-4 text-sm">
                                @if($detail->kondisi == 'Baik')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                        <span class="h-2 w-2 rounded-full bg-green-500 mr-2"></span>
                                        Baik
                                    </span>
                                @elseif($detail->kondisi == 'Rusak Ringan')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                        <span class="h-2 w-2 rounded-full bg-yellow-500 mr-2"></span>
                                        Rusak Ringan
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                        <span class="h-2 w-2 rounded-full bg-red-500 mr-2"></span>
                                        Rusak Berat
                                    </span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-600">
                                {{ $detail->room->nama_ruangan ?? '-' }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-600">
                                {{ $detail->penanggungJawab->name ?? '-' }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-600">
                                {{ $detail->tgl_pembelian ? \Carbon\Carbon::parse($detail->tgl_pembelian)->format('d-m-Y') : '-' }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-600">
                                {{ $detail->harga_beli ? 'Rp ' . number_format($detail->harga_beli, 0, ',', '.') : '-' }}
                            </td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-6 text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-4">
                                    <a href="{{ route('aset-detail.edit', $detail) }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-semibold">
                                        Edit
                                    </a>

                                    <form action="{{ route('aset-detail.destroy', $detail) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus unit {{ $detail->kode_inv }} ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center text-red-600 hover:text-red-800 font-semibold">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="whitespace-nowrap px-4 py-12 text-center">
                                <div class="text-gray-500">
                                    <p class="text-lg font-semibold text-gray-900 mb-1">Belum ada unit aset</p>
                                    <p class="text-gray-500 mb-4">Mulai dengan menambahkan unit aset pertama untuk {{ $inventaris->nama_barang }}.</p>
                                    <a href="{{ route('inventaris.detail.create', $inventaris) }}" class="inline-flex items-center rounded-lg bg-gradient-to-r from-indigo-600 to-purple-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                        </svg>
                                        Tambah Unit Aset Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($inventarisDetails->hasPages())
        <div class="mt-8">
            {{ $inventarisDetails->links() }}
        </div>
    @endif
</div>
@endsection
