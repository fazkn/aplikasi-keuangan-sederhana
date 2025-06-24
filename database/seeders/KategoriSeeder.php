<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori')->insert([
            ['nama_kategori' => 'Gaji', 'tipe' => 'pemasukan'],
            ['nama_kategori' => 'Freelance', 'tipe' => 'pemasukan'],
            ['nama_kategori' => 'Investasi', 'tipe' => 'pemasukan'],
            ['nama_kategori' => 'Hadiah', 'tipe' => 'pemasukan'],
            ['nama_kategori' => 'Makan', 'tipe' => 'pengeluaran'],
            ['nama_kategori' => 'Transport', 'tipe' => 'pengeluaran'],
            ['nama_kategori' => 'Belanja Harian', 'tipe' => 'pengeluaran'],
            ['nama_kategori' => 'Tagihan Rumah', 'tipe' => 'pengeluaran'],
            ['nama_kategori' => 'Kesehatan', 'tipe' => 'pengeluaran'],
            ['nama_kategori' => 'Hiburan', 'tipe' => 'pengeluaran'],
            ['nama_kategori' => 'Lainnya', 'tipe' => 'pengeluaran']
        ]);
    }
}
