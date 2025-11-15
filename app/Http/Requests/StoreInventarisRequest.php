<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventarisRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // [REVISI] Kita buat logikanya di sini
        $rules = [
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|max:255', // Dibuat fleksibel
            'sumber_dana_id' => 'required|exists:sumber_danas,id', // Add validation for sumber_dana_id
            
            // Validasi lama, kita hapus 'unique' dan 'lokasi' karena tidak ada di form create.
            // 'lokasi' => 'nullable|string|max:255',
            // 'kode_inventaris' => 'nullable|string|max:255|unique:inventaris,kode_inventaris', 
        ];

        // Definisikan kategori mana saja yang termasuk 'habis pakai'
        $habisPakaiKategori = [
            'Barang Habis Pakai Medis',
            'Barang Habis Pakai Kebersihan',
            'Barang Habis Pakai ATK',
            'Obat'
        ];

        $kategori = $this->input('kategori');

        // Jika kategori yang dipilih ada di dalam array habisPakaiKategori
        if (in_array($kategori, $habisPakaiKategori)) {
            // Wajibkan 'initial_stok'
            $rules['initial_stok'] = 'required|integer|min:0';
        
        // Jika kategori dipilih (bukan empty) DAN BUKAN barang habis pakai (berarti Aset)
        } elseif ($kategori && !in_array($kategori, $habisPakaiKategori)) {
            // Wajibkan 'kondisi'
            $rules['kondisi_baik'] = 'required|integer|min:0';
            $rules['kondisi_rusak_ringan'] = 'required|integer|min:0';
            $rules['kondisi_rusak_berat'] = 'required|integer|min:0';
        }
        // Jika $kategori = null (belum dipilih), tidak ada rules tambahan

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
         return [
             'initial_stok.required' => 'Stok awal wajib diisi untuk kategori barang habis pakai.',
             'kondisi_baik.required' => 'Jumlah kondisi baik wajib diisi untuk kategori aset.',
             'sumber_dana_id.required' => 'Sumber Dana wajib diisi.',
             'sumber_dana_id.exists' => 'Sumber Dana yang dipilih tidak valid.',
             // ... (bisa tambahkan pesan lain jika perlu)
         ];
    }
}
