<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    // Nama tabel yang digunakan model ini
    protected $table = 'transaksi';

    // Field yang diizinkan untuk mass assignment
    protected $fillable = ['tanggal', 'tipe', 'kategori', 'deskripsi', 'jumlah'];
}