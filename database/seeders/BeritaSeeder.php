<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('beritas')->insert([
            [
                'id_kategori' => 1,
                'gambar' => 'berita1.jpg',
                'judul_berita' => 'Perkembangan AI di Tahun 2026',
                'berita' => 'Artificial Intelligence semakin berkembang pesat dan mulai digunakan di berbagai sektor industri.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kategori' => 2,
                'gambar' => 'berita2.jpg',
                'judul_berita' => 'Tim Nasional Menang Dramatis',
                'berita' => 'Pertandingan berlangsung sengit hingga menit terakhir dan dimenangkan lewat gol penalti.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}