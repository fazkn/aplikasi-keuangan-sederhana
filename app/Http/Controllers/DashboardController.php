<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        $pemasukan = Transaksi::where('tipe', 'pemasukan')->sum('jumlah');
        $pengeluaran = Transaksi::where('tipe', 'pengeluaran')->sum('jumlah');
        $saldo = $pemasukan - $pengeluaran;

        $pengeluaranPerKategori = DB::table('transaksi')
            ->join('kategori', 'transaksi.kategori_id', '=', 'kategori.id')
            ->select('kategori.nama_kategori', DB::raw('SUM(transaksi.jumlah) as total'))
            ->where('transaksi.tipe', 'pengeluaran')
            ->groupBy('kategori.nama_kategori')
            ->get();

        return view('dashboard', compact('pemasukan', 'pengeluaran', 'saldo', 'pengeluaranPerKategori'));
    }
}

