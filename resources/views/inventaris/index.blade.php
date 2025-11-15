@extends('dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50/20 p-4 sm:p-6 lg:p-8">
    <!-- Header Section dengan Glassmorphism -->
    <div class="mb-8 animate-fade-in">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <!-- Title & Info -->
            <div class="flex-1">
                <div class="flex items-center gap-4 mb-4">
                    <div class="p-3 bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20">
                        <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 bg-gradient-to-r from-gray-900 to-gray-700 bg-clip-text text-transparent">
                            @if(isset($kategori) && $kategori)
                                Manajemen Inventaris - <span class="capitalize">{{ $kategori }}</span>
                            @else
                                Manajemen Inventaris
                            @endif
                        </h1>
                        <p class="mt-2 text-sm text-gray-600 max-w-2xl">
                            @if(isset($kategori) && $kategori)
                                Kelola dan pantau inventaris kategori <span class="font-semibold text-indigo-600">{{ $kategori }}</span>. 
                                Data dikelompokkan berdasarkan nama barang untuk kemudahan analisis.
                            @else
                                Kelola dan pantau semua barang inventaris dalam satu dashboard terpusat. 
                                Data dikelompokkan secara smart untuk kemudahan analisis.
                            @endif
                        </p>
                    </div>
                </div>
                
                <!-- Breadcrumb & Filter -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-4">
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
                        @if(isset($kategori) && $kategori)
                            <a href="{{ route('inventaris.pilih_jenis') }}" 
                               class="hover:text-indigo-600 transition-colors duration-200">
                                Jenis Inventaris
                            </a>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            <span class="text-gray-900 font-medium capitalize">{{ $kategori }}</span>
                        @else
                            <span class="text-gray-900 font-medium">Semua Inventaris</span>
                        @endif
                    </nav>
                    
                    <!-- Quick Stats -->
                    <div class="flex items-center gap-4 text-xs text-gray-500">
                        <span class="flex items-center gap-1">
                            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                            {{ $inventaris->total() }} items
                        </span>
                        <span class="flex items-center gap-1">
                            <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                            {{ $inventaris->count() }} jenis
                        </span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons - Enhanced -->
            <div class="flex flex-col sm:flex-row gap-3">
                <!-- Tambah Inventaris -->
                <a href="{{ route('inventaris.create', ['kategori' => request('kategori')]) }}"
                   class="group relative inline-flex items-center justify-center gap-3 overflow-hidden rounded-2xl bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 px-6 py-4 text-sm font-semibold text-white shadow-2xl transition-all duration-500 hover:scale-105 hover:shadow-indigo-500/50 active:scale-95"
                   aria-label="Tambah inventaris baru">
                    <!-- Animated Background -->
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                    
                    <!-- Icon -->
                    <div class="relative p-1.5 bg-white/20 rounded-lg backdrop-blur-sm">
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                    
                    <span class="relative">Tambah</span>
                    
                    <!-- Corner Accent -->
                    <div class="absolute right-2 top-2 w-2 h-2 bg-white/40 rounded-full group-hover:scale-150 transition-transform duration-300"></div>
                </a>

                <!-- Action Menu -->
                <div class="relative group">
                    <button class="inline-flex items-center justify-center gap-2 rounded-2xl bg-white/80 backdrop-blur-sm border border-gray-200 px-4 py-4 text-sm font-semibold text-gray-700 shadow-lg hover:shadow-xl transition-all duration-300 hover:bg-white hover:border-gray-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                        </svg>
                    </button>
                    
                    <!-- Dropdown Menu -->
                    <div class="absolute right-0 top-full mt-2 w-64 origin-top-right rounded-2xl bg-white/95 backdrop-blur-xl shadow-2xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform scale-95 group-hover:scale-100 z-50">
                        <div class="p-2">
                            <!-- Import -->
                            <button onclick="document.getElementById('importModal').classList.remove('hidden')"
                                    class="flex items-center gap-3 w-full px-4 py-3 text-sm text-gray-700 rounded-xl hover:bg-indigo-50 hover:text-indigo-700 transition-all duration-200 group">
                                <div class="p-2 bg-emerald-100 rounded-lg group-hover:bg-emerald-200 transition-colors">
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                                    </svg>
                                </div>
                                <div class="flex-1 text-left">
                                    <div class="font-medium">Impor Data</div>
                                    <div class="text-xs text-gray-500">Upload file Excel</div>
                                </div>
                            </button>
                            
                            <!-- Export -->
                            <a href="{{ route('inventaris.export') }}"
                               class="flex items-center gap-3 w-full px-4 py-3 text-sm text-gray-700 rounded-xl hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 group mt-1">
                                <div class="p-2 bg-blue-100 rounded-lg group-hover:bg-blue-200 transition-colors">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                </div>
                                <div class="flex-1 text-left">
                                    <div class="font-medium">Ekspor Data</div>
                                    <div class="text-xs text-gray-500">Download Excel</div>
                                </div>
                            </a>
                            
                            <!-- Print -->
                            <a href="{{ route('inventaris.print_all') }}" target="_blank"
                               class="flex items-center gap-3 w-full px-4 py-3 text-sm text-gray-700 rounded-xl hover:bg-gray-100 hover:text-gray-900 transition-all duration-200 group mt-1">
                                <div class="p-2 bg-gray-100 rounded-lg group-hover:bg-gray-200 transition-colors">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                                    </svg>
                                </div>
                                <div class="flex-1 text-left">
                                    <div class="font-medium">Cetak Laporan</div>
                                    <div class="text-xs text-gray-500">PDF Document</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search & Filter Bar -->
    <div class="mb-8">
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 p-6">
            <form action="{{ route('inventaris.index') }}" method="GET" class="flex flex-col lg:flex-row gap-4">
                <!-- Search Input -->
                <div class="flex-1 relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input
                        type="text"
                        name="search"
                        placeholder="Cari nama barang, kategori, atau keterangan..."
                        class="block w-full rounded-xl bg-white/50 pl-12 pr-4 py-3.5 text-gray-900 shadow-sm ring-1 ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all duration-300"
                        value="{{ request('search') }}"
                    >
                </div>
                
                <!-- Action Buttons -->
                <div class="flex gap-3">
                    <button type="submit"
                            class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-gray-800 to-slate-800 px-6 py-3.5 text-sm font-semibold text-white shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Cari
                    </button>
                    
                    @if(request('search'))
                    <a href="{{ route('inventaris.index') }}"
                       class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-gray-200 to-slate-200 px-6 py-3.5 text-sm font-semibold text-gray-800 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Reset
                    </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
<!-- Statistics Grid dengan Animations -->
<div class="mb-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
    @php
        $stats = [
            [
                'title' => 'Total Barang Baik',
                'value' => $inventaris->sum('total_baik'),
                'subtitle' => 'Dalam kondisi baik',
                'bgColor' => 'bg-gradient-to-br from-emerald-400 to-emerald-600',
                'textColor' => 'text-white',
                'iconBg' => 'bg-white/20',
                'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                'trend' => $percentageData['barang_baik'] > 0 ? 'up' : ($percentageData['barang_baik'] < 0 ? 'down' : 'neutral'),
                'percentage' => ($percentageData['barang_baik'] > 0 ? '+' : '') . $percentageData['barang_baik'] . '%',
                'comparison' => 'vs bulan lalu'
            ],
            [
                'title' => 'Rusak Ringan',
                'value' => $inventaris->sum('total_rusak_ringan'),
                'subtitle' => 'Perlu perbaikan ringan',
                'bgColor' => 'bg-gradient-to-br from-amber-400 to-amber-600',
                'textColor' => 'text-white',
                'iconBg' => 'bg-white/20',
                'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z',
                'trend' => $percentageData['rusak_ringan'] > 5 ? 'warning' : ($percentageData['rusak_ringan'] < 0 ? 'up' : 'neutral'),
                'percentage' => ($percentageData['rusak_ringan'] > 0 ? '+' : '') . $percentageData['rusak_ringan'] . '%',
                'comparison' => 'vs bulan lalu'
            ],
            [
                'title' => 'Rusak Berat',
                'value' => $inventaris->sum('total_rusak_berat'),
                'subtitle' => 'Perlu perbaikan serius',
                'bgColor' => 'bg-gradient-to-br from-rose-400 to-rose-600',
                'textColor' => 'text-white',
                'iconBg' => 'bg-white/20',
                'icon' => 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                'trend' => $percentageData['rusak_berat'] < 0 ? 'up' : ($percentageData['rusak_berat'] > 10 ? 'down' : 'warning'),
                'percentage' => ($percentageData['rusak_berat'] > 0 ? '+' : '') . $percentageData['rusak_berat'] . '%',
                'comparison' => 'vs bulan lalu'
            ],
            [
                'title' => 'Jenis Barang',
                'value' => $inventaris->count(),
                'subtitle' => 'Kategori berbeda',
                'bgColor' => 'bg-gradient-to-br from-blue-400 to-blue-600',
                'textColor' => 'text-white',
                'iconBg' => 'bg-white/20',
                'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10',
                'trend' => $percentageData['jenis_barang'] >= 0 ? 'up' : 'down',
                'percentage' => ($percentageData['jenis_barang'] > 0 ? '+' : '') . $percentageData['jenis_barang'] . '%',
                'comparison' => 'vs bulan lalu'
            ]
        ];
    @endphp

    @foreach($stats as $stat)
    <div class="group relative overflow-hidden rounded-2xl {{ $stat['bgColor'] }} p-6 shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300 cursor-pointer">
        <!-- Animated Background -->
        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
        
        <!-- Content -->
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <div class="flex-1">
                    <p class="text-white/90 text-sm font-medium mb-1">{{ $stat['title'] }}</p>
                    <p class="{{ $stat['textColor'] }} text-4xl font-bold mb-2">{{ number_format($stat['value']) }}</p>
                    <p class="text-white/80 text-xs">{{ $stat['subtitle'] }}</p>
                </div>
                <div class="{{ $stat['iconBg'] }} p-4 rounded-xl text-white backdrop-blur-sm group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}"/>
                    </svg>
                </div>
            </div>
            
            <!-- Status Indicator with Percentage -->
            <div class="pt-4 border-t border-white/20">
                <div class="flex items-center justify-between">
                    <div class="flex items-center text-white/90 text-sm font-medium">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>
                            @if($stat['trend'] == 'up') Optimal
                            @elseif($stat['trend'] == 'warning') Perhatian
                            @elseif($stat['trend'] == 'down') Kritikal
                            @else Normal
                            @endif
                        </span>
                    </div>
                    
                    <!-- Percentage Badge -->
                    <div class="flex flex-col items-end">
                        <div class="flex items-center bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full">
                            @if(str_contains($stat['percentage'], '+'))
                            <svg class="w-4 h-4 mr-1 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                            @elseif(str_contains($stat['percentage'], '-'))
                            <svg class="w-4 h-4 mr-1 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            @else
                            <svg class="w-4 h-4 mr-1 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                            </svg>
                            @endif
                            <span class="text-white text-sm font-semibold">{{ $stat['percentage'] }}</span>
                        </div>
                        <span class="text-white/70 text-xs mt-1">{{ $stat['comparison'] }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

    <!-- Main Table Container -->
    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-2xl border border-white/20 overflow-hidden hover:shadow-3xl transition-all duration-500">
        <!-- Table Header -->
        <div class="px-6 py-5 border-b border-gray-200/50 bg-gradient-to-r from-gray-50/80 to-white/50">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-indigo-100 rounded-lg">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Daftar Inventaris</h3>
                        <p class="text-sm text-gray-500 mt-1">
                            {{ $inventaris->total() }} items ditemukan
                            @if($inventaris->total() > 0)
                                • Halaman {{ $inventaris->currentPage() }} dari {{ $inventaris->lastPage() }}
                            @endif
                        </p>
                    </div>
                </div>
                
                @if($inventaris->isNotEmpty())
                <div class="flex items-center gap-3">
                    <!-- Bulk Actions -->
                    <select class="rounded-xl border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">
                        <option>Aksi Massal</option>
                        <option>Ekspor Terpilih</option>
                        <option>Update Status</option>
                    </select>
                </div>
                @endif
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200/50">
                <thead class="bg-gray-50/80">
                    <tr>
                        <th scope="col" rowspan="2" class="py-4 pl-6 pr-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">No</th>
                        <th scope="col" rowspan="2" class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Inventaris</th>
                        <th scope="col" colspan="3" class="px-4 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider border-b border-gray-200/50">Kondisi Barang</th>
                        <th scope="col" rowspan="2" class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Keterangan</th>
                        <th scope="col" rowspan="2" class="relative py-4 pl-3 pr-6">
                            <span class="sr-only">Aksi</span>
                        </th>
                    </tr>
                    <tr>
                        <th scope="col" class="px-4 py-3 text-center text-xs font-semibold text-gray-500">
                            <span class="inline-flex items-center gap-1">
                                <span class="h-2 w-2 rounded-full bg-green-500 shadow-sm"></span>
                                Baik
                            </span>
                        </th>
                        <th scope="col" class="px-4 py-3 text-center text-xs font-semibold text-gray-500">
                            <span class="inline-flex items-center gap-1">
                                <span class="h-2 w-2 rounded-full bg-yellow-500 shadow-sm"></span>
                                Rusak Ringan
                            </span>
                        </th>
                        <th scope="col" class="px-4 py-3 text-center text-xs font-semibold text-gray-500">
                            <span class="inline-flex items-center gap-1">
                                <span class="h-2 w-2 rounded-full bg-red-500 shadow-sm"></span>
                                Rusak Berat
                            </span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200/30 bg-white/50">
                    @forelse ($inventaris as $item)
                    <tr class="hover:bg-white/80 transition-all duration-300 group border-l-4 border-l-transparent hover:border-l-indigo-500">
                        <td class="whitespace-nowrap py-4 pl-6 pr-3 text-sm font-medium text-gray-900">
                            {{ $loop->iteration + ($inventaris->currentPage() - 1) * $inventaris->perPage() }}
                        </td>
                        <td class="whitespace-nowrap px-4 py-4">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-indigo-50 rounded-lg">
                                    <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900 group-hover:text-gray-800">{{ $item->nama_barang }}</div>
                                    <div class="text-xs text-gray-500 mt-1 capitalize">{{ $item->kategori }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="whitespace-nowrap px-4 py-4 text-sm text-center">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 border border-green-200 shadow-sm">
                                {{ $item->total_baik }}
                            </span>
                        </td>
                        <td class="whitespace-nowrap px-4 py-4 text-sm text-center">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800 border border-yellow-200 shadow-sm">
                                {{ $item->total_rusak_ringan }}
                            </span>
                        </td>
                        <td class="whitespace-nowrap px-4 py-4 text-sm text-center">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800 border border-red-200 shadow-sm">
                                {{ $item->total_rusak_berat }}
                            </span>
                        </td>
                        <td class="px-4 py-4 text-sm text-gray-600 max-w-xs">
                            <div class="truncate group-hover:text-gray-500" title="{{ $item->keterangan }}">
                                {{ $item->keterangan ?: '-' }}
                            </div>
                        </td>
                        <td class="relative whitespace-nowrap py-4 pl-3 pr-6">
                            <div class="flex items-center justify-end gap-2 opacity-70 group-hover:opacity-100 transition-all duration-300">
                                <!-- View Details -->
                                <a href="{{ route('inventaris.show_grouped', $item) }}"
                                   class="inline-flex items-center p-2 text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 rounded-lg transition-all duration-200 tooltip"
                                   data-tip="Lihat Detail">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                                
                                <!-- Edit -->
                                <a href="{{ route('inventaris.edit', $item->id) }}"
                                   class="inline-flex items-center p-2 text-indigo-600 hover:text-indigo-800 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-all duration-200 tooltip"
                                   data-tip="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>

                                <!-- Delete -->
                                <form action="{{ route('inventaris.destroy', $item->id) }}" method="POST" 
                                      class="inline-flex">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirmDelete('{{ addslashes($item->nama_barang) }}', {{ $item->id }});"
                                            class="inline-flex items-center p-2 text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 rounded-lg transition-all duration-200 tooltip"
                                            data-tip="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-16 text-center">
                            <div class="text-center max-w-md mx-auto">
                                <div class="p-4 bg-gradient-to-br from-gray-50 to-blue-50 rounded-2xl inline-flex mb-4">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                              d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m8-8V4a1 1 0 00-1-1h-2a1 1 0 00-1 1v1M9 7h6"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak ada data inventaris</h3>
                                <p class="text-gray-500 mb-6">Mulai dengan menambahkan inventaris baru ke sistem</p>
                                <a href="{{ route('inventaris.create') }}"
                                   class="group inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                    <svg class="w-4 h-4 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Tambah Inventaris Pertama
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($inventaris->hasPages())
        <div class="mt-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="text-sm text-gray-600 bg-white/80 backdrop-blur-sm rounded-xl px-4 py-3 shadow-sm border border-white/20">
                Menampilkan 
                <span class="font-semibold text-gray-900">{{ $inventaris->firstItem() }}</span>
                sampai
                <span class="font-semibold text-gray-900">{{ $inventaris->lastItem() }}</span>
                dari
                <span class="font-semibold text-gray-900">{{ $inventaris->total() }}</span>
                hasil
            </div>
            <div class="bg-white/80 backdrop-blur-sm rounded-xl p-2 shadow-sm border border-white/20">
                {{ $inventaris->links() }}
            </div>
        </div>
    @endif
</div>

<!-- Import Modal (Tetap sama seperti sebelumnya) -->
<div id="importModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <!-- ... modal content sama seperti sebelumnya ... -->
</div>

<!-- Custom Styles -->
<style>
.animate-fade-in {
    animation: fadeIn 0.6s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.tooltip {
    position: relative;
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
    margin-bottom: 5px;
}

.tooltip:hover::before {
    content: '';
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    border: 5px solid transparent;
    border-top-color: #1f2937;
    margin-bottom: -5px;
}
</style>

<script>
function confirmDelete(itemName, itemId) {
    return confirm(`Apakah Anda yakin ingin menghapus master barang "${itemName}" beserta semua unit asetnya?\n\nTindakan ini tidak dapat dibatalkan!`);
}

// Enhanced file upload display
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('file');
    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name;
            if (fileName) {
                const label = document.querySelector('label[for="file"]');
                label.innerHTML = `
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <p class="text-sm font-medium text-gray-900">${fileName}</p>
                        <p class="text-xs text-gray-500 mt-1">File siap diupload</p>
                    </div>
                `;
            }
        });
    }
});
</script>
@endsection