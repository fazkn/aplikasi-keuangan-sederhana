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

        $pengeluaranPerKategori = Transaksi::select('kategori', DB::raw('SUM(jumlah) as total'))
        ->where('tipe', 'pengeluaran')
        ->groupBy('kategori')
        ->get();

        return view('dashboard', compact('pemasukan', 'pengeluaran', 'saldo', 'pengeluaranPerKategori'));
    }
}

