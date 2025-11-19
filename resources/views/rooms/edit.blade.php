@extends('dashboard') <!-- Pastikan dashboard.blade.php punya <html>, <body>, dan @yield('content') -->

@section('content')
<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Ruangan - {{ $room->nama_ruangan }}</title>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="h-full bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">

<div class="min-h-screen flex flex-col">
    <!-- Full Page Header -->
    <header class="bg-white/80 backdrop-blur-md shadow-lg border-b border-gray-200 sticky top-0 z-10">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('rooms.show', $room->id_room) }}" 
                   class="inline-flex items-center text-gray-600 hover:text-indigo-600 transition">
                    <i class="fas fa-arrow-left mr-2"></i>
                    <span class="font-medium">Kembali</span>
                </a>
                <div class="h-8 w-px bg-gray-300"></div>
                <div>
                    <h1 class="text-xl font-bold text-gray-900 flex items-center">
                        <i class="fas fa-edit text-indigo-600 mr-2"></i>
                        Edit Ruangan
                    </h1>
                    <p class="text-sm text-gray-600 flex items-center">
                        <i class="fas fa-door-open text-indigo-500 mr-1"></i>
                        {{ $room->nama_ruangan }}
                    </p>
                </div>
            </div>
            <div class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-xs font-mono font-bold">
                #{{ str_pad($room->id_room, 6, '0', STR_PAD_LEFT) }}
            </div>
        </div>
    </header>

    <!-- Full Page Form Container -->
    <main class="flex-1 flex items-center justify-center p-4 sm:p-6 lg:p-8">
        <div class="w-full max-w-4xl mx-auto">
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-200">
                <!-- Gradient Header -->
                <div class="bg-gradient-to-r from-indigo-600 via-blue-600 to-purple-700 px-8 py-6">
                    <div class="flex items-center text-white">
                        <div class="bg-white/20 p-4 rounded-2xl mr-5">
                            <i class="fas fa-edit text-3xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold">Form Edit Ruangan</h2>
                            <p class="text-indigo-100">Perbarui detail ruangan dengan akurat</p>
                        </div>
                    </div>
                </div>

                <!-- Form Body -->
                <div class="p-8 lg:p-10">
                    <form action="{{ route('rooms.update', $room->id_room) }}" method="POST" class="space-y-8">
                        @csrf
                        @method('PUT')

                        <!-- Nama Ruangan -->
                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-door-open text-indigo-600 mr-2"></i>
                                Nama Ruangan <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                    <i class="fas fa-building"></i>
                                </div>
                                <input 
                                    type="text" 
                                    name="nama_ruangan" 
                                    id="nama_ruangan"
                                    value="{{ old('nama_ruangan', $room->nama_ruangan) }}" 
                                    required
                                    class="w-full pl-12 pr-4 py-4 rounded-xl border-2 border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all duration-200 @error('nama_ruangan') border-red-500 @enderror"
                                    placeholder="Ruang Sidang Utama"
                                    x-ref="nama"
                                >
                            </div>
                            @error('nama_ruangan')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-1"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Lokasi -->
                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-map-marker-alt text-green-600 mr-2"></i>
                                Lokasi <span class="text-gray-400 text-xs">(Opsional)</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                    <i class="fas fa-location-arrow"></i>
                                </div>
                                <input 
                                    type="text" 
                                    name="lokasi" 
                                    value="{{ old('lokasi', $room->lokasi) }}" 
                                    class="w-full pl-12 pr-4 py-4 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-100 transition-all @error('lokasi') border-red-500 @enderror"
                                    placeholder="Gedung A, Lantai 3, Sayap Barat"
                                >
                            </div>
                            @error('lokasi')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-1"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Unit -->
                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-sitemap text-purple-600 mr-2"></i>
                                Unit Kerja / Fakultas <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                    <i class="fas fa-university"></i>
                                </div>
                                <select 
                                    name="unit_id" 
                                    required
                                    class="w-full pl-12 pr-4 py-4 rounded-xl border-2 border-gray-200 focus:border-purple-500 focus:ring-4 focus:ring-purple-100 transition-all @error('unit_id') border-red-500 @enderror appearance-none bg-white"
                                >
                                    <option value="">-- Pilih Unit --</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}" {{ old('unit_id', $room->unit_id) == $unit->id ? 'selected' : '' }}>
                                            {{ $unit->nama_unit }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-400"></i>
                                </div>
                            </div>
                            @error('unit_id')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-1"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Info Sistem -->
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-2xl p-6 border border-gray-200">
                            <h3 class="font-semibold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-info-circle text-blue-600 mr-2"></i> Informasi Sistem
                            </h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="text-gray-500">Dibuat:</span>
                                    <p class="font-medium text-gray-900">{{ $room->created_at->format('d M Y, H:i') }}</p>
                                </div>
                                <div>
                                    <span class="text-gray-500">Diperbarui:</span>
                                    <p class="font-medium text-gray-900">{{ $room->updated_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                            <button 
                                type="submit"
                                class="flex-1 sm:flex-initial inline-flex justify-center items-center px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-700 text-white font-bold rounded-xl hover:from-indigo-700 hover:to-purple-800 focus:ring-4 focus:ring-indigo-300 transform hover:-translate-y-1 transition-all duration-200 shadow-xl"
                            >
                                <i class="fas fa-save mr-3"></i>
                                Simpan Perubahan
                            </button>
                            <a href="{{ route('rooms.show', $room->id_room) }}" 
                               class="flex-1 sm:flex-initial inline-flex justify-center items-center px-8 py-4 bg-white border-2 border-gray-300 text-gray-700 font-bold rounded-xl hover:bg-gray-50 focus:ring-4 focus:ring-gray-200 transition">
                                <i class="fas fa-times mr-3"></i>
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tips Box -->
            <div class="mt-8 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-2xl p-6">
                <div class="flex">
                    <div class="bg-blue-200 p-3 rounded-xl mr-5">
                        <i class="fas fa-lightbulb text-blue-700 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-blue-900 mb-2">Tips Pengisian</h3>
                        <ul class="text-sm text-blue-800 space-y-1">
                            <li class="flex items-center"><i class="fas fa-check text-green-600 mr-2"></i> Gunakan nama ruangan yang unik</li>
                            <li class="flex items-center"><i class="fas fa-check text-green-600 mr-2"></i> Lokasi membantu pencarian cepat</li>
                            <li class="flex items-center"><i class="fas fa-check text-green-600 mr-2"></i> Pilih unit yang benar untuk laporan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white/80 backdrop-blur-sm border-t border-gray-200 py-4 mt-auto">
        <div class="max-w-7xl mx-auto px-6 text-center text-xs text-gray-500">
            Form Edit • ID: <span class="font-mono">#{{ str_pad($room->id_room, 6, '0', STR_PAD_LEFT) }}</span> • 
            {{ now()->format('d M Y, H:i') }} WIB
        </div>
    </footer>
</div>

<!-- Alpine.js untuk interaktivitas -->
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('form', () => ({
            init() {
                // Auto-focus nama ruangan
                this.$refs.nama?.focus();
            }
        }));
    });
</script>

<!-- Custom CSS -->
<style>
    .group:focus-within .border-gray-200 {
        @apply border-indigo-500 ring-4 ring-indigo-100;
    }
    input, select {
        transition: all 0.2s ease;
    }
</style>
</body>
</html>
@endsection
