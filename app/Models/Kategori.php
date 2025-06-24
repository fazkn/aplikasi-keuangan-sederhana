<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{

    protected $table = 'kategori';
    protected $fillable = ['nama_kategori', 'tipe'];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
