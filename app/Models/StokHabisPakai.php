<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokHabisPakai extends Model
{
    protected $fillable = [
        'id_inventaris', // [PERBAIKAN] Sesuaikan dengan nama kolom di database (sebelumnya inventaris_id)
        'jumlah_masuk',
        'jumlah_keluar',
        'tanggal',
        'satuan',
        'tgl_kadaluarsa',
        'tgl_pengecekan',
        'keterangan',
    ];

    // Relationships
    public function inventaris()
    {
        // [PERBAIKAN] Tambahkan parameter kedua 'id_inventaris' karena nama kolomnya tidak standar (bukan inventaris_id)
        return $this->belongsTo(Inventaris::class, 'id_inventaris');
    }
}
