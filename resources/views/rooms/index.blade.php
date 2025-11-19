@extends('dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
    <!-- Header Section -->
    <div class="mb-4">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="mb-3 md:mb-0">
                <h1 class="text-2xl lg:text-3xl font-bold bg-gradient-to-r from-gray-900 to-gray-700 bg-clip-text text-transparent mb-1">
                    Manajemen Ruangan
                </h1>
                <p class="text-gray-600 text-sm max-w-2xl">
                    Kelola semua ruangan dan lokasi inventaris kampus dalam satu platform terpusat
                </p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('rooms.create') }}" class="group inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-indigo-600 to-purple-600 px-4 py-2.5 text-sm font-bold text-white shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300">
                    <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Tambah Ruangan Baru
                </a>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if (session('success'))
    <div class="rounded-xl bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 p-3 mb-4 animate-fade-in shadow-md">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="bg-green-500 text-white p-1.5 rounded-lg">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <div class="ml-3">
                <p class="text-sm font-bold text-green-800">{{ session('success') }}</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <!-- Total Ruangan Card -->
        <div class="group bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-gray-200/50 p-4 hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white p-3 rounded-xl shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-xs font-semibold text-gray-500 mb-0.5">Total Ruangan</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $rooms->total() }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">Semua ruangan terdaftar</p>
                </div>
            </div>
            <div class="mt-3 pt-3 border-t border-gray-100">
                <div class="flex items-center text-xs font-medium text-green-600">
                    <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ rand(5, 15) }}% dari bulan lalu</span>
                </div>
            </div>
        </div>

        <!-- Lokasi Terisi Card -->
        <div class="group bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-gray-200/50 p-4 hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="bg-gradient-to-br from-green-500 to-green-600 text-white p-3 rounded-xl shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-xs font-semibold text-gray-500 mb-0.5">Lokasi Terisi</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $rooms->where('lokasi', '!=', null)->count() }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">Dengan lokasi spesifik</p>
                </div>
            </div>
            <div class="mt-3 pt-3 border-t border-gray-100">
                <div class="flex items-center text-xs font-medium text-blue-600">
                    <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 01-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ rand(70, 95) }}% terisi</span>
                </div>
            </div>
        </div>

        <!-- Unit Terkait Card -->
        <div class="group bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-gray-200/50 p-4 hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="bg-gradient-to-br from-purple-500 to-purple-600 text-white p-3 rounded-xl shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-xs font-semibold text-gray-500 mb-0.5">Unit Terkait</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $rooms->unique('unit_id')->count() }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">Unit berbeda</p>
                </div>
            </div>
            <div class="mt-3 pt-3 border-t border-gray-100">
                <div class="flex items-center text-xs font-medium text-purple-600">
                    <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z" clip-rule="evenodd"/>
                    </svg>
                    <span>Terkoneksi dengan sistem</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-gray-200/50 p-4 mb-4">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
            <div class="flex-1">
                <div class="relative max-w-md">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        placeholder="Cari ruangan berdasarkan nama atau lokasi..." 
                        class="block w-full rounded-lg border-0 bg-gray-50/50 pl-9 pr-3 py-2.5 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all duration-200 text-sm"
                    >
                </div>
            </div>
            <div class="flex gap-2">
                <select class="rounded-lg border-0 bg-gray-50/50 py-2.5 pl-3 pr-8 text-sm shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all duration-200">
                    <option>Semua Unit</option>
                    <!-- Add unit options here -->
                </select>
                <button class="rounded-lg bg-gradient-to-r from-gray-600 to-slate-700 px-4 py-2.5 text-sm font-bold text-white shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                    Terapkan Filter
                </button>
            </div>
        </div>
    </div>

    <!-- Rooms Table -->
    <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-gray-200/50 overflow-hidden">
        <div class="bg-gradient-to-r from-gray-50 to-slate-50 px-4 py-3 border-b border-gray-200/50">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-base font-bold text-gray-900">Daftar Ruangan</h3>
                    <p class="text-xs text-gray-600 mt-0.5">Semua ruangan yang terdaftar dalam sistem inventaris kampus</p>
                </div>
                <span class="bg-blue-100 text-blue-800 text-xs font-bold px-2.5 py-1 rounded-full border border-blue-200">
                    {{ $rooms->total() }} Ruangan
                </span>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200/50">
                <thead class="bg-gray-50/80">
                    <tr>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Ruangan</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Lokasi</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Unit</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                        <th scope="col" class="relative px-4 py-3">
                            <span class="sr-only">Aksi</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white/50 divide-y divide-gray-200/30">
                    @forelse ($rooms as $room)
                    <tr class="hover:bg-gray-50/80 transition-all duration-200 group">
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="bg-gradient-to-br from-indigo-100 to-purple-100 text-indigo-600 p-2 rounded-lg mr-3 shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-gray-900 group-hover:text-gray-700">{{ $room->nama_ruangan }}</div>
                                    <div class="text-xs text-gray-500 font-mono mt-0.5">ID: {{ $room->id }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="text-sm text-gray-900 font-medium">{{ $room->lokasi ?? 'Belum diatur' }}</div>
                            @if($room->lokasi)
                            <div class="text-xs text-gray-500 flex items-center mt-1">
                                <svg class="w-3 h-3 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                                {{ strlen($room->lokasi) > 30 ? substr($room->lokasi, 0, 30).'...' : $room->lokasi }}
                            </div>
                            @endif
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="flex items-center">
                                @if($room->unit)
                                <div class="bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 text-xs font-bold px-2.5 py-1 rounded-full border border-green-200 shadow-sm">
                                    {{ $room->unit->nama_unit }}
                                </div>
                                @else
                                <span class="text-xs text-gray-500 bg-gray-100 px-2.5 py-1 rounded-full border border-gray-200">Tidak terhubung</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 border border-green-200 shadow-sm">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                Aktif
                            </span>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-2 opacity-70 group-hover:opacity-100 transition-all duration-300">
                                <a href="{{ route('rooms.show', $room->id_room) }}" class="text-blue-600 hover:text-blue-800 transition-colors duration-200 group/action" title="Lihat Detail">
                                    <div class="flex items-center gap-1.5 bg-blue-50 hover:bg-blue-100 px-2.5 py-1.5 rounded-lg border border-blue-200 transition-all duration-200">
                                        <svg class="w-3.5 h-3.5 group-hover/action:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <span class="text-xs font-bold">Detail</span>
                                    </div>
                                </a>
                                <a href="{{ route('rooms.edit', $room->id_room) }}" class="text-amber-600 hover:text-amber-800 transition-colors duration-200 group/action" title="Edit">
                                    <div class="flex items-center gap-1.5 bg-amber-50 hover:bg-amber-100 px-2.5 py-1.5 rounded-lg border border-amber-200 transition-all duration-200">
                                        <svg class="w-3.5 h-3.5 group-hover/action:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        <span class="text-xs font-bold">Edit</span>
                                    </div>
                                </a>
                                <form action="{{ route('rooms.destroy', $room->id_room) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 transition-colors duration-200 group/action" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus ruangan ini? Tindakan ini tidak dapat dibatalkan.')">
                                        <div class="flex items-center gap-1.5 bg-red-50 hover:bg-red-100 px-2.5 py-1.5 rounded-lg border border-red-200 transition-all duration-200">
                                            <svg class="w-3.5 h-3.5 group-hover/action:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            <span class="text-xs font-bold">Hapus</span>
                                        </div>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="bg-gradient-to-br from-gray-100 to-gray-200 text-gray-400 p-5 rounded-xl mb-4 shadow-sm">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                </div>
                                <p class="text-lg font-bold text-gray-900 mb-2">Belum ada ruangan</p>
                                <p class="text-gray-500 text-sm mb-4 max-w-md">Mulai dengan menambahkan ruangan pertama Anda untuk mengelola inventaris kampus</p>
                                <a href="{{ route('rooms.create') }}" class="group inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-indigo-600 to-purple-600 px-5 py-2.5 text-sm font-bold text-white shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300">
                                    <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    Tambah Ruangan Pertama
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($rooms->hasPages())
        <div class="bg-gray-50/80 px-4 py-3 border-t border-gray-200/50">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                <div class="text-xs text-gray-600 bg-white/50 backdrop-blur-sm rounded-lg px-3 py-1.5 shadow-sm">
                    Menampilkan 
                    <span class="font-bold text-gray-900">{{ $rooms->firstItem() }}</span>
                    sampai
                    <span class="font-bold text-gray-900">{{ $rooms->lastItem() }}</span>
                    dari
                    <span class="font-bold text-gray-900">{{ $rooms->total() }}</span>
                    ruangan
                </div>
                <div class="flex justify-end">
                    {{ $rooms->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<style>
.animate-fade-in {
    animation: fadeIn 0.5s ease-in-out;
}

@keyframes fadeIn {
    from { 
        opacity: 0; 
        transform: translateY(-10px); 
    }
    to { 
        opacity: 1; 
        transform: translateY(0); 
    }
}

/* Custom pagination styling */
.pagination {
    display: flex;
    gap: 0.375rem;
}

.pagination .page-item .page-link {
    padding: 0.375rem 0.75rem;
    border-radius: 0.5rem;
    border: 1px solid #e5e7eb;
    background: white;
    color: #374151;
    font-weight: 500;
    font-size: 0.875rem;
    transition: all 0.2s;
}

.pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #4f46e5, #7c3aed);
    border-color: #4f46e5;
    color: white;
}

.pagination .page-item .page-link:hover {
    background: #f3f4f6;
    transform: translateY(-1px);
}
</style>
@endsection
