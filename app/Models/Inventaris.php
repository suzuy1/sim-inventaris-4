<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StokHabisPakai;
use App\Models\Room;
use App\Models\Unit;
use App\Models\Transaction;
use App\Models\Request as ItemRequest; // Alias Request model to avoid conflict
use App\Models\AsetDetail; // <-- TAMBAHKAN INI

class Inventaris extends Model
{
    use HasFactory;

    protected $table = 'inventaris';

    /**
     * The attributes that are mass assignable.
     * Kolomnya sekarang HANYA ini.
     */
    protected $fillable = [
        'nama_barang',
        'kategori',
    ];

    // Relationships

    /**
     * Relasi untuk barang 'habis_pakai'
     */
    public function stokHabisPakai()
    {
        return $this->hasMany(StokHabisPakai::class, 'inventaris_id', 'id');
    }

    /**
     * Relasi BARU: Satu master inventaris punya BANYAK detail aset.
     */
    public function asetDetails()
    {
        return $this->hasMany(AsetDetail::class, 'inventaris_id', 'id');
    }

    // Relasi lama (dengan asumsi foreign key sudah di-refactor ke 'inventaris_id')
    public function transactions()
    {
        // Pastikan foreign key di tabel transactions adalah 'inventaris_id'
        return $this->hasMany(Transaction::class, 'inventaris_id', 'id'); 
    }

    public function requests()
    {
        // Pastikan foreign key di tabel requests adalah 'inventaris_id'
        return $this->hasMany(ItemRequest::class, 'inventaris_id', 'id'); 
    }

    // Relasi public function unit() KITA HAPUS karena kolom unit_id sudah tidak ada
}
