@extends('dashboard')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Card -->
        <div class="mb-8">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-white bg-opacity-20 rounded-xl">
                            <i class="fas fa-building text-2xl"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold">Tambah Unit Baru</h1>
                            <p class="text-blue-100 opacity-90">Tambahkan unit organisasi baru ke sistem</p>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="bg-white bg-opacity-20 rounded-lg px-3 py-1">
                            <span class="text-sm font-medium">Step 1 of 1</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="border-b border-gray-100 px-8 py-6 bg-gradient-to-r from-gray-50 to-white">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <i class="fas fa-info-circle text-blue-600 text-lg"></i>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800">Informasi Unit</h2>
                </div>
                <p class="text-gray-600 text-sm mt-1">Isi detail unit organisasi yang akan ditambahkan</p>
            </div>

            <form action="{{ route('units.store') }}" method="POST" class="p-8">
                @csrf

                <!-- Nama Unit Field -->
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-3">
                        <label for="nama_unit" class="block text-sm font-medium text-gray-700">
                            Nama Unit <span class="text-red-500">*</span>
                        </label>
                        <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">Wajib diisi</span>
                    </div>
                    
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-building text-gray-400"></i>
                        </div>
                        <input 
                            type="text" 
                            name="nama_unit" 
                            id="nama_unit" 
                            value="{{ old('nama_unit') }}"
                            class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-200 ease-in-out py-3 px-4 border @error('nama_unit') border-red-300 bg-red-50 @enderror"
                            placeholder="Masukkan nama unit (contoh: HRD, IT, Marketing)"
                            required
                        >
                    </div>
                    
                    @error('nama_unit')
                        <div class="mt-2 flex items-center space-x-2 text-red-600 text-sm">
                            <i class="fas fa-exclamation-circle"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                    
                    <div class="mt-2 text-sm text-gray-500 flex items-center space-x-1">
                        <i class="fas fa-lightbulb text-yellow-500"></i>
                        <span>Gunakan nama yang jelas dan mudah dipahami</span>
                    </div>
                </div>

                <!-- Divider -->
                <div class="border-t border-gray-200 my-8"></div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-blue-50 rounded-lg">
                            <i class="fas fa-shield-alt text-blue-600"></i>
                        </div>
                        <div class="text-sm text-gray-600">
                            <p class="font-medium">Data terlindungi</p>
                            <p class="text-gray-500">Informasi Anda aman dan terenkripsi</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('units.index') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200 ease-in-out">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali
                        </a>
                        <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm transition duration-200 ease-in-out">
                            <i class="fas fa-plus-circle mr-2"></i>
                            Tambah Unit
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Additional Info -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center space-x-3 mb-3">
                    <div class="p-2 bg-green-100 rounded-lg">
                        <i class="fas fa-clock text-green-600"></i>
                    </div>
                    <h3 class="font-semibold text-gray-800">Proses Cepat</h3>
                </div>
                <p class="text-gray-600 text-sm">Penambahan unit akan langsung tersedia di sistem setelah disimpan</p>
            </div>
            
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center space-x-3 mb-3">
                    <div class="p-2 bg-purple-100 rounded-lg">
                        <i class="fas fa-users text-purple-600"></i>
                    </div>
                    <h3 class="font-semibold text-gray-800">Multi-User</h3>
                </div>
                <p class="text-gray-600 text-sm">Unit dapat diakses oleh semua pengguna yang berwenang</p>
            </div>
            
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center space-x-3 mb-3">
                    <div class="p-2 bg-orange-100 rounded-lg">
                        <i class="fas fa-edit text-orange-600"></i>
                    </div>
                    <h3 class="font-semibold text-gray-800">Mudah Dikelola</h3>
                </div>
                <p class="text-gray-600 text-sm">Data unit dapat diubah kapan saja melalui panel admin</p>
            </div>
        </div>
    </div>
</div>

<!-- Success Notification (hidden by default) -->
@if(session('success'))
<div id="success-notification" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50 transition-opacity duration-300">
    <div class="bg-white rounded-2xl shadow-xl p-6 max-w-sm mx-4 transform transition-all duration-300 scale-100">
        <div class="flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mx-auto mb-4">
            <i class="fas fa-check text-green-600 text-2xl"></i>
        </div>
        <h3 class="text-lg font-semibold text-gray-800 text-center mb-2">Berhasil!</h3>
        <p class="text-gray-600 text-center mb-6">{{ session('success') }}</p>
        <button onclick="closeNotification()" class="w-full bg-blue-600 text-white py-2 rounded-lg font-medium hover:bg-blue-700 transition duration-200">
            Tutup
        </button>
    </div>
</div>

<script>
    function closeNotification() {
        document.getElementById('success-notification').classList.add('opacity-0', 'scale-95');
        setTimeout(() => {
            document.getElementById('success-notification').style.display = 'none';
        }, 300);
    }
    
    // Auto close after 5 seconds
    setTimeout(closeNotification, 5000);
</script>
@endif

@endsection