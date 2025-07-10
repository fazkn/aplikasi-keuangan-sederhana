@extends('layout')

@php
use App\Facades\Format;
use Carbon\Carbon;

$carbon = Carbon::parse($bulan . '-01');
$grouped = $transaksi->groupBy(function($item)
{
    return Format::tanggalIndo($item->tanggal, true);
});

$prevBulan = $carbon->copy()->subMonth()->format('Y-m');
$nextBulan = $carbon->copy()->addMonth()->format('Y-m');
@endphp

@section('content')
<a href="{{ route('transaksi.create') }}" class="btn btn-primary mb-3">+ Tambah Transaksi</a>

<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="{{route('transaksi.index', ['bulan' => $prevBulan]) }}" class="btn btn-outline-secondary">
        &laquo; {{$carbon->copy()->subMonth()->translatedFormat('F Y') }}
    </a>

    <h5 class="mb-0">{{ $carbon->translatedFormat('F Y') }}</h5>

    <a href="{{ route('transaksi.index', ['bulan' => $nextBulan]) }}" class="btn btn-outline-secondary">
        {{ $carbon->copy()->addMonth()->translatedFormat('F Y') }} &raquo;
    </a>
</div>

@forelse ($grouped as $tanggal => $list)
    <div class="mb-4">
        <h5 class="fw-bold text-primary border-bottom pb-2">{{$tanggal}}</h5>
    
    @foreach ($list as $t)
    <div class="card mb-3 shadow-sm {{ $t->tipe === 'pemasukan' ? 'border-success' : 'border-danger' }}">
        <div class="card-body">
            <div class="d-flex justify-content-between flex-column flex-md-row">
                <div class="mb-2 mb-md-0">
                    <h5 class="mb-1">{{ $t->deskripsi }}</h5>
                    <div class="text-muted small">
                        {{ Format::tanggalIndo($t->tanggal, true) }}
                        {{ ucfirst($t->tipe) }} • {{ $t->kategori->nama_kategori ?? '-'}}
                    </div>
                </div>
                <div class="text-end">
                    <h5 class="{{ $t->tipe === 'pemasukan' ? 'text-success' : 'text-danger' }}">
                        {{ Format::rupiah($t->jumlah) }}
                    </h5>
                </div>
            </div>
            <div class="mt-2 d-flex gap-2">
                <a href="{{ route('transaksi.edit', $t->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                <form action="{{ route('transaksi.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Hapus transaksi ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@empty
    <div class="alert alert-info text-center">Belum ada transaksi untuk bulan ini.</div>    
@endempty

<hr>
<h5>Total Pemasukan: {{ Format::rupiah($totalPemasukan) }}</h5>
<h5>Total Pengeluaran: {{ Format::rupiah($totalPengeluaran) }}</h5>
<h5><strong>Saldo: {{ Format::rupiah($saldo) }}</strong></h5>
@endsection
