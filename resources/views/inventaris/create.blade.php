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
                            <label for="keterangan" class="block text-sm font-semibold leading-6 text-gray-900">Keterangan (Master Barang)</label>
                            <div class="mt-2">
                                <textarea name="keterangan" id="keterangan" rows="3"
                                    class="block w-full rounded-lg border-0 bg-white/50 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                                    placeholder="Keterangan umum untuk master barang ini.">{{ old('keterangan') }}</textarea>
                            </div>
                        </div>

                        <!-- Consumable Fields Group -->
                        <div id="consumable-fields" class="hidden grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6 p-6 bg-blue-50/50 rounded-xl border border-blue-100">
                            <div class="sm:col-span-2">
                                <h3 class="text-lg font-semibold text-blue-800 mb-4">Detail Barang Habis Pakai</h3>
                            </div>
                            
                            <div>
                                <label for="stock" class="block text-sm font-semibold leading-6 text-gray-900">Stock Awal <span class="text-red-600">*</span></label>
                                <div class="mt-2">
                                    <input type="number" name="stock" id="stock" value="{{ old('stock', 0) }}" min="0"
                                        class="block w-full rounded-lg border-0 bg-white/50 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                                        placeholder="Jumlah stock awal">
                                </div>
                            </div>

                            <div>
                                <label for="satuan" class="block text-sm font-semibold leading-6 text-gray-900">Satuan <span class="text-red-600">*</span></label>
                                <div class="mt-2">
                                    <input type="text" name="satuan" id="satuan" value="{{ old('satuan') }}"
                                        class="block w-full rounded-lg border-0 bg-white/50 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                                        placeholder="Contoh: Pcs, Box, Botol">
                                </div>
                            </div>

                            <div>
                                <label for="tgl_kadaluarsa" class="block text-sm font-semibold leading-6 text-gray-900">Tanggal Kadaluarsa</label>
                                <div class="mt-2">
                                    <input type="date" name="tgl_kadaluarsa" id="tgl_kadaluarsa" value="{{ old('tgl_kadaluarsa') }}"
                                        class="block w-full rounded-lg border-0 bg-white/50 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                </div>
                            </div>

                            <div>
                                <label for="tgl_pengecekan" class="block text-sm font-semibold leading-6 text-gray-900">Tanggal Pengecekan Terakhir</label>
                                <div class="mt-2">
                                    <input type="date" name="tgl_pengecekan" id="tgl_pengecekan" value="{{ old('tgl_pengecekan') }}"
                                        class="block w-full rounded-lg border-0 bg-white/50 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                </div>
                            </div>

                            <div class="sm:col-span-2">
                                <label for="stok_keterangan" class="block text-sm font-semibold leading-6 text-gray-900">Keterangan (Stok Habis Pakai)</label>
                                <div class="mt-2">
                                    <textarea name="stok_keterangan" id="stok_keterangan" rows="3"
                                        class="block w-full rounded-lg border-0 bg-white/50 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                                        placeholder="Keterangan spesifik untuk stok habis pakai ini.">{{ old('stok_keterangan') }}</textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="bg-gray-50/80 backdrop-blur-sm px-6 py-4 flex items-center justify-end gap-3">
                    <a href="{{ route('inventaris.index', ['kategori' => $kategori]) }}" 
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
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const kategoriSelect = document.getElementById('kategori');
        const consumableFields = document.getElementById('consumable-fields');
        const stockInput = document.getElementById('stock');
        const satuanInput = document.getElementById('satuan');

        const consumableCategories = [
            'Barang Habis Pakai Medis',
            'Barang Habis Pakai Kebersihan',
            'Barang Habis Pakai ATK',
            'Obat'
        ];

        function toggleConsumableFields() {
            const selectedKategori = kategoriSelect.value;
            console.log('Selected Kategori:', selectedKategori);
            if (consumableCategories.includes(selectedKategori)) {
                consumableFields.classList.remove('hidden');
                stockInput.removeAttribute('disabled');
                satuanInput.removeAttribute('disabled');
                stockInput.setAttribute('required', 'required');
                satuanInput.setAttribute('required', 'required');
                stockInput.name = 'stock'; // Ensure name is present
                satuanInput.name = 'satuan'; // Ensure name is present
                console.log('Consumable fields shown. Stock required:', stockInput.required, 'Satuan required:', satuanInput.required, 'Stock name:', stockInput.name, 'Satuan name:', satuanInput.name);
            } else {
                consumableFields.classList.add('hidden');
                stockInput.setAttribute('disabled', 'disabled');
                satuanInput.setAttribute('disabled', 'disabled');
                stockInput.removeAttribute('required');
                satuanInput.removeAttribute('required');
                stockInput.name = ''; // Remove name to prevent submission/validation
                satuanInput.name = ''; // Remove name to prevent submission/validation
                console.log('Consumable fields hidden. Stock required:', stockInput.required, 'Satuan required:', satuanInput.required, 'Stock name:', stockInput.name, 'Satuan name:', satuanInput.name);
            }
        }

        // Initial check on page load
        toggleConsumableFields();

        // Listen for changes
        kategoriSelect.addEventListener('change', toggleConsumableFields);
    });
</script>
@endpush
