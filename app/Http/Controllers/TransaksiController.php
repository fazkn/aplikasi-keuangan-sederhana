<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Kategori;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(Request $request)
{
    $bulan = $request->get('bulan') ?? now()->format('Y-m');

    $transaksi = Transaksi::whereYear('tanggal', substr($bulan, 0, 4))
        ->whereMonth('tanggal', substr($bulan, 5, 2))
        ->orderBy('tanggal', 'desc')
        ->get();

    $totalPemasukan = $transaksi->where('tipe', 'pemasukan')->sum('jumlah');
    $totalPengeluaran = $transaksi->where('tipe', 'pengeluaran')->sum('jumlah');
    $saldo = $totalPemasukan - $totalPengeluaran;

    return view('transaksi.index', compact('transaksi', 'totalPemasukan', 'totalPengeluaran', 'saldo', 'bulan'));
}

    public function create()
    {
        $pemasukanKategori = Kategori::where('tipe', 'pemasukan')->get();
        $pengeluaranKategori = Kategori::where('tipe', 'pengeluaran')->get();
        return view('transaksi.create', compact('pemasukanKategori', 'pengeluaranKategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'tipe' => 'required|in:pemasukan,pengeluaran',
            'kategori_id' => 'required|exists:kategori,id',
            'deskripsi' => 'required|string',
            'jumlah' => 'required|numeric|min:0',
        ]);

        Transaksi::create($request->only(['tanggal', 'tipe', 'kategori_id', 'deskripsi', 'jumlah']));
        return redirect()->route('transaksi.index');
    }

    public function show(string $id)
    {
        // Belum digunakan
    }

    public function edit(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $pemasukanKategori = Kategori::where('tipe', 'pemasukan')->get();
        $pengeluaranKategori = Kategori::where('tipe', 'pengeluaran')->get();
        return view('transaksi.edit', compact('transaksi', 'pemasukanKategori', 'pengeluaranKategori'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'tipe' => 'required|in:pemasukan,pengeluaran',
            'kategori_id' => 'required|exists:kategori,id',
            'deskripsi' => 'required|string',
            'jumlah' => 'required|numeric|min:0',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update($request->only(['tanggal','tipe','kategori_id','deskripsi','jumlah']));
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui');
    }

    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        return redirect()->route('transaksi.index');
    }
}
