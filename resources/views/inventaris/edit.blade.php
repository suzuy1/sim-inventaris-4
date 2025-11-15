@extends('dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50/30 p-4 sm:p-6 lg:p-8">
    <!-- Header Section -->
    <div class="mb-8 animate-fade-in">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <!-- Title & Info -->
            <div class="flex-1">
                <div class="flex items-center gap-4 mb-4">
                    <div class="p-3 bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20">
                        <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 bg-gradient-to-r from-gray-900 to-gray-700 bg-clip-text text-transparent">
                            Edit Master Inventaris
                        </h1>
                        <p class="mt-2 text-sm text-gray-600 max-w-2xl">
                            Perbarui informasi dasar untuk 
                            <span class="font-semibold text-indigo-600 bg-indigo-50 px-2 py-1 rounded-lg">
                                {{ $inventaris->nama_barang }}
                            </span>
                        </p>
                    </div>
                </div>
                
                <!-- Breadcrumb -->
                <nav class="flex items-center gap-2 text-sm text-gray-600">
                    <a href="{{ route('dashboard') }}" 
                       class="hover:text-indigo-600 transition-colors duration-200 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Dashboard
                    </a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <a href="{{ route('inventaris.index', ['kategori' => $inventaris->kategori]) }}" 
                       class="hover:text-indigo-600 transition-colors duration-200">
                        Daftar Inventaris
                    </a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <span class="text-gray-900 font-medium">Edit</span>
                </nav>
            </div>

            <!-- Back Button -->
            <a href="{{ route('inventaris.index', ['kategori' => $inventaris->kategori]) }}"
               class="group inline-flex items-center gap-2 rounded-xl bg-white/80 backdrop-blur-sm border border-gray-200 px-5 py-3 text-sm font-semibold text-gray-700 shadow-lg hover:shadow-xl transition-all duration-300 hover:bg-white hover:border-gray-300">
                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Daftar
            </a>
        </div>
    </div>

    <!-- Form Section -->
    <div class="max-w-2xl mx-auto">
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-2xl border border-white/20 hover:shadow-3xl transition-all duration-500">
            <!-- Form Header -->
            <div class="border-b border-gray-100/60 bg-gradient-to-r from-white to-gray-50/50 rounded-t-2xl px-6 py-5">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-indigo-100 rounded-xl">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-gray-900">Informasi Master Barang</h2>
                </div>
            </div>

            <!-- Form Content -->
            <form action="{{ route('inventaris.update', $inventaris->id) }}" method="POST" class="p-6 lg:p-8">
                @csrf
                @method('PUT')

                <!-- Error Display -->
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4 animate-shake" role="alert">
                        <div class="flex items-center gap-3 mb-2">
                            <svg class="h-5 w-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <strong class="font-semibold text-red-800">Perhatian!</strong>
                        </div>
                        <ul class="mt-1 text-sm text-red-700 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="space-y-6">
                    <!-- Nama Barang -->
                    <div class="form-group">
                        <label for="nama_barang" class="flex items-center gap-2 text-sm font-semibold text-gray-900 mb-3">
                            <span>Nama Barang</span>
                            <span class="text-red-500">*</span>
                            <div class="tooltip" data-tip="Nama lengkap dan spesifik dari barang">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </label>
                        <div class="relative">
                            <input type="text" name="nama_barang" id="nama_barang" 
                                   value="{{ old('nama_barang', $inventaris->nama_barang) }}"
                                   class="w-full rounded-xl border-0 bg-white/70 py-3.5 px-4 text-gray-900 
                                          shadow-sm ring-1 ring-inset ring-gray-200 placeholder:text-gray-400
                                          focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all duration-300
                                          hover:ring-gray-300"
                                   placeholder="Contoh: Laptop ASUS ROG, Meja Kerja Minimalis"
                                   required>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                        </div>
                        @error('nama_barang')
                            <p class="mt-2 text-sm text-red-600 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div class="form-group">
                        <label for="kategori" class="flex items-center gap-2 text-sm font-semibold text-gray-900 mb-3">
                            <span>Kategori</span>
                            <span class="text-red-500">*</span>
                            <div class="tooltip" data-tip="Pilih kategori yang paling sesuai">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </label>
                        <div class="relative">
                            <select id="kategori" name="kategori" required
                                    class="w-full rounded-xl border-0 bg-white/70 py-3.5 px-4 text-gray-900 
                                           shadow-sm ring-1 ring-inset ring-gray-200 appearance-none
                                           focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all duration-300
                                           hover:ring-gray-300">
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
                                            {{ old('kategori', $inventaris->kategori) == $kategoriOption ? 'selected' : '' }}
                                            class="py-2">
                                        {{ $kategoriOption }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                        @error('kategori')
                            <p class="mt-2 text-sm text-red-600 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Keterangan -->
                    <div class="form-group">
                        <label for="keterangan" class="flex items-center gap-2 text-sm font-semibold text-gray-900 mb-3">
                            <span>Keterangan</span>
                            <div class="tooltip" data-tip="Informasi tambahan tentang barang (opsional)">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </label>
                        <div class="relative">
                            <textarea id="keterangan" name="keterangan" rows="4"
                                    class="w-full rounded-xl border-0 bg-white/70 py-3.5 px-4 text-gray-900 
                                           shadow-sm ring-1 ring-inset ring-gray-200 placeholder:text-gray-400
                                           focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all duration-300
                                           hover:ring-gray-300 resize-none"
                                    placeholder="Tambahkan deskripsi, spesifikasi, atau catatan penting tentang barang ini...">{{ old('keterangan', $inventaris->keterangan) }}</textarea>
                        </div>
                        <div class="mt-2 flex justify-between items-center text-xs text-gray-500">
                            <span>Informasi tambahan yang membantu identifikasi</span>
                            <span id="charCount">0/500 karakter</span>
                        </div>
                        @error('keterangan')
                            <p class="mt-2 text-sm text-red-600 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Form Footer -->
                <div class="mt-8 pt-6 border-t border-gray-100/60 flex flex-col sm:flex-row items-center justify-end gap-3">
                    <a href="{{ route('inventaris.index', ['kategori' => $inventaris->kategori]) }}" 
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-xl 
                              bg-white px-6 py-3.5 text-sm font-semibold text-gray-700 
                              shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 
                              hover:shadow-md transform hover:-translate-y-0.5 transition-all duration-200
                              hover:ring-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Batalkan
                    </a>
                    <button type="submit" 
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-xl 
                                   bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-3.5 text-sm font-semibold text-white 
                                   shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200
                                   hover:from-indigo-700 hover:to-purple-700 active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Custom Styles & Scripts -->
<style>
.animate-fade-in {
    animation: fadeIn 0.6s ease-out;
}

.animate-shake {
    animation: shake 0.5s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
}

.form-group {
    position: relative;
}

.tooltip {
    position: relative;
    cursor: help;
}

.tooltip:hover::after {
    content: attr(data-tip);
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    background: #1f2937;
    color: white;
    padding: 0.5rem 0.75rem;
    border-radius: 0.5rem;
    font-size: 0.75rem;
    white-space: nowrap;
    z-index: 10;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Character counter for keterangan
    const textarea = document.getElementById('keterangan');
    const charCount = document.getElementById('charCount');
    
    if (textarea && charCount) {
        textarea.addEventListener('input', function() {
            const length = this.value.length;
            charCount.textContent = `${length}/500 karakter`;
            
            if (length > 500) {
                charCount.classList.add('text-red-600');
            } else {
                charCount.classList.remove('text-red-600');
            }
        });
        
        // Initialize count
        charCount.textContent = `${textarea.value.length}/500 karakter`;
    }
    
    // Form validation enhancement
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('ring-2', 'ring-red-500');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            // Scroll to first error
            const firstError = form.querySelector('.ring-red-500');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstError.focus();
            }
        }
    });
    
    // Remove error styling on input
    const inputs = form.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            this.classList.remove('ring-red-500');
        });
    });
});
</script>
@endsection