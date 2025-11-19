@extends('dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center mb-4 sm:mb-0">
                    <a href="{{ route('rooms.index') }}" 
                       class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 transition duration-150 ease-in-out mr-4">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali ke Daftar Ruangan
                    </a>
                    <div class="border-l border-gray-300 h-6 mx-3"></div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900">
                        Detail Ruangan
                    </h1>
                </div>
                
                <div class="flex space-x-3">
                    <a href="{{ route('rooms.edit', $room->id_room) }}"
                       class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 focus:bg-yellow-600 active:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                        <i class="fas fa-edit mr-2"></i>
                        Edit
                    </a>
                    
                    <form action="{{ route('rooms.destroy', $room->id_room) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus ruangan ini? Tindakan ini tidak dapat dibatalkan.')"
                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                            <i class="fas fa-trash mr-2"></i>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Room Information -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
                    <!-- Header Card -->
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-8">
                        <div class="flex items-center">
                            <div class="bg-white bg-opacity-20 p-3 rounded-lg mr-4">
                                <i class="fas fa-door-open text-white text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-2xl md:text-3xl font-bold text-white mb-1">
                                    {{ $room->nama_ruangan }}
                                </h2>
                                <p class="text-blue-100 flex items-center">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    {{ $room->lokasi ?? 'Lokasi belum ditentukan' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Information Grid -->
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Basic Information -->
                            <div class="space-y-6">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">
                                        <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                                        Informasi Dasar
                                    </h3>
                                    
                                    <div class="space-y-4">
                                        <div class="flex items-start">
                                            <div class="bg-blue-50 p-2 rounded-lg mr-3">
                                                <i class="fas fa-door-open text-blue-600 text-sm"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-500">Nama Ruangan</p>
                                                <p class="text-lg font-semibold text-gray-900">{{ $room->nama_ruangan }}</p>
                                            </div>
                                        </div>

                                        <div class="flex items-start">
                                            <div class="bg-green-50 p-2 rounded-lg mr-3">
                                                <i class="fas fa-map-marker-alt text-green-600 text-sm"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-500">Lokasi</p>
                                                <p class="text-lg font-semibold text-gray-900">
                                                    {{ $room->lokasi ?? 'Tidak tersedia' }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="flex items-start">
                                            <div class="bg-purple-50 p-2 rounded-lg mr-3">
                                                <i class="fas fa-building text-purple-600 text-sm"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-500">Unit</p>
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800 mt-1">
                                                    <i class="fas fa-hashtag mr-1 text-xs"></i>
                                                    {{ $room->unit->nama_unit ?? 'Tidak terdaftar' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Timestamps -->
                            <div class="space-y-6">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">
                                        <i class="fas fa-history text-gray-500 mr-2"></i>
                                        Informasi Sistem
                                    </h3>
                                    
                                    <div class="space-y-4">
                                        <div class="flex items-start">
                                            <div class="bg-green-50 p-2 rounded-lg mr-3">
                                                <i class="fas fa-calendar-plus text-green-600 text-sm"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-500">Dibuat Pada</p>
                                                <p class="text-base font-semibold text-gray-900">
                                                    {{ $room->created_at->format('d F Y') }}
                                                </p>
                                                <p class="text-sm text-gray-500">
                                                    {{ $room->created_at->format('H:i:s') }} WIB
                                                </p>
                                            </div>
                                        </div>

                                        <div class="flex items-start">
                                            <div class="bg-amber-50 p-2 rounded-lg mr-3">
                                                <i class="fas fa-calendar-check text-amber-600 text-sm"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-500">Terakhir Diperbarui</p>
                                                <p class="text-base font-semibold text-gray-900">
                                                    {{ $room->updated_at->diffForHumans() }}
                                                </p>
                                                <p class="text-sm text-gray-500">
                                                    {{ $room->updated_at->format('d F Y, H:i:s') }} WIB
                                                </p>
                                            </div>
                                        </div>

                                        <div class="flex items-start">
                                            <div class="bg-gray-50 p-2 rounded-lg mr-3">
                                                <i class="fas fa-fingerprint text-gray-600 text-sm"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-500">ID Ruangan</p>
                                                <p class="text-base font-semibold text-gray-900">
                                                    #{{ str_pad($room->id_room, 6, '0', STR_PAD_LEFT) }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Information Section (bisa ditambahkan nanti) -->
                <div class="mt-6 bg-white rounded-xl shadow-lg border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-ellipsis-h text-blue-500 mr-2"></i>
                        Informasi Tambahan
                    </h3>
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-info-circle text-3xl mb-3 text-gray-300"></i>
                        <p>Tidak ada informasi tambahan untuk ruangan ini.</p>
                        <p class="text-sm mt-2">Fitur ini dapat dikembangkan sesuai kebutuhan.</p>
                    </div>
                </div>
            </div>

            <!-- Right Column - Quick Actions & Stats -->
            <div class="space-y-6">
                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-bolt text-yellow-500 mr-2"></i>
                        Tindakan Cepat
                    </h3>
                    <div class="space-y-3">
                        <a href="{{ route('rooms.edit', $room->id_room) }}"
                           class="w-full flex items-center justify-center px-4 py-3 border border-yellow-300 rounded-lg text-yellow-700 bg-yellow-50 hover:bg-yellow-100 transition duration-150 ease-in-out font-medium">
                            <i class="fas fa-edit mr-2"></i>
                            Edit Ruangan
                        </a>
                        
                        <a href="#"
                           class="w-full flex items-center justify-center px-4 py-3 border border-blue-300 rounded-lg text-blue-700 bg-blue-50 hover:bg-blue-100 transition duration-150 ease-in-out font-medium">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            Jadwalkan Penggunaan
                        </a>
                        
                        <a href="#"
                           class="w-full flex items-center justify-center px-4 py-3 border border-green-300 rounded-lg text-green-700 bg-green-50 hover:bg-green-100 transition duration-150 ease-in-out font-medium">
                            <i class="fas fa-print mr-2"></i>
                            Cetak Informasi
                        </a>
                    </div>
                </div>

                <!-- Room Status -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-chart-bar text-green-500 mr-2"></i>
                        Status Ruangan
                    </h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Status</span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <i class="fas fa-circle text-xs mr-1"></i>
                                Tersedia
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Kapasitas</span>
                            <span class="font-semibold text-gray-900">-</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Fasilitas</span>
                            <span class="font-semibold text-gray-900">-</span>
                        </div>
                    </div>
                </div>

                <!-- System Info -->
                <div class="bg-gradient-to-r from-gray-800 to-gray-900 rounded-xl shadow-lg p-6 text-white">
                    <h3 class="text-lg font-semibold mb-4">
                        <i class="fas fa-database mr-2"></i>
                        Informasi Sistem
                    </h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-300">ID Sistem</span>
                            <span class="font-mono">#{{ $room->id_room }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-300">Versi</span>
                            <span>v1.0</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-300">Terakhir Akses</span>
                            <span>Sekarang</span>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-700 text-xs text-gray-400 text-center">
                        Sistem Manajemen Ruangan
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Info -->
        <div class="mt-8 text-center">
            <p class="text-sm text-gray-500">
                Halaman detail ruangan • 
                <span class="font-mono">ID: #{{ str_pad($room->id_room, 6, '0', STR_PAD_LEFT) }}</span> • 
                {{ now()->format('d M Y, H:i') }}
            </p>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
    .bg-gradient-br {
        background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
    }
    
    .shadow-custom {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    
    .hover-lift {
        transition: all 0.2s ease-in-out;
    }
    
    .hover-lift:hover {
        transform: translateY(-2px);
    }
</style>

<script>
    // Tambahkan efek interaktif sederhana
    document.addEventListener('DOMContentLoaded', function() {
        // Tambahkan kelas hover untuk card
        const cards = document.querySelectorAll('.bg-white');
        cards.forEach(card => {
            card.classList.add('hover-lift');
        });
        
        // Animasi untuk tombol hapus
        const deleteButton = document.querySelector('button[type="submit"]');
        if (deleteButton) {
            deleteButton.addEventListener('mouseover', function() {
                this.classList.add('shadow-lg');
            });
            deleteButton.addEventListener('mouseout', function() {
                this.classList.remove('shadow-lg');
            });
        }
    });
</script>
@endsection
