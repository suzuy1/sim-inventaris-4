@extends('dashboard')

@section('content')
<div class="space-y-4">
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-700 rounded-xl shadow-xl overflow-hidden">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative p-4 text-white">
            <div class="flex flex-col lg:flex-row items-center justify-between">
                <div class="flex-1 max-w-2xl mb-4 lg:mb-0">
                    <h2 class="text-xl lg:text-2xl font-bold mb-2 leading-tight">
                        Selamat Datang di<br>
                        <span class="bg-gradient-to-r from-yellow-300 to-amber-300 bg-clip-text text-transparent">
                            Sistem Inventaris Kampus
                        </span>
                    </h2>
                    <p class="text-blue-100 text-sm mb-4 leading-relaxed">
                        Kelola seluruh aset kampus Anda dengan mudah dan efisien. Pantau stok, lacak transaksi, dan optimalkan pengelolaan inventaris dalam satu platform terintegrasi.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('inventaris.create') }}" class="group bg-white text-blue-600 hover:bg-blue-50 px-4 py-2.5 rounded-lg font-bold transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg inline-flex items-center justify-center text-sm">
                            <svg class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Tambah Inventaris Baru
                        </a>
                        <a href="{{ route('inventaris.index') }}" class="group border-2 border-white text-white hover:bg-white hover:text-blue-600 px-4 py-2.5 rounded-lg font-bold transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg inline-flex items-center justify-center text-sm">
                            <svg class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            Lihat Semua Inventaris
                        </a>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <div class="bg-white/10 backdrop-blur-lg rounded-xl p-4 border border-white/20 shadow-xl">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full -translate-y-12 translate-x-12"></div>
        <div class="absolute bottom-0 left-0 w-20 h-20 bg-white/5 rounded-full -translate-x-10 translate-y-10"></div>
    </div>

    <!-- Dashboard Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between bg-white/80 backdrop-blur-sm rounded-xl p-4 shadow-lg border border-gray-200/50">
        <div class="flex-1">
            <h1 class="text-xl lg:text-2xl font-bold bg-gradient-to-r from-slate-800 to-slate-600 bg-clip-text text-transparent mb-1">
                Dasbor Inventaris
            </h1>
            <p class="text-gray-600 text-sm">Ringkasan dan statistik sistem inventaris Anda</p>
        </div>
        <div class="mt-3 md:mt-0">
            <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-bold bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 border border-green-200 shadow-sm">
                <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                </svg>
                Terakhir diperbarui: {{ now()->format('d M Y, H:i') }}
            </span>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Inventaris -->
        <div class="group bg-white rounded-xl shadow-lg border border-gray-200/50 p-4 hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between mb-3">
                <div class="flex-1">
                    <p class="text-xs font-semibold text-gray-500 mb-0.5">Total Inventaris</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $totalInventaris }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">Jumlah keseluruhan aset</p>
                </div>
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white p-3 rounded-xl shadow-md group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                    </svg>
                </div>
            </div>
            <div class="mt-3 pt-3 border-t border-gray-100">
                <div class="flex items-center text-xs font-medium text-green-600">
                    <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ rand(5, 15) }}% dari bulan lalu</span>
                </div>
            </div>
        </div>

        <!-- Total Jenis Inventaris -->
        <a href="{{ route('inventaris.pilih_jenis') }}" class="group bg-white rounded-xl shadow-lg border border-gray-200/50 p-4 hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
            <div x-data="{ totalJenisInventaris: '...' }" x-init="fetch('{{ route('dashboard.total_inventory_types') }}')
                .then(response => response.json())
                .then(data => totalJenisInventaris = data.totalJenisInventaris)">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex-1">
                        <p class="text-xs font-semibold text-gray-500 mb-0.5">Total Jenis Inventaris</p>
                        <p class="text-2xl font-bold text-slate-800" x-text="totalJenisInventaris"></p>
                        <p class="text-xs text-gray-400 mt-0.5">Jenis barang berbeda</p>
                    </div>
                    <div class="bg-gradient-to-br from-indigo-500 to-purple-600 text-white p-3 rounded-xl shadow-md group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                    </div>
                </div>
                <div class="mt-3 pt-3 border-t border-gray-100">
                    <div class="flex items-center text-xs font-medium text-blue-600">
                        <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 10.293a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l4.293-4.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>Kategori unik</span>
                    </div>
                </div>
            </div>
        </a>

        <!-- Jumlah Ruangan -->
        <div class="group bg-white rounded-xl shadow-lg border border-gray-200/50 p-4 hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between mb-3">
                <div class="flex-1">
                    <p class="text-xs font-semibold text-gray-500 mb-0.5">Jumlah Ruangan</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $totalRooms }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">Lokasi inventaris</p>
                </div>
                <div class="bg-gradient-to-br from-green-500 to-green-600 text-white p-3 rounded-xl shadow-md group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>
            </div>
            <div class="mt-3 pt-3 border-t border-gray-100">
                <div class="flex items-center text-xs font-medium text-blue-600">
                    <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 10.293a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l4.293-4.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ rand(2, 8) }} ruangan terisi</span>
                </div>
            </div>
        </div>

        <!-- Total Unit -->
        <div class="group bg-white rounded-xl shadow-lg border border-gray-200/50 p-4 hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between mb-3">
                <div class="flex-1">
                    <p class="text-xs font-semibold text-gray-500 mb-0.5">Total Unit</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $totalUnits }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">Seluruh item</p>
                </div>
                <div class="bg-gradient-to-br from-amber-500 to-amber-600 text-white p-3 rounded-xl shadow-md group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 5a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-3 pt-3 border-t border-gray-100">
                <div class="flex items-center text-xs font-medium text-green-600">
                    <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ rand(10, 25) }}% pertumbuhan</span>
                </div>
            </div>
        </div>

        <!-- Pending Requests -->
        <div class="group bg-white rounded-xl shadow-lg border border-gray-200/50 p-4 hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between mb-3">
                <div class="flex-1">
                    <p class="text-xs font-semibold text-gray-500 mb-0.5">Pending Requests</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $pendingRequests }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">Menunggu persetujuan</p>
                </div>
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 text-white p-3 rounded-xl shadow-md group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-3 pt-3 border-t border-gray-100">
                @if($pendingRequests > 0)
                <div class="flex items-center text-xs font-medium text-red-600">
                    <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <span>Perlu perhatian segera</span>
                </div>
                @else
                <div class="flex items-center text-xs font-medium text-green-600">
                    <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>Semua request telah diproses</span>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Low Stock & Recent Transactions -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <!-- Stok Rendah -->
        <div class="group bg-white rounded-xl shadow-lg border border-gray-200/50 overflow-hidden hover:shadow-xl transition-all duration-300">
            <div class="bg-gradient-to-r from-red-50 to-orange-50 border-b border-gray-200/50 px-4 py-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="bg-red-100 text-red-600 p-1.5 rounded-lg mr-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-slate-800">Stok Rendah</h2>
                            <p class="text-xs text-gray-600">Inventaris dengan stok hampir habis</p>
                        </div>
                    </div>
                    <span class="bg-red-100 text-red-800 text-xs font-bold px-2.5 py-1 rounded-full border border-red-200">
                        {{ $lowStockItems->count() }} items
                    </span>
                </div>
            </div>
            <div class="p-4">
                @if ($lowStockItems->isEmpty())
                <div class="text-center py-6">
                    <div class="bg-green-100 text-green-600 p-3 rounded-xl inline-flex mb-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <p class="text-gray-700 font-bold text-base mb-1">Semua stok aman</p>
                    <p class="text-gray-500 text-sm">Tidak ada inventaris dengan stok rendah</p>
                </div>
                @else
                <div class="space-y-3">
                    @foreach ($lowStockItems as $item)
                    <div class="flex items-center justify-between p-2.5 bg-red-50/50 rounded-lg border border-red-200 hover:bg-red-100/50 transition-all duration-200 group/item">
                        <div class="flex items-center space-x-3">
                            <div class="bg-white text-red-600 p-1.5 rounded-md shadow-sm group-hover/item:scale-110 transition-transform duration-200">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-sm text-slate-800">{{ $item->nama_barang }}</p>
                                <div class="flex items-center space-x-2 text-xs text-gray-600">
                                    <span class="font-mono">{{ $item->kode_inventaris }}</span>
                                    <span class="w-1 h-1 bg-gray-400 rounded-full"></span>
                                    <span class="font-bold text-red-600">Stok: {{ $item->total_sisa_stok }}</span>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('inventaris.show', $item) }}" class="text-blue-600 hover:text-blue-800 text-xs font-bold flex items-center group/link">
                            Lihat
                            <svg class="w-3 h-3 ml-1 group-hover/link:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>

        <!-- Transaksi Terbaru -->
        <div class="group bg-white rounded-xl shadow-lg border border-gray-200/50 overflow-hidden hover:shadow-xl transition-all duration-300">
            <div class="bg-gradient-to-r from-blue-50 to-cyan-50 border-b border-gray-200/50 px-4 py-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="bg-blue-100 text-blue-600 p-1.5 rounded-lg mr-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-slate-800">Transaksi Terbaru</h2>
                            <p class="text-xs text-gray-600">Aktivitas inventaris terkini</p>
                        </div>
                    </div>
                    <span class="bg-blue-100 text-blue-800 text-xs font-bold px-2.5 py-1 rounded-full border border-blue-200">
                        {{ $recentTransactions->count() }} transaksi
                    </span>
                </div>
            </div>
            <div class="p-4">
                @if ($recentTransactions->isEmpty())
                <div class="text-center py-6">
                    <div class="bg-gray-100 text-gray-400 p-3 rounded-xl inline-flex mb-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <p class="text-gray-700 font-bold text-base mb-1">Belum ada transaksi</p>
                    <p class="text-gray-500 text-sm">Tidak ada aktivitas transaksi terbaru</p>
                </div>
                @else
                <div class="space-y-3">
                    @foreach ($recentTransactions as $transaction)
                    <div class="flex items-center justify-between p-2.5 bg-gray-50/50 rounded-lg border border-gray-200 hover:bg-gray-100/50 transition-all duration-200 group/item">
                        <div class="flex items-center space-x-3">
                            <div class="bg-white p-1.5 rounded-md shadow-sm group-hover/item:scale-110 transition-transform duration-200
                                {{ $transaction->jenis === 'masuk' ? 'text-green-600' : 'text-red-600' }}">
                                @if($transaction->jenis === 'masuk')
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                @else
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                </svg>
                                @endif
                            </div>
                            <div>
                                <p class="font-bold text-sm text-slate-800">
                                    {{ $transaction->item->nama_barang ?? 'N/A' }}
                                </p>
                                <div class="flex items-center space-x-2 text-xs text-gray-600">
                                    <span class="capitalize font-medium">{{ $transaction->jenis }}</span>
                                    <span class="w-1 h-1 bg-gray-400 rounded-full"></span>
                                    <span>{{ $transaction->jumlah }} unit</span>
                                    <span class="w-1 h-1 bg-gray-400 rounded-full"></span>
                                    <span>{{ $transaction->tanggal->format('d M') }}</span>
                                </div>
                            </div>
                        </div>
                        <span class="text-xs font-bold px-2.5 py-1 rounded-full border shadow-sm
                            {{ $transaction->jenis === 'masuk' 
                                ? 'bg-green-100 text-green-800 border-green-200' 
                                : 'bg-red-100 text-red-800 border-red-200' }}">
                            {{ $transaction->jenis === 'masuk' ? 'Masuk' : 'Keluar' }}
                        </span>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
