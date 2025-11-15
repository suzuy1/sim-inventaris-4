{{-- 
File: resources/views/inventaris/pilih-jenis.blade.php (BIRU-UNGU VIBES VERSION)
--}}
@extends('dashboard') 

@section('title', 'Pilih Jenis Inventaris')
@section('subtitle', 'Pilih kategori untuk melihat daftar inventaris')

@section('content')
<!-- Hero Section with Blue-Purple Gradient -->
<div class="relative bg-white overflow-hidden">
    <!-- Background Gradient: Blue to Purple Flow -->
    <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 z-0"></div>
    <div class="absolute top-0 right-0 -mt-24 mr-24 w-72 h-72 bg-blue-200 rounded-full opacity-40 blur-3xl animate-pulse"></div>
    <div class="absolute bottom-0 left-0 -mb-24 ml-24 w-72 h-72 bg-purple-200 rounded-full opacity-40 blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
    
    <!-- Content with Fade-in -->
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">
        <div class="text-center animate-fade-in-down">
            <h1 class="text-4xl lg:text-6xl font-bold bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 bg-clip-text text-transparent mb-6 tracking-tight">
                Kelola Inventaris
            </h1>
            <p class="text-xl lg:text-2xl text-gray-700 max-w-3xl mx-auto leading-relaxed">
                Pilih kategori inventaris untuk mengelola aset perusahaan dengan efisien dan real-time insights.
            </p>
        </div>
    </div>
</div>

<!-- Main Content with Light Blue-Purple Tint -->
<div class="bg-gradient-to-b from-blue-50/30 to-purple-50/30 py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Stats Overview with Blue-Purple Accents -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-blue-100/50 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="p-3 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-xl">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Kategori</p>
                        <p class="text-2xl font-bold text-gray-900">{{ count($kategoriList ?? []) }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-purple-100/50 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="p-3 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-xl">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Status Sistem</p>
                        <p class="text-lg font-bold text-indigo-600">Aktif</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-blue-100/50 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="p-3 bg-gradient-to-br from-purple-100 to-blue-100 rounded-xl">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Update Terakhir</p>
                        <p class="text-sm font-bold text-gray-900">{{ date('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Category Section with Blue-Purple Theme -->
        <div class="bg-white rounded-2xl shadow-sm border border-indigo-100/50 overflow-hidden">
            <!-- Section Header -->
            <div class="px-6 py-8 lg:px-8 lg:py-10 border-b border-blue-100/30">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="mb-4 sm:mb-0">
                        <h2 class="text-2xl lg:text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-2">
                            Kategori Inventaris
                        </h2>
                        <p class="text-gray-600">
                            Pilih kategori untuk melihat dan mengelola item inventaris dengan mudah.
                        </p>
                    </div>
                    <div class="flex items-center space-x-2 text-sm text-gray-500 bg-gradient-to-r from-blue-50 to-purple-50 px-4 py-2 rounded-lg border border-indigo-200/30">
                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                               class="group relative block p-6 bg-white rounded-xl border border-blue-200/50
                                      hover:border-indigo-300 hover:shadow-xl transition-all duration-300 ease-out overflow-hidden focus:outline-none focus:ring-4 focus:ring-blue-200/50
                                      transform hover:scale-[1.02] active:scale-[0.98]" 
                               aria-label="Lihat inventaris kategori {{ $kategori }} ({{ $kategoriCounts[$kategori] ?? 0 }} item)">
                                
                                <!-- Background Accent: Blue-Purple Shimmer -->
                                <div class="absolute top-0 right-0 w-20 h-20 -mt-10 -mr-10 rounded-full 
                                            bg-gradient-to-br from-blue-100/60 to-purple-100/60
                                            group-hover:from-blue-200/80 group-hover:to-purple-200/80
                                            transition-all duration-500 opacity-0 group-hover:opacity-100 blur-sm"></div>
                                
                                <!-- Content -->
                                <div class="relative z-10">
                                    <!-- Icon Container with Cycling Blue-Purple Shades -->
                                    <div class="w-16 h-16 mb-5 rounded-2xl flex items-center justify-center
                                                transition-all duration-300 group-hover:rotate-6
                                                @switch($index % 6)
                                                    @case(0) bg-gradient-to-br from-blue-100 to-indigo-100 group-hover:from-blue-200 group-hover:to-indigo-200 @break
                                                    @case(1) bg-gradient-to-br from-indigo-100 to-purple-100 group-hover:from-indigo-200 group-hover:to-purple-200 @break
                                                    @case(2) bg-gradient-to-br from-purple-100 to-blue-100 group-hover:from-purple-200 group-hover:to-blue-200 @break
                                                    @case(3) bg-gradient-to-br from-blue-100 to-purple-100 group-hover:from-blue-200 group-hover:to-purple-200 @break
                                                    @case(4) bg-gradient-to-br from-purple-100 to-indigo-100 group-hover:from-purple-200 group-hover:to-indigo-200 @break
                                                    @case(5) bg-gradient-to-br from-indigo-100 to-blue-100 group-hover:from-indigo-200 group-hover:to-blue-200 @break
                                                @endswitch">
                                        
                                        <!-- Dynamic Icon with Blue-Purple Colors -->
                                        @php
                                            $kategoriLower = strtolower($kategori);
                                        @endphp
                                        
                                        @if(str_contains($kategoriLower, 'elektronik') || str_contains($kategoriLower, 'komputer') || str_contains($kategoriLower, 'laptop'))
                                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                        @elseif(str_contains($kategoriLower, 'mebel') || str_contains($kategoriLower, 'furniture') || str_contains($kategoriLower, 'perabot'))
                                            <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                            </svg>
                                        @elseif(str_contains($kategoriLower, 'kendaraan') || str_contains($kategoriLower, 'mobil') || str_contains($kategoriLower, 'motor'))
                                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                            </svg>
                                        @elseif(str_contains($kategoriLower, 'alat') || str_contains($kategoriLower, 'tools'))
                                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        @elseif(str_contains($kategoriLower, 'atk') || str_contains($kategoriLower, 'alat tulis') || str_contains($kategoriLower, 'office'))
                                            <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                            </svg>
                                        @elseif(str_contains($kategoriLower, 'buku') || str_contains($kategoriLower, 'dokumen'))
                                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                            </svg>
                                        @else
                                            <!-- Default Icon Cycle with Blue-Purple -->
                                            @switch($index % 6)
                                                @case(0)
                                                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                    </svg>
                                                    @break
                                                @case(1)
                                                    <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                                                    </svg>
                                                    @break
                                                @case(2)
                                                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                                    </svg>
                                                    @break
                                                @case(3)
                                                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                                    </svg>
                                                    @break
                                                @case(4)
                                                    <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                                    </svg>
                                                    @break
                                                @default
                                                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                                    </svg>
                                            @endswitch
                                        @endif
                                    </div>
                                    
                                    <!-- Category Info -->
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900 group-hover:text-indigo-700 transition-colors duration-300 mb-1">
                                            {{ $kategori }}
                                        </h3>
                                        <p class="text-sm text-gray-500 group-hover:text-purple-600 transition-colors duration-300">
                                            {{ $kategoriCounts[$kategori] ?? 0 }} barang
                                        </p>
                                    </div>
                                    
                                    <!-- Hover Indicator -->
                                    <div class="mt-4 flex items-center text-indigo-600 opacity-0 group-hover:opacity-100 transform -translate-x-2 group-hover:translate-x-0 transition-all duration-300">
                                        <span class="text-sm font-medium mr-2">Lihat detail</span>
                                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </div>
                                </div>
                                
                                <!-- Gradient Bottom Border: Blue to Purple -->
                                <div class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 
                                            group-hover:w-full transition-all duration-500 ease-out"></div>
                            </a>
                        @endforeach
                    </div>
                    
                    <!-- Help Text with Blue-Purple Gradient -->
                    <div class="mt-10 text-center">
                        <div class="inline-flex items-center px-6 py-4 bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl text-sm text-gray-600 border border-indigo-200/30">
                            <svg class="w-5 h-5 mr-3 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Pilih kategori untuk mulai mengelola inventaris Anda</span>
                        </div>
                    </div>
                    
                @else
                    <!-- Empty State with Blue-Purple Accent -->
                    <div class="text-center py-20">
                        <div class="w-24 h-24 mx-auto mb-8 bg-gradient-to-br from-blue-100 to-purple-100 rounded-3xl flex items-center justify-center animate-bounce">
                            <svg class="w-12 h-12 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Belum Ada Kategori</h3>
                        <p class="text-gray-600 mb-8 max-w-md mx-auto leading-relaxed">
                            Kategori inventaris belum tersedia. Mulai dengan menambahkan yang baru untuk mengoptimalkan pengelolaan aset.
                        </p>
                        <button class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl
                                     hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-4 focus:ring-indigo-300/50
                                     transition-all duration-200 transform hover:scale-105 shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Kategori Baru
                        </button>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Footer with Subtle Blue Tint -->
        <div class="mt-12 pt-8 border-t border-indigo-100/30 text-center">
            <p class="text-sm text-gray-500">
                &copy; {{ date('Y') }} Sistem Inventaris. Dibuat dengan ❤️ untuk efisiensi.
            </p>
        </div>
    </div>
</div>

<!-- Custom Styles for Blue-Purple Theme -->
<style>
/* Keyframe Animations */
@keyframes fadeInDown {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(15px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-fade-in-down { animation: fadeInDown 0.8s ease-out forwards; }
.animate-fade-in { animation: fadeIn 0.6s ease-out forwards; }

/* Staggered Card Animations */
.category-card:nth-child(1) { animation-delay: 0.1s; }
.category-card:nth-child(2) { animation-delay: 0.2s; }
.category-card:nth-child(3) { animation-delay: 0.3s; }
.category-card:nth-child(4) { animation-delay: 0.4s; }
.category-card:nth-child(5) { animation-delay: 0.5s; }
.category-card:nth-child(6) { animation-delay: 0.6s; }
.category-card:nth-child(7) { animation-delay: 0.7s; }
.category-card:nth-child(8) { animation-delay: 0.8s; }

/* Custom Scrollbar with Blue Tint */
::-webkit-scrollbar { width: 8px; }
::-webkit-scrollbar-track { background: #eff6ff; border-radius: 4px; }
::-webkit-scrollbar-thumb { background: #c7d2fe; border-radius: 4px; }
::-webkit-scrollbar-thumb:hover { background: #a5b4fc; }

/* Print Styles */
@media print {
    .shadow-lg, .hover\:shadow-lg { box-shadow: none !important; }
}
</style>

<!-- JavaScript for Interactions -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Staggered animations for cards
    const cards = document.querySelectorAll('a[href*="inventaris"]');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${(index + 1) * 0.1}s`;
        card.classList.add('animate-fade-in', 'category-card');
    });
    
    // Hover effects for stats
    const statCards = document.querySelectorAll('.rounded-2xl');
    statCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-4px) scale(1.02)';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0) scale(1)';
        });
    });
});
</script>
@endsection