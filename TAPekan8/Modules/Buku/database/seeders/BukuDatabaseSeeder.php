<?php

namespace Modules\Buku\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Buku\Models\Book;

class BukuDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            ['Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', 2005, 8],
            ['Bumi Manusia', 'Pramoedya Ananta Toer', 'Hasta Mitra', 1980, 5],
            ['Laut Bercerita', 'Leila S. Chudori', 'Kepustakaan Populer Gramedia', 2017, 6],
            ['Pulang', 'Tere Liye', 'Republika', 2015, 4],
            ['Negeri 5 Menara', 'Ahmad Fuadi', 'Gramedia Pustaka Utama', 2009, 7],
        ];

        foreach ($books as [$judul, $penulis, $penerbit, $tahun, $stok]) {
            Book::firstOrCreate(['judul' => $judul], [
                'penulis' => $penulis,
                'penerbit' => $penerbit,
                'tahun_terbit' => $tahun,
                'stok' => $stok,
            ]);
        }
    }
}
