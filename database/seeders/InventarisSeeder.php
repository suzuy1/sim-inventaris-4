<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inventaris; // Import model
use App\Models\StokHabisPakai; // Import model

class InventarisSeeder extends Seeder
{
    public function run(): void
    {
        $inventaris1 = Inventaris::create([
            'nama_barang' => 'Pulpen Standard',
            'kategori' => 'habis_pakai',
        ]);

        StokHabisPakai::create([
            'inventaris_id' => $inventaris1->id, // Gunakan ID dari inventaris yang baru dibuat
            'jumlah_masuk' => 100,
            'jumlah_keluar' => 0,
            'tanggal' => now()->toDateString(),
        ]);

        Inventaris::create([
            'nama_barang' => 'Laptop Lenovo',
            'kategori' => 'tidak_habis_pakai',
        ]);

        Inventaris::create([
            'nama_barang' => 'Meja Kantor',
            'kategori' => 'aset_tetap',
        ]);

        $inventaris4 = Inventaris::create([
            'nama_barang' => 'Spidol Whiteboard',
            'kategori' => 'habis_pakai',
        ]);

        StokHabisPakai::create([
            'inventaris_id' => $inventaris4->id, // Gunakan ID dari inventaris yang baru dibuat
            'jumlah_masuk' => 50,
             'jumlah_keluar' => 0,
            'tanggal' => now()->toDateString(),
        ]);
    }
}
