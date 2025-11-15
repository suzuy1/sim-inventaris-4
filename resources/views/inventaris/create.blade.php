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
            Tambah Master Inventaris Baru
        </h1>
        <p class="mt-2 text-sm text-gray-600">
            Buat jenis barang baru. Jika barang 'Tidak Habis Pakai', Anda akan diarahkan untuk menambah unit detail setelahnya.
        </p>
    </div>

    <div class="max-w-2xl mx-auto">
        <div class="overflow-hidden rounded-2xl shadow-2xl border-0 bg-white/50 backdrop-blur-sm">
            
            <form action="{{ route('inventaris.store') }}" method="POST">
                @csrf
                <div class="p-6 lg:p-8">
                    
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
                                <input type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang') }}" required
                                    class="block w-full rounded-lg border-0 bg-white/50 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                                    placeholder="Contoh: Kursi Kantor, Spidol Whiteboard">
                            </div>
                        </div>

                        <div>
                            <label for="kategori" class="block text-sm font-semibold leading-6 text-gray-900">Kategori <span class="text-red-600">*</span></label>
                            <div class="mt-2">
                                <select name="kategori" id="kategori" required
                                    class="block w-full rounded-lg border-0 bg-white/50 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="Elektronik" @if(old('kategori') == 'Elektronik') selected @endif>Elektronik</option>
                                    <option value="Furniture" @if(old('kategori') == 'Furniture') selected @endif>Furniture</option>
                                    <option value="Kendaraan" @if(old('kategori') == 'Kendaraan') selected @endif>Kendaraan</option>
                                    <option value="Alat Tulis Kantor" @if(old('kategori') == 'Alat Tulis Kantor') selected @endif>Alat Tulis Kantor</option>
                                    <option value="Peralatan Listrik" @if(old('kategori') == 'Peralatan Listrik') selected @endif>Peralatan Listrik</option>
                                    <option value="Peralatan Kebersihan" @if(old('kategori') == 'Peralatan Kebersihan') selected @endif>Peralatan Kebersihan</option>
                                    <option value="Peralatan Dapur" @if(old('kategori') == 'Peralatan Dapur') selected @endif>Peralatan Dapur</option>
                                    <option value="Peralatan Medis" @if(old('kategori') == 'Peralatan Medis') selected @endif>Peralatan Medis</option>
                                    <option value="Peralatan Teknologi" @if(old('kategori') == 'Peralatan Teknologi') selected @endif>Peralatan Teknologi</option>
                                    <option value="Barang Habis Pakai Medis" @if(old('kategori') == 'Barang Habis Pakai Medis') selected @endif>Barang Habis Pakai Medis</option>
                                    <option value="Barang Habis Pakai Kebersihan" @if(old('kategori') == 'Barang Habis Pakai Kebersihan') selected @endif>Barang Habis Pakai Kebersihan</option>
                                    <option value="Barang Habis Pakai ATK" @if(old('kategori') == 'Barang Habis Pakai ATK') selected @endif>Barang Habis Pakai ATK</option>
                                    <option value="Obat" @if(old('kategori') == 'Obat') selected @endif>Obat</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="sumber_dana_id" class="block text-sm font-semibold leading-6 text-gray-900">Sumber Dana <span class="text-red-600">*</span></label>
                            <div class="mt-2">
                                <select name="sumber_dana_id" id="sumber_dana_id" required
                                    class="block w-full rounded-lg border-0 bg-white/50 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                    <option value="">-- Pilih Sumber Dana --</option>
                                    @foreach($sumberDanas as $sumberDana)
                                        <option value="{{ $sumberDana->id }}" @if(old('sumber_dana_id') == $sumberDana->id) selected @endif>{{ $sumberDana->nama_sumber_dana }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div id="stok-awal-wrapper" class="hidden">
                            <label for="initial_stok" class="block text-sm font-semibold leading-6 text-gray-900">Stok Awal <span class="text-red-600">*</span></label>
                            <div class="mt-2">
                                <input type="number" name="initial_stok" id="initial_stok" value="{{ old('initial_stok', 0) }}"
                                    class="block w-full rounded-lg border-0 bg-white/50 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                                    placeholder="0">
                            </div>
                            <p class="mt-2 text-xs text-gray-500">Hanya diisi untuk barang 'Habis Pakai'.</p>
                        </div>

                        <div id="kondisi-wrapper" class="hidden grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="kondisi_baik" class="block text-sm font-semibold leading-6 text-gray-900">Jumlah Kondisi Baik <span class="text-red-600">*</span></label>
                                <div class="mt-2">
                                    <input type="number" name="kondisi_baik" id="kondisi_baik" value="{{ old('kondisi_baik', 0) }}" min="0"
                                        class="block w-full rounded-lg border-0 bg-white/50 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                                        placeholder="0">
                                </div>
                            </div>
                            <div>
                                <label for="kondisi_rusak_ringan" class="block text-sm font-semibold leading-6 text-gray-900">Jumlah Rusak Ringan <span class="text-red-600">*</span></label>
                                <div class="mt-2">
                                    <input type="number" name="kondisi_rusak_ringan" id="kondisi_rusak_ringan" value="{{ old('kondisi_rusak_ringan', 0) }}" min="0"
                                        class="block w-full rounded-lg border-0 bg-white/50 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                                        placeholder="0">
                                </div>
                            </div>
                            <div>
                                <label for="kondisi_rusak_berat" class="block text-sm font-semibold leading-6 text-gray-900">Jumlah Rusak Berat <span class="text-red-600">*</span></label>
                                <div class="mt-2">
                                    <input type="number" name="kondisi_rusak_berat" id="kondisi_rusak_berat" value="{{ old('kondisi_rusak_berat', 0) }}" min="0"
                                        class="block w-full rounded-lg border-0 bg-white/50 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                                        placeholder="0">
                                </div>
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
                        Simpan Master Barang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const kategoriSelect = document.getElementById('kategori');
        const stokAwalWrapper = document.getElementById('stok-awal-wrapper');
        const stokAwalInput = document.getElementById('initial_stok');
        const kondisiWrapper = document.getElementById('kondisi-wrapper');
        const kondisiBaikInput = document.getElementById('kondisi_baik');
        const kondisiRusakRinganInput = document.getElementById('kondisi_rusak_ringan');
        const kondisiRusakBeratInput = document.getElementById('kondisi_rusak_berat');

        function toggleFields(kategori) {
            // Daftar kategori yang dianggap sebagai barang habis pakai
            const habisPakaiKategori = [
                'Barang Habis Pakai Medis',
                'Barang Habis Pakai Kebersihan', 
                'Barang Habis Pakai ATK',
                'Obat'
            ];
            
            // Daftar kategori yang dianggap sebagai barang tidak habis pakai
            const tidakHabisPakaiKategori = [
                'Elektronik',
                'Furniture',
                'Kendaraan',
                'Alat Tulis Kantor',
                'Peralatan Listrik',
                'Peralatan Kebersihan',
                'Peralatan Dapur',
                'Peralatan Medis',
                'Peralatan Teknologi'
            ];
            
            if (habisPakaiKategori.includes(kategori)) {
                stokAwalWrapper.classList.remove('hidden');
                stokAwalInput.required = true;
                kondisiWrapper.classList.add('hidden');
                kondisiBaikInput.required = false;
                kondisiRusakRinganInput.required = false;
                kondisiRusakBeratInput.required = false;
            } else if (tidakHabisPakaiKategori.includes(kategori)) {
                stokAwalWrapper.classList.add('hidden');
                stokAwalInput.required = false;
                kondisiWrapper.classList.remove('hidden');
                kondisiBaikInput.required = true;
                kondisiRusakRinganInput.required = true;
                kondisiRusakBeratInput.required = true;
            } else {
                stokAwalWrapper.classList.add('hidden');
                stokAwalInput.required = false;
                kondisiWrapper.classList.add('hidden');
                kondisiBaikInput.required = false;
                kondisiRusakRinganInput.required = false;
                kondisiRusakBeratInput.required = false;
            }
        }
        toggleFields(kategoriSelect.value);
        kategoriSelect.addEventListener('change', function(e) {
            toggleFields(e.target.value);
        });
    });
</script>
@endsection
