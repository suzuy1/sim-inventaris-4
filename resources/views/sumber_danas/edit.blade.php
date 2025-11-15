@extends('dashboard')

@section('title', 'Edit Sumber Dana')
@section('subtitle', 'Form untuk mengedit sumber dana')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-lg rounded-xl overflow-hidden max-w-2xl mx-auto">
        <div class="p-6 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-800">Edit Sumber Dana</h1>
        </div>
        <div class="p-6">
            <form action="{{ route('sumber_danas.update', $sumberDana->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="kode_sumber_dana" class="block text-gray-700 text-sm font-bold mb-2">Kode Sumber Dana:</label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('kode_sumber_dana') border-red-500 @enderror" id="kode_sumber_dana" name="kode_sumber_dana" value="{{ old('kode_sumber_dana', $sumberDana->kode_sumber_dana) }}" required>
                    @error('kode_sumber_dana')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="nama_sumber_dana" class="block text-gray-700 text-sm font-bold mb-2">Nama Sumber Dana:</label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama_sumber_dana') border-red-500 @enderror" id="nama_sumber_dana" name="nama_sumber_dana" value="{{ old('nama_sumber_dana', $sumberDana->nama_sumber_dana) }}" required>
                    @error('nama_sumber_dana')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out">
                        Update
                    </button>
                    <a href="{{ route('sumber_danas.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-600 hover:text-blue-800">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
