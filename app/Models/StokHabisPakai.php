<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokHabisPakai extends Model
{
    protected $fillable = [
        'inventaris_id',
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
        return $this->belongsTo(Inventaris::class);
    }
}
