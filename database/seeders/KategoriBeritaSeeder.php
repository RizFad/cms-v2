<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriBeritaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kategori_beritas')->insert([
            [
                'nama_kategori' => 'Teknologi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Olahraga',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Pendidikan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}