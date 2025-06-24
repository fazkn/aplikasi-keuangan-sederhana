<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function create()
    {
        return view('kategori.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|unique:kategori,nama_kategori',
            'tipe' => 'required|in:pemasukan,pengeluaran',
        ]);

        Kategori::create($request->only(['nama_kategori', 'tipe']));
        return redirect()->route('transaksi.create')->with('success', 'Kategori berhasil ditambahkan');
    }

}
