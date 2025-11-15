{{-- 
File: resources/views/inventaris/pilih-jenis.blade.php (MODERN & PROFESSIONAL VERSION)
--}}
@extends('dashboard') 

@section('title', 'Pilih Jenis Inventaris')
@section('subtitle', 'Pilih kategori untuk melihat daftar inventaris')

@section('content')
<!-- Modern Hero Section -->
<div class="relative bg-white overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0 bg-gradient-to-br from-gray-50 to-white z-0"></div>
    <div class="absolute top-0 right-0 -mt-20 mr-20 w-64 h-64 bg-blue-50 rounded-full opacity-50 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 -mb-20 ml-20 w-64 h-64 bg-indigo-50 rounded-full opacity-50 blur-3xl"></div>
    
    <!-- Content -->
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
        <div class="text-center">
            <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6 tracking-tight">
                Kelola Inventaris
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Pilih kategori inventaris untuk mengelola dan memonitor aset perusahaan secara efisien
            </p>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="bg-gray-50/50 py-8 lg:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-50 rounded-xl">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Kategori</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ count($kategoriList ?? []) }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                <div class="flex items-center">
                    <div class="p-3 bg-emerald-50 rounded-xl">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Status Sistem</p>
                        <p class="text-lg font-semibold text-emerald-600">Aktif</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                <div class="flex items-center">
                    <div class="p-3 bg-violet-50 rounded-xl">
                        <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Update Terakhir</p>
                        <p class="text-sm font-semibold text-gray-900">{{ date('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Category Section -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Section Header -->
            <div class="px-6 py-8 lg:px-8 lg:py-10 border-b border-gray-100">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="mb-4 sm:mb-0">
                        <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-2">
                            Kategori Inventaris
                        </h2>
                        <p class="text-gray-600">
                            Pilih kategori untuk melihat dan mengelola item inventaris
                        </p>
                    </div>
                    <div class="flex items-center space-x-2 text-sm text-gray-500 bg-gray-50 px-4 py-2 rounded-lg">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>{{ count($kategoriList ?? []) }} kategori tersedia</span>
                    </div>
                </div>
            </div>
            
            <!-- Category Grid -->
            <div class="p-6 lg:p-8">
                @if(isset($kategoriList) && count($kategoriList) > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach ($kategoriList as $index => $kategori)
                            <a href="{{ route('inventaris.index', ['kategori' => $kategori]) }}" 
                               class="group relative block p-6 bg-white rounded-xl border border-gray-200
                                      hover:border-blue-300 hover:shadow-lg
                                      transition-all duration-300 ease-out
                                      overflow-hidden">
                                
                                <!-- Subtle background accent -->
                                <div class="absolute top-0 right-0 w-16 h-16 -mt-8 -mr-8 rounded-full 
                                            bg-gradient-to-br from-blue-50 to-indigo-50 
                                            group-hover:from-blue-100 group-hover:to-indigo-100
                                            transition-all duration-500 opacity-0 group-hover:opacity-100"></div>
                                
                                <!-- Content -->
                                <div class="relative z-10">
                                    <!-- Icon Container -->
                                    <div class="w-14 h-14 mb-5 rounded-xl 
                                                flex items-center justify-center
                                                transition-colors duration-300
                                                @switch($index % 6)
                                                    @case(0) bg-blue-50 group-hover:bg-blue-100 @break
                                                    @case(1) bg-emerald-50 group-hover:bg-emerald-100 @break
                                                    @case(2) bg-violet-50 group-hover:bg-violet-100 @break
                                                    @case(3) bg-amber-50 group-hover:bg-amber-100 @break
                                                    @case(4) bg-rose-50 group-hover:bg-rose-100 @break
                                                    @case(5) bg-cyan-50 group-hover:bg-cyan-100 @break
                                                @endswitch">
                                        
                                        <!-- Icon - Dynamic based on category name -->
                                        @php
                                            $kategoriLower = strtolower($kategori);
                                        @endphp
                                        
                                        @if(str_contains($kategoriLower, 'elektronik') || str_contains($kategoriLower, 'komputer') || str_contains($kategoriLower, 'laptop'))
                                            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                        @elseif(str_contains($kategoriLower, 'mebel') || str_contains($kategoriLower, 'furniture') || str_contains($kategoriLower, 'perabot'))
                                            <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                            </svg>
                                        @elseif(str_contains($kategoriLower, 'kendaraan') || str_contains($kategoriLower, 'mobil') || str_contains($kategoriLower, 'motor'))
                                            <svg class="w-7 h-7 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                            </svg>
                                        @elseif(str_contains($kategoriLower, 'alat') || str_contains($kategoriLower, 'tools'))
                                            <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        @elseif(str_contains($kategoriLower, 'atk') || str_contains($kategoriLower, 'alat tulis') || str_contains($kategoriLower, 'office'))
                                            <svg class="w-7 h-7 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                            </svg>
                                        @elseif(str_contains($kategoriLower, 'buku') || str_contains($kategoriLower, 'dokumen'))
                                            <svg class="w-7 h-7 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                            </svg>
                                        @else
                                            <!-- Default icon based on index -->
                                            @switch($index % 6)
                                                @case(0)
                                                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                    </svg>
                                                    @break
                                                @case(1)
                                                    <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                                                    </svg>
                                                    @break
                                                @case(2)
                                                    <svg class="w-7 h-7 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                                    </svg>
                                                    @break
                                                @case(3)
                                                    <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                                    </svg>
                                                    @break
                                                @case(4)
                                                    <svg class="w-7 h-7 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                                    </svg>
                                                    @break
                                                @default
                                                    <svg class="w-7 h-7 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                                    </svg>
                                            @endswitch
                                        @endif
                                    </div>
                                    
                                    <!-- Category Info -->
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-700 transition-colors duration-300 mb-1">
                                            {{ $kategori }}
                                        </h3>
                                        <p class="text-sm text-gray-500 group-hover:text-gray-700 transition-colors duration-300">
                                            {{ $kategoriCounts[$kategori] ?? 0 }} barang
                                        </p>
                                    </div>
                                    
                                    <!-- Hover Indicator -->
                                    <div class="mt-4 flex items-center text-blue-600 opacity-0 group-hover:opacity-100 transform translate-x-0 group-hover:translate-x-1 transition-all duration-300">
                                        <span class="text-sm font-medium mr-2">Lihat detail</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </div>
                                </div>
                                
                                <!-- Bottom border accent -->
                                <div class="absolute bottom-0 left-0 w-0 h-1 bg-gradient-to-r from-blue-500 to-indigo-500 
                                            group-hover:w-full transition-all duration-500 ease-out"></div>
                            </a>
                        @endforeach
                    </div>
                    
                    <!-- Help Text -->
                    <div class="mt-10 text-center">
                        <div class="inline-flex items-center px-4 py-3 bg-gray-50 rounded-xl text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Pilih kategori untuk melihat dan mengelola inventaris
                        </div>
                    </div>
                    
                @else
                    <!-- Empty State -->
                    <div class="text-center py-16">
                        <div class="w-20 h-20 mx-auto mb-6 bg-gray-100 rounded-2xl flex items-center justify-center">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Kategori</h3>
                        <p class="text-gray-600 mb-6 max-w-md mx-auto">
                            Tidak ada kategori inventaris yang tersedia. Hubungi administrator untuk menambahkan kategori baru.
                        </p>
                        <button class="inline-flex items-center px-5 py-2.5 bg-blue-600 text-white font-medium rounded-lg
                                     hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2
                                     transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Kategori
                        </button>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Footer -->
        <div class="mt-10 pt-6 border-t border-gray-200 text-center">
            <p class="text-sm text-gray-500">
                &copy; {{ date('Y') }} Sistem Inventaris. Semua hak dilindungi.
            </p>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
/* Smooth animations */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.category-card {
    animation: fadeIn 0.5s ease-out forwards;
}

/* Stagger animation for cards */
.category-card:nth-child(1) { animation-delay: 0.05s; }
.category-card:nth-child(2) { animation-delay: 0.1s; }
.category-card:nth-child(3) { animation-delay: 0.15s; }
.category-card:nth-child(4) { animation-delay: 0.2s; }
.category-card:nth-child(5) { animation-delay: 0.25s; }
.category-card:nth-child(6) { animation-delay: 0.3s; }
.category-card:nth-child(7) { animation-delay: 0.35s; }
.category-card:nth-child(8) { animation-delay: 0.4s; }

/* Focus styles for accessibility */
a:focus {
    outline: 2px solid #3b82f6;
    outline-offset: 2px;
    border-radius: 0.75rem;
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 6px;
}

::-webkit-scrollbar-track {
    background: #f1f5f9;
}

::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 3px;
}

::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}
</style>

<!-- JavaScript for enhanced interactions -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add staggered animation to category cards
    const cards = document.querySelectorAll('a[href*="inventaris"]');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.05}s`;
        card.classList.add('category-card');
    });
    
    // Add subtle hover effect to stats cards
    const statCards = document.querySelectorAll('.bg-white.rounded-2xl');
    statCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});
</script>
@endsection
