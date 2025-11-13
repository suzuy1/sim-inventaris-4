@extends('dashboard')

@section('content')
{{-- REVISI 1: Diubah dari max-w-4xl menjadi max-w-7xl untuk layout yang lebih lebar --}}
<div class="max-w-7xl mx-auto space-y-6">
    {{-- Breadcrumb --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-purple-600 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <a href="{{ route('transactions.index') }}" class="ml-1 text-sm font-medium text-gray-500 hover:text-purple-600 transition-colors duration-200 md:ml-2">
                            Transaksi Inventaris
                        </a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-purple-600 md:ml-2">
                            #{{ $transaction->id }}
                        </span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    {{-- Header Card --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <div class="p-3 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-xl shadow-sm">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Detail Transaksi Inventaris</h1>
                        <p class="text-sm text-gray-500 mt-1">ID: #{{ $transaction->id }}</p>
                    </div>
                </div>
                {{-- Status Badge --}}
                <div class="flex items-center space-x-3">
                    <span @class([
                        'px-4 py-2 text-sm font-semibold rounded-full border shadow-sm transition-all duration-200',
                        'bg-green-50 text-green-700 border-green-200' => $transaction->jenis === 'masuk',
                        'bg-red-50 text-red-700 border-red-200' => $transaction->jenis === 'keluar',
                        'bg-blue-50 text-blue-700 border-blue-200' => !in_array($transaction->jenis, ['masuk', 'keluar'])
                    ])>
                        <span class="flex items-center space-x-2">
                            @if($transaction->jenis === 'masuk')
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                                </svg>
                            @elseif($transaction->jenis === 'keluar')
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                                </svg>
                            @else
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                                </svg>
                            @endif
                            <span>{{ ucfirst($transaction->jenis) }}</span>
                        </span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Detail Card --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Informasi Transaksi</h2>
                    <p class="text-sm text-gray-500">Detail lengkap transaksi inventaris</p>
                </div>
            </div>
        </div>
        <div class="p-6">
            {{-- REVISI 2: Ditambahkan `lg:grid-cols-3` agar di layar lebar menjadi 3 kolom --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($details as $detail)
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 hover:border-purple-300 transition-colors duration-200">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <div @class([
                                    'p-2 rounded-lg',
                                    'bg-purple-100 text-purple-600' => $detail['color'] === 'purple',
                                    'bg-blue-100 text-blue-600' => $detail['color'] === 'blue',
                                    'bg-green-100 text-green-600' => $detail['color'] === 'green',
                                    'bg-pink-100 text-pink-600' => $detail['color'] === 'pink',
                                    'bg-gray-100 text-gray-600' => $detail['color'] === 'gray',
                                ])>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        @if($detail['icon'] === 'heroicon-o-cube')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        @elseif($detail['icon'] === 'heroicon-o-archive-box')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                        @elseif($detail['icon'] === 'heroicon-o-calendar')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        @elseif($detail['icon'] === 'heroicon-o-user')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        @elseif($detail['icon'] === 'heroicon-o-clock')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        @elseif($detail['icon'] === 'heroicon-o-refresh')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                        @endif
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-500">{{ $detail['label'] }}</p>
                                <p class="text-lg font-semibold text-gray-900 mt-1">{{ $detail['value'] }}</p>
                                @if(isset($detail['subtext']))
                                    <p class="text-sm text-gray-400 mt-1">{{ $detail['subtext'] }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- Keterangan (Full Width) --}}
                {{-- REVISI 3: Ditambahkan `lg:col-span-3` agar di 3-column layout tetap full-width --}}
                <div class="md:col-span-2 lg:col-span-3">
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 hover:border-purple-300 transition-colors duration-200">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <div class="p-2 bg-indigo-100 text-indigo-600 rounded-lg">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-500">Keterangan</p>
                                <p class="text-lg font-semibold text-gray-900 mt-1">{{ $transaction->keterangan ?? '-' }}</p>
</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        {{-- Delete with Modal --}}
        <div x-data="{ open: false }" class="flex-1 sm:flex-none">
            <button @click="open = true"
                    class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 shadow-sm transition-all duration-200 transform hover:-translate-y-0.5"
                    aria-label="Hapus transaksi #{{ $transaction->id }}">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                <span>Hapus Transaksi</span>
            </button>

            {{-- Modal Confirm --}}
            <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 p-4" style="display: none;">
                <div class="bg-white rounded-2xl p-6 max-w-md w-full mx-auto shadow-2xl transform transition-all duration-300 scale-95" x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="flex-shrink-0">
                            <div class="p-3 bg-red-100 rounded-xl">
                                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Konfirmasi Hapus</h3>
                            <p class="text-sm text-gray-500 mt-1">Data akan dihapus permanent</p>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-6">Apakah Anda yakin ingin menghapus transaksi <strong class="text-red-600">#{{ $transaction->id }}</strong>? Tindakan ini tidak dapat dibatalkan.</p>
                    <div class="flex flex-col sm:flex-row gap-3 justify-end">
                        <button @click="open = false"
                                class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 shadow-sm transition-all duration-200"
                                aria-label="Batal hapus transaksi">
                            Batal
                        </button>
                        <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" class="w-full sm:w-auto">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 shadow-sm transition-all duration-200"
                                    aria-label="Konfirmasi hapus transaksi #{{ $transaction->id }}">
                                <span>Ya, Hapus</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <a href="{{ route('transactions.index') }}"
           class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 shadow-sm transition-all duration-200 transform hover:-translate-y-0.5"
           aria-label="Kembali ke daftar transaksi">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Daftar
        </a>
    </div>
</div>
@endsection
