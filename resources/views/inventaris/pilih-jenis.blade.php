{{-- 
File: resources/views/inventaris/pilih-jenis.blade.php (FILE BARU)
--}}
@extends('dashboard') 

{{-- Sesuaikan 'dashboard' jika nama layout utama kamu beda, misal 'layouts.app' --}}
{{-- Dari file dashboard.blade.php yang kamu kirim, sepertinya @yield('content') ada di sana --}}

@section('title', 'Pilih Jenis Inventaris')
@section('subtitle', 'Pilih kategori untuk melihat daftar inventaris')

@section('content')
<div class="p-4 sm:p-6 lg:p-8">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white/80 backdrop-blur-sm shadow-2xl rounded-2xl overflow-hidden border border-gray-200/80">
            <div class="p-6 lg:p-8 border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-900 gradient-text">
                    Pilih Jenis Inventaris
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Silakan pilih kategori inventaris yang ingin Anda kelola.
                </p>
            </div>
            
            <div class="p-6 lg:p-8">
                {{-- Cek jika $kategoriList ada dan tidak kosong --}}
                @if(isset($kategoriList) && count($kategoriList) > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        
                        {{-- Loop semua kategori dari controller --}}
                        @foreach ($kategoriList as $kategori)
                            <a href="{{ route('inventaris.index', ['kategori' => $kategori]) }}" 
                               title="Lihat kategori {{ $kategori }}"
                               aria-label="Lihat kategori {{ $kategori }}"
                               class="block p-6 bg-white rounded-2xl shadow-lg border border-gray-200/80
                                      hover:bg-gradient-to-br hover:from-purple-50 hover:to-blue-50 
                                      hover:border-purple-300 hover:shadow-xl
                                      text-center font-semibold text-gray-800 hover:text-purple-700 
                                      transition-all duration-300 ease-in-out transform hover:-translate-y-1 hover-lift">
                                
                                {{-- Nanti bisa ditambahin icon di sini kalo mau --}}
                                
                                <span class="text-lg">{{ $kategori }}</span>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="text-center text-gray-500">
                        <p>Tidak ada kategori yang didefinisikan di controller.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection