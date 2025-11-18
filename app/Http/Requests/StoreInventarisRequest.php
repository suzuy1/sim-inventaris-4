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
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        if ($this->has('harga_beli')) {
            $this->merge([
                'harga_beli' => preg_replace('/[^0-9]/', '', $this->input('harga_beli')),
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // [REVISI] Kita buat logikanya di sini
        $habisPakaiKategori = [
            'Barang Habis Pakai Medis',
            'Barang Habis Pakai Kebersihan',
            'Barang Habis Pakai ATK',
            'Obat'
        ];

        $rules = [
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'harga_beli' => 'nullable|numeric', // This field is not used for master inventaris, but kept for compatibility if needed elsewhere.
            'keterangan' => 'nullable|string', // Keterangan for Inventaris master
        ];

        // Add conditional rules for consumable items
        if (in_array($this->kategori, $habisPakaiKategori)) {
            $rules['stock'] = 'required|integer|min:0';
            $rules['satuan'] = 'required|string|max:255';
            $rules['tgl_kadaluarsa'] = 'nullable|date';
            $rules['tgl_pengecekan'] = 'nullable|date';
            $rules['stok_keterangan'] = 'nullable|string'; // Keterangan for StokHabisPakai
        }

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
             // Pesan kustom yang dihapus
             'harga_beli.numeric' => 'The harga beli field must be a number.',
         ];
    }
}
