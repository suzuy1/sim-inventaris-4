@extends('dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50/30 p-4 sm:p-6 lg:p-8">
    <!-- Header Section -->
    <div class="mb-8 animate-fade-in">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <!-- Title & Breadcrumb -->
            <div class="flex-1">
                <div class="flex items-center gap-4 mb-4">
                    <div class="p-3 bg-white rounded-2xl shadow-lg border border-gray-100">
                        <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 bg-gradient-to-r from-gray-900 to-gray-700 bg-clip-text text-transparent">
                            Detail Unit Aset
                        </h1>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="text-lg text-indigo-600 font-semibold bg-indigo-50 px-3 py-1 rounded-lg">
                                {{ $inventaris->nama_barang }}
                            </span>
                            <span class="text-gray-400">•</span>
                            <span class="text-sm text-gray-600 bg-gray-100 px-2 py-1 rounded-md">
                                {{ $inventaris->kategori }}
                            </span>
                        </div>
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
                    <a href="{{ route('inventaris.pilih_jenis') }}" 
                       class="hover:text-indigo-600 transition-colors duration-200">
                        Jenis Inventaris
                    </a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <span class="text-gray-900 font-medium">Detail Unit</span>
                </nav>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('inventaris.detail.create', $inventaris) }}" 
                   class="group inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 px-5 py-3.5 text-sm font-semibold text-white shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 hover:from-indigo-700 hover:to-purple-700 active:scale-95">
                    <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Unit Aset
                </a>
                <a href="{{ route('inventaris.index', ['kategori' => $inventaris->kategori]) }}" 
                   class="group inline-flex items-center justify-center gap-2 rounded-xl border border-gray-300 bg-white px-5 py-3.5 text-sm font-semibold text-gray-700 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 hover:bg-gray-50 hover:border-gray-400">
                    <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Index
                </a>
            </div>
        </div>
    </div>

   <!-- Statistics Section - Enhanced -->
<div class="mb-8">
    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
        <div class="p-2 bg-indigo-100 rounded-xl">
            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
        </div>
        Ringkasan Statistik Unit
    </h2>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @php
            $totalUnits = $summaryStatistics->total_units;
            $totalBaik = $summaryStatistics->total_baik;
            $totalRusakRingan = $summaryStatistics->total_rusak_ringan;
            $totalRusakBerat = $summaryStatistics->total_rusak_berat;
            
            // Hitung persentase dari total
            $percentageBaik = $totalUnits > 0 ? round(($totalBaik / $totalUnits) * 100, 1) : 0;
            $percentageRusakRingan = $totalUnits > 0 ? round(($totalRusakRingan / $totalUnits) * 100, 1) : 0;
            $percentageRusakBerat = $totalUnits > 0 ? round(($totalRusakBerat / $totalUnits) * 100, 1) : 0;
            
            $stats = [
                [
                    'title' => 'Total Unit',
                    'value' => $totalUnits,
                    'subtitle' => 'Semua unit aset',
                    'bgColor' => 'bg-gradient-to-br from-blue-400 to-blue-600',
                    'textColor' => 'text-white',
                    'iconBg' => 'bg-white/20',
                    'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10',
                    'percentage' => '100%',
                    'trend' => 'neutral'
                ],
                [
                    'title' => 'Kondisi Baik',
                    'value' => $totalBaik,
                    'subtitle' => 'Siap digunakan',
                    'bgColor' => 'bg-gradient-to-br from-emerald-400 to-emerald-600',
                    'textColor' => 'text-white',
                    'iconBg' => 'bg-white/20',
                    'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                    'percentage' => $percentageBaik . '%',
                    'trend' => $percentageBaik >= 70 ? 'up' : ($percentageBaik >= 50 ? 'neutral' : 'down')
                ],
                [
                    'title' => 'Rusak Ringan',
                    'value' => $totalRusakRingan,
                    'subtitle' => 'Perlu perbaikan',
                    'bgColor' => 'bg-gradient-to-br from-amber-400 to-amber-600',
                    'textColor' => 'text-white',
                    'iconBg' => 'bg-white/20',
                    'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z',
                    'percentage' => $percentageRusakRingan . '%',
                    'trend' => $percentageRusakRingan > 20 ? 'warning' : 'neutral'
                ],
                [
                    'title' => 'Rusak Berat',
                    'value' => $totalRusakBerat,
                    'subtitle' => 'Prioritas perbaikan',
                    'bgColor' => 'bg-gradient-to-br from-rose-400 to-rose-600',
                    'textColor' => 'text-white',
                    'iconBg' => 'bg-white/20',
                    'icon' => 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                    'percentage' => $percentageRusakBerat . '%',
                    'trend' => $percentageRusakBerat > 10 ? 'down' : 'neutral'
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
                                @if($stat['trend'] == 'up')
                                <svg class="w-4 h-4 mr-1 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                </svg>
                                @elseif($stat['trend'] == 'down')
                                <svg class="w-4 h-4 mr-1 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                @elseif($stat['trend'] == 'warning')
                                <svg class="w-4 h-4 mr-1 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                @else
                                <svg class="w-4 h-4 mr-1 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                                </svg>
                                @endif
                                <span class="text-white text-sm font-semibold">{{ $stat['percentage'] }}</span>
                            </div>
                            <span class="text-white/70 text-xs mt-1">dari total unit</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Health Status Bar -->
    <div class="mt-6 bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-3">
            <h3 class="text-sm font-semibold text-gray-700">Status Kesehatan Aset</h3>
            <span class="text-xs text-gray-500">{{ $totalUnits }} Total Unit</span>
        </div>
        <div class="relative w-full bg-gray-200 rounded-full h-4 overflow-hidden">
            @if($totalUnits > 0)
                <div class="absolute top-0 left-0 h-full bg-emerald-500 transition-all duration-500" 
                     style="width: {{ $percentageBaik }}%"
                     title="Baik: {{ $totalBaik }} unit ({{ $percentageBaik }}%)"></div>
                <div class="absolute top-0 h-full bg-amber-500 transition-all duration-500" 
                     style="left: {{ $percentageBaik }}%; width: {{ $percentageRusakRingan }}%"
                     title="Rusak Ringan: {{ $totalRusakRingan }} unit ({{ $percentageRusakRingan }}%)"></div>
                <div class="absolute top-0 h-full bg-rose-500 transition-all duration-500" 
                     style="left: {{ $percentageBaik + $percentageRusakRingan }}%; width: {{ $percentageRusakBerat }}%"
                     title="Rusak Berat: {{ $totalRusakBerat }} unit ({{ $percentageRusakBerat }}%)"></div>
            @else
                <div class="absolute top-0 left-0 h-full bg-gray-300 w-full"></div>
            @endif
        </div>
        <div class="flex items-center justify-between mt-3 text-xs">
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 bg-emerald-500 rounded-full"></span>
                <span class="text-gray-600">Baik ({{ $percentageBaik }}%)</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 bg-amber-500 rounded-full"></span>
                <span class="text-gray-600">Rusak Ringan ({{ $percentageRusakRingan }}%)</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 bg-rose-500 rounded-full"></span>
                <span class="text-gray-600">Rusak Berat ({{ $percentageRusakBerat }}%)</span>
            </div>
        </div>
    </div>
</div>

    <!-- Table Section - Enhanced -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-300">
        <!-- Table Header -->
        <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-indigo-100 rounded-lg">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">
                            Daftar Unit Aset
                        </h3>
                        <p class="text-sm text-gray-500 mt-1">
                            {{ $inventarisDetails->total() }} item ditemukan
                            @if($inventarisDetails->total() > 0)
                                • Halaman {{ $inventarisDetails->currentPage() }} dari {{ $inventarisDetails->lastPage() }}
                            @endif
                        </p>
                    </div>
                </div>
                
                @if($inventarisDetails->isNotEmpty())
                <div class="flex items-center gap-3">
                    <!-- Export Button -->
                    <button onclick="exportToExcel()" 
                            class="inline-flex items-center gap-2 rounded-lg border border-green-200 bg-green-50 px-4 py-2 text-sm font-semibold text-green-700 hover:bg-green-100 transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Export Excel
                    </button>
                </div>
                @endif
            </div>
        </div>

        <!-- Table Container -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="py-4 pl-6 pr-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            No
                        </th>
                        <th scope="col" class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Kode Unit
                        </th>
                        <th scope="col" class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Tipe Barang
                        </th>
                        <th scope="col" class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Kondisi
                        </th>
                        <th scope="col" class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Lokasi
                        </th>
                        <th scope="col" class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Penanggung Jawab
                        </th>
                        <th scope="col" class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Sumber Dana
                        </th>
                        <th scope="col" class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Tgl Beli
                        </th>
                            <th scope="col" class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                Harga Beli
                            </th>
                            <th scope="col" class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                Keterangan
                            </th>
                            <th scope="col" class="relative py-4 pl-3 pr-6">
                                <span class="sr-only">Aksi</span>
                            </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($inventarisDetails as $detail)
                        <tr class="hover:bg-gray-50 transition-all duration-200 group border-l-4 border-l-transparent hover:border-l-indigo-500">
                            <td class="whitespace-nowrap py-4 pl-6 pr-3 text-sm font-medium text-gray-900">
                                {{ $loop->iteration + ($inventarisDetails->currentPage() - 1) * $inventarisDetails->perPage() }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="p-2 bg-blue-50 rounded-lg">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                                        </svg>
                                    </div>
                                    <span class="font-semibold text-gray-900 font-mono text-sm">
                                        {{ $detail->kode_inv }}
                                    </span>
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-600">
                                {{ $detail->tipe_barang ?? '-' }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-4 text-sm">
                                @php
                                    $statusConfig = [
                                        'Baik' => ['color' => 'green', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                                        'Rusak Ringan' => ['color' => 'yellow', 'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z'],
                                        'Rusak Berat' => ['color' => 'red', 'icon' => 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z']
                                    ];
                                    $config = $statusConfig[$detail->kondisi] ?? $statusConfig['Baik'];
                                @endphp
                                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold bg-{{ $config['color'] }}-100 text-{{ $config['color'] }}-800 border border-{{ $config['color'] }}-200">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $config['icon'] }}"/>
                                    </svg>
                                    {{ $detail->kondisi }}
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-600">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ $detail->room->nama_ruangan ?? '-' }}
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-600">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    {{ $detail->penanggungJawab->name ?? '-' }}
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-600">
                                {{ $detail->sumberDana->nama_sumber_dana ?? '-' }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-600">
                                @if($detail->tgl_pembelian)
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ \Carbon\Carbon::parse($detail->tgl_pembelian)->format('d/m/Y') }}
                                    </div>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-4 text-sm font-medium">
                                @if($detail->harga_beli)
                                    <div class="text-gray-900 bg-green-50 px-2 py-1 rounded-lg font-mono text-xs">
                                        Rp {{ number_format($detail->harga_beli, 0, ',', '.') }}
                                    </div>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-600">
                                {{ $detail->keterangan ?? '-' }}
                            </td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-6">
                                <div class="flex items-center justify-end gap-2 opacity-70 group-hover:opacity-100 transition-all duration-200">
                                    <!-- View Button -->
                                    <a href="{{ route('aset-detail.show', $detail) }}" 
                                       class="inline-flex items-center p-2 text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 rounded-lg transition-all duration-200 tooltip"
                                       data-tip="Lihat Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    
                                    <!-- Edit Button -->
                                    <a href="{{ route('aset-detail.edit', $detail) }}" 
                                       class="inline-flex items-center p-2 text-indigo-600 hover:text-indigo-800 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-all duration-200 tooltip"
                                       data-tip="Edit Unit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('aset-detail.destroy', $detail) }}" method="POST" 
                                          class="inline-flex">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus unit {{ $detail->kode_inv }}? Tindakan ini tidak dapat dibatalkan.');"
                                                class="inline-flex items-center p-2 text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 rounded-lg transition-all duration-200 tooltip"
                                                data-tip="Hapus Unit">
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
                            <td colspan="10" class="px-6 py-16 text-center">
                                <div class="text-center max-w-md mx-auto">
                                    <div class="p-4 bg-gradient-to-br from-gray-50 to-blue-50 rounded-2xl inline-flex mb-4">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum ada unit aset</h3>
                                    <p class="text-gray-500 mb-6">
                                        Mulai dengan menambahkan unit aset pertama untuk 
                                        <span class="font-semibold text-indigo-600">{{ $inventaris->nama_barang }}</span>.
                                    </p>
                                    <a href="{{ route('inventaris.detail.create', $inventaris) }}" 
                                       class="group inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                        <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Tambah Unit Aset Pertama
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
    @if($inventarisDetails->hasPages())
        <div class="mt-8 flex justify-center">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-4">
                {{ $inventarisDetails->links() }}
            </div>
        </div>
    @endif
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
function exportToExcel() {
    // Simple Excel export simulation
    const table = document.querySelector('table');
    const rows = table.querySelectorAll('tr');
    let csv = [];
    
    for (let i = 0; i < rows.length; i++) {
        let row = [], cols = rows[i].querySelectorAll('td, th');
        
        for (let j = 0; j < cols.length - 1; j++) { // Skip action column
            let text = cols[j].innerText.replace(/,/g, '');
            row.push(text);
        }
        
        csv.push(row.join(','));
    }

    // Create download link
    const csvString = csv.join('\n');
    const blob = new Blob([csvString], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    
    a.setAttribute('hidden', '');
    a.setAttribute('href', url);
    a.setAttribute('download', 'unit-aset-{{ $inventaris->nama_barang }}-{{ date('Y-m-d') }}.csv');
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    
    // Show success message
    alert('Data berhasil diexport!');
}
</script>
@endsection
