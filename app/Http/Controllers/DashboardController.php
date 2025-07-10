<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->input('bulan', now()->format('m'));
        $tahun = $request->input('tahun', now()->format('Y'));

        $summary = Transaksi::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->selectRaw("
                SUM(CASE WHEN tipe = 'pemasukan' THEN jumlah ELSE 0 END) as pemasukan,
                SUM(CASE WHEN tipe = 'pengeluaran' THEN jumlah ELSE 0 END) as pengeluaran")
            ->first();

        $pemasukan = $summary->pemasukan ?? 0;
        $pengeluaran = $summary->pengeluaran ?? 0; 
        $saldo = $pemasukan - $pengeluaran;

        $pengeluaranPerKategori = Transaksi::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->where('transaksi.tipe', 'pengeluaran')
            ->join('kategori', 'transaksi.kategori_id', '=', 'kategori.id')
            ->select('kategori.nama_kategori', DB::raw('SUM(transaksi.jumlah) as total'))
            ->groupBy('kategori.nama_kategori')
            ->get();

        return view('dashboard', compact('pemasukan', 'pengeluaran', 'saldo', 'pengeluaranPerKategori', 'bulan', 'tahun'));
    }
}

