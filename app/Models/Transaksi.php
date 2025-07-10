<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan model ini
    protected $table = 'transaksi';

    // Field yang diizinkan untuk mass assignment
    protected $fillable = ['tanggal', 'tipe', 'kategori_id', 'deskripsi', 'jumlah'];

    public function kategori()
        {
            return $this->belongsTo(Kategori::class);
        }

}