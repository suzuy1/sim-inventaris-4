@extends('dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Hero Header with Gradient -->
        <div class="relative mb-8 bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 rounded-3xl p-8 shadow-2xl overflow-hidden">
            <!-- Decorative Elements -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mb-24"></div>
            
            <div class="relative z-10">
                <!-- Breadcrumb -->
                <nav class="flex mb-6" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-2">
                        <li class="inline-flex items-center">
                            <a href="{{ route('units.index') }}" class="inline-flex items-center text-sm font-medium text-white/80 hover:text-white transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                                </svg>
                                Unit Kerja
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-white/60" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="ml-2 text-sm font-medium text-white/90">{{ $unit->nama_unit }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>

                <!-- Hero Content -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="bg-white/20 backdrop-blur-sm p-3 rounded-2xl">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            @php
                                $typeColors = [
                                    'fakultas' => 'bg-blue-500/30 text-blue-100 border-blue-400/50',
                                    'departemen' => 'bg-green-500/30 text-green-100 border-green-400/50',
                                    'laboratorium' => 'bg-purple-500/30 text-purple-100 border-purple-400/50',
                                    'prodi' => 'bg-amber-500/30 text-amber-100 border-amber-400/50',
                                    'unit_kerja' => 'bg-gray-500/30 text-gray-100 border-gray-400/50',
                                    'administrasi' => 'bg-red-500/30 text-red-100 border-red-400/50'
                                ];
                                $typeColor = $typeColors[$unit->tipe ?? 'unit_kerja'] ?? $typeColors['unit_kerja'];
                            @endphp
                            <span class="px-4 py-1.5 rounded-full text-sm font-semibold backdrop-blur-sm border {{ $typeColor }} capitalize">
                                {{ $unit->tipe ?? 'Unit Kerja' }}
                            </span>
                        </div>
                        <h1 class="text-4xl md:text-5xl font-bold text-white mb-3 leading-tight">{{ $unit->nama_unit }}</h1>
                        <p class="text-lg text-white/90 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            Kode: <span class="font-mono font-bold">{{ $unit->kode_unit ?? 'N/A' }}</span>
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('units.edit', $unit->id) }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white text-indigo-600 font-bold rounded-xl hover:bg-indigo-50 transition-all duration-200 shadow-lg hover:shadow-xl hover:scale-105">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit Unit
                        </a>
                        <button onclick="window.print()" class="inline-flex items-center gap-2 px-6 py-3 bg-white/20 backdrop-blur-sm text-white font-bold rounded-xl border-2 border-white/30 hover:bg-white/30 transition-all duration-200 hover:scale-105">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                            </svg>
                            Cetak
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Statistics Cards with Animation -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Ruangan Card -->
            <div class="group bg-white rounded-2xl p-6 shadow-lg border-2 border-transparent hover:border-blue-400 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                    <div class="text-right">
                        <p class="text-4xl font-bold text-gray-900">{{ $unit->rooms_count ?? 0 }}</p>
                    </div>
                </div>
                <div class="border-t border-gray-100 pt-4">
                    <p class="text-sm font-semibold text-gray-600 mb-1">Total Ruangan</p>
                    <div class="flex items-center gap-2">
                        <span class="inline-block w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                        <span class="text-xs text-gray-500">Tersedia dalam unit</span>
                    </div>
                </div>
            </div>

            <!-- Inventaris Card -->
            <div class="group bg-white rounded-2xl p-6 shadow-lg border-2 border-transparent hover:border-green-400 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <div class="text-right">
                        <p class="text-4xl font-bold text-gray-900">{{ $unit->inventaris_count ?? 0 }}</p>
                    </div>
                </div>
                <div class="border-t border-gray-100 pt-4">
                    <p class="text-sm font-semibold text-gray-600 mb-1">Total Inventaris</p>
                    <div class="flex items-center gap-2">
                        <span class="inline-block w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                        <span class="text-xs text-gray-500">Terdaftar dalam sistem</span>
                    </div>
                </div>
            </div>

            <!-- Staff Card -->
            <div class="group bg-white rounded-2xl p-6 shadow-lg border-2 border-transparent hover:border-purple-400 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div class="text-right">
                        <p class="text-4xl font-bold text-gray-900">{{ $unit->staff_count ?? 0 }}</p>
                    </div>
                </div>
                <div class="border-t border-gray-100 pt-4">
                    <p class="text-sm font-semibold text-gray-600 mb-1">Total Staf</p>
                    <div class="flex items-center gap-2">
                        <span class="inline-block w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                        <span class="text-xs text-gray-500">Pengelola unit kerja</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Informasi Dasar dengan Tabs Style -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-5 border-b border-gray-200">
                        <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
                            <div class="bg-gradient-to-br from-blue-500 to-indigo-600 p-3 rounded-xl shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            Informasi Detail Unit
                        </h2>
                    </div>
                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama Unit -->
                            <div class="md:col-span-2">
                                <label class="flex items-center gap-2 text-sm font-bold text-gray-500 uppercase tracking-wide mb-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                    Nama Unit
                                </label>
                                <p class="text-2xl font-bold text-gray-900 bg-gradient-to-r from-gray-50 to-blue-50 px-6 py-4 rounded-xl border-2 border-gray-200">
                                    {{ $unit->nama_unit }}
                                </p>
                            </div>
                            
                            <!-- Kode Unit -->
                            <div>
                                <label class="flex items-center gap-2 text-sm font-bold text-gray-500 uppercase tracking-wide mb-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                    Kode Unit
                                </label>
                                <p class="text-lg font-mono font-bold text-blue-600 bg-blue-50 px-6 py-4 rounded-xl border-2 border-blue-200">
                                    {{ $unit->kode_unit ?? 'N/A' }}
                                </p>
                            </div>
                            
                            <!-- Tipe Unit -->
                            <div>
                                <label class="flex items-center gap-2 text-sm font-bold text-gray-500 uppercase tracking-wide mb-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                                    </svg>
                                    Tipe Unit
                                </label>
                                @php
                                    $typeColors = [
                                        'fakultas' => 'bg-gradient-to-r from-blue-500 to-blue-600 text-white border-blue-300',
                                        'departemen' => 'bg-gradient-to-r from-green-500 to-green-600 text-white border-green-300',
                                        'laboratorium' => 'bg-gradient-to-r from-purple-500 to-purple-600 text-white border-purple-300',
                                        'prodi' => 'bg-gradient-to-r from-amber-500 to-amber-600 text-white border-amber-300',
                                        'unit_kerja' => 'bg-gradient-to-r from-gray-500 to-gray-600 text-white border-gray-300',
                                        'administrasi' => 'bg-gradient-to-r from-red-500 to-red-600 text-white border-red-300'
                                    ];
                                    $typeColor = $typeColors[$unit->tipe ?? 'unit_kerja'] ?? $typeColors['unit_kerja'];
                                @endphp
                                <span class="inline-flex items-center gap-2 px-6 py-4 rounded-xl text-base font-bold shadow-lg {{ $typeColor }} capitalize">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $unit->tipe ?? 'Unit Kerja' }}
                                </span>
                            </div>

                            @if($unit->penanggung_jawab)
                            <div class="md:col-span-2">
                                <label class="flex items-center gap-2 text-sm font-bold text-gray-500 uppercase tracking-wide mb-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Penanggung Jawab
                                </label>
                                <div class="flex items-center gap-4 bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-4 rounded-xl border-2 border-purple-200">
                                    <div class="bg-gradient-to-br from-purple-500 to-pink-600 p-3 rounded-full">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-lg font-bold text-gray-900">{{ $unit->penanggung_jawab }}</p>
                                        <p class="text-sm text-gray-600">Kepala Unit</p>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if($unit->email || $unit->telepon)
                            <div class="md:col-span-2">
                                <label class="flex items-center gap-2 text-sm font-bold text-gray-500 uppercase tracking-wide mb-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    Informasi Kontak
                                </label>
                                <div class="grid md:grid-cols-2 gap-4">
                                    @if($unit->email)
                                    <a href="mailto:{{ $unit->email }}" class="flex items-center gap-3 bg-blue-50 hover:bg-blue-100 px-5 py-4 rounded-xl border-2 border-blue-200 transition-all group">
                                        <div class="bg-blue-500 p-2 rounded-lg group-hover:scale-110 transition-transform">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs text-gray-600 mb-0.5">Email</p>
                                            <p class="text-sm font-semibold text-blue-600 truncate">{{ $unit->email }}</p>
                                        </div>
                                    </a>
                                    @endif

                                    @if($unit->telepon)
                                    <a href="tel:{{ $unit->telepon }}" class="flex items-center gap-3 bg-green-50 hover:bg-green-100 px-5 py-4 rounded-xl border-2 border-green-200 transition-all group">
                                        <div class="bg-green-500 p-2 rounded-lg group-hover:scale-110 transition-transform">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs text-gray-600 mb-0.5">Telepon</p>
                                            <p class="text-sm font-semibold text-green-600">{{ $unit->telepon }}</p>
                                        </div>
                                    </a>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>

                        @if($unit->keterangan)
                        <div class="mt-8 p-6 bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl border-2 border-amber-200">
                            <label class="flex items-center gap-2 text-sm font-bold text-amber-800 uppercase tracking-wide mb-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Keterangan
                            </label>
                            <p class="text-gray-700 leading-relaxed">{{ $unit->keterangan }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Daftar Ruangan dengan Enhanced Design -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-teal-50 to-cyan-50 px-6 py-5 border-b border-gray-200 flex justify-between items-center">
                        <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
                            <div class="bg-gradient-to-br from-teal-500 to-cyan-600 p-3 rounded-xl shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                                </svg>
                            </div>
                            Daftar Ruangan
                        </h2>
                        <a href="{{ route('rooms.create', ['unit_id' => $unit->id]) }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-teal-600 to-cyan-600 text-white font-bold rounded-xl hover:from-teal-700 hover:to-cyan-700 transition-all shadow-lg hover:shadow-xl hover:scale-105">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Tambah Ruangan
                        </a>
                    </div>
                    <div class="p-6">
                        @if($unit->rooms->isEmpty())
                            <div class="text-center py-16">
                                <div class="bg-gradient-to-br from-teal-100 to-cyan-100 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-6 shadow-lg">
                                    <svg class="w-12 h-12 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Ruangan</h3>
                                <p class="text-gray-600 mb-6 max-w-md mx-auto">Mulai tambahkan ruangan untuk unit kerja ini agar dapat mengelola inventaris dengan lebih baik.</p>
                                <a href="{{ route('rooms.create', ['unit_id' => $unit->id]) }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-teal-600 to-cyan-600 text-white font-bold rounded-xl hover:from-teal-700 hover:to-cyan-700 transition-all shadow-lg hover:shadow-xl">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    Tambah Ruangan Pertama
                                </a>
                            </div>
                        @else
                            <div class="overflow-hidden rounded-xl border-2 border-gray-200">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                        <tr>
                                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Ruangan</th>
                                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Lokasi</th>
                                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Kapasitas</th>
                                            <th class="px-6 py-4 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($unit->rooms as $room)
                                            <tr class="hover:bg-gradient-to-r hover:from-teal-50 hover:to-cyan-50 transition-all duration-200">
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center gap-3">
                                                        <div class="bg-teal-100 p-2 rounded-lg">
                                                            <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <div class="text-sm font-bold text-gray-900">{{ $room->nama_ruangan }}</div>
                                                            <div class="text-xs text-gray-500 font-mono">{{ $room->kode_ruangan ?? '-' }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center gap-2 text-sm text-gray-600">
                                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        </svg>
                                                        {{ $room->lokasi }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-sm">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                                        </svg>
                                                        {{ $room->kapasitas ?? 0 }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 text-right">
                                                    <div class="flex items-center justify-end gap-2">
                                                        <a href="{{ route('rooms.show', $room->id_room) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors text-sm font-semibold">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                            </svg>
                                                            Detail
                                                        </a>
                                                        <a href="{{ route('rooms.edit', $room->id_room) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-amber-100 text-amber-700 rounded-lg hover:bg-amber-200 transition-colors text-sm font-semibold">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                            </svg>
                                                            Edit
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <!-- Status Card dengan Enhanced Design -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-5 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Status Unit
                        </h2>
                    </div>
                    <div class="p-6 space-y-5">
                        @if($unit->status === 'active')
                            <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl p-6 text-white shadow-lg">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-sm font-semibold opacity-90">Status Operasional</span>
                                    <div class="bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full">
                                        <span class="text-xs font-bold">LIVE</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="bg-white/20 backdrop-blur-sm p-3 rounded-xl">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-2xl font-bold">Aktif</p>
                                        <p class="text-sm opacity-90">Beroperasi Normal</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="bg-gradient-to-br from-red-500 to-rose-600 rounded-2xl p-6 text-white shadow-lg">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-sm font-semibold opacity-90">Status Operasional</span>
                                    <div class="bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full">
                                        <span class="text-xs font-bold">OFFLINE</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="bg-white/20 backdrop-blur-sm p-3 rounded-xl">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-2xl font-bold">Non-Aktif</p>
                                        <p class="text-sm opacity-90">Tidak Beroperasi</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                        @if($unit->tanggal_berdiri)
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-5 border-2 border-blue-200">
                            <label class="flex items-center gap-2 text-xs font-bold text-blue-700 uppercase tracking-wide mb-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Tanggal Berdiri
                            </label>
                            <p class="text-lg font-bold text-gray-900">{{ \Carbon\Carbon::parse($unit->tanggal_berdiri)->format('d F Y') }}</p>
                            <p class="text-sm text-gray-600 mt-1">{{ \Carbon\Carbon::parse($unit->tanggal_berdiri)->diffForHumans() }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Timestamps dengan Enhanced Design -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-50 to-slate-50 px-6 py-5 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Riwayat Waktu
                        </h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-start gap-4 p-4 bg-green-50 rounded-xl border-2 border-green-200">
                            <div class="bg-green-500 p-2 rounded-lg flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-xs font-bold text-green-700 uppercase tracking-wide mb-1">Dibuat</p>
                                <p class="text-sm font-bold text-gray-900">{{ $unit->created_at->format('d F Y, H:i') }}</p>
                                <p class="text-xs text-gray-600 mt-1">{{ $unit->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-4 p-4 bg-blue-50 rounded-xl border-2 border-blue-200">
                            <div class="bg-blue-500 p-2 rounded-lg flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-xs font-bold text-blue-700 uppercase tracking-wide mb-1">Terakhir Diperbarui</p>
                                <p class="text-sm font-bold text-gray-900">{{ $unit->updated_at->format('d F Y, H:i') }}</p>
                                <p class="text-xs text-gray-600 mt-1">{{ $unit->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons dengan Enhanced Design -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-5 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            Aksi Cepat
                        </h2>
                    </div>
                    <div class="p-6 space-y-3">
                        <a href="{{ route('units.edit', $unit->id) }}" class="group w-full flex items-center justify-between px-5 py-4 bg-gradient-to-r from-amber-500 to-orange-500 text-white font-bold rounded-xl hover:from-amber-600 hover:to-orange-600 transition-all shadow-lg hover:shadow-xl hover:scale-105">
                            <span class="flex items-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit Unit
                            </span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                        
                        <form action="{{ route('units.destroy', $unit->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="group w-full flex items-center justify-between px-5 py-4 bg-gradient-to-r from-red-600 to-rose-600 text-white font-bold rounded-xl hover:from-red-700 hover:to-rose-700 transition-all shadow-lg hover:shadow-xl hover:scale-105" onclick="return confirm('⚠️ Peringatan!\n\nApakah Anda yakin ingin menghapus unit ini?\n\nTindakan ini akan:\n• Menghapus semua ruangan terkait\n• Menghapus data inventaris\n• Tidak dapat dibatalkan\n\nKetik OK untuk melanjutkan.')">
                                <span class="flex items-center gap-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus Unit
                                </span>
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </form>

                        <a href="{{ route('units.index') }}" class="group w-full flex items-center justify-between px-5 py-4 bg-gray-600 text-white font-bold rounded-xl hover:bg-gray-700 transition-all shadow-lg hover:shadow-xl hover:scale-105">
                            <span class="flex items-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Kembali
                            </span>
                            <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links dengan Enhanced Design -->
                <div class="bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 rounded-2xl shadow-2xl overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-white mb-2 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            Tautan Cepat
                        </h2>
                        <p class="text-white/80 text-sm mb-5">Akses fitur terkait unit</p>
                        <div class="space-y-2">
                            <a href="{{ route('rooms.index', ['unit_id' => $unit->id]) }}" class="group flex items-center gap-3 p-4 bg-white/10 backdrop-blur-sm hover:bg-white/20 rounded-xl transition-all border border-white/20 hover:border-white/40">
                                <div class="bg-white/20 p-2.5 rounded-lg group-hover:scale-110 transition-transform">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="font-bold text-white">Kelola Ruangan</p>
                                    <p class="text-xs text-white/70">Lihat & edit ruangan</p>
                                </div>
                                <svg class="w-5 h-5 text-white/70 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                            
                            <a href="{{ route('inventaris.index', ['unit_id' => $unit->id]) }}" class="group flex items-center gap-3 p-4 bg-white/10 backdrop-blur-sm hover:bg-white/20 rounded-xl transition-all border border-white/20 hover:border-white/40">
                                <div class="bg-white/20 p-2.5 rounded-lg group-hover:scale-110 transition-transform">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="font-bold text-white">Kelola Inventaris</p>
                                    <p class="text-xs text-white/70">Lihat barang inventaris</p>
                                </div>
                                <svg class="w-5 h-5 text-white/70 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Print Styles -->
<style>
@media print {
    .no-print {
        display: none !important;
    }
    body {
        background: white !important;
    }
    .bg-gradient-to-br,
    .bg-gradient-to-r {
        background: white !important;
    }
}

/* Custom Animations */
@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: .5;
    }
}

.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const unitId = {{ $unit->id }}; // Get unit ID from Blade
        const roomCountElement = document.querySelector('.group:nth-child(1) .text-right .text-4xl'); // Select the room count element

        async function fetchRoomCount() {
            try {
                const response = await fetch(`/units/${unitId}/room-count`);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const data = await response.json();
                if (roomCountElement) {
                    roomCountElement.textContent = data.room_count;
                }
            } catch (error) {
                console.error('Error fetching room count:', error);
            }
        }

        // Initial fetch
        fetchRoomCount();

        // Fetch every 5 seconds
        setInterval(fetchRoomCount, 5000);
    });
</script>
@endsection
