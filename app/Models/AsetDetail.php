<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsetDetail extends Model
{
    use HasFactory;

    /**
     * Tentukan nama tabel secara eksplisit
     */
    protected $table = 'aset_details';

    /**
     * Kolom yang boleh diisi secara massal (mass assignable).
     */
    protected $fillable = [
        'inventaris_id',
        'kode_inv',
        'tgl_pembelian',
        'harga_beli',
        'sumber_dana',
        'kondisi',
        'room_id',
        'penanggung_jawab_id',
        'keterangan',
        'tgl_perbaikan',
        'tgl_pengecekan',
    ];

    /**
     * Relasi: Detail aset ini milik satu master Inventaris.
     */
    public function inventaris()
    {
        return $this->belongsTo(Inventaris::class, 'inventaris_id');
    }

    /**
     * Relasi: Detail aset ini berada di satu Ruangan (Room).
     */
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    /**
     * Relasi: Detail aset ini memiliki satu Penanggung Jawab (User).
     */
    public function penanggungJawab()
    {
        return $this->belongsTo(User::class, 'penanggung_jawab_id');
    }
}
