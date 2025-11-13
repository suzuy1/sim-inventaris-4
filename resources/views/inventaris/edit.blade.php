@extends('dashboard')

@section('content')
<div class="p-4 sm:p-6 lg:p-8">
    <div class="mb-8">
        <a href="{{ route('inventaris.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-gray-900 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
            Kembali ke Manajemen Inventaris
        </a>
        <h1 class="text-2xl md:text-3xl font-bold text-gray-900">
            Edit Master Inventaris
        </h1>
        <p class="mt-2 text-sm text-gray-600">
            Mengubah data master untuk barang: <span class="font-semibold">{{ $inventaris->nama_barang }}</span>
        </p>
    </div>

    <div class="max-w-2xl mx-auto">
        <div class="overflow-hidden rounded-2xl shadow-2xl border-0 bg-white/50 backdrop-blur-sm">

            <form action="{{ route('inventaris.update', $inventaris) }}" method="POST">
                @csrf
                @method('PATCH') <div class="p-6 lg:p-8">

                    @if ($errors->any())
                        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg" role="alert">
                            <strong class="font-bold">Oops! Ada kesalahan:</strong>
                            <ul class="mt-2 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 gap-6">

                        <div>
                            <label for="nama_barang" class="block text-sm font-semibold leading-6 text-gray-900">Nama Barang <span class="text-red-600">*</span></label>
                            <div class="mt-2">
                                <input type="text" name="nama_barang" id="nama_barang" 
                                       value="{{ old('nama_barang', $inventaris->nama_barang) }}" required
                                    class="block w-full rounded-lg border-0 bg-white/50 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                                    placeholder="Contoh: Kursi Kantor, Spidol Whiteboard">
                            </div>
                        </div>

                        <div>
                            <label for="kategori" class="block text-sm font-semibold leading-6 text-gray-900">Kategori <span class="text-red-600">*</span></label>
                            <div class="mt-2">
                                <select name="kategori" id="kategori" required
                                    class="block w-full rounded-lg border-0 bg-white/50 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                                    @if($inventaris->asetDetails->count() > 0 || $inventaris->stokHabisPakai->count() > 0) disabled @endif >

                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="tidak_habis_pakai" @if(old('kategori', $inventaris->kategori) == 'tidak_habis_pakai') selected @endif>Tidak Habis Pakai (Aset)</option>
                                    <option value="habis_pakai" @if(old('kategori', $inventaris->kategori) == 'habis_pakai') selected @endif>Habis Pakai (Stok)</option>
                                    <option value="aset_tetap" @if(old('kategori', $inventaris->kategori) == 'aset_tetap') selected @endif>Aset Tetap</option>
                                </select>

                                @if($inventaris->asetDetails->count() > 0 || $inventaris->stokHabisPakai->count() > 0)
                                    <p class="mt-2 text-xs text-gray-500">
                                        Kategori tidak dapat diubah karena sudah ada unit aset atau stok yang terdaftar.
                                    </p>
                                    <input type="hidden" name="kategori" value="{{ $inventaris->kategori }}" />
                                @endif
                            </div>
                        </div>

                        </div>
                </div>

                <div class="bg-gray-50/80 backdrop-blur-sm px-6 py-4 flex items-center justify-end gap-3">
                    <a href="{{ route('inventaris.index') }}" 
                       class="rounded-lg bg-gradient-to-r from-gray-200 to-slate-200 px-6 py-3 text-sm font-semibold text-gray-800 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        Batal
                    </a>
                    <button type="submit" 
                            class="rounded-lg bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        Update Master Barang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
