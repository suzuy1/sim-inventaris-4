@extends('dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50/30 p-4 sm:p-6 lg:p-8">
    <div class="mb-8">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div class="flex-1">
                <div class="flex items-center gap-4 mb-4">
                    <div class="p-3 bg-white rounded-2xl shadow-lg border border-gray-100">
                        <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Detail Unit Aset</h1>
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
                
                <nav class="flex items-center gap-2 text-sm text-gray-600">
                    <a href="{{ route('dashboard') }}" class="hover:text-indigo-600 transition-colors flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Dashboard
                    </a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <a href="{{ route('inventaris.pilih_jenis') }}" class="hover:text-indigo-600 transition-colors">
                        Jenis Inventaris
                    </a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <span class="text-gray-900 font-medium">Detail Unit</span>
                </nav>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('inventaris.detail.create', $inventaris) }}" class="group inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 px-5 py-3.5 text-sm font-semibold text-white shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all active:scale-95">
                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Unit Aset
                </a>
                <a href="{{ route('inventaris.index', ['kategori' => $inventaris->kategori]) }}" class="group inline-flex items-center justify-center gap-2 rounded-xl border border-gray-300 bg-white px-5 py-3.5 text-sm font-semibold text-gray-700 shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all hover:bg-gray-50">
                    <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Index
                </a>
            </div>
        </div>
    </div>

    @php
        // Pre-calculate once instead of multiple times in loop
        $totalUnits = $summaryStatistics->total_units;
        $totalBaik = $summaryStatistics->total_baik;
        $totalRusakRingan = $summaryStatistics->total_rusak_ringan;
        $totalRusakBerat = $summaryStatistics->total_rusak_berat;
        
        $percentageBaik = $totalUnits > 0 ? round(($totalBaik / $totalUnits) * 100, 1) : 0;
        $percentageRusakRingan = $totalUnits > 0 ? round(($totalRusakRingan / $totalUnits) * 100, 1) : 0;
        $percentageRusakBerat = $totalUnits > 0 ? round(($totalRusakBerat / $totalUnits) * 100, 1) : 0;
        
        // Define stats array once
        $statsData = [
            [
                'title' => 'Total Unit',
                'value' => $totalUnits,
                'subtitle' => 'Semua unit aset',
                'gradient' => 'from-blue-500 to-blue-600',
                'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10',
                'percentage' => '100%',
                'status' => 'Total Keseluruhan'
            ],
            [
                'title' => 'Kondisi Baik',
                'value' => $totalBaik,
                'subtitle' => 'Siap digunakan',
                'gradient' => 'from-emerald-500 to-emerald-600',
                'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                'percentage' => $percentageBaik . '%',
                'status' => $percentageBaik >= 70 ? 'Optimal' : ($percentageBaik >= 50 ? 'Normal' : 'Perhatian'),
                'trend' => $percentageBaik >= 70 ? 'up' : 'neutral'
            ],
            [
                'title' => 'Rusak Ringan',
                'value' => $totalRusakRingan,
                'subtitle' => 'Perlu perbaikan',
                'gradient' => 'from-amber-500 to-amber-600',
                'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z',
                'percentage' => $percentageRusakRingan . '%',
                'status' => $percentageRusakRingan > 20 ? 'Perhatian' : 'Normal',
                'trend' => 'warning'
            ],
            [
                'title' => 'Rusak Berat',
                'value' => $totalRusakBerat,
                'subtitle' => 'Prioritas perbaikan',
                'gradient' => 'from-rose-500 to-rose-600',
                'icon' => 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                'percentage' => $percentageRusakBerat . '%',
                'status' => $percentageRusakBerat > 10 ? 'Kritikal' : 'Normal',
                'trend' => 'down'
            ]
        ];
    @endphp

    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
            <div class="p-2 bg-indigo-100 rounded-xl">
                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            Ringkasan Statistik Unit
        </h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($statsData as $stat)
            <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br {{ $stat['gradient'] }} p-6 shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-300">
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex-1">
                            <p class="text-white/90 text-sm font-medium mb-1">{{ $stat['title'] }}</p>
                            <p class="text-white text-4xl font-bold mb-2">{{ number_format($stat['value']) }}</p>
                            <p class="text-white/80 text-xs">{{ $stat['subtitle'] }}</p>
                        </div>
                        <div class="bg-white/20 p-4 rounded-xl backdrop-blur-sm group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}"/>
                            </svg>
                        </div>
                    </div>
                    
                    <div class="pt-4 border-t border-white/20">
                        <div class="flex items-center justify-between">
                            <span class="text-white/90 text-sm font-medium">{{ $stat['status'] }}</span>
                            <div class="bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full">
                                <span class="text-white text-sm font-semibold">{{ $stat['percentage'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="mt-6 bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-sm font-semibold text-gray-700">Status Kesehatan Aset</h3>
                <span class="text-xs text-gray-500">{{ $totalUnits }} Total Unit</span>
            </div>
            <div class="relative w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                @if($totalUnits > 0)
                    <div class="absolute top-0 left-0 h-full bg-emerald-500 transition-all duration-500" style="width: {{ $percentageBaik }}%" title="Baik: {{ $totalBaik }} unit"></div>
                    <div class="absolute top-0 h-full bg-amber-500 transition-all duration-500" style="left: {{ $percentageBaik }}%; width: {{ $percentageRusakRingan }}%" title="Rusak Ringan: {{ $totalRusakRingan }} unit"></div>
                    <div class="absolute top-0 h-full bg-rose-500 transition-all duration-500" style="left: {{ $percentageBaik + $percentageRusakRingan }}%; width: {{ $percentageRusakBerat }}%" title="Rusak Berat: {{ $totalRusakBerat }} unit"></div>
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

    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-indigo-100 rounded-lg">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Daftar Unit Aset</h3>
                        <p class="text-sm text-gray-500 mt-1">
                            {{ $inventarisDetails->total() }} item ditemukan
                            @if($inventarisDetails->total() > 0)
                                • Halaman {{ $inventarisDetails->currentPage() }} dari {{ $inventarisDetails->lastPage() }}
                            @endif
                        </p>
                    </div>
                </div>
                
                @if($inventarisDetails->isNotEmpty())
                <button onclick="exportTable()" class="inline-flex items-center gap-2 rounded-lg border border-green-200 bg-green-50 px-4 py-2 text-sm font-semibold text-green-700 hover:bg-green-100 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Export Excel
                </button>
                @endif
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200" id="assetTable">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="py-4 pl-6 pr-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">No</th>
                        <th scope="col" class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Kode Unit</th>
                        <th scope="col" class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tipe Barang</th>
                        <th scope="col" class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Kondisi</th>
                        <th scope="col" class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Lokasi</th>
                        <th scope="col" class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Penanggung Jawab</th>
                        <th scope="col" class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Sumber Dana</th>
                        <th scope="col" class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tgl Beli</th>
                        <th scope="col" class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Harga Beli</th>
                        <th scope="col" class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tgl Perbaikan</th>
                        <th scope="col" class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tgl Pengecekan</th>
                        <th scope="col" class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Keterangan</th>
                        <th scope="col" class="relative py-4 pl-3 pr-6"><span class="sr-only">Aksi</span></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($inventarisDetails as $detail)
                        @php
                            // Pre-calculate status config
                            $kondisiConfig = match($detail->kondisi) {
                                'Baik' => ['color' => 'green', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                                'Rusak Ringan' => ['color' => 'yellow', 'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z'],
                                'Rusak Berat' => ['color' => 'red', 'icon' => 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                                default => ['color' => 'green', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z']
                            };
                        @endphp
                        <tr class="hover:bg-gray-50 transition-colors group border-l-4 border-l-transparent hover:border-l-indigo-500">
                            <td class="py-4 pl-6 pr-3 text-sm font-medium text-gray-900">
                                {{ $loop->iteration + ($inventarisDetails->currentPage() - 1) * $inventarisDetails->perPage() }}
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="p-2 bg-blue-50 rounded-lg flex-shrink-0">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                                        </svg>
                                    </div>
                                    <span class="font-semibold text-gray-900 font-mono text-sm">{{ $detail->kode_inv }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-600">{{ $detail->tipe_barang ?? '-' }}</td>
                            <td class="px-4 py-4 text-sm">
                                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold bg-{{ $kondisiConfig['color'] }}-100 text-{{ $kondisiConfig['color'] }}-800 border border-{{ $kondisiConfig['color'] }}-200">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $kondisiConfig['icon'] }}"/>
                                    </svg>
                                    {{ $detail->kondisi }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-600">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ $detail->room->nama_ruangan ?? '-' }}
                                </div>
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-600">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    {{ $detail->penanggungJawab->name ?? '-' }}
                                </div>
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-600">{{ $detail->sumberDana->nama_sumber_dana ?? '-' }}</td>
                            <td class="px-4 py-4 text-sm text-gray-600">
                                @if($detail->tgl_pembelian)
                                    {{ \Carbon\Carbon::parse($detail->tgl_pembelian)->format('d/m/Y') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-4 py-4 text-sm font-medium">
                                @if($detail->harga_beli)
                                    <span class="text-gray-900 bg-green-50 px-2 py-1 rounded-lg font-mono text-xs">
                                        Rp {{ number_format($detail->harga_beli, 0, ',', '.') }}
                                    </span>
                                @else
                                    -
                                @endif
                            </td>
                            {{-- START PERBAIKAN: Menggunakan tgl_perbaikan --}}
                            <td class="px-4 py-4 text-sm text-gray-600">
                                @if($detail->tgl_perbaikan)
                                    {{ \Carbon\Carbon::parse($detail->tgl_perbaikan)->format('d/m/Y') }}
                                @else
                                    -
                                @endif
                            </td>
                            {{-- START PERBAIKAN: Menggunakan tgl_pengecekan --}}
                            <td class="px-4 py-4 text-sm text-gray-600">
                                @if($detail->tgl_pengecekan)
                                    {{ \Carbon\Carbon::parse($detail->tgl_pengecekan)->format('d/m/Y') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-600">{{ $detail->keterangan ?? '-' }}</td>
                            <td class="relative py-4 pl-3 pr-6">
                                <div class="flex items-center justify-end gap-2 opacity-70 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('aset-detail.show', $detail) }}" class="p-2 text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors" title="Lihat Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('aset-detail.edit', $detail) }}" class="p-2 text-indigo-600 hover:text-indigo-800 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-colors" title="Edit Unit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('aset-detail.destroy', $detail) }}" method="POST" class="inline-flex" onsubmit="return confirm('Hapus unit {{ $detail->kode_inv }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 rounded-lg transition-colors" title="Hapus Unit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="13" class="px-6 py-16 text-center">
                                <div class="text-center max-w-md mx-auto">
                                    <div class="p-4 bg-gradient-to-br from-gray-50 to-blue-50 rounded-2xl inline-flex mb-4">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum ada unit aset</h3>
                                    <p class="text-gray-500 mb-6">
                                        Mulai dengan menambahkan unit aset pertama untuk 
                                        <span class="font-semibold text-indigo-600">{{ $inventaris->nama_barang }}</span>.
                                    </p>
                                    <a href="{{ route('inventaris.detail.create', $inventaris) }}" class="group inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
                                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

    @if($inventarisDetails->hasPages())
        <div class="mt-8 flex justify-center">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-4">
                {{ $inventarisDetails->links() }}
            </div>
        </div>
    @endif
</div>

<script>
// Use event delegation for better performance
document.addEventListener('DOMContentLoaded', function() {
    // Lazy load images if any
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                        imageObserver.unobserve(img);
                    }
                }
            });
        });

        document.querySelectorAll('img[data-src]').forEach(img => imageObserver.observe(img));
    }
});

// Optimized export function with better performance
function exportTable() {
    try {
        const table = document.getElementById('assetTable');
        if (!table) return;

        const rows = table.querySelectorAll('tr');
        const csvData = [];
        
        // Use DocumentFragment for better performance
        rows.forEach((row, index) => {
            const cols = row.querySelectorAll('td, th');
            const rowData = [];
            
            // Skip last column (actions) and process others
            for (let i = 0; i < cols.length - 1; i++) {
                // Clean text content
                let text = cols[i].innerText.trim().replace(/\s+/g, ' ').replace(/,/g, ';');
                rowData.push(text);
            }
            
            if (rowData.length > 0) {
                csvData.push(rowData.join(','));
            }
        });

        // Create blob and download
        const csvString = csvData.join('\n');
        const BOM = '\uFEFF'; // UTF-8 BOM for Excel compatibility
        const blob = new Blob([BOM + csvString], { type: 'text/csv;charset=utf-8;' });
        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');
        
        link.setAttribute('href', url);
        link.setAttribute('download', `unit-aset-{{ Str::slug($inventaris->nama_barang) }}-{{ date('Y-m-d-His') }}.csv`);
        link.style.display = 'none';
        
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        
        // Clean up
        URL.revokeObjectURL(url);
        
        // Show success notification
        showNotification('Data berhasil diexport!', 'success');
    } catch (error) {
        console.error('Export error:', error);
        showNotification('Gagal export data. Silakan coba lagi.', 'error');
    }
}

// Notification system
function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
    
    notification.className = `fixed top-4 right-4 ${bgColor} text-white px-6 py-3 rounded-lg shadow-xl z-50 transform transition-all duration-300 translate-x-0`;
    notification.innerHTML = `
        <div class="flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                ${type === 'success' 
                    ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>'
                    : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>'
                }
            </svg>
            <span class="font-medium">${message}</span>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Auto remove after 3 seconds
    setTimeout(() => {
        notification.style.transform = 'translateX(400px)';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// Debounce function for search/filter (if needed)
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}
</script>

<style>
/* Use will-change for animations that will happen */
.group:hover .group-hover\:scale-110 {
    will-change: transform;
}

/* Reduce repaints with transform instead of top/left */
.hover\:-translate-y-0\.5:hover {
    transform: translateY(-0.125rem);
}

/* GPU acceleration for smooth animations */
.transition-all,
.transition-transform,
.transition-colors {
    backface-visibility: hidden;
    perspective: 1000px;
}

/* Optimize table rendering */
table {
    border-collapse: collapse;
    border-spacing: 0;
}

/* Prevent layout shifts */
img {
    max-width: 100%;
    height: auto;
}

/* Smooth scrolling */
html {
    scroll-behavior: smooth;
}

/* Loading state optimization */
@media (prefers-reduced-motion: reduce) {
    * {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}
</style>
@endsection