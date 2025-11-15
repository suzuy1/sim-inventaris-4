{{-- 
File: resources/views/inventaris/pilih-jenis.blade.php (IMPROVED VERSION - LOGO & COLOR MATCHING)
--}}
@extends('dashboard') 

@section('title', 'Pilih Jenis Inventaris')
@section('subtitle', 'Pilih kategori untuk melihat daftar inventaris')

@section('content')
<!-- Hero Section dengan Bubble Bubble Lebih Banyak -->
<div class="relative bg-white overflow-hidden">
    <!-- Background dengan Bubble Bubble Super -->
    <div class="absolute inset-0 overflow-hidden">
        <!-- Gradient utama dengan animasi -->
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 animate-gradient-flow"></div>
        
        <!-- Orbital bubbles besar -->
        <div class="absolute top-0 right-0 -mt-24 mr-24 w-72 h-72 bg-blue-200 rounded-full opacity-40 blur-3xl animate-orbital-1"></div>
        <div class="absolute bottom-0 left-0 -mb-24 ml-24 w-72 h-72 bg-purple-200 rounded-full opacity-40 blur-3xl animate-orbital-2"></div>
        <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-indigo-200 rounded-full opacity-30 blur-3xl animate-orbital-3"></div>
        
        <!-- Bubble Cluster 1 - Kiri Atas -->
        <div class="absolute top-1/4 left-1/4 w-6 h-6 bg-blue-300 rounded-full opacity-70 animate-bubble-1"></div>
        <div class="absolute top-1/3 left-1/5 w-4 h-4 bg-indigo-400 rounded-full opacity-60 animate-bubble-2"></div>
        <div class="absolute top-1/5 left-1/3 w-8 h-8 bg-purple-300 rounded-full opacity-50 animate-bubble-3"></div>
        <div class="absolute top-1/6 left-1/6 w-3 h-3 bg-blue-400 rounded-full opacity-80 animate-bubble-4"></div>
        <div class="absolute top-1/4 left-1/8 w-5 h-5 bg-indigo-300 rounded-full opacity-65 animate-bubble-5"></div>
        
        <!-- Bubble Cluster 2 - Kanan Bawah -->
        <div class="absolute bottom-1/4 right-1/4 w-7 h-7 bg-purple-400 rounded-full opacity-55 animate-bubble-6"></div>
        <div class="absolute bottom-1/3 right-1/5 w-5 h-5 bg-blue-300 rounded-full opacity-70 animate-bubble-7"></div>
        <div class="absolute bottom-1/5 right-1/3 w-9 h-9 bg-indigo-300 rounded-full opacity-45 animate-bubble-8"></div>
        <div class="absolute bottom-1/6 right-1/6 w-4 h-4 bg-purple-500 rounded-full opacity-75 animate-bubble-9"></div>
        <div class="absolute bottom-1/4 right-1/8 w-6 h-6 bg-blue-400 rounded-full opacity-60 animate-bubble-10"></div>
        
        <!-- Bubble Cluster 3 - Tengah -->
        <div class="absolute top-1/2 left-1/2 w-5 h-5 bg-indigo-400 rounded-full opacity-65 animate-bubble-11"></div>
        <div class="absolute top-2/5 left-2/5 w-3 h-3 bg-purple-300 rounded-full opacity-85 animate-bubble-12"></div>
        <div class="absolute top-3/5 left-3/5 w-7 h-7 bg-blue-300 rounded-full opacity-50 animate-bubble-13"></div>
        <div class="absolute top-2/5 left-3/5 w-4 h-4 bg-indigo-500 rounded-full opacity-70 animate-bubble-14"></div>
        <div class="absolute top-3/5 left-2/5 w-6 h-6 bg-purple-400 rounded-full opacity-55 animate-bubble-15"></div>
        
        <!-- Bubble Cluster 4 - Pinggir -->
        <div class="absolute top-1/10 left-1/10 w-4 h-4 bg-blue-400 rounded-full opacity-80 animate-bubble-16"></div>
        <div class="absolute top-1/10 right-1/10 w-5 h-5 bg-indigo-300 rounded-full opacity-65 animate-bubble-17"></div>
        <div class="absolute bottom-1/10 left-1/10 w-6 h-6 bg-purple-300 rounded-full opacity-60 animate-bubble-18"></div>
        <div class="absolute bottom-1/10 right-1/10 w-3 h-3 bg-blue-500 rounded-full opacity-90 animate-bubble-19"></div>
        
        <!-- Bubble Cluster 5 - Extra Random -->
        <div class="absolute top-3/4 left-1/4 w-4 h-4 bg-indigo-400 rounded-full opacity-75 animate-bubble-20"></div>
        <div class="absolute top-1/4 right-3/4 w-5 h-5 bg-purple-300 rounded-full opacity-65 animate-bubble-21"></div>
        <div class="absolute bottom-3/4 right-1/4 w-6 h-6 bg-blue-400 rounded-full opacity-55 animate-bubble-22"></div>
        <div class="absolute top-3/4 right-3/4 w-3 h-3 bg-indigo-500 rounded-full opacity-85 animate-bubble-23"></div>
        
        <!-- Micro Bubbles (Super Kecil) -->
        <div class="absolute top-1/3 left-2/3 w-2 h-2 bg-blue-300 rounded-full opacity-90 animate-micro-1"></div>
        <div class="absolute top-2/3 left-1/3 w-1.5 h-1.5 bg-purple-400 rounded-full opacity-80 animate-micro-2"></div>
        <div class="absolute top-1/5 right-2/5 w-2 h-2 bg-indigo-300 rounded-full opacity-95 animate-micro-3"></div>
        <div class="absolute bottom-1/5 left-2/5 w-1.5 h-1.5 bg-blue-500 rounded-full opacity-85 animate-micro-4"></div>
        
        <!-- Wave effect -->
        <div class="absolute bottom-0 left-0 w-full h-32 bg-gradient-to-t from-blue-100/40 to-transparent animate-wave"></div>
    </div>
    
    <!-- Content -->
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">
        <div class="text-center animate-fade-in-down">
            <h1 class="text-4xl lg:text-6xl font-bold bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 bg-clip-text text-transparent mb-6 tracking-tight">
                Kelola Inventaris
            </h1>
            <p class="text-xl lg:text-2xl text-gray-700 max-w-3xl mx-auto leading-relaxed">
                Pilih kategori inventaris untuk mengelola aset kampus.
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
                                
                                <!-- Background Accent: Dynamic Color Matching -->
                                <div class="absolute top-0 right-0 w-20 h-20 -mt-10 -mr-10 rounded-full 
                                            transition-all duration-500 opacity-0 group-hover:opacity-100 blur-sm
                                            @switch($index % 6)
                                                @case(0) bg-gradient-to-br from-blue-100/60 to-indigo-100/60 @break
                                                @case(1) bg-gradient-to-br from-indigo-100/60 to-purple-100/60 @break
                                                @case(2) bg-gradient-to-br from-purple-100/60 to-pink-100/60 @break
                                                @case(3) bg-gradient-to-br from-green-100/60 to-emerald-100/60 @break
                                                @case(4) bg-gradient-to-br from-orange-100/60 to-amber-100/60 @break
                                                @case(5) bg-gradient-to-br from-cyan-100/60 to-sky-100/60 @break
                                            @endswitch
                                            group-hover:from-blue-200/80 group-hover:to-purple-200/80"></div>
                                
                                <!-- Content -->
                                <div class="relative z-10">
                                    <!-- Icon Container with Enhanced Color Matching -->
                                    <div class="w-16 h-16 mb-5 rounded-2xl flex items-center justify-center
                                                transition-all duration-300 group-hover:rotate-6
                                                @switch($index % 6)
                                                    @case(0) bg-gradient-to-br from-blue-100 to-indigo-100 group-hover:from-blue-200 group-hover:to-indigo-200 @break
                                                    @case(1) bg-gradient-to-br from-indigo-100 to-purple-100 group-hover:from-indigo-200 group-hover:to-purple-200 @break
                                                    @case(2) bg-gradient-to-br from-purple-100 to-pink-100 group-hover:from-purple-200 group-hover:to-pink-200 @break
                                                    @case(3) bg-gradient-to-br from-green-100 to-emerald-100 group-hover:from-green-200 group-hover:to-emerald-200 @break
                                                    @case(4) bg-gradient-to-br from-orange-100 to-amber-100 group-hover:from-orange-200 group-hover:to-amber-200 @break
                                                    @case(5) bg-gradient-to-br from-cyan-100 to-sky-100 group-hover:from-cyan-200 group-hover:to-sky-200 @break
                                                @endswitch">
                                        
                                        <!-- Enhanced Icons with Category-Specific Colors -->
                                        @php
                                            $kategoriLower = strtolower($kategori);
                                        @endphp
                                        
                                        @if(str_contains($kategoriLower, 'elektronik') || str_contains($kategoriLower, 'komputer') || str_contains($kategoriLower, 'laptop') || str_contains($kategoriLower, 'gadget'))
                                            <!-- Electronics - Blue Tech Theme -->
                                            <div class="relative">
                                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                </svg>
                                                <!-- Tech accent -->
                                                <div class="absolute -top-1 -right-1 w-3 h-3 bg-blue-500 rounded-full animate-pulse"></div>
                                            </div>
                                        @elseif(str_contains($kategoriLower, 'mebel') || str_contains($kategoriLower, 'furniture') || str_contains($kategoriLower, 'perabot') || str_contains($kategoriLower, 'kursi') || str_contains($kategoriLower, 'meja'))
                                            <!-- Furniture - Warm Wood Theme -->
                                            <div class="relative">
                                                <svg class="w-8 h-8 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                                </svg>
                                                <!-- Wood accent -->
                                                <div class="absolute -bottom-1 -left-1 w-3 h-3 bg-amber-600 rounded-full animate-pulse"></div>
                                            </div>
                                        @elseif(str_contains($kategoriLower, 'kendaraan') || str_contains($kategoriLower, 'mobil') || str_contains($kategoriLower, 'motor') || str_contains($kategoriLower, 'sepeda') || str_contains($kategoriLower, 'transport'))
                                            <!-- Vehicles - Road Theme -->
                                            <div class="relative">
                                                <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                                </svg>
                                                <!-- Speed accent -->
                                                <div class="absolute -top-1 -right-1 w-3 h-3 bg-gray-600 rounded-full animate-pulse"></div>
                                            </div>
                                        @elseif(str_contains($kategoriLower, 'alat') || str_contains($kategoriLower, 'tools') || str_contains($kategoriLower, 'perkakas') || str_contains($kategoriLower, 'mesin'))
                                            <!-- Tools - Industrial Theme -->
                                            <div class="relative">
                                                <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                <!-- Tool accent -->
                                                <div class="absolute -bottom-1 -right-1 w-3 h-3 bg-orange-500 rounded-full animate-pulse"></div>
                                            </div>
                                        @elseif(str_contains($kategoriLower, 'atk') || str_contains($kategoriLower, 'alat tulis') || str_contains($kategoriLower, 'office') || str_contains($kategoriLower, 'stationery'))
                                            <!-- Office Supplies - Purple Theme -->
                                            <div class="relative">
                                                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                                </svg>
                                                <!-- Pen accent -->
                                                <div class="absolute -top-1 -left-1 w-3 h-3 bg-purple-500 rounded-full animate-pulse"></div>
                                            </div>
                                        @elseif(str_contains($kategoriLower, 'buku') || str_contains($kategoriLower, 'dokumen') || str_contains($kategoriLower, 'buku besar') || str_contains($kategoriLower, 'archieve'))
                                            <!-- Books & Documents - Green Theme -->
                                            <div class="relative">
                                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                                </svg>
                                                <!-- Book accent -->
                                                <div class="absolute -bottom-1 -right-1 w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                                            </div>
                                        @elseif(str_contains($kategoriLower, 'pakaian') || str_contains($kategoriLower, 'seragam') || str_contains($kategoriLower, 'textile') || str_contains($kategoriLower, 'kain'))
                                            <!-- Clothing - Pink Theme -->
                                            <div class="relative">
                                                <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                </svg>
                                                <!-- Fashion accent -->
                                                <div class="absolute -top-1 -right-1 w-3 h-3 bg-pink-500 rounded-full animate-pulse"></div>
                                            </div>
                                        @elseif(str_contains($kategoriLower, 'makanan') || str_contains($kategoriLower, 'minuman') || str_contains($kategoriLower, 'catering') || str_contains($kategoriLower, 'bahan makanan'))
                                            <!-- Food & Beverage - Orange Theme -->
                                            <div class="relative">
                                                <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                                </svg>
                                                <!-- Food accent -->
                                                <div class="absolute -bottom-1 -left-1 w-3 h-3 bg-orange-500 rounded-full animate-pulse"></div>
                                            </div>
                                        @elseif(str_contains($kategoriLower, 'obat') || str_contains($kategoriLower, 'medis') || str_contains($kategoriLower, 'health') || str_contains($kategoriLower, 'farmasi'))
                                            <!-- Medical - Red Theme -->
                                            <div class="relative">
                                                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                                </svg>
                                                <!-- Medical accent -->
                                                <div class="absolute -top-1 -left-1 w-3 h-3 bg-red-500 rounded-full animate-pulse"></div>
                                            </div>
                                        @else
                                            <!-- Default Enhanced Icons with Color Cycling -->
                                            @switch($index % 8)
                                                @case(0)
                                                    <!-- Archive - Teal -->
                                                    <div class="relative">
                                                        <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                                        </svg>
                                                        <div class="absolute -bottom-1 -right-1 w-3 h-3 bg-teal-500 rounded-full animate-pulse"></div>
                                                    </div>
                                                    @break
                                                @case(1)
                                                    <!-- Box - Sky Blue -->
                                                    <div class="relative">
                                                        <svg class="w-8 h-8 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                        </svg>
                                                        <div class="absolute -top-1 -left-1 w-3 h-3 bg-sky-500 rounded-full animate-pulse"></div>
                                                    </div>
                                                    @break
                                                @case(2)
                                                    <!-- Package - Emerald -->
                                                    <div class="relative">
                                                        <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                                                        </svg>
                                                        <div class="absolute -bottom-1 -left-1 w-3 h-3 bg-emerald-500 rounded-full animate-pulse"></div>
                                                    </div>
                                                    @break
                                                @case(3)
                                                    <!-- Tag - Violet -->
                                                    <div class="relative">
                                                        <svg class="w-8 h-8 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                                        </svg>
                                                        <div class="absolute -top-1 -right-1 w-3 h-3 bg-violet-500 rounded-full animate-pulse"></div>
                                                    </div>
                                                    @break
                                                @case(4)
                                                    <!-- Document - Lime -->
                                                    <div class="relative">
                                                        <svg class="w-8 h-8 text-lime-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                                        </svg>
                                                        <div class="absolute -bottom-1 -right-1 w-3 h-3 bg-lime-500 rounded-full animate-pulse"></div>
                                                    </div>
                                                    @break
                                                @case(5)
                                                    <!-- Storage - Rose -->
                                                    <div class="relative">
                                                        <svg class="w-8 h-8 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                                        </svg>
                                                        <div class="absolute -top-1 -left-1 w-3 h-3 bg-rose-500 rounded-full animate-pulse"></div>
                                                    </div>
                                                    @break
                                                @case(6)
                                                    <!-- Files - Indigo -->
                                                    <div class="relative">
                                                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                        </svg>
                                                        <div class="absolute -bottom-1 -left-1 w-3 h-3 bg-indigo-500 rounded-full animate-pulse"></div>
                                                    </div>
                                                    @break
                                                @default
                                                    <!-- Box Open - Cyan -->
                                                    <div class="relative">
                                                        <svg class="w-8 h-8 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                                        </svg>
                                                        <div class="absolute -top-1 -right-1 w-3 h-3 bg-cyan-500 rounded-full animate-pulse"></div>
                                                    </div>
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
                                
                                <!-- Gradient Bottom Border: Dynamic Color Matching -->
                                <div class="absolute bottom-0 left-0 w-0 h-0.5 
                                            @switch($index % 6)
                                                @case(0) bg-gradient-to-r from-blue-500 to-indigo-500 @break
                                                @case(1) bg-gradient-to-r from-indigo-500 to-purple-500 @break
                                                @case(2) bg-gradient-to-r from-purple-500 to-pink-500 @break
                                                @case(3) bg-gradient-to-r from-green-500 to-emerald-500 @break
                                                @case(4) bg-gradient-to-r from-orange-500 to-amber-500 @break
                                                @case(5) bg-gradient-to-r from-cyan-500 to-sky-500 @break
                                            @endswitch
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

<!-- Enhanced Custom Styles for Improved Logo & Color Matching -->
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
@keyframes pulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.7; transform: scale(1.1); }
}

.animate-fade-in-down { animation: fadeInDown 0.8s ease-out forwards; }
.animate-fade-in { animation: fadeIn 0.6s ease-out forwards; }
.animate-pulse { animation: pulse 2s infinite; }

/* Staggered Card Animations */
.category-card:nth-child(1) { animation-delay: 0.1s; }
.category-card:nth-child(2) { animation-delay: 0.2s; }
.category-card:nth-child(3) { animation-delay: 0.3s; }
.category-card:nth-child(4) { animation-delay: 0.4s; }
.category-card:nth-child(5) { animation-delay: 0.5s; }
.category-card:nth-child(6) { animation-delay: 0.6s; }
.category-card:nth-child(7) { animation-delay: 0.7s; }
.category-card:nth-child(8) { animation-delay: 0.8s; }

/* Custom Scrollbar with Enhanced Blue Tint */
::-webkit-scrollbar { width: 8px; }
::-webkit-scrollbar-track { background: #eff6ff; border-radius: 4px; }
::-webkit-scrollbar-thumb { background: linear-gradient(to bottom, #c7d2fe, #a5b4fc); border-radius: 4px; }
::-webkit-scrollbar-thumb:hover { background: linear-gradient(to bottom, #a5b4fc, #818cf8); }

/* Enhanced Hover Effects for Cards */
.group:hover .bg-gradient-to-br {
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

/* Pulse Animation for Accent Dots */
.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

/* Print Styles */
@media print {
    .shadow-lg, .hover\:shadow-lg { box-shadow: none !important; }
}

/* Responsive Enhancements */
@media (max-width: 640px) {
    .group:hover {
        transform: scale(1.01);
    }
}

/* Accessibility Improvements */
@media (prefers-reduced-motion: reduce) {
    .animate-fade-in-down,
    .animate-fade-in,
    .animate-pulse {
        animation: none;
    }
    
    .group:hover {
        transform: none;
    }
}

/* Focus States */
.focus\:ring-blue-200\/50:focus {
    --tw-ring-color: rgb(199 210 254 / 0.5);
}

/* Enhanced Gradient Text */
.bg-gradient-to-r.bg-clip-text {
    -webkit-background-clip: text;
    background-clip: text;
}

/* Keyframe Animations untuk Bubble Bubble Lebih Banyak */
@keyframes gradientFlow {
    0%, 100% {
        background-position: 0% 50%;
        background-size: 200% 200%;
    }
    50% {
        background-position: 100% 50%;
        background-size: 200% 200%;
    }
}

@keyframes orbital1 {
    0% { transform: translate(0, 0) rotate(0deg); opacity: 0.4; }
    25% { transform: translate(20px, -15px) rotate(90deg); opacity: 0.5; }
    50% { transform: translate(0, -30px) rotate(180deg); opacity: 0.3; }
    75% { transform: translate(-20px, -15px) rotate(270deg); opacity: 0.5; }
    100% { transform: translate(0, 0) rotate(360deg); opacity: 0.4; }
}

@keyframes orbital2 {
    0% { transform: translate(0, 0) rotate(0deg); opacity: 0.4; }
    25% { transform: translate(-15px, 20px) rotate(-90deg); opacity: 0.5; }
    50% { transform: translate(0, 40px) rotate(-180deg); opacity: 0.3; }
    75% { transform: translate(15px, 20px) rotate(-270deg); opacity: 0.5; }
    100% { transform: translate(0, 0) rotate(-360deg); opacity: 0.4; }
}

@keyframes orbital3 {
    0% { transform: translate(0, 0) rotate(0deg) scale(1); opacity: 0.3; }
    33% { transform: translate(30px, -10px) rotate(120deg) scale(1.1); opacity: 0.4; }
    66% { transform: translate(-20px, 25px) rotate(240deg) scale(0.9); opacity: 0.2; }
    100% { transform: translate(0, 0) rotate(360deg) scale(1); opacity: 0.3; }
}

/* Bubble Animations - Setiap bubble punya pattern unik */
@keyframes bubble1 {
    0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.7; }
    25% { transform: translate(15px, -20px) scale(1.1); opacity: 0.9; }
    50% { transform: translate(30px, 10px) scale(0.9); opacity: 0.5; }
    75% { transform: translate(15px, 25px) scale(1.2); opacity: 0.8; }
}

@keyframes bubble2 {
    0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.6; }
    20% { transform: translate(-20px, 15px) scale(1.3); opacity: 0.8; }
    40% { transform: translate(-35px, -10px) scale(0.8); opacity: 0.4; }
    60% { transform: translate(-15px, -25px) scale(1.1); opacity: 0.7; }
    80% { transform: translate(10px, -15px) scale(0.9); opacity: 0.5; }
}

@keyframes bubble3 {
    0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.5; }
    33% { transform: translate(25px, 5px) scale(1.4); opacity: 0.7; }
    66% { transform: translate(-15px, 20px) scale(0.7); opacity: 0.3; }
}

@keyframes bubble4 {
    0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.8; }
    50% { transform: translate(-10px, -15px) scale(1.2); opacity: 1; }
}

@keyframes bubble5 {
    0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.65; }
    25% { transform: translate(20px, 10px) scale(1.1); opacity: 0.8; }
    50% { transform: translate(10px, -20px) scale(0.9); opacity: 0.5; }
    75% { transform: translate(-15px, -5px) scale(1.3); opacity: 0.75; }
}

@keyframes bubble6 {
    0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.55; }
    30% { transform: translate(-25px, 15px) scale(1.2); opacity: 0.7; }
    60% { transform: translate(20px, -10px) scale(0.8); opacity: 0.4; }
}

@keyframes bubble7 {
    0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.7; }
    40% { transform: translate(15px, -25px) scale(1.3); opacity: 0.9; }
    80% { transform: translate(-20px, 10px) scale(0.7); opacity: 0.5; }
}

@keyframes bubble8 {
    0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.45; }
    33% { transform: translate(-30px, -5px) scale(1.1); opacity: 0.6; }
    66% { transform: translate(25px, 20px) scale(0.9); opacity: 0.3; }
}

@keyframes bubble9 {
    0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.75; }
    50% { transform: translate(10px, 25px) scale(1.4); opacity: 0.95; }
}

@keyframes bubble10 {
    0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.6; }
    25% { transform: translate(-15px, -20px) scale(1.2); opacity: 0.8; }
    50% { transform: translate(30px, 5px) scale(0.8); opacity: 0.4; }
    75% { transform: translate(-5px, 30px) scale(1.1); opacity: 0.7; }
}

/* Bubble 11-15 */
@keyframes bubble11 {
    0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.65; }
    20% { transform: translate(20px, -15px) scale(1.3); opacity: 0.85; }
    40% { transform: translate(-10px, 25px) scale(0.9); opacity: 0.5; }
    60% { transform: translate(25px, 10px) scale(1.1); opacity: 0.7; }
    80% { transform: translate(-15px, -20px) scale(0.8); opacity: 0.45; }
}

@keyframes bubble12 {
    0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.85; }
    33% { transform: translate(-25px, 5px) scale(1.4); opacity: 1; }
    66% { transform: translate(15px, -25px) scale(0.6); opacity: 0.6; }
}

@keyframes bubble13 {
    0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.5; }
    50% { transform: translate(30px, 15px) scale(1.5); opacity: 0.8; }
}

@keyframes bubble14 {
    0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.7; }
    25% { transform: translate(-20px, -10px) scale(1.2); opacity: 0.9; }
    50% { transform: translate(10px, 30px) scale(0.8); opacity: 0.5; }
    75% { transform: translate(25px, -15px) scale(1.1); opacity: 0.75; }
}

@keyframes bubble15 {
    0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.55; }
    30% { transform: translate(15px, 25px) scale(1.3); opacity: 0.75; }
    60% { transform: translate(-30px, -5px) scale(0.7); opacity: 0.35; }
}

/* Bubble 16-23 */
@keyframes bubble16 {
    0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.8; }
    50% { transform: translate(-25px, 20px) scale(1.4); opacity: 1; }
}

@keyframes bubble17 {
    0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.65; }
    33% { transform: translate(30px, -15px) scale(1.1); opacity: 0.8; }
    66% { transform: translate(-20px, 25px) scale(0.9); opacity: 0.5; }
}

@keyframes bubble18 {
    0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.6; }
    25% { transform: translate(-15px, -25px) scale(1.2); opacity: 0.8; }
    50% { transform: translate(25px, 10px) scale(0.8); opacity: 0.4; }
    75% { transform: translate(-10px, 30px) scale(1.3); opacity: 0.7; }
}

@keyframes bubble19 {
    0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.9; }
    40% { transform: translate(20px, 15px) scale(1.5); opacity: 1; }
    80% { transform: translate(-25px, -10px) scale(0.5); opacity: 0.7; }
}

@keyframes bubble20 {
    0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.75; }
    33% { transform: translate(25px, -20px) scale(1.3); opacity: 0.95; }
    66% { transform: translate(-15px, 25px) scale(0.7); opacity: 0.55; }
}

@keyframes bubble21 {
    0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.65; }
    50% { transform: translate(-30px, 10px) scale(1.4); opacity: 0.85; }
}

@keyframes bubble22 {
    0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.55; }
    25% { transform: translate(15px, 30px) scale(1.1); opacity: 0.75; }
    50% { transform: translate(-25px, -15px) scale(0.9); opacity: 0.4; }
    75% { transform: translate(30px, -10px) scale(1.2); opacity: 0.65; }
}

@keyframes bubble23 {
    0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.85; }
    33% { transform: translate(-20px, -25px) scale(1.5); opacity: 1; }
    66% { transform: translate(25px, 15px) scale(0.5); opacity: 0.6; }
}

/* Micro Bubbles */
@keyframes micro1 {
    0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.9; }
    50% { transform: translate(10px, -15px) scale(1.5); opacity: 1; }
}

@keyframes micro2 {
    0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.8; }
    50% { transform: translate(-12px, 8px) scale(1.3); opacity: 0.95; }
}

@keyframes micro3 {
    0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.95; }
    50% { transform: translate(8px, 12px) scale(1.6); opacity: 1; }
}

@keyframes micro4 {
    0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.85; }
    50% { transform: translate(-8px, -10px) scale(1.4); opacity: 1; }
}

@keyframes wave {
    0%, 100% { transform: translateY(0) scaleY(1); opacity: 0.4; }
    50% { transform: translateY(-10px) scaleY(1.2); opacity: 0.6; }
}

/* Animation Classes */
.animate-gradient-flow {
    background: linear-gradient(-45deg, #dbeafe, #e0e7ff, #f3e8ff, #e0f2fe);
    background-size: 400% 400%;
    animation: gradientFlow 15s ease infinite;
}

.animate-orbital-1 { animation: orbital1 20s linear infinite; }
.animate-orbital-2 { animation: orbital2 25s linear infinite; }
.animate-orbital-3 { animation: orbital3 30s linear infinite; }

/* Bubble Animation Classes */
.animate-bubble-1 { animation: bubble1 18s ease-in-out infinite; }
.animate-bubble-2 { animation: bubble2 22s ease-in-out infinite; }
.animate-bubble-3 { animation: bubble3 16s ease-in-out infinite; }
.animate-bubble-4 { animation: bubble4 14s ease-in-out infinite; }
.animate-bubble-5 { animation: bubble5 20s ease-in-out infinite; }
.animate-bubble-6 { animation: bubble6 19s ease-in-out infinite; }
.animate-bubble-7 { animation: bubble7 21s ease-in-out infinite; }
.animate-bubble-8 { animation: bubble8 17s ease-in-out infinite; }
.animate-bubble-9 { animation: bubble9 15s ease-in-out infinite; }
.animate-bubble-10 { animation: bubble10 23s ease-in-out infinite; }
.animate-bubble-11 { animation: bubble11 18s ease-in-out infinite; }
.animate-bubble-12 { animation: bubble12 16s ease-in-out infinite; }
.animate-bubble-13 { animation: bubble13 22s ease-in-out infinite; }
.animate-bubble-14 { animation: bubble14 19s ease-in-out infinite; }
.animate-bubble-15 { animation: bubble15 21s ease-in-out infinite; }
.animate-bubble-16 { animation: bubble16 17s ease-in-out infinite; }
.animate-bubble-17 { animation: bubble17 20s ease-in-out infinite; }
.animate-bubble-18 { animation: bubble18 18s ease-in-out infinite; }
.animate-bubble-19 { animation: bubble19 14s ease-in-out infinite; }
.animate-bubble-20 { animation: bubble20 22s ease-in-out infinite; }
.animate-bubble-21 { animation: bubble21 19s ease-in-out infinite; }
.animate-bubble-22 { animation: bubble22 21s ease-in-out infinite; }
.animate-bubble-23 { animation: bubble23 16s ease-in-out infinite; }

.animate-micro-1 { animation: micro1 12s ease-in-out infinite; }
.animate-micro-2 { animation: micro2 11s ease-in-out infinite; }
.animate-micro-3 { animation: micro3 13s ease-in-out infinite; }
.animate-micro-4 { animation: micro4 10s ease-in-out infinite; }

.animate-wave { animation: wave 8s ease-in-out infinite; }

/* Efek glowing untuk beberapa bubble */
.animate-bubble-1, .animate-bubble-9, .animate-bubble-19 {
    filter: drop-shadow(0 0 8px rgba(59, 130, 246, 0.3));
}

.animate-bubble-4, .animate-bubble-12, .animate-bubble-23 {
    filter: drop-shadow(0 0 6px rgba(139, 92, 246, 0.3));
}

/* Color Theme Variables */
:root {
    --color-electronics: #2563eb; /* Blue */
    --color-furniture: #d97706; /* Amber */
    --color-vehicles: #374151; /* Gray */
    --color-tools: #ea580c; /* Orange */
    --color-office: #9333ea; /* Purple */
    --color-books: #16a34a; /* Green */
    --color-clothing: #db2777; /* Pink */
    --color-food: #ea580c; /* Orange */
    --color-medical: #dc2626; /* Red */
}
</style>

<!-- Enhanced JavaScript for Better Interactions -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Staggered animations for cards
    const cards = document.querySelectorAll('a[href*="inventaris"]');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${(index + 1) * 0.1}s`;
        card.classList.add('animate-fade-in', 'category-card');
    });
    
    // Enhanced hover effects for stats
    const statCards = document.querySelectorAll('.rounded-2xl');
    statCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-4px) scale(1.02)';
            card.style.boxShadow = '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0) scale(1)';
            card.style.boxShadow = '';
        });
    });

    // Enhanced card hover effects with color transitions
    cards.forEach((card, index) => {
        const icon = card.querySelector('svg');
        const accentDot = card.querySelector('.animate-pulse');
        
        if (icon) {
            card.addEventListener('mouseenter', () => {
                icon.style.transform = 'scale(1.1) rotate(5deg)';
                icon.style.transition = 'all 0.3s ease';
            });
            
            card.addEventListener('mouseleave', () => {
                icon.style.transform = 'scale(1) rotate(0deg)';
            });
        }
        
        if (accentDot) {
            card.addEventListener('mouseenter', () => {
                accentDot.style.transform = 'scale(1.2)';
                accentDot.style.transition = 'all 0.3s ease';
            });
            
            card.addEventListener('mouseleave', () => {
                accentDot.style.transform = 'scale(1)';
            });
        }
    });

    // Keyboard navigation enhancement
    cards.forEach(card => {
        card.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                card.click();
            }
        });
    });

    // Smooth scroll for better UX
    if (window.location.hash) {
        const target = document.querySelector(window.location.hash);
        if (target) {
            target.scrollIntoView({ behavior: 'smooth' });
        }
    }
});
</script>
@endsection