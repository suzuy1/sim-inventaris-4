@extends('dashboard')

@section('content')
<div class="p-4 sm:p-6 lg:p-8">
    <div class="mb-8">
        <a href="{{ route('inventaris.show_grouped', $inventaris) }}" class="inline-flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-gray-900 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
            Kembali ke Detail Aset
        </a>
        <h1 class="text-2xl md:text-3xl font-bold text-gray-900">
            Tambah Unit Aset Baru
        </h1>
        <p class="mt-2 text-sm text-gray-600">
            Menambahkan unit baru untuk master barang: <span class="font-semibold">{{ $inventaris->nama_barang }}</span>
        </p>
    </div>

    <div class="max-w-4xl mx-auto">
        <div class="overflow-hidden rounded-2xl shadow-2xl border-0 bg-white/50 backdrop-blur-sm">

            <form action="{{ route('inventaris.detail.store', $inventaris) }}" method="POST">
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

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="md:col-span-2">
                            <label for="kode_inv" class="block text-sm font-semibold leading-6 text-gray-900">Kode Unit <span class="text-red-600">*</span></label>
                            <div class="mt-2">
                                <input type="text" name="kode_inv" id="kode_inv" value="{{ old('kode_inv') }}" required
                                    class="block w-full rounded-lg border-0 bg-white/50 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                                    placeholder="Contoh: KRS-FAK-001">
                            </div>
                            <p class="mt-2 text-xs text-gray-500">Kode unik untuk unit aset ini.</p>
                        </div>

                        <div>
                            <label for="kondisi" class="block text-sm font-semibold leading-6 text-gray-900">Kondisi <span class="text-red-600">*</span></label>
                            <div class="mt-2">
                                <select name="kondisi" id="kondisi" required
                                    class="block w-full rounded-lg border-0 bg-white/50 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                    <option value="Baik" @if(old('kondisi') == 'Baik') selected @endif>Baik</option>
                                    <option value="Rusak Ringan" @if(old('kondisi') == 'Rusak Ringan') selected @endif>Rusak Ringan</option>
                                    <option value="Rusak Berat" @if(old('kondisi') == 'Rusak Berat') selected @endif>Rusak Berat</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="sumber_dana" class="block text-sm font-semibold leading-6 text-gray-900">Sumber Dana</label>
                            <div class="mt-2">
                                <input type="text" name="sumber_dana" id="sumber_dana" value="{{ old('sumber_dana') }}"
                                    class="block w-full rounded-lg border-0 bg-white/50 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                                    placeholder="Contoh: Dana Operasional">
                            </div>
                        </div>

                        <div>
                            <label for="tgl_pembelian" class="block text-sm font-semibold leading-6 text-gray-900">Tanggal Pembelian</label>
                            <div class="mt-2">
                                <input type="date" name="tgl_pembelian" id="tgl_pembelian" value="{{ old('tgl_pembelian') }}"
                                    class="block w-full rounded-lg border-0 bg-white/50 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                            </div>
                        </div>

                        <div>
                            <label for="harga_beli" class="block text-sm font-semibold leading-6 text-gray-900">Harga Beli</label>
                            <div class="mt-2 relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500">Rp</div>
                                <input type="number" name="harga_beli" id="harga_beli" value="{{ old('harga_beli') }}"
                                    class="block w-full rounded-lg border-0 bg-white/50 py-3 pl-10 pr-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                                    placeholder="500000">
                            </div>
                        </div>

                        <div>
                            <label for="room_id" class="block text-sm font-semibold leading-6 text-gray-900">Ruangan / Lokasi</label>
                            <div class="mt-2">
                                <select name="room_id" id="room_id"
                                    class="block w-full rounded-lg border-0 bg-white/50 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                    <option value="">-- Pilih Ruangan --</option>
                                    @foreach($rooms as $room)
                                        <option value="{{ $room->id }}" @if(old('room_id') == $room->id) selected @endif>{{ $room->nama_ruangan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="penanggung_jawab_id" class="block text-sm font-semibold leading-6 text-gray-900">Penanggung Jawab</label>
                            <div class="mt-2">
                                <select name="penanggung_jawab_id" id="penanggung_jawab_id"
                                    class="block w-full rounded-lg border-0 bg-white/50 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                    <option value="">-- Pilih Pengguna --</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" @if(old('penanggung_jawab_id') == $user->id) selected @endif>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <label for="keterangan" class="block text-sm font-semibold leading-6 text-gray-900">Keterangan</label>
                            <div class="mt-2">
                                <textarea name="keterangan" id="keterangan" rows="3"
                                    class="block w-full rounded-lg border-0 bg-white/50 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                                    placeholder="Detail tambahan, catatan perbaikan, dll...">{{ old('keterangan') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50/80 backdrop-blur-sm px-6 py-4 flex items-center justify-end gap-3">
                    <a href="{{ route('inventaris.show_grouped', $inventaris) }}" 
                       class="rounded-lg bg-gradient-to-r from-gray-200 to-slate-200 px-6 py-3 text-sm font-semibold text-gray-800 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        Batal
                    </a>
                    <button type="submit" 
                            class="rounded-lg bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        Simpan Unit Aset
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
