@extends('dashboard')

@section('title', 'Detail Sumber Dana')
@section('subtitle', 'Informasi lengkap sumber dana')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-lg rounded-xl overflow-hidden max-w-2xl mx-auto">
        <div class="p-6 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-800">Detail Sumber Dana</h1>
        </div>
        <div class="p-6">
            <div class="mb-4">
                <p class="text-gray-700 text-sm font-bold mb-2">ID:</p>
                <p class="text-gray-900 text-base">{{ $sumberDana->id }}</p>
            </div>
            <div class="mb-4">
                <p class="text-gray-700 text-sm font-bold mb-2">Kode Sumber Dana:</p>
                <p class="text-gray-900 text-base">{{ $sumberDana->kode_sumber_dana }}</p>
            </div>
            <div class="mb-6">
                <p class="text-gray-700 text-sm font-bold mb-2">Nama Sumber Dana:</p>
                <p class="text-gray-900 text-base">{{ $sumberDana->nama_sumber_dana }}</p>
            </div>
            <div class="flex items-center justify-between">
                <a href="{{ route('sumber_danas.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-600 hover:text-blue-800">
                    Kembali ke Daftar
                </a>
                <a href="{{ route('sumber_danas.edit', $sumberDana->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out">
                    Edit
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
