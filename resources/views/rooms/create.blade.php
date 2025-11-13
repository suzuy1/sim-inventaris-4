<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Ruangan Baru
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-green-50 via-white to-emerald-50">
        <!-- Main Content -->
        <main class="py-8">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Page Header -->
                <div class="mb-8">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                        <div class="mb-6 lg:mb-0">
                            <div class="flex items-center mb-3">
                                <a href="{{ route('rooms.index') }}" 
                                   class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 transition duration-150 ease-in-out mr-4 group">
                                    <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
                                    Kembali ke Daftar Ruangan
                                </a>
                                <div class="border-l border-gray-300 h-4 mx-3"></div>
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-home mr-2"></i>
                                    <span>Ruangan</span>
                                    <i class="fas fa-chevron-right mx-2 text-xs"></i>
                                    <span class="text-green-600 font-medium">Tambah Baru</span>
                                </div>
                            </div>
                            
                            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">
                                Tambah Ruangan Baru
                            </h1>
                            <p class="text-lg text-gray-600 max-w-2xl">
                                Tambahkan ruangan baru ke dalam sistem manajemen ruangan dengan mengisi form berikut.
                            </p>
                        </div>
                        
                        <!-- Quick Stats -->
                        <div class="grid grid-cols-2 gap-4 sm:flex sm:space-x-6">
                            <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-200 text-center min-w-[120px]">
                                <div class="text-2xl font-bold text-green-600 mb-1">{{ $totalRooms ?? '0' }}</div>
                                <div class="text-xs text-gray-500">Total Ruangan</div>
                            </div>
                            <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-200 text-center min-w-[120px]">
                                <div class="text-2xl font-bold text-blue-600 mb-1">{{ $availableRooms ?? '0' }}</div>
                                <div class="text-xs text-gray-500">Tersedia</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                    <!-- Main Form Column -->
                    <div class="xl:col-span-2">
                        <!-- Form Card -->
                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200 hover:shadow-2xl transition-shadow duration-300">
                            <!-- Form Header -->
                            <div class="bg-gradient-to-r from-green-600 to-emerald-700 px-6 py-6">
                                <div class="flex items-center">
                                    <div class="bg-white bg-opacity-20 p-3 rounded-xl mr-4">
                                        <i class="fas fa-plus-circle text-white text-2xl"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h2 class="text-xl font-bold text-white mb-1">
                                            Form Tambah Ruangan
                                        </h2>
                                        <p class="text-green-100 text-sm">
                                            Isi semua informasi yang diperlukan dengan benar
                                        </p>
                                    </div>
                                    <div class="bg-white bg-opacity-20 px-3 py-1 rounded-full">
                                        <span class="text-white text-sm font-medium">Wajib Diisi *</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Content -->
                            <div class="p-6 sm:p-8">
                                <form action="{{ route('rooms.store') }}" method="POST" class="space-y-8" id="roomForm">
                                    @csrf

                                    <!-- Nama Ruangan Field -->
                                    <div class="space-y-3">
                                        <label for="nama_ruangan" class="block text-sm font-semibold text-gray-700">
                                            <span class="flex items-center">
                                                <i class="fas fa-door-open text-green-500 mr-2"></i>
                                                Nama Ruangan
                                                <span class="text-red-500 ml-1">*</span>
                                            </span>
                                        </label>
                                        <div class="relative">
                                            <input 
                                                type="text" 
                                                name="nama_ruangan" 
                                                id="nama_ruangan" 
                                                value="{{ old('nama_ruangan') }}" 
                                                required
                                                class="w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-100 transition duration-200 ease-in-out @error('nama_ruangan') border-red-500 @enderror"
                                                placeholder="Contoh: Ruang Rapat Utama Lantai 5"
                                                autofocus
                                            >
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <i class="fas fa-building text-gray-400 text-lg"></i>
                                            </div>
                                        </div>
                                        @error('nama_ruangan')
                                            <div class="flex items-center mt-2 text-sm text-red-600 bg-red-50 px-3 py-2 rounded-lg">
                                                <i class="fas fa-exclamation-circle mr-2"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <p class="text-xs text-gray-500 mt-2 flex items-center">
                                            <i class="fas fa-info-circle mr-2 text-green-500"></i>
                                            Berikan nama yang jelas dan mudah dikenali oleh semua pengguna
                                        </p>
                                    </div>

                                    <!-- Lokasi Field -->
                                    <div class="space-y-3">
                                        <label for="lokasi" class="block text-sm font-semibold text-gray-700">
                                            <span class="flex items-center">
                                                <i class="fas fa-map-marker-alt text-blue-500 mr-2"></i>
                                                Lokasi Detail
                                                <span class="text-gray-400 text-xs ml-2">(Opsional)</span>
                                            </span>
                                        </label>
                                        <div class="relative">
                                            <input 
                                                type="text" 
                                                name="lokasi" 
                                                id="lokasi" 
                                                value="{{ old('lokasi') }}" 
                                                class="w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition duration-200 ease-in-out @error('lokasi') border-red-500 @enderror"
                                                placeholder="Contoh: Gedung A, Lantai 3, Sayap Timur, Dekat Lift"
                                            >
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <i class="fas fa-location-arrow text-gray-400 text-lg"></i>
                                            </div>
                                        </div>
                                        @error('lokasi')
                                            <div class="flex items-center mt-2 text-sm text-red-600 bg-red-50 px-3 py-2 rounded-lg">
                                                <i class="fas fa-exclamation-circle mr-2"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <p class="text-xs text-gray-500 mt-2 flex items-center">
                                            <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                                            Informasi lokasi membantu pengguna menemukan ruangan dengan mudah
                                        </p>
                                    </div>

                                    <!-- Unit Field -->
                                    <div class="space-y-3">
                                        <label for="unit_id" class="block text-sm font-semibold text-gray-700">
                                            <span class="flex items-center">
                                                <i class="fas fa-sitemap text-purple-500 mr-2"></i>
                                                Unit Kerja / Fakultas
                                                <span class="text-red-500 ml-1">*</span>
                                            </span>
                                        </label>
                                        <div class="relative">
                                            <select 
                                                name="unit_id" 
                                                id="unit_id" 
                                                required
                                                class="w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 transition duration-200 ease-in-out appearance-none @error('unit_id') border-red-500 @enderror"
                                            >
                                                <option value="">-- Pilih Unit Kerja --</option>
                                                @foreach ($units as $unit)
                                                    <option value="{{ $unit->id }}" {{ old('unit_id') == $unit->id ? 'selected' : '' }}>
                                                        {{ $unit->nama_unit }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <i class="fas fa-university text-gray-400 text-lg"></i>
                                            </div>
                                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                                <i class="fas fa-chevron-down text-gray-400"></i>
                                            </div>
                                        </div>
                                        @error('unit_id')
                                            <div class="flex items-center mt-2 text-sm text-red-600 bg-red-50 px-3 py-2 rounded-lg">
                                                <i class="fas fa-exclamation-circle mr-2"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <p class="text-xs text-gray-500 mt-2 flex items-center">
                                            <i class="fas fa-info-circle mr-2 text-purple-500"></i>
                                            Pilih unit atau fakultas yang akan menaungi ruangan ini
                                        </p>
                                    </div>

                                    <!-- Additional Information -->
                                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl p-6 border border-gray-200">
                                        <h3 class="text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                            <i class="fas fa-info-circle text-green-600 mr-2"></i>
                                            Informasi Tambahan
                                        </h3>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-600">
                                            <div class="flex items-center">
                                                <i class="fas fa-check-circle text-green-500 mr-3 text-lg"></i>
                                                <span>Ruangan akan langsung aktif setelah dibuat</span>
                                            </div>
                                            <div class="flex items-center">
                                                <i class="fas fa-check-circle text-green-500 mr-3 text-lg"></i>
                                                <span>Dapat diakses oleh semua pengguna terdaftar</span>
                                            </div>
                                            <div class="flex items-center">
                                                <i class="fas fa-check-circle text-green-500 mr-3 text-lg"></i>
                                                <span>Informasi dapat diedit kapan saja</span>
                                            </div>
                                            <div class="flex items-center">
                                                <i class="fas fa-check-circle text-green-500 mr-3 text-lg"></i>
                                                <span>Status tersedia secara default</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="pt-6 border-t border-gray-200">
                                        <div class="flex flex-col sm:flex-row gap-4 justify-end">
                                            <button 
                                                type="submit"
                                                class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-green-600 to-emerald-700 border border-transparent rounded-xl text-white font-bold hover:from-green-700 hover:to-emerald-800 focus:outline-none focus:ring-4 focus:ring-green-200 transition duration-200 ease-in-out shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 group"
                                                id="submitBtn"
                                            >
                                                <i class="fas fa-plus-circle mr-3 text-lg group-hover:scale-110 transition-transform"></i>
                                                Tambah Ruangan Baru
                                            </button>

                                            <a href="{{ route('rooms.index') }}" 
                                               class="inline-flex items-center justify-center px-8 py-4 border-2 border-gray-300 rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-4 focus:ring-gray-200 transition duration-200 ease-in-out font-bold hover:border-gray-400">
                                                <i class="fas fa-times mr-3 text-lg"></i>
                                                Batalkan
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Column -->
                    <div class="space-y-8">
                        <!-- Quick Tips -->
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-lightbulb text-yellow-500 mr-3 text-xl"></i>
                                Tips Penamaan
                            </h3>
                            <ul class="space-y-3 text-sm text-gray-600">
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mr-3 mt-0.5 text-xs"></i>
                                    <span>Gunakan nama yang deskriptif dan mudah diingat</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mr-3 mt-0.5 text-xs"></i>
                                    <span>Sertakan nomor lantai dan gedung jika diperlukan</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mr-3 mt-0.5 text-xs"></i>
                                    <span>Hindari singkatan yang tidak umum</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mr-3 mt-0.5 text-xs"></i>
                                    <span>Konsisten dengan pola penamaan yang sudah ada</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mr-3 mt-0.5 text-xs"></i>
                                    <span>Pertimbangkan kapasitas dan fungsi ruangan</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Next Steps -->
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-100 rounded-2xl shadow-lg border border-blue-200 p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-forward text-blue-600 mr-3 text-xl"></i>
                                Langkah Selanjutnya
                            </h3>
                            <ul class="space-y-3 text-sm text-gray-700">
                                <li class="flex items-center">
                                    <div class="bg-blue-100 text-blue-600 rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold mr-3">1</div>
                                    <span>Atur jadwal penggunaan ruangan</span>
                                </li>
                                <li class="flex items-center">
                                    <div class="bg-blue-100 text-blue-600 rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold mr-3">2</div>
                                    <span>Tambahkan fasilitas dan peralatan</span>
                                </li>
                                <li class="flex items-center">
                                    <div class="bg-blue-100 text-blue-600 rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold mr-3">3</div>
                                    <span>Tetapkan penanggung jawab ruangan</span>
                                </li>
                                <li class="flex items-center">
                                    <div class="bg-blue-100 text-blue-600 rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold mr-3">4</div>
                                    <span>Konfigurasi aturan penggunaan</span>
                                </li>
                            </ul>
                        </div>

                        <!-- System Info -->
                        <div class="bg-gradient-to-r from-gray-800 to-gray-900 rounded-2xl shadow-lg p-6 text-white">
                            <h3 class="text-lg font-bold mb-4 flex items-center">
                                <i class="fas fa-cog mr-3 text-xl"></i>
                                Informasi Sistem
                            </h3>
                            <div class="space-y-3 text-sm">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-300">ID Sistem</span>
                                    <span class="font-mono bg-gray-700 px-2 py-1 rounded">#{{ rand(1000, 9999) }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-300">Versi</span>
                                    <span>v2.1.0</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-300">Status</span>
                                    <span class="text-green-400 font-medium">Aktif</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-300">Terakhir Update</span>
                                    <span>{{ now()->format('d/m/Y') }}</span>
                                </div>
                            </div>
                            <div class="mt-4 pt-4 border-t border-gray-700 text-xs text-gray-400 text-center">
                                RoomManager Pro Edition
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>

@push('styles')
<style>
    .font-inter {
        font-family: 'Inter', sans-serif;
    }
    
    .shadow-custom {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    
    input:focus, select:focus {
        box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.1);
        border-color: #10b981;
    }
    
    .hover-lift {
        transition: all 0.3s ease-in-out;
    }
    
    .hover-lift:hover {
        transform: translateY(-2px);
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-focus on first input
        const firstInput = document.getElementById('nama_ruangan');
        if (firstInput) {
            firstInput.focus();
        }
        
        // Real-time validation
        const requiredFields = document.querySelectorAll('input[required], select[required]');
        requiredFields.forEach(field => {
            field.addEventListener('input', function() {
                if (this.value.trim() !== '') {
                    this.classList.remove('border-red-500');
                    this.classList.add('border-green-500');
                } else {
                    this.classList.remove('border-green-500');
                    this.classList.add('border-red-500');
                }
            });
            
            // Initial check
            if (field.value.trim() !== '') {
                field.classList.add('border-green-500');
            }
        });
        
        // Form submission handling
        const form = document.getElementById('roomForm');
        const submitBtn = document.getElementById('submitBtn');
        
        if (form && submitBtn) {
            form.addEventListener('submit', function(e) {
                // Change button state
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-3"></i> Menyimpan Ruangan...';
                submitBtn.disabled = true;
                submitBtn.classList.remove('hover:from-green-700', 'hover:to-emerald-800', 'hover:shadow-xl', 'transform', 'hover:-translate-y-0.5');
            });
        }
        
        // Add hover effects to cards
        const cards = document.querySelectorAll('.bg-white');
        cards.forEach(card => {
            card.classList.add('hover-lift');
        });
        
        // Character counter for nama_ruangan
        const namaRuanganInput = document.getElementById('nama_ruangan');
        if (namaRuanganInput) {
            const counterDiv = document.createElement('div');
            counterDiv.className = 'text-xs text-gray-500 mt-1 text-right';
            counterDiv.id = 'charCounter';
            namaRuanganInput.parentNode.appendChild(counterDiv);
            
            namaRuanganInput.addEventListener('input', function() {
                const count = this.value.length;
                counterDiv.textContent = `${count}/100 karakter`;
                
                if (count > 80) {
                    counterDiv.classList.add('text-orange-500');
                    counterDiv.classList.remove('text-gray-500');
                } else {
                    counterDiv.classList.remove('text-orange-500');
                    counterDiv.classList.add('text-gray-500');
                }
            });
            
            // Initial count
            namaRuanganInput.dispatchEvent(new Event('input'));
        }
    });
</script>
@endpush
